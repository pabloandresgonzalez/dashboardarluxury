<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Membership;
use App\Models\User;
use DB;

class GuiaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}  

	public function index()
	{
    	// Conseguir usuario identificado
		$user = \Auth::user();
		$id = $user->id;

    // Total comission del usuario mes en curso
    $totalCommission = $this->totalCommission();

    // Hitorial de produccion 
    $totalProduction = $this->totalProduction();

    // Total produccion del usuario mes en curso
    $totalProductionMes = $this->totalProductionMes();

		// Total usuarios
		$totalusers = $totalusers = $this->countUsers();

		return view('guias.index', compact('user', 'totalusers', 'totalCommission', 'totalProduction', 'totalProductionMes'));
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

      // Total, de comisión por activación de membresías de usuarios referidos 
      $totalCommission = DB::table("network_transactions")
      ->where('user', $id)
      ->where('type', 'Activation')      
      ->get()->sum("value");

      /*$totalCommission1 = DB::select("SELECT * FROM network_transactions 
        WHERE YEAR(created_at) = YEAR(CURRENT_DATE()) 
        AND MONTH(created_at)  = MONTH(CURRENT_DATE())
        AND type = 'Activation'
        AND status = 'Activo'
        AND user = ?", [$id]);*/

      //$valores = array_column($totalCommission1, 'value');
      //$totalCommission = array_sum($valores);

      return $totalCommission;
    }

	private function totalProduction()
    {
      // Conseguir usuario identificado
      $user = \Auth::user();
      $id = $user->id;

      // Total usuarios
      $totalProduction = DB::table("network_transactions")
      ->where('user', $id)
      ->where('type', 'Daily')
      ->get()->sum("value");

      return $totalProduction;
    }

    private function totalProductionMes()
    {
      // Conseguir usuario identificado
      $user = \Auth::user();
      $id = $user->id;

      $totalProductionMes1 = DB::select("SELECT * FROM network_transactions 
        WHERE YEAR(created_at) = YEAR(CURRENT_DATE()) 
        AND MONTH(created_at)  = MONTH(CURRENT_DATE())
        AND type = 'Daily'
        AND status = 'Activo'
        AND user = ?", [$id]);

      $valores = array_column($totalProductionMes1, 'value');
      $totalProductionMes = array_sum($valores);

      return $totalProductionMes;
    }
}
