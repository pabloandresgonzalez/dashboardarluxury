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

        //return view('memberships.index');
        //echo "string";

        //$memberships = Membresia::all();
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

        //return view('membresias.create');

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
        //$photo = $user->photo;
        //$photoDoc = $user->photoDoc;

        //dd($request->all());


        //$this->perfomrValidationCreate($request);

        /*
        $hashUSDT = $request->input('hashUSDT');

        if ($hashUSDT) {
            $hashUSDT = 'hashUSDT';
            $hashBTC = 'NA';
        } else {
            $hashUSDT = 'NA';
            $hashBTC = 'hashBTC';
        }
        */

           

        $fecha_actual = date("Y-m-d H:i:s");
        /*
        //sumo 30 días
        $datecierre = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 30 days"));

        $date_expire = $datecierre;  
        $date = new DateTime($date_expire);
        $now = new DateTime();

        $date->diff($now)->format("%d days, %h hours and %i minuts");
        */


        $membership = new UserMembership();
        $membership->membership = $request->input('membership');
        $membership->user = $id;
        $membership->hash = $request->input('hash');
        $membership->typeHash = $request->input('typeHash');     
        $membership->detail = 'Pendiente';
        $membership->status = 'Pendiente';
        $membership->closedAt = $fecha_actual; //imagehash

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


        //dd($membership);
        $membership->save();// INSERT BD

        //return redirect('home');

        return redirect()->route('home')->with([
                    'message' => 'Hash enviado correctamente!'
        ]);

    }

    
}
