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

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      //Conseguir usuario identificado
      //$user = \Auth::user();

      $users = User::orderBy('id', 'Desc')->paginate(10);
      $data = ['users' => $users];

      return view('users.index', $data);
    }

    public function create()
    {
      return view('users.create');

    }

    public function edit($id)
    {
      //dd($id);

      $user = User::find($id);

      return view('users.edit', [
        'user' => $user
      ]);
    }

    public function getImage($filename)
    {
      $file = Storage::disk('photousers')->get($filename);
      return new Response($file, 200);
    }

    public function getImageDoc($filename)
    {
      $file = Storage::disk('photoDocusers')->get($filename);
      return new Response($file, 200);
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


    private function perfomrValidationUpdate(Request $request)
    {

      $rules = [
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'typeDoc' => 'required|string|max:255',
        'numberDoc' => 'string|max:255',
        'role' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'cellphone' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'level' => 'required|string|max:255',
        'isActive' => 'required|string|max:255',
        'ownerId' => 'string|max:255',
        'email' => 'string|max:255',
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
      //dd($request->all());

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
                'message' => 'El usuario '.$user->name.' fue creado correctamente!'
        ]);

    }

    public function update(Request $request, $id)
    {

      //dd($request->all());


      $user = User::findOrFail($id);

        //Conseguir usuario identificado
        //$user = \Auth::user();
        //$id = $user->id;
        //$photo = $user->photo;
        //$photoDoc = $user->photoDoc;

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
        //$user->password = $request->input('password');




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
                'message' => 'El usuario '.$user->name.' fue actualizado correctamente!'
        ]);

    }


    public function indexperfil()
    {
      //Conseguir usuario identificado
        $user = \Auth::user();

      return Response()->view('users.indexperfil', [
        'user' => $user
      ]);

    }


}
