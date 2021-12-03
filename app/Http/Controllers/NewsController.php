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
    $totalusers = User::count(); 

    $news = News::orderBy('created_at', 'Desc')->paginate(30);
    $data = ['news' => $news];

    return view('news.index', compact('news', 'totalusers'));

  }

  public function create()
  {   
    $totalusers = User::count();

    return view('news.create', compact('totalusers'));

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

    $totalusers = User::count();

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
            'totalusers' => $totalusers
    ]);

  }

  public function indexuser()
  {

    $totalusers = User::count();

    $news = News::where('isActive', '1')->orderBy('id', 'Desc')->paginate(15);
    $data = ['news' => $news];        

    return view('news.indexuser', compact('news', 'totalusers'));

  }

  public function edit($id)
  {
      
    $news = News::find($id);

    $totalusers = User::count();

    return view('news.edit', [
      'news' => $news,
      'totalusers' => $totalusers
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

    $totalusers = User::count();

    return redirect('news')->with([
            'message' => 'La news '.$news->title.' fue editada correctamente!',
            'totalusers' => $totalusers
    ]);

  }

  public function detail($id)
  {

    $news = News::find($id);

    $totalusers = User::count();

    return view('news.detail', [
        'news' => $news,
        'totalusers' => $totalusers
    ]);
  }

    
  public function getImagevideo($filename)
  {
    $file = Storage::disk('photoNews')->get($filename);
    return new Response($file, 200);
  }

}
