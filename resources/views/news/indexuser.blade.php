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
                    <div class="card-body" style="text-align:center;">

                      @if($new->image)
                      <video class="table-responsive" width="320" height="240" controls>
                              <source src="{{ route('new.avatar',['filename'=>$new->image]) }}" type="video/mp4">
                              Your browser does not support the video tag.
                      </video>
                      @else
                      <img src="">
                      @endif


                        
                    </div>
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


                      {{ $new->detail }}
                      
                    </div>
                    
                </div>
            </div>
        </div>
        <br><br>
        <hr class="my-4" />
      

          




          @endforeach

          
          

      <!--
        <div class="row">
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                
                                <h2 class="text-white mb-0">{{ $new->title }}</h2>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body" style="text-align:center;">
                        
                      <video width="320" height="240" controls>
                              <source src="" type="video/mp4">
                              Your browser does not support the video tag.
                      </video>



                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">{{ $new->isActive }}</h6>
                                <h2 class="mb-0">{{ $new->intro }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                      {{ $new->detail }}
                        
                    </div>
                      
                </div>
            </div>
        </div>
        <br>
        <hr class="my-4" />
      -->

        







          </div>


        </div>

        <br>
        <hr class="my-3">
           

        <main class="py-4">
            @yield('content')
        </main>

@endsection