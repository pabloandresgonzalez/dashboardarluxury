<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UserMembership;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Membresia;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusChangeMessage;
use App\Mail\MembershipCreatedMessage;
use App\Mail\MembershipPurchaseMessage;
use App\Exports\UsersMembershipsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\wallet_transactions;
use App\Models\NetworkTransaction;
use Carbon\Carbon;


class UserMembershipController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //Conseguir usuario identificado
        $user = \Auth::user();
        $iduser = $user->id;

        $nombre = $request->get('buscarpor');

        // Buscador 
        $memberships = UserMembership::where('membership', 'LIKE', "%$nombre%")
        ->orwhere('user_name', 'LIKE', "%$nombre%")
        ->orwhere('user_email', 'LIKE', "%$nombre%")
        ->orwhere('hash', 'LIKE', "%$nombre%")
        ->orwhere('typeHash', 'LIKE', "%$nombre%")
        ->orwhere('status', 'LIKE', "%$nombre%")
        ->orderBy('created_at', 'desc')
        ->paginate(100);

        // total de usuarios
        $totalusers = User::count();

        return view('memberships.index', [
        'memberships' => $memberships,
        'totalusers' => $totalusers
        ]);

    }

    public function create()
    {       

        // Conseguir usuario identificado
        $user = \Auth::user();
        $iduser = $user->id;

        // Conseguir UserMembership de usuario identificado
        $memberships = UserMembership::where('user', $user->id)->orderBy('id', 'desc')->get()->toArray();

        // Conseguir membresias de usuario identificado
        //$membresias = DB::table('membresias')->pluck()->toArray();
        $membresias = Membresia::orderBy('id', 'Desc')->get();

        // total de usuarios
        $totalusers = User::count();


        return view('memberships.create', compact('membresias', 'totalusers'));

    }

    public function edit($id) {
        
        $memberships = UserMembership::find($id);        
        $fecha_actual = date("Y-m-d H:i:s");

        // total de usuarios
        $totalusers = User::count();

        return view('memberships.edit', [
          'memberships' => $memberships,
          'fecha_actual' => $fecha_actual,
          'totalusers' => $totalusers
      ]);

    }

    public function store(Request $request)
    {
   
        //Conseguir usuario identificado
        $user = \Auth::user();
        $id = $user->id;
        $name = $user->name;
        $email = $user->email;

        // reglas de validacion  
        $rules = ([
            
            //'id_membresia' => 'exists:App\Models\UserMembership',
            'id_membresia' => 'required|string',  //|unique:user_memberships|min:4
            //'membership' => 'required|string',  //|unique:user_memberships|min:4      
            'hash' => 'required|max:255|unique:user_memberships', //|unique:user_memberships
            'typeHash' => 'required|max:255',       
            'image' => 'file',             
            
        ]);

       $this->validate($request, $rules);


       $id_membresia = Membresia::find($id);

       $membresia = Membresia::find($request->input('id_membresia'));
       $namemembresia =$membresia->name;

       $membershipsuser = UserMembership::where('user', $user->id)
        ->Where('membership', $namemembresia)
        ->where('status', 'Activo')
        ->get()->toArray();

        if ($membershipsuser) {

          return redirect()->route('home')->with([
                    'message' => 'Ya cuentas con una membresia de este valor activa!'
          ]);
          
        }

              
        $fecha_actual = date("Y-m-d H:i:s");                       

        $membership = new UserMembership();
        $membership->id_membresia = $request->input('id_membresia');
        $membership->membresiaPadre = 0;
        $membership->membership = $namemembresia;
        $membership->user_email = $email;
        $membership->user = $id;
        $membership->user_name = $name;
        $membership->hash = $request->input('hash');
        $membership->typeHash = $request->input('typeHash');     
        $membership->detail = 'Pendiente';
        $membership->status = 'Pendiente';
        $membership->closedAt = null;
        $membership->activedAt = null;

        //Subir la imagen imagehash
        $image_photo = $request->file('image');
        if ($image_photo) {

          //Poner nombre unico
          $image_photo_name = time() . $image_photo->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/imagehash)
          Storage::disk('imagehash')->put($image_photo_name, File::get($image_photo));

          //Seteo el nombre de la imagen en el objeto
          $membership->image = $image_photo_name;
        }

        $membership->save();// INSERT BD

        //Enviar email
        $user_email = User::where('role', 'admin')->first();
        $user_email_admin = $user_email->email;

        Mail::to($user_email_admin)->send(new MembershipCreatedMessage($membership));

        Mail::to($email)->send(new MembershipPurchaseMessage($membership));

        // total de usuarios
        $totalusers = User::count();

        return redirect()->route('home')->with([
                    'message' => 'Hash enviado correctamente!',
                    'totalusers' => $totalusers
        ]);

    }

    public function update(Request $request, $id)
    {   

        //Validacion del formulario
        $validate = $this->validate($request, [
            'membership' => 'required|string|min:4',        
            //'hash' => 'required|max:255|unique:user_memberships', 
            'typeHash' => 'required|max:255',  
            //'detail' => 'required|max:255', 
            'activedAt'=>'required|date_format:Y-m-d H:i:s',
            //'closedAt' => 'required|max:255',    
            'image' => 'file',
        ]);

        $membership = UserMembership::findOrFail($id);
        $membership->membership = $request->input('membership');
        $membership->typeHash = $request->input('typeHash');
        $membership->detail = $request->input('status');
        $membership->activedAt = $request->input('activedAt');
        $membership->closedAt = $request->input('closedAt');
        $membership->status = $request->input('status');
     

        //Subir la imagen photo
        $image_photo = $request->file('image');
        if ($image_photo) {

          //Poner nombre unico
          $image_photo_name = time() . $image_photo->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/imagehash)
          Storage::disk('imagehash')->put($image_photo_name, File::get($image_photo));

          //Seteo el nombre de la imagen en el objeto
          $membership->image = $image_photo_name;
        }

        $membership->save(); //INSERT BD
        
        //Enviar email
        $user_email = $membership->user_email;

        Mail::to($user_email)->send(new StatusChangeMessage($membership));    

        // total de usuarios
        $totalusers = User::count();  

        return redirect()->route('home')->with([
                    'message' => 'Membership editado correctamente!',
                    'totalusers' => $totalusers
        ]);

    }

    public function indexUserMemberships()
    {

      //Conseguir usuario identificado
      $user = \Auth::user();
      $username = $user->name;

      $memberships = UserMembership::where('user', $user->id)
        ->orderBy('created_at', 'desc')
        ->paginate(30);

      // total de usuarios
      $totalusers = User::count();

      return view('memberships.mismemberships', [
          'memberships' => $memberships,
          'user' => $user,
          'totalusers' => $totalusers,
          'username' => $username
      ]);

    }

    public function getImage($filename)
    {
      // obtener imagen avatar
      $file = Storage::disk('imagehash')->get($filename);
      return new Response($file, 200);
    }

    public function orden($id)
    {      
        $membership = UserMembership::find($id);

        // total de usuarios
        $totalusers = User::count();

        return view('memberships.soporte', [
            'membership' => $membership,
            'totalusers' => $totalusers
        ]);

    }

    public function pagos(Request $request, $id)
    {
        $totalusers = User::count();
        $membership = UserMembership::findOrFail($id);        
        //$networktransaction = NetworkTransaction::findOrFail($request->user);
        //dd($membership);
        return view('networktransaction.index', compact('totalusers'));

    }

    public function editrenovar($id)
    {

        //Conseguir usuario identificado
        $user = \Auth::user();
        $iduser = $user->id;

        $data = [
          'userId' => $iduser,
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

        if ($result) {
          $url = ($result);
                $data = json_decode($url, true);
          if (isset($data['total'])) {
            
              $total = $data['total']; 
              //echo $balancecho;
          }else {
            
          } 
        } 

        //dd($total);

        $totalusers = User::count();

        $memberships = UserMembership::where('user', $iduser)
        ->where('status', 'Activo')
        ->paginate(50);

        $cantmemberships = $memberships->count();

        $memberships = UserMembership::find($id);
        $id_membresia = $memberships->id_membresia;

        $membresia = Membresia::where('id', $id_membresia)->first();
        $valor_membresia = $membresia->valor;


        if ($total > $valor_membresia || $cantmemberships > 0) {

                    
          return view('memberships.renovar', [
                'memberships' => $memberships,
                'user' => $user,
                'result' => $result,
                'totalusers' => $totalusers,
                'valor_membresia' => $valor_membresia
              ]);             

        }


          return redirect()->route('home')->with([
                  'message' => 'Debes tener saldo suficiente o al menos una membresía activa para renovar!',
                  'totalusers' => $totalusers
              ]); 

    }

    public function renovar(Request $request, $id)
    {

        //Conseguir usuario identificado
        $user = \Auth::user();
        $iduser = $user->id;
        $name = $user->name;
        $email = $user->email;


        $totalusers = User::count();

        $membershippadre = UserMembership::findOrFail($id);
        $id_membresia = $membershippadre->id_membresia;
        $typeHash =  $membershippadre->typeHash;


        $membresia = Membresia::where('id', $id_membresia)->first();
        $valor_membresia = $membresia->valor;

        $data = [
          'userId' => $iduser,
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


        $valor_saldo  = $respuestaDecodificada->total;

        $percentage = 5;
        $valmembresia = $valor_membresia;

        $toPorcMemberschip = ($percentage / 100) * $valmembresia;

        $percentageuser = 2;

        $toPorcMemberschiprefe = ($percentageuser / 100) * $valmembresia;


        if ($valor_membresia > $valor_saldo) {
            
            return redirect()->route('home')->with([
                    'message' => 'Saldo insuficiente para renovar!',
                    'totalusers' => $totalusers,
                    'valor_membresia' => $valor_membresia
                ]); 

        }

        //Validacion del formulario
        $validate = $this->validate($request, [
            'membership' => 'required|string|min:4',        
            //'hash' => 'required|max:255|unique:user_memberships', 
            //'typeHash' => 'required|max:255',  
            //'detail' => 'required|max:255', 
            //'activedAt' => 'required|max:255',
            //'closedAt' => 'required|max:255',    
            //'image' => 'file',
        ]);      

        $membership = new UserMembership();
        $membership->id_membresia = $id_membresia;
        $membership->membresiaPadre = $id;
        $membership->membership = $request->input('membership');
        $membership->user_email = $email;
        $membership->user = $iduser;
        $membership->user_name = $name;
        $membership->hash = 'Descuento de saldo '.bin2hex(random_bytes(20));
        $membership->typeHash = $typeHash;     
        $membership->detail = 'Activo';
        $membership->status = 'Activo';
        $membership->closedAt = null;
        $fecha_actual = date("Y-m-d H:i:s");
        $membership->activedAt = $fecha_actual;

        //Subir la imagen imagehash
        $image_photo = $request->file('image');
        if ($image_photo) {

          //Poner nombre unico
          $image_photo_name = time() . $image_photo->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/imagehash)
          Storage::disk('imagehash')->put($image_photo_name, File::get($image_photo));

          //Seteo el nombre de la imagen en el objeto
          $membership->image = $image_photo_name;
        }


        $membershipInicial = UserMembership::findOrFail($id);
        $membershipInicial->status = 'Terminada';
        $membershipInicial->detail = 'Terminada';

        $membership->save();// INSERT BD
        $membershipInicial->save();


        //Se registra el descuento por renovar 
        $Wallet = new wallet_transactions();
        $Wallet->user = $iduser;
        $Wallet->email = $email;
        $Wallet->value = $valor_membresia + $toPorcMemberschip;
        $Wallet->fee = $toPorcMemberschip;
        $Wallet->type = 0;
        $Wallet->hash = 'Descuento para renovar '.bin2hex(random_bytes(20));
        $Wallet->currency = $typeHash;//$request->input('currency');
        $Wallet->approvedBy = $email;
        $Wallet->inOut = 0;
        $Wallet->status = 'Aprobada';     
        $Wallet->detail = 'Descuento para renovar membresia';


        $Wallet->save();// INSERT BD
       

        return redirect()->route('home')->with([
                    'message' => 'Hash de renovación enviado correctamente!',
                    'totalusers' => $totalusers
                    
        ]);
        
    }

    public function detail($id) {

      $membership = UserMembership::find($id);
      $totalusers = User::count();

      return view('memberships.detail', [
          'membership' => $membership,
          'totalusers' => $totalusers
      ]);
    }

    public function exportExcel()
    {
      return Excel::download(new UsersMembershipsExport, 'memberships.xlsx');
    }
    
}