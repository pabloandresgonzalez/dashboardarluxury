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
          <br>


      <div class="container-fluid">
        <div class="header-body">
            <div class="row-fluid ">
              <div class="row">

              @foreach($misusers1 as $misuser)


                <div class="col-xl-2 order-xl-2 mb-5 mb-xl-0">
			          <div class="card card-profile shadow">
			            <div class="row justify-content-center">
			              <div class="col-lg-3 order-lg-2">
			                <div class="card-profile-image">
			                  <a href="#" data-toggle="modal" >
			                    <img style="width: 80px" src="{{ route('user.avatar',['filename'=>$misuser->photo ]) }}"/>
			                  </a>			                  
			                </div>
			              </div>
			            </div><!--
			            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-4">
			            	<div class="d-flex justify-content-between">
                <a href="#" data-toggle="modal" class="btn btn-sm btn-info mr-4" >{{ $misuser->user_email }}</a>
              
              </div>
			            </div>-->
                  <br><br>
			            <div class="card-body pt-0 pt-md-2">
			              <div class="row">
			                <div class="col">
			                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
			                    <div>
			                      <h5>{{ $misuser->user_email }}</h5>
			                      <span class="description">Membresia: {{ $misuser->membership }}</span>
			                    </div>                          
			                  </div>
			                </div>
			              </div>
			              <div class="text-center">
			                <h3>
			                  <span class="font-weight-light">Estado: {{ $misuser->status }}</span>
			                </h3>
			                <div class="h5 font-weight-300">
			                  <i class="ni location_pin mr-2"></i>
                        <div></div>
			                </div>	

			              </div>
			            </div>
			          </div>
			        </div> 

              @endforeach

            
        </div>
      </div>
    </div>
    <br>

    <div class="card-header">
          <i class="ni ni-money-coins"></i> &nbsp;Historial de pagos</h3>
        </div> 


          <div class="table-responsive">
            <table class="table align-items-center table-dark">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="sort">Membresia</th>
                  <th scope="col">Fecha de pago</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">$ Monto</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Detalle</th>
                </tr>
              </thead>


              <tbody>
                @foreach ($networktransactions as $networktransaction)
                <tr>                  
                  <td scope="row">
                    {{ $networktransaction->userMembership }}
                  </td>
                  <td>
                    {{ $networktransaction->created_at }}
                  </td>
                  <td>
                    {{ $networktransaction->email  }}
                  </td>
                  <td>
                    {{ $networktransaction->value }}
                  </td>
                  <td>
                    {{ $networktransaction->type }}
                  </td>
                  <td>
                    {{ $networktransaction->detail }}                   
                  </td> 
                 </tr>
                  @endforeach
            </table>
            <br>     

            

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
