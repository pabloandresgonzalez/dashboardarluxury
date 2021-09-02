<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMembership;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class UserMembershipController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {

        $memberships = UserMembership::orderBy('id', 'Desc')->paginate(50);
        $data = ['memberships' => $memberships];

        return view('memberships.index', compact('memberships'));

    }

    public function create()
    {
        return view('memberships.create');


    }

    public function edit($id) {
        
        $memberships = UserMembership::find($id);


        return view('memberships.edit', [
          'memberships' => $memberships
      ]);

    }

    public function store(Request $request)
    {
        

        $rules = ([
            
            'membership' => 'required|string|min:4',        
            'hash' => 'required|max:255|unique:user_memberships', 
            'typeHash' => 'required|max:255',       
            'image' => 'file',             
            
        ]);


       $this->validate($request, $rules);


        //Conseguir usuario identificado
        $user = \Auth::user();
        $id = $user->id;
           

        $fecha_actual = date("Y-m-d H:i:s");


        $membership = new UserMembership();
        $membership->membership = $request->input('membership');
        $membership->user = $id;
        $membership->hash = $request->input('hash');
        $membership->typeHash = $request->input('typeHash');     
        $membership->detail = 'Pendiente';
        $membership->status = 'Pendiente';
        $membership->closedAt = $fecha_actual; //imagehash

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

        //return redirect('home');

        return redirect()->route('home')->with([
                    'message' => 'Hash enviado correctamente!'
        ]);

    }

    public function update(Request $request, $id)
    {
        

        /*
        //Conseguir usuario identificado
        $user = \Auth::user();
        $id = $user->id;

        $membership = UserMembership::findOrFail($id);
        $membership->hash;
        */


        //Validacion del formulario
        $validate = $this->validate($request, [
            'membership' => 'required|string|min:4',        
            //'hash' => 'required|max:255|unique:user_memberships', 
            'typeHash' => 'required|max:255',  
            'detail' => 'required|max:255',     
            'image' => 'file',
        ]);


        $membership = UserMembership::findOrFail($id);
        $membership->membership = $request->input('membership');
        $membership->typeHash = $request->input('typeHash');
        $membership->detail = $request->input('detail');
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

        return redirect()->route('home')->with([
                    'message' => 'Membership editado correctamente!'
        ]);


    }


    
}
