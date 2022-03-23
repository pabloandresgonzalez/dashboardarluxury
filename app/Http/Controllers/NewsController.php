<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsCreatedMessage;

class NewsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    // Total comission del usuario mes en curso
    $totalCommission = $this->totalCommission();

    // Hitorial de produccion 
    $totalProduction = $this->totalProduction();

    // Total produccion del usuario mes en curso
    $totalProductionMes = $this->totalProductionMes();

    // Total usuarios
    $totalusers = $totalusers = $this->countUsers();

    $news = News::orderBy('created_at', 'Desc')->paginate(30);
    $data = ['news' => $news];

    return view('news.index', compact('news', 'totalusers', 'totalCommission', 'totalProduction', 'totalProductionMes'));

  }

  public function create()
  {   
    // Total comission del usuario mes en curso
    $totalCommission = $this->totalCommission();

    // Hitorial de produccion 
    $totalProduction = $this->totalProduction();

    // Total produccion del usuario mes en curso
    $totalProductionMes = $this->totalProductionMes();

    // Total usuarios
    $totalusers = $totalusers = $this->countUsers();

    return view('news.create', compact('totalusers', 'totalCommission', 'totalProduction', 'totalProductionMes'));

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

    /*// Total, de comisión por activación de membresías de usuarios referidos 
    $totalCommission = DB::table("network_transactions")
    ->where('user', $id)
    ->where('type', 'Activation')      
    ->get()->sum("value");*/

    $totalCommission1 = DB::select("SELECT * FROM network_transactions 
      WHERE YEAR(created_at) = YEAR(CURRENT_DATE()) 
      AND MONTH(created_at)  = MONTH(CURRENT_DATE())
      AND type = 'Activation'
      AND status = 'Activo'
      AND user = ?", [$id]);

    $valores = array_column($totalCommission1, 'value');
    $totalCommission = array_sum($valores);

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

  public function perfomrValidationCreate(Request $request)
  {
    $rules = [
    'title' => 'required|string|min:4|max:255',
    'intro' => 'required|string|max:255',
    'detail' => 'required|string|max:255',
    //'url_video' => 'string|max:255',
    'isActive' => 'required|string|max:255',
    'image' => 'file',

    ];

    $messages =[

      'title.required' => 'Es necesario ingresar el nombre',
      'intro.required' => 'Es necesario ingresar el intro',
      'detail.required' => 'Es necesario ingresar el detalle',
      'isActive.required' => 'Es necesario ingresar el estado',

    ];

  $this->validate($request, $rules, $messages);

  }

  public function store(Request $request)
  {

    $this->perfomrValidationCreate($request);

    // Total comission del usuario mes en curso
    $totalCommission = $this->totalCommission();

    // Hitorial de produccion 
    $totalProduction = $this->totalProduction();

    // Total produccion del usuario mes en curso
    $totalProductionMes = $this->totalProductionMes();

    // Total usuarios
    $totalusers = $totalusers = $this->countUsers();

    $news = new News();
    $news->title = $request->input('title');
    $news->intro = $request->input('intro');
    $news->detail = $request->input('detail');
    $news->url_video = $request->input('url_video');
    $news->isActive = $request->input('isActive');
    
    //Subir la imagen photo
    $image_photo = $request->file('image');
    if ($image_photo) {

      //Poner nombre unico
      $image_photo_name = time() . $image_photo->getClientOriginalName();

      //Guardarla en la carpeta storage (storage/app/photoNews)
      Storage::disk('photoNews')->put($image_photo_name, File::get($image_photo));

      //Seteo el nombre de la imagen en el objeto
      $news->image = $image_photo_name;
    }    

    $news->save(); //INSERT BD

    //Enviar email
    $users = DB::table('users')->pluck('email'); 

    Mail::to($users)->send(new NewsCreatedMessage($news));

    return redirect('news')->with([
            'message' => 'La news '.$news->title.' fue creada correctamente!',
            'totalusers' => $totalusers,
            'totalCommission' => $totalCommission,
            'totalProduction' => $totalProduction,
            'totalProductionMes' => $totalProductionMes

    ]);

  }

  public function indexuser()
  {
    // Total comission del usuario mes en curso
    $totalCommission = $this->totalCommission();

    // Hitorial de produccion 
    $totalProduction = $this->totalProduction();

    // Total produccion del usuario mes en curso
    $totalProductionMes = $this->totalProductionMes();

    // Total usuarios
    $totalusers = $totalusers = $this->countUsers();

    $news = News::where('isActive', '1')->orderBy('id', 'Desc')->paginate(15);
    $data = ['news' => $news];        

    return view('news.indexuser', compact('news', 'totalusers', 'totalCommission', 'totalProduction', 'totalProductionMes'));

  }

  public function edit($id)
  {
      
    $news = News::find($id);

    // Total comission del usuario mes en curso
    $totalCommission = $this->totalCommission();

    // Hitorial de produccion 
    $totalProduction = $this->totalProduction();

    // Total produccion del usuario mes en curso
    $totalProductionMes = $this->totalProductionMes();

    // Total usuarios
    $totalusers = $totalusers = $this->countUsers();

    return view('news.edit', [
      'news' => $news,
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
        'title' => 'required|string|min:4|max:255',
        'intro' => 'required|string|min:4|max:255',
        'detail' => 'required|string|max:255',
        //'url_video' => 'string|max:255',
        'isActive' => 'required|string|max:255',            
        'image' => 'file'
    ]);        


    $news = News::findOrFail($id);
    $news->title = $request->input('title');
    $news->intro = $request->input('intro');
    $news->detail = $request->input('detail');
    $news->url_video = $request->input('url_video');
    $news->isActive = $request->input('isActive');

    //Subir la imagen photo
    $image_photo = $request->file('image');
    if ($image_photo) {

      //Poner nombre unico
      $image_photo_name = time() . $image_photo->getClientOriginalName();

      //Guardarla en la carpeta storage (storage/app/photoNews)
      Storage::disk('photoNews')->put($image_photo_name, File::get($image_photo));

      //Seteo el nombre de la imagen en el objeto
      $news->image = $image_photo_name;
    }

    $news->save(); //INSERT BD

    //Enviar email
    $users = DB::table('users')->pluck('email');

    Mail::to($users)->send(new NewsCreatedMessage($news));

    // Total comission del usuario mes en curso
    $totalCommission = $this->totalCommission();

    // Hitorial de produccion 
    $totalProduction = $this->totalProduction();

    // Total produccion del usuario mes en curso
    $totalProductionMes = $this->totalProductionMes();

    // Total usuarios
    $totalusers = $totalusers = $this->countUsers();

    return redirect('news')->with([
            'message' => 'La news '.$news->title.' fue editada correctamente!',
            'totalusers' => $totalusers,
            'totalCommission' => $totalCommission,
            'totalProduction' => $totalProduction,
            'totalProductionMes' => $totalProductionMes
    ]);

  }

  public function detail($id)
  {

    $news = News::find($id);

    // Total comission del usuario mes en curso
    $totalCommission = $this->totalCommission();

    // Hitorial de produccion 
    $totalProduction = $this->totalProduction();

    // Total produccion del usuario mes en curso
    $totalProductionMes = $this->totalProductionMes();

    // Total usuarios
    $totalusers = $totalusers = $this->countUsers();

    return view('news.detail', [
        'news' => $news,
        'totalusers' => $totalusers,
        'totalCommission' => $totalCommission,
        'totalProduction' => $totalProduction,
        'totalProductionMes' => $totalProductionMes
    ]);
  }

    
  public function getImagevideo($filename)
  {
    $file = Storage::disk('photoNews')->get($filename);
    return new Response($file, 200);
  }

}
