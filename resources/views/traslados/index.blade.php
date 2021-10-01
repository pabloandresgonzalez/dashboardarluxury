@extends('layouts.panel')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-bullet-list-67"></i> &nbsp;Detalle</h3>
        </div>
        <div class="col-md-6">
          <a href="/home" class="btn btn-outline-default">
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

      <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
      <div class="card pub-prestamo">
        <div class="card-header">
          <h3 class="mb-0"><i class="ni ni-single-02"></i> &nbsp;Balance de - {{ $user->name }}</h3>
        </div>

        
        <div class="card-body">
          
          <div class="list-inline-item">
            <ul>
              Balance:  &nbsp;
              <li class="list-inline-item"><h4><?php echo $respuestaDecodificada->balance;?></h4></li>
            </ul>
            <ul>
              En canje: &nbsp;
              <li class="list-inline-item"><h4><?php echo $respuestaDecodificada->exhange;?></h4></li>
            </ul>
            <ul>
              Total:  &nbsp;
              <li class="list-inline-item"><h4><?php echo $respuestaDecodificada->total;?></h4>
              </li>
            </ul>
            

            </div>
          
    </div>
  </div>
  
  </div>
  

        <hr class="my-3"> 

@endsection





