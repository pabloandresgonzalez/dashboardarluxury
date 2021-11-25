<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NetworkTransaction;
use App\Models\UserMembership;
use App\Models\User;
use App\Models\Membresia;

class NetworkTransactionController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index(Request $request)
    {

        //Conseguir usuario identificado
        $user = \Auth::user();

        $id = $request->id;
        $networktransactions = NetworkTransaction::where('userMembership', $id)
                                ->where('type', 'Daily')
                                ->orderBy('id', 'desc')->paginate(50);

        $totalusers = User::count(); 

        return view('networktransaction.index', compact('networktransactions', 'totalusers'));        

    }

    public function indexactivacion(Request $request)
    {

        //Conseguir usuario identificado
        $user = \Auth::user();
        $iduser = $user->id;

        $id = $request->id;
        //$networktransactions = NetworkTransaction::where('user', $iduser)->orderBy('id', 'desc')->paginate(40);
        //dd($networktransactions);
        $networktransactions = NetworkTransaction::where( 'user', $iduser)
                                ->where('type', 'Activation')
                                ->orderBy('id', 'desc')->paginate(50);


        $totalusers = User::count();

        // get your main collection with all the attributes...
        //$emailuser = NetworkTransaction::get();

        // build your second collection with a subset of attributes. this new
        // collection will be a collection of plain arrays, not Users models.
        //$subset = $emailuser->map->only(['userMembership'])->toArray(); 


        return view('networktransaction.indexactivacion', compact('networktransactions', 'totalusers'));        

    }
}
