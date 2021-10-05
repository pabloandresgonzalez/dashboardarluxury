@extends('layouts.panel')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-ruler-pencil"></i> &nbsp;Editar wallet</h3>
        </div>
        <div class="col-md-6">
          <a href="/walletadmin" class="btn btn-outline-default">
          <i class="ni ni-bold-left"></i> Volver
          </a>
        </div>
      </div>
    </div>
    <div class="table-responsive">
    <div class="card-body">

      @if($errors->any())
        <div class="alert alert-danger" role="alert">
          <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}
          </li>
          @endforeach
          <ul>
        </div>
      @endif

      <div class="container-fluid">
        <div class="header-body">
            <div class="row-fluid ">
              <div class="row">



            <div class="col-xl-8 order-xl-2 mb-5 mb-xl-0">
                <div class="card pub-prestamo">
                  <div class="card-header">
                    <h3 class="mb-0"><i class="ni ni-credit-card"></i> &nbsp;Cambiar estado de retiro - {{ $Wallets->id }}</h3>
                  </div>

                  
                    <div class="card-body">
                    
                      <form class="row g-3" action="{{ url('/wallet/'.$Wallets->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')

                        	
                            <div class="col-md-6" >
                              <div class="input-group input-group-alternative mb-3">
                                 
                                @if($Wallets->status === 'Aprobada')
                                <label>&nbsp; El estado es <strong>{{ $Wallets->status }}</strong>, ya no es &nbsp;posible hacer mas cambios &nbsp; &nbsp; </label>
                            @else 
                            <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
                                </div>                             
                                <select id="status" name="status" class="form-control" required>                             	
                                		
                                	<option value="{{ $Wallets->status }}">Selecione un estado</option>
      					                  <option value="change"  >En proceso</option>
      					                  <option value="Rechazada"  >Rechazada</option>
      					                  <option value="Aprobada"  >Aprobada</option>
					                       </select>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-alternative mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                  </div>                        
                                  <input class="form-control" placeholder="hash" type="text" name="hash" value="" autocomplete="hash" autofocus>             
                                </div>
                              </div>


                            <div class="col-md-4">
                              <button type="submit" class="btn btn-outline-default" ><i class="ni ni-satisfied"></i> Cambiar estado</button>
                            </div>

                          @endif  
                    </div>

                  <div class="col-md-4">
                                

                      </form>

                    
                    </div>
                  </div> 
                </div>


              </div>
            </div>
        </div>    
      </div>





        <hr class="my-3"> 

@endsection





