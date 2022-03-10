<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Membership;
use App\Models\User;
use DB;
use App\Mail\CreateContact;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
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

    	// Total comission del usuario 
		$totalCommission = $this->totalCommission();

		// Total produccion del usuario 
      	$totalProduction = $this->totalProduction();

		// Total usuarios
		$totalusers = $totalusers = $this->countUsers();

		return view('contacto.index', compact('user', 'totalusers', 'totalCommission', 'totalProduction'));
	}

	public function store(Request $request)
	{
      // Conseguir usuario identificado
		$user = \Auth::user();

		$message = $request->input('message');
      //dd($message);

      //$correo = new CreateContact();
      //Mail::to('pabloandres6@gmail.com')->send($correo);

      //Enviar email
		$user_email = User::where('role', 'admin')->first();
		$user_email_admin = $user_email->email;
      	//$user_email_admin = 'pabloandres6@gmail.com';

		Mail::to($user_email_admin)->send(new CreateContact($message, $user));

		return redirect()->route('home')->with([
			'message' => 'Mensaje enviado con exito!'
		]);

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
		->where('type', 'Activation')
		->get()->sum("value");

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
}
