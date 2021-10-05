<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\wallet_transactions;

class WalletTransactionsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function indexAdmin(Request $request)
    {

      $nombre = $request->get('buscarpor');

        $Wallets = wallet_transactions::where('fee', 'LIKE', "%$nombre%")
        ->orwhere('user', 'LIKE', "%$nombre%")
        ->orwhere('status', 'LIKE', "%$nombre%")
        ->orwhere('currency', 'LIKE', "%$nombre%")
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('wallets.indexAdmin', [
        'Wallets' => $Wallets
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

      //dd($result);
      curl_close($curl);
      //$data1 = print_r($result);

      //decodificar JSON porque esa es la respuesta
      $respuestaDecodificada = json_decode($result);  

      //dd($databalance);

      $Wallets = wallet_transactions::where('user', $user->id)->orderBy('id', 'desc')
            ->paginate(4);


        return view('wallets.index', [
          'respuestaDecodificada' => $respuestaDecodificada,
          'user' => $user,
          'Wallets' => $Wallets

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
           'type' => 'required|string',          
          
      ]);

       $this->validate($request, $rules);


        $Wallet = new wallet_transactions();
        $Wallet->user = $id;
        $Wallet->value = $request->input('value');
        $Wallet->fee = 0;
        $Wallet->type = $request->input('type');
        $Wallet->hash = '';
        $Wallet->currency = '';
        $Wallet->approvedBy = '';
        $Wallet->inOut = 0;
        $Wallet->status = 'change';     
        $Wallet->detail = $request->input('detail');
       

        $Wallet->save();// INSERT BD

        //return redirect('home');

        return redirect()->route('home')->with([
                    'message' => 'Solicitud de Retiro enviado correctamente!'
        ]);

    }

    public function edit($id) {
        
        $Wallets = wallet_transactions::find($id);
        //$fecha_actual = date("Y-m-d H:i:s");


        return view('wallets.edit', [
          'Wallets' => $Wallets
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

      $Wallet = wallet_transactions::find($id);
      $user = $Wallet->user;
      $value = $Wallet->value;
      $detail = $Wallet->detail;
      $type = $Wallet->type;


                
      $rules = ([
          
          //'value' => 'required|string|max:255',
          //'detail' => 'required|string', 
          'status' => 'required|string|max:50',

          
      ]);

       $this->validate($request, $rules);

        $Wallet = wallet_transactions::findOrFail($id);
        $Wallet->user = $user;
        $Wallet->value = $value;
        $Wallet->fee = 0;
        $Wallet->type = $type;
        $Wallet->hash = $request->input('hash');
        $Wallet->currency = '';
        $Wallet->approvedBy = $iduser;
        $Wallet->inOut = 0;
        $Wallet->status = $request->input('status');     
        $Wallet->detail = $detail;
       

        $Wallet->save();// INSERT BD

        //return redirect('home');

        return redirect()->route('home')->with([
                    'message' => 'Solicitud de Retiro editada correctamente!'
        ]);

    }
}
