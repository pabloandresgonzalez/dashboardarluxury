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


      <div class="card pub-prestamo">
        <div class="card-header">
          <h3 class="mb-0"><i class="ni ni-single-02"></i> &nbsp;Balance de </h3>
        </div>

        <!--
        <div class="card-body">
          <div class="list-inline-item">
            <ul>
              Nombre:  &nbsp;
              <li class="list-inline-item"><h4></h4></li>
            </ul>
            <ul>
              Id: &nbsp;
              <li class="list-inline-item"><h4></h4></li>
            </ul>
            <ul>
              Estado:  &nbsp;
              <li class="list-inline-item">
                <h4>
                
                </h4>
              </li>
            </ul>
            <ul>
              Tipo de documento:  &nbsp
              <li class="list-inline-item"><h4></h4></li>
            </ul>
            <ul>
              Numero de documento:  &nbsp;
              <li class="list-inline-item"><h4></h4></li>
            </ul>
            <ul>
              Rol:  &nbsp;
              <li class="list-inline-item"><h4></h4></li>
            </ul>
            <ul>
              Email:  &nbsp;
              <li class="list-inline-item"><h4></h4></li>
            </ul>
            <ul>
              Telefono:  &nbsp;
              <li class="list-inline-item"><h4></h4></li>
            </ul>
            <ul>
              Celular:  &nbsp;
              <li class="list-inline-item"><h4></h4></li>
            </ul>
            <ul>
              País:  &nbsp;
              <li class="list-inline-item"><h4></h4></li>
            </ul>
            <ul>
              Nivel:  &nbsp;
              <li class="list-inline-item">
                <h4>
                  
                </h4>
              </li>
            </ul>
            <ul>
              Id de referido:  &nbsp;
              <li class="list-inline-item"><h4></h4></li>
            </ul>
            </div>
          
    </div>
  -->
  </div>
  

        <hr class="my-3"> 

@endsection





