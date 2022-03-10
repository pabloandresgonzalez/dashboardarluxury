<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membresia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\Membership;
use App\Models\User;
use DB;

class MembresiaController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total produccion del usuario 
      $totalProduction = $this->totalProduction();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      $membresias = Membresia::orderBy('created_at', 'asc')->paginate(20);
      $data = ['membresias' => $membresias];

      return view('membresias.index', compact('membresias', 'totalusers', 'totalCommission', 'totalProduction'));

    }

    public function create()
    {
      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total produccion del usuario 
      $totalProduction = $this->totalProduction();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      return view('membresias.create', compact('totalusers', 'totalCommission', 'totalProduction'));

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
      ->where('type', 'Activation')
      ->get()->sum("value");

      return $totalCommission;
    }

    private function totalProduction()
    {
      // Conseguir usuario identificado
      $user = \Auth::user();
      $id = $user->id;

      // Total usuarios
      $totalProduction = DB::table("network_transactions")
      ->where('user', $id)
      ->where('type', 'Daily')
      ->get()->sum("value");

      return $totalProduction;
    }

    public function perfomrValidationCreate(Request $request)
    {
        $rules = [
        'name' => 'required|string|min:4|max:255',
        'isActive' => 'required|string|max:255',
        'detail' => 'required|string|max:255',
        'valor' => 'required|string|max:255',
        'image' => 'file',

      ];

        $messages =[

          'name.required' => 'Es necesario ingresar el nombre',
          'name.min' => 'El nombre de la membresía debe tener al menos 4 caracteres',
          'isActive.required' => 'Es necesario ingresar el estado',
          'valor.required' => 'Es necesario ingresar el valor',
          'detail.required' => 'Es necesario ingresar el detalle de la membresía ',

        ];

    $this->validate($request, $rules, $messages);

    }

    public function store(Request $request)
    {

        $this->perfomrValidationCreate($request);


        $membresia = new Membresia();
        $membresia->name = $request->input('name');
        $membresia->isActive = $request->input('isActive');
        $membresia->valor = $request->input('valor');
        $membresia->detail = $request->input('detail');

        //Subir la imagen photo
        $image_photo = $request->file('image');
        if ($image_photo) {

          //Poner nombre unico
          $image_photo_name = time() . $image_photo->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/photoMembership)
          Storage::disk('photoMembership')->put($image_photo_name, File::get($image_photo));

          //Seteo el nombre de la imagen en el objeto
          $membresia->photo = $image_photo_name;
        }

        $membresia->save(); //INSERT BD

        // Total comission del usuario 
        $totalCommission = $this->totalCommission();

        // Total produccion del usuario 
        $totalProduction = $this->totalProduction();

        // Total usuarios
        $totalusers = $totalusers = $this->countUsers();

        return redirect('membresias')->with([
                'message' => 'La tarjeta de membresía '.$membresia->name.' fue creada correctamente!',
                'totalusers' => $totalusers,
                'totalCommission' => $totalCommission,
                'totalProduction' => $totalProduction
        ]);

    }

    public function indexuser()
    {
      
      $membresias = Membresia::orderBy('created_at', 'asc')->paginate(10);
      $data = ['membresias' => $membresias];

      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total produccion del usuario 
      $totalProduction = $this->totalProduction();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      return view('membresias.indexuser', compact('membresias', 'totalusers', 'totalCommission', 'totalProduction'));

    }

    public function edit($id)
    {
        
      $membresias = Membresia::find($id);

      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total produccion del usuario 
      $totalProduction = $this->totalProduction();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      return view('membresias.edit', [
        'membresias' => $membresias,
        'totalusers' => $totalusers,
        'totalCommission' => $totalCommission,
        'totalProduction' => $totalProduction
      ]);

  }

    public function update(Request $request, $id)
    {
        
      //Validacion del formulario
      $validate = $this->validate($request, [
          'name' => 'required|string|min:4|max:255',
          'isActive' => 'required|string|max:255',
          'detail' => 'required|string|max:255',
          'valor' => 'required|string|max:255',
          'image' => 'file'
      ]);


      $membresia = Membresia::findOrFail($id);
      $membresia->name = $request->input('name');
      $membresia->isActive = $request->input('isActive');
      $membresia->valor = $request->input('valor');
      $membresia->detail = $request->input('detail');

      //Subir la imagen photo
      $image_photo = $request->file('image');
      if ($image_photo) {

        //Poner nombre unico
        $image_photo_name = time() . $image_photo->getClientOriginalName();

        //Guardarla en la carpeta storage (storage/app/photoMembership)
        Storage::disk('photoMembership')->put($image_photo_name, File::get($image_photo));

        //Seteo el nombre de la imagen en el objeto
        $membresia->image = $image_photo_name;
      }

      $membresia->save(); //INSERT BD

      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total produccion del usuario 
      $totalProduction = $this->totalProduction();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      return redirect('membresias')->with([
              'message' => 'La tarjeta de membresía '.$membresia->name.' fue actualizada correctamente!',
              'totalusers' => $totalusers,
              'totalCommission' => $totalCommission,
              'totalProduction' => $totalProduction
      ]);

    }

    public function createMemberchip()
    {  
      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total produccion del usuario 
      $totalProduction = $this->totalProduction();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

        return view('memberchip.index', compact('totalusers', 'totalCommission', 'totalProduction'));        

    }

    public function detail($id)
    {

      $membresia = Membresia::find($id);

      // Total comission del usuario 
      $totalCommission = $this->totalCommission();

      // Total produccion del usuario 
      $totalProduction = $this->totalProduction();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      return view('membresias.detail', [
          'membresia' => $membresia,
          'totalusers' => $totalusers,
          'totalCommission' => $totalCommission,
          'totalProduction' => $totalProduction
      ]);
    }

}
