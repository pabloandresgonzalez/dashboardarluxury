@extends('layouts.panel')


@section('content')
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0"> Noticias</h3>
              </div>
              @if(session('message'))
                    <div class="alert alert-success">
                      {{ session('message') }}
                    </div>
              @endif

            </div>
          </div>

          <div class="card-body">


          @foreach($news as $new)




      
          <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{ $new->title }}</h3>
                            </div>
                            
                        </div>
                    </div>
                    
                    @if (!empty(in_array(strtolower(pathinfo($new->image,PATHINFO_EXTENSION)),["png","jpg","gif","avg"]))) 

                   
                    <div class="card-body" style="text-align:center;"> 
                        <img class="table-responsive" width="240" height="320" controls src="{{ route('new.avatar',['filename'=>$new->image]) }}"> 
                    </div>

                    @else                        
                    <div class="card shadow">
                  <div class="row justify-content-center">  
                        <iframe width="400px" height="300px" src="{{ $new->url_video }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>

                    @endif

                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{ $new->intro }}</h3>
                            </div>
                            
                        </div>
                    </div>


                    <div class="card-body">

                      {{ $news->appends(request()->input())->links() }} 
                      
                    </div>
                    
                </div>
            </div>
        </div>
        <br><br>
        <hr class="my-4" />

          @endforeach


          </div>


        </div>

        <br>
        <hr class="my-3">
           

        <main class="py-4">
            @yield('content')
        </main>

@endsection