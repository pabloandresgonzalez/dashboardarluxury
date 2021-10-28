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
        //$id = $user->id;
        //$name = $user->name;
        //$image = $user->image;
        //$users = User::orderBy('id', 'desc')->get();
        //$memberships = UserMembership::where('id', $user->id)->orderBy('id', 'desc')->get();
        $id = $request->id;
        $networktransactions = NetworkTransaction::where('userMembership', $id)
                                ->where('type', 'Daily')
                                ->orderBy('id', 'desc')->paginate(40);
            //->paginate(5);


        //dd($networktransactions);

        return view('networktransaction.index', compact('networktransactions'));        

    }

    public function indexactivacion(Request $request)
    {

        //Conseguir usuario identificado
        $user = \Auth::user();
        $iduser = $user->id;
        //$name = $user->name;
        //$image = $user->image;
        //$users = User::orderBy('id', 'desc')->get();
        //$memberships = UserMembership::where('id', $user->id)->orderBy('id', 'desc')->get();
        $id = $request->id;
        //$networktransactions = NetworkTransaction::where('user', $iduser)->orderBy('id', 'desc')->paginate(40);
        //dd($networktransactions);
        $networktransactions = NetworkTransaction::where( 'user', $iduser)
                                ->where('type', 'Activation')
                                ->orderBy('id', 'desc')->paginate(40);

        //dd($networktransactions);

            //->paginate(5);

        //dd($networktransactions);

        return view('networktransaction.indexactivacion', compact('networktransactions'));        

    }



}
