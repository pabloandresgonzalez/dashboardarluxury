<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\News;

class NewsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        //$membresias = Membresia::all();
        $news = News::orderBy('id', 'Desc')->paginate(10);
        $data = ['news' => $news];

        return view('news.index', compact('news'));

    }

    public function create()
    {
        return view('news.create');

    }

    public function perfomrValidationCreate(Request $request)
    {
        $rules = [
        'title' => 'required|string|min:4|max:255',
        'intro' => 'required|string|max:255',
        'detail' => 'required|string|max:255',
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


        $news = new News();
        $news->title = $request->input('title');
        $news->intro = $request->input('intro');
        $news->detail = $request->input('detail');
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

        return redirect('news')->with([
                'message' => 'La news '.$news->title.' fue creada correctamente!'
        ]);

    }

    public function indexuser()
    {
        //$news = News::all();
        $news = News::orderBy('id', 'Desc')->paginate(10);
        $data = ['news' => $news];

        

        return view('news.indexuser', compact('news'));

    }

    public function edit($id) {
        
        $news = News::find($id);

        //return view('membresias.create');

        return view('news.edit', [
          'news' => $news
      ]);

  }

    public function update(Request $request, $id)
    {

        //Validacion del formulario
        $validate = $this->validate($request, [
            'title' => 'required|string|min:4|max:255',
            'intro' => 'required|string|min:4|max:255',
            'detail' => 'required|string|max:255',
            'isActive' => 'required|string|max:255',            
            'image' => 'file'
        ]);        


        $news = News::findOrFail($id);
        $news->title = $request->input('title');
        $news->intro = $request->input('intro');
        $news->detail = $request->input('detail');
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

        return redirect('news')->with([
                'message' => 'La news '.$news->title.' fue editada correctamente!'
        ]);

    }

    public function detail($id) {

      $news = News::find($id);

      return view('news.detail', [
          'news' => $news
      ]);
    }

    
    public function getImagevideo($filename)
    {
      $file = Storage::disk('photoNews')->get($filename);
      return new Response($file, 200);
    }

    
    

   /*
    public function getVideo(Video $video)
    {
        $name = $video->name;
        $fileContents = Storage::disk('photoNews')->get("app/photoNews/{$name}");
        $response = Response::make($fileContents, 200);
        $response->header('Content-Type', "video/mp4");
        return $response;
    }
    */
    


}
