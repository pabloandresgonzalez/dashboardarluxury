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
                    <h3 class="mb-0"><i class="ni ni-credit-card"></i> &nbsp;Asignar saldo </h3>
                  </div>

                  
                    <div class="card-body">
                    
                      <form class="row g-3" action="{{ url('/wallets/asaldo') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')



                        <div class="col-md-12">
                          <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                            </div>
                            <input class="form-control" placeholder="Valor" type="number" name="value" value="" required autocomplete="value" autofocus>
                         </div>
                        </div>

                        <div class="col-md-12">
                          <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-single-02"></i>&nbsp;Asignar a </span>
                            </div>
                              <select id="id" name="idmovimiento" class="form-control" >
                                @foreach($users as $user)
                                  <option value="{{ $user->id }}"> {{ $user->email }} - {{ $user->name. " ".$user->lastname }}</option>
                                @endforeach
                              </select>                              
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                            </div>
                              <select id="type" name="type" class="form-control" required>
                                  <option value=""  >Tipo de movimiento</option>
                                  <option value="0"  >Retiro</option>
                                  <option value="1"  >Abono</option>
                              </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                            </div>
                              <select id="currency" name="currency" class="form-control" required>
                                  <option value=""  >Tipo divisa</option>
                                  <option value="USDT"  >USDT</option>
                                  <option value="BTC"  >BTC</option>
                              </select>
                          </div>
                        </div>

                        <div class="col-md-12" >
                          <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
                            </div>
                            <input class="form-control" placeholder="Observación movimiento" type="text" name="detail" value="" required autocomplete="detail" autofocus>
                          </div>
                        </div>                        



                        <div class="col-md-4">
                          <button type="submit" class="btn btn-outline-default" ><i class="ni ni-satisfied"></i> Hacer traslado</button>
                        </div>

                         
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