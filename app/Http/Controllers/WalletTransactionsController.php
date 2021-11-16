<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\wallet_transactions;
use App\Mail\TransactionSentMessage;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\TransactionMessageCreated;
use DB;
use App\Exports\WalletTransactionsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\StatusChangeTransactionMessage;
use App\Mail\StatusChangeTransactionMessageAdmin;
use App\Models\UserMembership;

class WalletTransactionsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function indexAdmin(Request $request)
    {

      $nombre = $request->get('buscarpor');

        $Wallets = wallet_transactions::where('user', 'LIKE', "%$nombre%")
        ->orwhere('email', 'LIKE', "%$nombre%")
        ->orwhere('currency', 'LIKE', "%$nombre%")
        ->orwhere('type', 'LIKE', "%$nombre%")
        ->orwhere('status', 'LIKE', "%$nombre%")
        ->orwhere('created_at', 'LIKE', "%$nombre%")
        ->orderBy('id', 'desc')
        ->paginate(50);

        /*
        $users = DB::table('wallet_transactions')
        ->join('users', 'users.id', '=' , 'wallet_transactions.user')
        ->select('users.email')
        ->get();

        dd($users);
        */


        //$actualStock = DB::table('wallet_transactions')->where('id')->first();
        //$useremails = DB::table('wallet_transactions')->select(DB::raw('user'))->get()->pluck('user');

        //$useremails = $tienda;

        //dd($Wallets);

        /*

        foreach($Wallets as $Wallet)
          $wallets1 = $Wallets;

        foreach($useremails as $useremail)
          $useremail = DB::table('users')->select(DB::raw('email'))->get()->pluck('email')->toArray();

        */

          //dd($useremail);

        //$resultados = array_merge($wallets1, $useremail);





        //dd($useremail);
        $totalusers = User::count(); 


        return view('wallets.indexAdmin', [
        'Wallets' => $Wallets,
        'totalusers' => $totalusers
        ]);


    }

    public function index(Request $request)
    {


          //return view('wallets.index');

          //Conseguir usuario identificado
          $user = \Auth::user();

          $id = $user->id;


          //$id = 'b3361710-4e21-4fe1-a86e-a29fbecb15f2';

          $data = [
          'userId' => $id, //'b3361710-4e21-4fe1-a86e-a29fbecb15f2',
          'token' => 'AcjAa76AHxGRdyTemDb2jcCzRmqpWN'
          ];

          $curl = curl_init();

          curl_setopt_array($curl, array(
              CURLOPT_URL => "https://ekgra7pfqh.execute-api.us-east-2.amazonaws.com/Prod_getBalanceByUser",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30000,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => json_encode($data),        
              CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                  "accept: */*",
                  "accept-language: en-US,en;q=0.8",
                  "content-type: application/json",
              ),
          ));

          $result = curl_exec($curl);
          $err = curl_error($curl);

          //dd($err);

          //dd($result);
          curl_close($curl);
          //$data1 = print_r($result);

          //decodificar JSON porque esa es la respuesta
          $respuestaDecodificada = json_decode($result);  

          //dd($respuestaDecodificada);

          //$balance = $respuestaDecodificada->balance;

          //dd($balance);

          //$d = $balance + 100 ;

          //dd($result);

          $Wallets = wallet_transactions::where('user', $user->id)->orderBy('id', 'desc')
            ->paginate(30);

          $totalusers = User::count(); 

            
            return view('wallets.index', [
              //'respuestaDecodificada' => $respuestaDecodificada,
              'result' => $result,
              'user' => $user,
              'Wallets' => $Wallets,
              'totalusers' => $totalusers

            ]);             

    }

    public function store(Request $request)
    {


      //Conseguir usuario identificado
      $user = \Auth::user();
      $id = $user->id;
      $name = $user->name;
      $email = $user->email;

                
      $rules = ([
          
          'value' => 'required|string|max:255',
           'detail' => 'required|string', 
           'currency' => 'required|string',          
          
      ]);

       $this->validate($request, $rules);


        $Wallet = new wallet_transactions();
        $Wallet->user = $id;
        $Wallet->email = $email;
        $Wallet->value = $request->input('value');
        $Wallet->fee = 5;
        $Wallet->type = 0;
        $Wallet->hash = '';
        $Wallet->currency = $request->input('currency');;
        $Wallet->approvedBy = '';
        $Wallet->inOut = 0;
        $Wallet->status = 'exhange';     
        $Wallet->detail = $request->input('detail');

        //dd($Wallet);       

        $Wallet->save();// INSERT BD



        //enviar email
        $user_email = User::where('role', 'admin')->first();
        $user_email_admin = $user_email->email;
        //$useremail = 'pabloandres6@gmail.com';

        Mail::to($email)->send(new TransactionSentMessage($Wallet));

        Mail::to($user_email_admin)->send(new TransactionMessageCreated($Wallet));

        //return redirect('home');
        $totalusers = User::count(); 

        return redirect()->route('home')->with([
                    'message' => 'Solicitud de Retiro enviado correctamente!',
                    'totalusers' => $totalusers
        ]);

    }

    public function edit($id) {
        
        $Wallets = wallet_transactions::find($id);
        //$fecha_actual = date("Y-m-d H:i:s");
        $totalusers = User::count(); 


        return view('wallets.edit', [
          'Wallets' => $Wallets,
          'totalusers' => $totalusers
      ]);

    }

    public function update(Request $request, $id)
    {

      //dd($result);

      //Conseguir usuario identificado
      $user = \Auth::user();
      $iduser = $user->id;
      //dd($id);
      //$name = $user->name;
      //$email = $user->email;

      //dd($email);

      $Wallet = wallet_transactions::find($id);
      $user = $Wallet->user;
      $email = $Wallet->email;
      $value = $Wallet->value;
      $detail = $Wallet->detail;
      $type = $Wallet->type;
      $currency = $Wallet->currency;
      $fee = $Wallet->fee;


                
      $rules = ([
          
          //'value' => 'required|string|max:255',
          //'detail' => 'required|string', 
          'hash' => 'required|max:255|unique:wallet_transactions',
          'status' => 'required|string|max:50',

          
      ]);

       $this->validate($request, $rules);

        $Wallet = wallet_transactions::findOrFail($id);
        $Wallet->user = $user;
        $email = $email;
        $Wallet->value = $value;
        $Wallet->fee = $fee;
        $Wallet->type = $type;
        $Wallet->hash = $request->input('hash');
        $Wallet->currency = $currency;
        $Wallet->approvedBy = $iduser;
        $Wallet->inOut = 0;
        $Wallet->status = $request->input('status');     
        $Wallet->detail = $detail;
       

        $Wallet->save();// INSERT BD

       
        //enviar email
        $user_email = User::where('role', 'admin')->first();
        $user_email_admin = $user_email->email;
        //$useremail = 'pabloandres6@gmail.com';

        Mail::to($email)->send(new StatusChangeTransactionMessage($Wallet));

        Mail::to($user_email_admin)->send(new StatusChangeTransactionMessageAdmin($Wallet));

        //return redirect('home');
        $totalusers = User::count(); 

        return redirect()->route('home')->with([
                    'message' => 'Solicitud de retiro editada correctamente!',
                    'totalusers' => $totalusers
        ]);

    }

    public function exportExcel()
    {
      return Excel::download(new WalletTransactionsExport, 'Wallets.xlsx');
    }

    public function editsaldos(Request $request)
    {

      $users = User::where('isActive', 1)
               ->orderBy('name')
               ->get();


      //dd($users);

      $fecha_actual = date("Y-m-d H:i:s");

      //$Wallets = wallet_transactions::find($id);
      //$fecha_actual = date("Y-m-d H:i:s");
      $totalusers = User::count(); 

        return view('wallets.gsaldosadmin', [
          'users' => $users,
          'fecha_actual' => $fecha_actual,
          'totalusers' => $totalusers
      ]);

    }

    public function storeAdmin(Request $request)
    {

      //dd($request);


      //Conseguir usuario identificado
      $user = \Auth::user();
      $id = $user->id;
      $name = $user->name;
      $email = $user->email;


      $rules = ([
          
          'idmovimiento' => 'required|string|max:255',
          'value' => 'required|string|max:255',
          'detail' => 'required|string', 
          //'currency' => 'required|string', 
          //'wallet' => 'required|string',         
          
      ]);

       $this->validate($request, $rules);

       $type = $request->input('type');


       $idmovimiento = $request->input('idmovimiento');

       $idmovimiento = User::where('id', $idmovimiento)->first();
       $userid = $idmovimiento->id;
       $useremail = $idmovimiento->email;

       //dd($userid);


       $memberships = UserMembership::where('user', $userid)
        ->where('status', 'Activo')
        ->paginate();
       //$depositos = UserMembership::where('user', $userid);
            //->where('status', 'Activo')
            //->paginate(5);

        //dd($memberships);

        $cantmemberships = $memberships->count();

        //dd($cantmemberships);

        // Si tiene almenos una membresia activa
        if ($cantmemberships > 0) {

        //wallet_transactions de retiro
        $Wallet = new wallet_transactions();
        $Wallet->user = $userid;
        $Wallet->email = $useremail;
        $Wallet->value = $request->input('value');
        $Wallet->fee = 5;
        $Wallet->type = $request->input('type');
        $Wallet->hash = 'Autoriza'." ".$name."-".$email;
        $Wallet->currency = $request->input('currency');
        $Wallet->approvedBy = $id;
        $Wallet->inOut = 0;
        $Wallet->status = 'Aprobada';     
        $Wallet->detail = $request->input('detail');

        //dd($Wallet);        

        $Wallet->save();// INSERT BD

        $totalusers = User::count(); 

        return redirect()->route('home')->with([
                    'message' => 'Asignación de saldo enviada correctamente!',
                    'totalusers' => $totalusers
        ]);

        }

        //dd($memberships);

        //No tiene ninguna membresia activa
        $totalusers = User::count(); 

        return redirect()->route('walletadmin')->with([
                    'message' => 'El usuario no tine una membresia activa!',
                    'totalusers' => $totalusers
        ]);


        /*
        $idsumar = $request->input('idsumar');

       $idsumar = User::where('id', $idsumar)->first();
       $idsumaemail = $idsumar->email;

        //wallet_transactions de retiro para cuando se implemente traslados entre usuarios
        $Walletsuma = new wallet_transactions();
        $Walletsuma->user = $request->input('idsumar');
        $Walletsuma->email = $idsumaemail;
        $Walletsuma->value = $request->input('value');
        $Walletsuma->fee = 0;
        $Walletsuma->type = 1;
        $Walletsuma->hash = 'Autoriza'. $name. $email;
        $Walletsuma->currency = $request->input('currencysuma');
        $Walletsuma->approvedBy = $id;
        $Walletsuma->inOut = 0;
        $Walletsuma->status = 'Aprobada';     
        $Walletsuma->detail = $request->input('detail')." de ".$idrestaemail;

        //dd($Walletsuma);
       

        $Walletsuma->save();// INSERT BD

        */


        

      /*
                
      $rules = ([
          
          'value' => 'required|string|max:255',
          'detail' => 'required|string', 
          'currency' => 'required|string', 
          'wallet' => 'required|string',         
          
      ]);

       $this->validate($request, $rules);


        $Wallet = new wallet_transactions();
        $Wallet->user = $id;
        $Wallet->email = $email;
        $Wallet->value = $request->input('value');
        $Wallet->fee = 5;
        $Wallet->type = 0;
        $Wallet->hash = '';
        $Wallet->currency = $request->input('currency');
        $Wallet->approvedBy = '';
        $Wallet->wallet = $request->input('wallet');
        $Wallet->inOut = 0;
        $Wallet->status = 'exhange';     
        $Wallet->detail = $request->input('detail');

        //dd($Wallet);
       

        $Wallet->save();// INSERT BD


        //enviar email
        $user_email = User::where('role', 'admin')->first();
        $user_email_admin = $user_email->email;
        //$useremail = 'pabloandres6@gmail.com';

        Mail::to($email)->send(new TransactionSentMessage($Wallet));

        Mail::to($user_email_admin)->send(new TransactionMessageCreated($Wallet));

        //return redirect('home');

        return redirect()->route('home')->with([
                    'message' => 'Solicitud de retiro enviado correctamente!'
        ]);
        */

    }


}
