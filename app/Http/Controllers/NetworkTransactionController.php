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
        $id = $user->id;

        $id = $request->id;
        $networktransactions = NetworkTransaction::where('userMembership', $id)
                                ->where('type', 'Daily')
                                ->orderBy('id', 'desc')->paginate(50);

        // Total comission del usuario 
        $totalCommission = $this->totalCommission();

        // Total usuarios
        $totalusers = $totalusers = $this->countUsers();

        return view('networktransaction.index', compact('networktransactions', 'totalusers', 'totalCommission'));        

    }

    public function indexactivacion(Request $request)
    {

        //Conseguir usuario identificado
        $user = \Auth::user();
        $iduser = $user->id;

        $id = $request->id;

        $networktransactions1 = NetworkTransaction::where('user', $iduser)
                                ->where('type', 'Activation')    
                                ->orderBy('id', 'desc')->paginate(50);
        
        $networktransactions = DB::table('network_transactions')            
            ->where('user', $iduser) 
            ->where('type', 'Activation') 
            ->join('users', 'users.id', '=', 'network_transactions.user')
            //->select('users.*', 'contacts.phone', 'orders.price')
            ->get();

        //dd($misusers);

        // Total comission del usuario 
        $totalCommission = $this->totalCommission();

        // Total usuarios
        $totalusers = $totalusers = $this->countUsers();

        return view('networktransaction.indexactivacion', compact( 'totalusers', 'networktransactions', 'totalCommission'));        

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
      ->get()->sum("value");

      return $totalCommission;
    }
}
