<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Traits\UsesUuid;
use App\Traits\AutoGenerateUuid;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Models\UserMembership;
use App\Models\wallet_transactions;
use App\Exports\WalletTransactionsExport;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index(Request $request)
    {
      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      $nombre = $request->get('buscarpor');
      
      // Buscador
      $users = User::where('name', 'LIKE', "%$nombre%")
      ->orwhere('lastname', 'LIKE', "%$nombre%")
      ->orwhere('role', 'LIKE', "%$nombre%")
      ->orwhere('email', 'LIKE', "%$nombre%")
      ->orderBy('created_at', 'desc')
      ->paginate(50);

      return view('users.index', [
      'users' => $users,
      'totalusers' => $totalusers,
      'totalCommission' => $totalCommission
      ]);            

    }

    public function create()
    {
      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      return view('users.create', compact('totalusers', 'totalCommission'));

    }

    public function edit($id)
    {
      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      $user = User::find($id);

      return view('users.edit', [
        'user' => $user,
        'totalusers' => $totalusers,
        'totalCommission' => $totalCommission
      ]);
    }

    public function getImage($filename)
    {
      // Obtener imagen de avatar
      $file = Storage::disk('photousers')->get($filename);
      return new Response($file, 200);
    }

    public function getImageDoc($filename)
    {
      // Obtener imagen de soporte de pago
      $file = Storage::disk('photoDocusers')->get($filename);
      return new Response($file, 200);
    }

    private function countUsers()
    {
      // Conseguir usuario identificado
      $user = \Auth::user();
      $id = $user->id;

      // Total usuarios
      $totalusers = DB::table('users')
            ->where('ownerId', $id)->count();

      return $totalusers;
    }

    private function totalCommission()
    {
      // Conseguir usuario identificado
      $user = \Auth::user();
      $id = $user->id;

      // Total usuarios
      $totalCommission = DB::table("network_transactions")
      ->where('user', $id)
      ->get()->sum("value");

      return $totalCommission;
    }

    private function perfomrValidationCreate(Request $request)
    {
      $rules = [
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'typeDoc' => 'required|string|max:255',
        'numberDoc' => 'required|string|max:255|unique:users',
        'role' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'cellphone' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'level' => 'required|string|max:255',
        'isActive' => 'required|string|max:255',
        'ownerId' => 'required|string|max:255',
        'email' => 'required|string|max:255|unique:users,email',
      ];

      $messages =[

        'name.required' => 'Es necesario ingresar el nombre',
        'lastname.required' => 'Es necesario ingresar el apellido',
        'typeDoc.required' => 'Es necesario ingresar el tipo de documento',
        'numberDoc.required' => 'Es necesario ingresar el numero docuemnto',
        'role.required' => 'Es necesario ingresar el tipo de rol',
        'phone.required' => 'Es necesario ingresar el telefono',
        'cellphone.required' => 'Es necesario ingresar el numero de movil',
        'country.required' => 'Es necesario ingresar el país',
        'level.required' => 'Es necesario ingresar el nivel',
        'isActive.required' => 'Es necesario ingresar el estado',
        'ownerId' => 'Es necesario ingresar el Código de referido',
        'email' => 'Es necesario ingresar el email',
        'password' => 'Es necesario ingresar el password',
      ];

    $this->validate($request, $rules, $messages);

    }

    public function store(Request $request)
    {
      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      $this->perfomrValidationCreate($request);


      $user = new User();
      $user->name = $request->input('name');
      $user->lastname = $request->input('lastname');
      $user->typeDoc = $request->input('typeDoc');
      $user->numberDoc = $request->input('numberDoc');
      $user->role = $request->input('role');
      $user->phone = $request->input('phone');
      $user->cellphone = $request->input('cellphone');
      $user->country = $request->input('country');
      $user->level = $request->input('level');
      $user->isActive = $request->input('isActive');
      $user->ownerId = $request->input('ownerId');
      $user->email = $request->input('email');
      $user->password = bcrypt($request->input('password'));

      //Subir la imagen photo
        $image_photo = $request->file('photo');
        if ($image_photo) {

          //Poner nombre unico
          $image_photo_name = time() . $image_photo->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/users)
          Storage::disk('photousers')->put($image_photo_name, File::get($image_photo));

          //Seteo el nombre de la imagen en el objeto
          $user->photo = $image_photo_name;
        }

        //Subir la imagen photoDoc
        $image_photoDoc = $request->file('photoDoc');

        if ($image_photoDoc) {

          //Poner nombre unico
          $image_photoDoc_name = time() . $image_photoDoc->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/users)
          Storage::disk('photoDocusers')->put($image_photoDoc_name, File::get($image_photoDoc));

          //Seteo el nombre de la imagen en el objeto
          $user->photoDoc = $image_photoDoc_name;
        }


      $user->save(); //INSERT EN BD


      return redirect('user')->with([
                'message' => 'El usuario '.$user->name.' fue creado correctamente!',
                'totalusers' => $totalusers,
                'totalCommission' => $totalCommission
        ]);

    }

    public function update(Request $request, $id)
    {

      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      $user = User::findOrFail($id);
      
      //Validacion del formulario
      $validate = $this->validate($request, [
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'typeDoc' => 'required|string|max:255',
        'numberDoc' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'cellphone' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'level' => 'required|string|max:255',
        'isActive' => 'required|string|max:255',
        'ownerId' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'photo' => 'file',
        'photo' => 'file',
      ]);


      //Recoger los datos del formulario
      $user->name = $request->input('name');
      $user->lastname = $request->input('lastname');
      $user->typeDoc = $request->input('typeDoc');
      $user->numberDoc = $request->input('numberDoc');
      $user->role = $request->input('role');
      $user->phone = $request->input('phone');
      $user->cellphone = $request->input('cellphone');
      $user->country = $request->input('country');
      $user->level = $request->input('level');
      $user->isActive = $request->input('isActive');
      $user->ownerId = $request->input('ownerId');
      $user->email = $request->input('email');
      $user->password = bcrypt($request->input('password'));


        //Subir la imagen photo
        $image_photo = $request->file('photo');
        if ($image_photo) {

          //Poner nombre unico
          $image_photo_name = time() . $image_photo->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/users)
          Storage::disk('photousers')->put($image_photo_name, File::get($image_photo));

          //Seteo el nombre de la imagen en el objeto
          $user->photo = $image_photo_name;
        }


        //Subir la imagen photoDoc
        $image_photoDoc = $request->file('photoDoc');

        if ($image_photoDoc) {

          //Poner nombre unico
          $image_photoDoc_name = time() . $image_photoDoc->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/users)
          Storage::disk('photoDocusers')->put($image_photoDoc_name, File::get($image_photoDoc));

          //Seteo el nombre de la imagen en el objeto
          $user->photoDoc = $image_photoDoc_name;
        }


        //Ejecutar consulta y actualizar registro de BD
        $user->save();


        return redirect('user')->with([
                'message' => 'La informacion de '.$user->name.', fue actualizada correctamente!',
                'totalusers' => $totalusers,
                'totalCommission' => $totalCommission
        ]);

    }

    public function updateUser(Request $request, $id)
    {
      
      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      $user = User::findOrFail($id);
      $name = $user->name;
      $lastname = $user->lastname;
      $typeDoc = $user->typeDoc;
      $numberDoc = $user->numberDoc;
      $role = $user->role;
      //$phone = $user->phone;
      //$cellphone = $user->cellphone;
      $country = $user->country;
      $level = $user->level;
      $isActive = $user->isActive;
      $ownerId = $user->ownerId;
      $email = $user->email;


      //Validacion del formulario
      $validate = $this->validate($request, [          
        'phone' => 'required|string|max:255',
        'cellphone' => 'required|string|max:255',
        'photo' => 'file',
        'photoDoc' => 'file',
      ]);


      //Recoger los datos del formulario
      $user->name = $name;
      $user->lastname = $lastname;
      $user->typeDoc = $typeDoc;
      $user->numberDoc = $numberDoc;
      $user->role = $role;
      $user->phone = $request->input('phone');
      $user->cellphone = $request->input('cellphone');
      $user->country = $country;
      $user->level = $level;
      $user->isActive = $isActive;
      $user->ownerId = $ownerId;
      $user->email = $email;


        //Subir la imagen photo
        $image_photo = $request->file('photo');
        if ($image_photo) {

          //Poner nombre unico
          $image_photo_name = time() . $image_photo->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/users)
          Storage::disk('photousers')->put($image_photo_name, File::get($image_photo));

          //Seteo el nombre de la imagen en el objeto
          $user->photo = $image_photo_name;
        }


        //Subir la imagen photoDoc
        $image_photoDoc = $request->file('photoDoc');

        if ($image_photoDoc) {

          //Poner nombre unico
          $image_photoDoc_name = time() . $image_photoDoc->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/users)
          Storage::disk('photoDocusers')->put($image_photoDoc_name, File::get($image_photoDoc));

          //Seteo el nombre de la imagen en el objeto
          $user->photoDoc = $image_photoDoc_name;
        }


        //Ejecutar consulta y actualizar registro de BD
        $user->save();


        return redirect('home')->with([
                'message' => $user->name.', tu informacion fue actualizada correctamente!',
                'totalusers' => $totalusers,
                'totalCommission' => $totalCommission
        ]);

    }


    public function indexperfil()
    {
      // Conseguir usuario identificado
      $user = \Auth::user();
      $id = $user->id;

      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      return Response()->view('users.indexperfil', [
        'user' => $user,
        'totalusers' => $totalusers,
        'totalCommission' => $totalCommission
      ]);

    }

    public function detail($id)
    {
      //dd($id);
      
      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      $Wallets = wallet_transactions::where('user', $id)->orderBy('id', 'desc')
        ->paginate(100);
      
      $user = User::find($id);

      $data = [
      'userId' => $id,
      'token' => 'AcjAa76AHxGRdyTemDb2jcCzRmqpWN'
      ];

      $curl = curl_init();

      curl_setopt_array($curl, array(
          CURLOPT_URL => "https://ekgra7pfqh.execute-api.us-east-2.amazonaws.com/Prod_getBalanceByUser",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30000,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data),        
          CURLOPT_HTTPHEADER => array(
            // Set here requred headers
              "accept: */*",
              "accept-language: en-US,en;q=0.8",
              "content-type: application/json",
          ),
      ));

      $result = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);



      //decodificar JSON porque esa es la respuesta
      $respuestaDecodificada = json_decode($result);

      return view('users.detail', [
          'user' => $user,
          'totalusers' => $totalusers,
          'totalCommission' => $totalCommission,
          'Wallets' => $Wallets,
          'result' => $result,
      ]);
    } 

    public function exportExcel()
    {
      // Exportar tabla user a excel
      return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function indexRed()
    {

      // Conseguir usuario identificado
      $user = \Auth::user();
      $id = $user->id;

      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();
     
      $misusers1 = DB::table('users')
            ->where('ownerId', $id)
            ->join('user_memberships', 'user_memberships.user', '=', 'users.id')
            //->join('orders', 'users.id', '=', 'orders.user_id')
            //->select('users.*', 'contacts.phone', 'orders.price')
            ->get();

      $networktransactions = DB::select('SELECT u.*, nt.*   
        FROM network_transactions as nt
        INNER JOIN user_memberships as um ON nt.userMembership = um.id
        INNER JOIN users as u ON um.user = u.id
        WHERE nt.type="Activation" AND
        nt.user = ?', [$id]);

      return view('users.detailred', [
          'user' => $user,
          //'misusers' => $misusers,
          'totalusers' => $totalusers,
          'misusers1' => $misusers1,
          'networktransactions' => $networktransactions,
          'totalCommission' => $totalCommission
      ]);
    } 

    public function exportExcelMovimientos()
    {
      return Excel::download(new WalletTransactionsExport, 'movimientos.xlsx');
    }

}
