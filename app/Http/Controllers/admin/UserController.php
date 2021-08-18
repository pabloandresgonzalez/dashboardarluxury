<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

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

      $users = User::orderBy('id', 'Desc')->get();
      $data = ['users' => $users];

      return view('users.index', $data);
    }

    public function create()
    {
      return view('users.create');

    }

    public function edit($id)
    {
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

    public function store(Request $request)
    {

      //Conseguir usuario identificado
      //$userAuth = \Auth::user();


        //Validacion del formulario
        $validate = $this->validate($request, [
          'name' => 'required|string|max:255',
          'lastname' => 'required|string|max:255',
          'numberDoc' => 'required|string|max:255|unique:users,email,'. $id,
          'phone' => 'required|string|max:255',
          'cellphone' => 'required|string|max:255',
          'country' => 'required|string|max:255',
          'level' => 'required|string|max:255',
          'isActive' => 'required|string|max:255',
          'ownerId' => 'required|string|max:255',
        ]);


        //Recoger los datos del formulario
        $name = $request->input('name');
        $lastname =  $request->input('lastname');
        $phone = $request->input('phone');
        $cellphone = $request->input('cellphone');
        $country = $request->input('country');
        $level = $request->input('level');
        $isActive = $request->input('isActive');
        $ownerId = $request->input('ownerId');
        $typeDoc = $request->input('typeDoc');


        //Asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->lastname = $lastname;
        $user->phone = $phone;
        $user->cellphone = $cellphone;
        $user->country = $country;
        $user->level = $level;
        $user->isActive = $isActive;
        $user->ownerId = $ownerId;
        $user->typeDoc = $typeDoc;


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
        else {

          $user->photo = $photo;

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
        else {

          $user->photoDoc = $photoDoc;

        }


        //Ejecutar consulta y actualizar registro de BD
        $user->create();


        return redirect('users')->with([
                'message' => 'Usuario creado correctamente!'
        ]);


    }



    public function update(Request $request)
    {
        //Conseguir usuario identificado
        $user = \Auth::user();
        $id = $user->id;
        $photo = $user->photo;
        $photoDoc = $user->photoDoc;


        //Validacion del formulario
        $validate = $this->validate($request, [
          'name' => 'required|string|max:255',
          'lastname' => 'required|string|max:255',
          'numberDoc' => 'required|string|max:255|unique:users,email,'. $id,
          'phone' => 'required|string|max:255',
          'cellphone' => 'required|string|max:255',
          'country' => 'required|string|max:255',
          'level' => 'required|string|max:255',
          'isActive' => 'required|string|max:255',
          'ownerId' => 'required|string|max:255',
        ]);


        //Recoger los datos del formulario
        $name = $request->input('name');
        $lastname =  $request->input('lastname');
        $phone = $request->input('phone');
        $cellphone = $request->input('cellphone');
        $country = $request->input('country');
        $level = $request->input('level');
        $isActive = $request->input('isActive');
        $ownerId = $request->input('ownerId');
        $typeDoc = $request->input('typeDoc');


        //Asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->lastname = $lastname;
        $user->phone = $phone;
        $user->cellphone = $cellphone;
        $user->country = $country;
        $user->level = $level;
        $user->isActive = $isActive;
        $user->ownerId = $ownerId;
        $user->typeDoc = $typeDoc;


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
        else {

          $user->photo = $photo;

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
        else {

          $user->photoDoc = $photoDoc;

        }


        //Ejecutar consulta y actualizar registro de BD
        $user->update();


        return redirect('user')->with([
                'message' => 'El usuario '.$user->name.' fue actualizado correctamente!'
        ]);


    }

}
