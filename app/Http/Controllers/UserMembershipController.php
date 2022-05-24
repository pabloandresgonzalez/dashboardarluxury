<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UserMembership;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Membresia;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusChangeMessage;
use App\Mail\MembershipCreatedMessage;
use App\Mail\MembershipPurchaseMessage;
use App\Exports\UsersMembershipsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\wallet_transactions;
use App\Models\NetworkTransaction;
use Carbon\Carbon;


class UserMembershipController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //Conseguir usuario identificado
        $user = \Auth::user();
        $iduser = $user->id;

        $nombre = $request->get('buscarpor');

        // Buscador 
        $memberships = UserMembership::where('membership', 'LIKE', "%$nombre%")
        ->orwhere('user_name', 'LIKE', "%$nombre%")
        ->orwhere('user_email', 'LIKE', "%$nombre%")
        ->orwhere('hash', 'LIKE', "%$nombre%")
        ->orwhere('typeHash', 'LIKE', "%$nombre%")
        ->orwhere('status', 'LIKE', "%$nombre%")
        ->orderBy('created_at', 'desc')
        ->paginate(100);

        // Total comission del usuario mes en curso
        $totalCommission = $this->totalCommission();

        // Hitorial de produccion 
        $totalProduction = $this->totalProduction();

        // Total produccion del usuario mes en curso
        $totalProductionMes = $this->totalProductionMes();

        // Total usuarios
        $totalusers = $totalusers = $this->countUsers();

        return view('memberships.index', [
        'memberships' => $memberships,
        'totalusers' => $totalusers,
        'totalCommission' => $totalCommission,
        'totalProduction' => $totalProduction,
        'totalProductionMes' => $totalProductionMes
        ]);

    }

    public function create()
    {       

        // Conseguir usuario identificado
        $user = \Auth::user();
        $iduser = $user->id;

        // Conseguir UserMembership de usuario identificado
        $memberships = UserMembership::where('user', $user->id)->orderBy('id', 'desc')->get()->toArray();

        // Conseguir membresias de usuario identificado
        //$membresias = DB::table('membresias')->pluck()->toArray();
        $membresias = Membresia::orderBy('id', 'Desc')->get();

        // Total comission del usuario mes en curso
        $totalCommission = $this->totalCommission();

        // Hitorial de produccion 
        $totalProduction = $this->totalProduction();

        // Total produccion del usuario mes en curso
        $totalProductionMes = $this->totalProductionMes();

        // Total usuarios
        $totalusers = $totalusers = $this->countUsers();


        return view('memberships.create', compact('membresias', 'totalusers', 'totalCommission', 'totalProduction', 'totalProductionMes'));

    }

    public function edit($id) {
        
        $memberships = UserMembership::find($id);        
        $fecha_actual = date("Y-m-d H:i:s");

        // Total comission del usuario mes en curso
        $totalCommission = $this->totalCommission();

        // Hitorial de produccion 
        $totalProduction = $this->totalProduction();

        // Total produccion del usuario mes en curso
        $totalProductionMes = $this->totalProductionMes();

        // Total usuarios
        $totalusers = $totalusers = $this->countUsers();

        return view('memberships.edit', [
          'memberships' => $memberships,
          'fecha_actual' => $fecha_actual,
          'totalusers' => $totalusers,
          'totalCommission' => $totalCommission,
          'totalProduction' => $totalProduction,
          'totalProductionMes' => $totalProductionMes
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

    public function store(Request $request)
    {
   
        //Conseguir usuario identificado
        $user = \Auth::user();
        $id = $user->id;
        $name = $user->name;
        $email = $user->email;

        // reglas de validacion  
        $rules = ([
            
            //'id_membresia' => 'exists:App\Models\UserMembership',
            'id_membresia' => 'required|string',  //|unique:user_memberships|min:4
            //'membership' => 'required|string',  //|unique:user_memberships|min:4      
            'hash' => 'required|max:255|unique:user_memberships', //|unique:user_memberships
            'typeHash' => 'required|max:255',       
            'image' => 'file',             
            
        ]);

       $this->validate($request, $rules);


       $id_membresia = Membresia::find($id);

       $membresia = Membresia::find($request->input('id_membresia'));
       $namemembresia = $membresia->name;

       $membershipsuser = UserMembership::where('user', $user->id)
        ->Where('membership', $namemembresia)
        ->where('status', 'Activo')
        ->get()->toArray();

        if ($membershipsuser) {

          return redirect()->route('home')->with([
                    'message' => '¡' . $name . ' ' .'¡Ya cuentas con una membresia de este valor activa!'
          ]);
          
        }

              
        $fecha_actual = date("Y-m-d H:i:s");                       

        $membership = new UserMembership();
        $membership->id_membresia = $request->input('id_membresia');
        $membership->membresiaPadre = 0;
        $membership->membership = $namemembresia;
        $membership->user_email = $email;
        $membership->user = $id;
        $membership->user_name = $name;
        $membership->hash = $request->input('hash');
        $membership->typeHash = $request->input('typeHash');     
        $membership->detail = 'Pendiente';
        $membership->status = 'Pendiente';
        $membership->closedAt = null;
        $membership->activedAt = null;

        //Subir la imagen imagehash
        $image_photo = $request->file('image');
        if ($image_photo) {

          //Poner nombre unico
          $image_photo_name = time() . $image_photo->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/imagehash)
          Storage::disk('imagehash')->put($image_photo_name, File::get($image_photo));

          //Seteo el nombre de la imagen en el objeto
          $membership->image = $image_photo_name;
        }

        $membership->save();// INSERT BD

        //Enviar email
        $user_email = User::where('role', 'admin')->first();
        $user_email_admin = $user_email->email;
        //$user_email_admin = 'pabloandres6@gmail.com';

        Mail::to($user_email_admin)->send(new MembershipCreatedMessage($membership));

        Mail::to($email)->send(new MembershipPurchaseMessage($membership));

        // Total comission del usuario mes en curso
        $totalCommission = $this->totalCommission();

        // Hitorial de produccion 
        $totalProduction = $this->totalProduction();

        // Total produccion del usuario mes en curso
        $totalProductionMes = $this->totalProductionMes();

        // Total usuarios
        $totalusers = $totalusers = $this->countUsers();

        return redirect()->route('home')->with([
                    'message' => '¡' . $name . '¡hash enviado correctamente!',
                    'totalusers' => $totalusers,
                    'totalCommission' => $totalCommission,
                    'totalProduction' => $totalProduction,
                    'totalProductionMes' => $totalProductionMes
        ]);

    }

    public function update(Request $request, $id)
    {   

        //Validacion del formulario
        $validate = $this->validate($request, [
            'membership' => 'required|string|min:4',        
            //'hash' => 'required|max:255|unique:user_memberships', 
            'typeHash' => 'required|max:255',  
            //'detail' => 'required|max:255', 
            'activedAt'=>'required|date_format:Y-m-d H:i:s',
            //'closedAt' => 'required|max:255',    
            'image' => 'file',
        ]);

        $membership = UserMembership::findOrFail($id);
        $membership->membership = $request->input('membership');
        $membership->typeHash = $request->input('typeHash');
        $membership->detail = $request->input('status');
        $membership->activedAt = $request->input('activedAt');

        // Se crea una fecha sin sabados ni domingos  
        $fechaInicial = date("Y-m-d H:i:s"); //obtenemos la fecha actual, solo para usar como referencia al usuario  
    
        $MaxDias = 30; //Cantidad de dias maximo, este sera util para crear el for  
        
        $Segundos = 0;
          
          //Creamos un for desde 0 hasta 3  
          for ($i=0; $i<$MaxDias; $i++)  
          {  
            //Acumulamos la cantidad de segundos que tiene un dia en cada vuelta del for  
            $Segundos = $Segundos + 86400;  
              
            //Obtenemos el dia de la fecha, aumentando el tiempo en N cantidad de dias, segun la vuelta en la que estemos  
            $caduca = date("D",time()+$Segundos);  
              
            //Comparamos si estamos en sabado o domingo, si es asi restamos una vuelta al for, para brincarnos el o los dias...  
            if ($caduca == "Sat")  
            {  
               $i--;  
            }  
            else if ($caduca == "Sun")  
            {  
               $i--;  
            }  
            else  
            {  
               //Si no es sabado o domingo, y el for termina y nos muestra la nueva fecha  
              $FechaFinal = date("Y-m-d H:i:s",time()+$Segundos);  
            }  
          } 

        //dd($FechaFinal);

        $date= Carbon::now();
        $date->addDay(30);

        $now = $date->format('Y-m-d H:i:s');
        $membership->closedAt = $FechaFinal;//$request->input('closedAt');

        //$membership->closedAt = $request->input('closedAt');
        $membership->status = $request->input('status');
     

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

        $membership->save(); //INSERT BD
        
        //Enviar email
        $user_email = $membership->user_email;

        Mail::to($user_email)->send(new StatusChangeMessage($membership));    

        // Total comission del usuario mes en curso
        $totalCommission = $this->totalCommission();

        // Hitorial de produccion 
        $totalProduction = $this->totalProduction();

        // Total produccion del usuario mes en curso
        $totalProductionMes = $this->totalProductionMes();

        // Total usuarios
        $totalusers = $totalusers = $this->countUsers();

        return redirect()->route('home')->with([
                    'message' => 'Membresía editada correctamente!',
                    'totalusers' => $totalusers,
                    'totalCommission' => $totalCommission,
                    'totalProduction' => $totalProduction,
                    'totalProductionMes' => $totalProductionMes
        ]);

    }

    public function indexUserMemberships()
    {

      //Conseguir usuario identificado
      $user = \Auth::user();
      $username = $user->name;

      $memberships = UserMembership::where('user', $user->id)
        ->orderBy('created_at', 'desc')
        ->paginate(30);

      $membreshipsactivas = UserMembership::where('user', $user->id)
        ->where('status', 'Activo')->get();

      $cantmemberships = $membreshipsactivas->count();

      //dd($cantmemberships);

      // Total comission del usuario mes en curso
      $totalCommission = $this->totalCommission();

      // Hitorial de produccion 
      $totalProduction = $this->totalProduction();

      // Total produccion del usuario mes en curso
      $totalProductionMes = $this->totalProductionMes();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      return view('memberships.mismemberships', [
          'memberships' => $memberships,
          'user' => $user,
          'totalusers' => $totalusers,
          'username' => $username,
          'totalCommission' => $totalCommission,
          'totalProduction' => $totalProduction,
          'totalProductionMes' => $totalProductionMes,
          'cantmemberships' => $cantmemberships
      ]);

    }

    public function getImage($filename)
    {
      // obtener imagen avatar
      $file = Storage::disk('imagehash')->get($filename);
      return new Response($file, 200);
    }

    public function orden($id)
    {      
      $membership = UserMembership::find($id);

      // Total comission del usuario mes en curso
      $totalCommission = $this->totalCommission();

      // Hitorial de produccion 
      $totalProduction = $this->totalProduction();

      // Total produccion del usuario mes en curso
      $totalProductionMes = $this->totalProductionMes();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      return view('memberships.soporte', [
          'membership' => $membership,
          'totalusers' => $totalusers,
          'totalCommission' => $totalCommission,
          'totalProduction' => $totalProduction,
          'totalProductionMes' => $totalProductionMes
      ]);

    }

    public function pagos(Request $request, $id)
    {
      // Total comission del usuario mes en curso
      $totalCommission = $this->totalCommission();

      // Hitorial de produccion 
      $totalProduction = $this->totalProduction();

      // Total produccion del usuario mes en curso
      $totalProductionMes = $this->totalProductionMes();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();
      
      $membership = UserMembership::findOrFail($id);        
      //$networktransaction = NetworkTransaction::findOrFail($request->user);
      //dd($membership);
      return view('networktransaction.index', compact('totalusers', 'totalCommission', 'totalProduction', 'totalProductionMes'));
    }

    public function editrenovar($id)
    {

        //Conseguir usuario identificado
        $user = \Auth::user();
        $iduser = $user->id;

        $data = [
          'userId' => $iduser,
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

        curl_close($curl);

        //decodificar JSON porque esa es la respuesta
        $respuestaDecodificada = json_decode($result);  

        if ($result) {
          $url = ($result);
                $data = json_decode($url, true);
          if (isset($data['total'])) {
            
              $total = $data['total']; 
              //echo $balancecho;
          }else {

            $total = null;            
          } 
        } 

        // Total comission del usuario mes en curso
        $totalCommission = $this->totalCommission();

        // Hitorial de produccion 
        $totalProduction = $this->totalProduction();

        // Total produccion del usuario mes en curso
        $totalProductionMes = $this->totalProductionMes();

        // Total usuarios
        $totalusers = $totalusers = $this->countUsers();

        $memberships = UserMembership::where('user', $iduser)
        ->where('status', 'Activo')
        ->paginate(50);

        $cantmemberships = $memberships->count();

        $memberships = UserMembership::find($id);
        $id_membresia = $memberships->id_membresia;

        $membresia = Membresia::where('id', $id_membresia)->first();
        $valor_membresia = $membresia->valor;
        $valmembresia = $valor_membresia;

        $percentageMembership = 5;

        $valuetoPorcMemberschip = ($percentageMembership / 100) * $valmembresia;
        
        $totalMembershiAndPercentage = $valor_membresia + $valuetoPorcMemberschip;


        if ($total > $totalMembershiAndPercentage) {

                    
          return view('memberships.renovar', [
                'memberships' => $memberships,
                'user' => $user,
                'result' => $result,
                'totalusers' => $totalusers,
                'valor_membresia' => $valor_membresia,
                'totalCommission' => $totalCommission,
                'totalProduction' => $totalProduction,
                'totalProductionMes' => $totalProductionMes
              ]);             

        }


          return redirect()->route('home')->with([
                  'message' => '¡Ups ¡El saldo es insuficiente para renovar!',
                  'totalusers' => $totalusers,
                  'totalCommission' => $totalCommission,
                  'totalProduction' => $totalProduction,
                  'totalProductionMes' => $totalProductionMes
              ]); 

    }

    public function renovar(Request $request, $id)
    {

        //Conseguir usuario identificado
        $user = \Auth::user();
        $iduser = $user->id;
        $name = $user->name;
        $email = $user->email;


        // Total comission del usuario mes en curso
        $totalCommission = $this->totalCommission();

        // Hitorial de produccion 
        $totalProduction = $this->totalProduction();

        // Total produccion del usuario mes en curso
        $totalProductionMes = $this->totalProductionMes();

        // Total usuarios
        $totalusers = $totalusers = $this->countUsers();

        $membershippadre = UserMembership::findOrFail($id);
        $id_membresia = $membershippadre->id_membresia;
        $typeHash =  $membershippadre->typeHash;


        $membresia = Membresia::where('id', $id_membresia)->first();
        $valor_membresia = $membresia->valor;

        $data = [
          'userId' => $iduser,
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

        curl_close($curl);

        //decodificar JSON porque esa es la respuesta
        $respuestaDecodificada = json_decode($result);  


        $valor_saldo  = $respuestaDecodificada->total;

        $percentage = 5;
        $valmembresia = $valor_membresia;

        $toPorcMemberschip = ($percentage / 100) * $valmembresia;

        $percentageuser = 2;

        $toPorcMemberschiprefe = ($percentageuser / 100) * $valmembresia;


        if ($valor_membresia > $valor_saldo) {
            
            return redirect()->route('home')->with([
                    'message' => '¡Ups ¡El saldo es insuficiente para renovar!',
                    'totalusers' => $totalusers,
                    'valor_membresia' => $valor_membresia,
                    'totalCommission' => $totalCommission,
                    'totalProduction' => $totalProduction,
                    'totalProductionMes' => $totalProductionMes
                ]); 

        }

        //Validacion del formulario
        $validate = $this->validate($request, [
            'membership' => 'required|string|min:4',        
            //'hash' => 'required|max:255|unique:user_memberships', 
            //'typeHash' => 'required|max:255',  
            //'detail' => 'required|max:255', 
            //'activedAt' => 'required|max:255',
            //'closedAt' => 'required|max:255',    
            //'image' => 'file',
        ]);      

        $membership = new UserMembership();
        $membership->id_membresia = $id_membresia;
        $membership->membresiaPadre = $id;
        $membership->membership = $request->input('membership');
        $membership->user_email = $email;
        $membership->user = $iduser;
        $membership->user_name = $name;
        $membership->hash = 'Descuento de saldo '.bin2hex(random_bytes(20));
        $membership->typeHash = $typeHash;     
        $membership->detail = 'Activo';
        $membership->status = 'Activo';

        // Se crea una fecha sin sabados ni domingos  
        $fechaInicial = date("Y-m-d H:i:s"); //obtenemos la fecha actual, solo para usar como referencia al usuario  
    
        $MaxDias = 30; //Cantidad de dias maximo, este sera util para crear el for  
        
        $Segundos = 0;
          
          //Creamos un for desde 0 hasta 3  
          for ($i=0; $i<$MaxDias; $i++)  
          {  
            //Acumulamos la cantidad de segundos que tiene un dia en cada vuelta del for  
            $Segundos = $Segundos + 86400;  
              
            //Obtenemos el dia de la fecha, aumentando el tiempo en N cantidad de dias, segun la vuelta en la que estemos  
            $caduca = date("D",time()+$Segundos);  
              
            //Comparamos si estamos en sabado o domingo, si es asi restamos una vuelta al for, para brincarnos el o los dias...  
            if ($caduca == "Sat")  
            {  
               $i--;  
            }  
            else if ($caduca == "Sun")  
            {  
               $i--;  
            }  
            else  
            {  
               //Si no es sabado o domingo, y el for termina y nos muestra la nueva fecha  
              $FechaFinal = date("Y-m-d H:i:s",time()+$Segundos);  
            }  
          } 

        //dd($FechaFinal);

        $date= Carbon::now();
        $date->addDay(30);

        $now = $date->format('Y-m-d H:i:s');
        $membership->closedAt = $FechaFinal;//$request->input('closedAt');

        //$membership->closedAt = null;
        $fecha_actual = date("Y-m-d H:i:s");
        $membership->activedAt = $fecha_actual;

        //Subir la imagen imagehash
        $image_photo = $request->file('image');
        if ($image_photo) {

          //Poner nombre unico
          $image_photo_name = time() . $image_photo->getClientOriginalName();

          //Guardarla en la carpeta storage (storage/app/imagehash)
          Storage::disk('imagehash')->put($image_photo_name, File::get($image_photo));

          //Seteo el nombre de la imagen en el objeto
          $membership->image = $image_photo_name;
        }


        $membershipInicial = UserMembership::findOrFail($id);
        $membershipInicial->status = 'Terminada';
        $membershipInicial->detail = 'Terminada';

        $membership->save();// INSERT BD
        $membershipInicial->save();


        //Se registra el descuento por renovar 
        $Wallet = new wallet_transactions();
        $Wallet->user = $iduser;
        $Wallet->email = $email;
        $Wallet->value = $valor_membresia;// + $toPorcMemberschip;
        $Wallet->fee = $toPorcMemberschip;
        $Wallet->type = "Renovar";
        $Wallet->hash = 'Descuento para renovar '.bin2hex(random_bytes(20));
        $Wallet->currency = $typeHash;//$request->input('currency');
        $Wallet->approvedBy = $email;
        $Wallet->inOut = 0;
        $Wallet->status = 'Aprobada';     
        $Wallet->detail = 'Descuento para renovar membresia';


        $Wallet->save();// INSERT BD
       

        return redirect()->route('home')->with([
                    'message' => '¡' . $name . ' hash de renovación enviado correctamente!',
                    'totalusers' => $totalusers,
                    'totalCommission' => $totalCommission,
                    'totalProduction' => $totalProduction,
                    'totalProductionMes' => $totalProductionMes
                    
        ]);
        
    }

    public function detail($id) {

      $membership = UserMembership::find($id);

      // Total comission del usuario mes en curso
      $totalCommission = $this->totalCommission();

      // Hitorial de produccion 
      $totalProduction = $this->totalProduction();

      // Total produccion del usuario mes en curso
      $totalProductionMes = $this->totalProductionMes();

      // Total usuarios
      $totalusers = $totalusers = $this->countUsers();

      return view('memberships.detail', [
          'membership' => $membership,
          'totalusers' => $totalusers,
          'totalCommission' => $totalCommission,
          'totalProduction' => $totalProduction,
          'totalProductionMes' => $totalProductionMes
      ]);
    }

    public function exportExcel()
    {
      return Excel::download(new UsersMembershipsExport, 'memberships.xlsx');
    }    
    
}