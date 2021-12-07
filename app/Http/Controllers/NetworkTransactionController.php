<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NetworkTransaction;
use App\Models\UserMembership;
use App\Models\User;
use App\Models\Membresia;
use DB;

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

        $networktransactions = NetworkTransaction::where('user', $iduser)
                                ->where('type', 'Activation')    
                                ->orderBy('id', 'desc')->paginate(50);
        
        $misusers = DB::table('network_transactions')            
            ->where('user', $iduser) 
            //->orwhere('type', 'Activation') 
            ->join('users', 'users.id', '=', 'network_transactions.user')
            //->select('users.*', 'contacts.phone', 'orders.price')
            ->get();

        //dd($misusers);

        $totalusers = User::count();

        return view('networktransaction.indexactivacion', compact( 'totalusers', 'misusers'));        

    }
}
