@extends('layouts.panel')


@section('content')
<div class="card shadow">

          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h1 class="mb-0">Mi red</h1>
              </div>
              

              @if(session('message'))
                    <div class="alert alert-danger">
                      {{ session('message') }}
                    </div>
              @endif



            </div>
          </div>


      <div class="container-fluid">
        <div class="header-body">
            <div class="row-fluid ">
              <div class="row">

              @foreach($misusers as $misuser)


                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
			          <div class="card card-profile shadow">
			            <div class="row justify-content-center">
			              <div class="col-lg-3 order-lg-2">
			                <div class="card-profile-image">
			                  <a href="#" data-toggle="modal" data-target="#exampleModal">
			                    <img src="{{ route('user.avatar',['filename'=>$misuser->photo ]) }}"/>
			                  </a>			                  
			                </div>
			              </div>
			            </div>
			            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
			            	<div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4" data-toggle="modal" data-target="#exampleModal"><i class="ni ni-tag"></i> + Detalles</a>

                <!-- Modal -->

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">&#128512; Información de colaborador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

			            <div class="list-inline-item">
			            <ul>
			              <li class="list-inline-item"><h4></h4></li>
			            </ul> 
			            <ul>
			              <li class="list-inline-item"><h4></h4></li>
			            </ul>
			            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                      </div>
                    </div>
                  </div>
                </div>



                
              </div>
			            	<br><br>
			            </div>
			            <div class="card-body pt-0 pt-md-4">
			              <div class="row">
			                <div class="col">
			                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
			                    <div>
			                      <span class="heading">{{ $misuser->name }}  {{ $misuser->lastname }}</span>
			                      <span class="description">{{ $misuser->created_at }}</span>
			                    </div>
			                  </div>
			                </div>
			              </div>
			              <div class="text-center">
			                <h3>
			                  <span class="font-weight-light">{{ $misuser->email }}</span>
			                </h3>
			                <div class="h5 font-weight-300">
			                  <i class="ni location_pin mr-2"></i>{{ $misuser->cellphone }}
			                </div>	

			              </div>

			              <hr class="my-4" />
			                <br><br>
			            </div>
			          </div>
			        </div> 
			        <br><br><br>


              @endforeach

            
        </div>
      </div>
    </div>



  </div>
</div>

  <br>
        <hr class="my-3">
           <h5 style="text-align: center;"> &nbsp; Red de miembros <br><h5/>

        <main class="py-4">
            @yield('content')
        </main>


@endsection
