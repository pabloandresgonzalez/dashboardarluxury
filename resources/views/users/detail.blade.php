@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-bullet-list-67"></i> &nbsp;Detalle</h3>
        </div>
        <div class="col-md-6">
          <a href="/user" class="btn btn-outline-default">
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
          <h3 class="mb-0"><i class="ni ni-single-02"></i> &nbsp;Información de {{ $user->name }}</h3>
        </div>

        
        <div class="card-body">
          <div class="list-inline-item">
            <ul>
              Nombre:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->name }} {{ $user->lastname }}</h4></li>
            </ul>
            <ul>
              Id: &nbsp;
              <li class="list-inline-item"><h4>{{ $user->id }}</h4></li>
            </ul>
            <ul>
              Estado:  &nbsp;
              <li class="list-inline-item">
                <h4>
                @if($user->isActive == 1)
                    Activo
                  @elseif($user->isActive == 0)
                    Desactivado
                  @endif
                </h4>
              </li>
            </ul>
            <ul>
              Tipo de documento:  &nbsp
              <li class="list-inline-item"><h4>{{ $user->typeDoc }}</h4></li>
            </ul>
            <ul>
              Numero de documento:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->numberDoc }}</h4></li>
            </ul>
            <ul>
              Rol:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->role }}</h4></li>
            </ul>
            <ul>
              Email:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->email }}</h4></li>
            </ul>
            <ul>
              Telefono:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->phone }}</h4></li>
            </ul>
            <ul>
              Celular:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->numberDoc }}</h4></li>
            </ul>
            <ul>
              País:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->country }}</h4></li>
            </ul>
            <ul>
              Nivel:  &nbsp;
              <li class="list-inline-item">
                <h4>
                  @if($user->level == 1)
                     USUARIO
                  @elseif($user->level == 2)
                    DIRECTOR
                  @elseif($user->level == 3)
                    DIRECTOR JUNIOR
                  @elseif($user->level == 4)
                    DIRECTOR SENIOR
                  @elseif($user->level == 5)
                    VICE PRESIDENTE
                  @endif
                </h4>
              </li>
            </ul>
            <ul>
              Id de referido:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->ownerId }}</h4></li>
            </ul>
            </div>
          
    </div>
  </div>
  

        <hr class="my-3"> 

@endsection





