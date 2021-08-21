<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membresia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class MembresiaController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        //$membresias = Membresia::all();
        $membresias = Membresia::orderBy('id', 'Desc')->paginate(10);
        $data = ['membresias' => $membresias];

        return view('membresias.index', compact('membresias'));

    }

    public function create()
    {
        return view('membresias.create');

    }

    public function perfomrValidationCreate(Request $request)
    {
        $rules = [
        'name' => 'required|string|min:4|max:255',
        'isActive' => 'required|string|max:255',
        'detail' => 'required|string|max:255',

      ];

        $messages =[

          'name.required' => 'Es necesario ingresar el nombre',
          'name.min' => 'El nombre de la membresía debe tener al menos 4 caracteres',
          'isActive.required' => 'Es necesario ingresar el estado',
          'detail.required' => 'Es necesario ingresar el detalle de la membresía ',

        ];

    $this->validate($request, $rules, $messages);

    }

    public function store(Request $request)
    {
        //dd($request->all());

        $this->perfomrValidationCreate($request);


        $membresia = new Membresia();
        $membresia->name = $request->input('name');
        $membresia->isActive = $request->input('isActive');
        $membresia->detail = $request->input('detail');

        //Subir la imagen photo
        $image_photo = $request->file('image');
        if ($image_photo) {

          //Poner nombre unico
          $image_photo_name = time() . $image_photo->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/users)
          Storage::disk('photoMembership')->put($image_photo_name, File::get($image_photo));

          //Seteo el nombre de la imagen en el objeto
          $user->photo = $image_photo_name;
        }

        $membresia->save(); //INSERT BD

        return redirect('membresias')->with([
                'message' => 'La membresía '.$membresia->name.' fue creada correctamente!'
        ]);

    }

    public function indexuser()
    {

        return view('membresias.indexuser');

    }

}
