<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ConsultId extends Controller
{
    public function index()
    {
    	// Total comission del usuario 
        $totalCommission = $this->totalCommission();

        // Total usuarios
        $totalusers = $totalusers = $this->countUsers();

        return view('users.ConsultId', compact('totalusers', 'totalCommission'));

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
