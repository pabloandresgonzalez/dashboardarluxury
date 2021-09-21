@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-bullet-list-67"></i> &nbsp;Detalle</h3>
        </div>
        <div class="col-md-6">
          <a href="/membresias" class="btn btn-outline-default">
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


      <div class="card pub-prestamo">
        <div class="card-header">
          <h3 class="mb-0"><i class="ni ni-single-02"></i> &nbsp;Información de la membresia {{ $membresia->name }}</h3>
        </div>

        
        <div class="card-body">
          <div class="list-inline-item">
            <ul>
              Nombre:  &nbsp;
              <li class="list-inline-item"><h4>{{ $membresia->name }}</h4></li>
            </ul>
            <ul>
              Estado: &nbsp;
              <li class="list-inline-item"><h4>{{ $membresia->isActive }}</h4></li>
            </ul>
            <ul>
              Valor: &nbsp;
              <li class="list-inline-item"><h4>{{ $membresia->valor }}</h4></li>
            </ul>
            <ul>
              Detalle:  &nbsp
              <li class="list-inline-item"><h4>{{ $membresia->detail }}</h4></li>
            </ul>
                     
    </div>
     </div>
  </div>

        <hr class="my-3">
@endsection





