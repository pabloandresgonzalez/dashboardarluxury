@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-single-02"></i> Editar membresía - {{ $membresias->name }}</h3>
        </div>
        <div class="col-md-6">
          <a href="{{ url('membresias') }}" class="btn btn-outline-default">
          <i class="ni ni-bold-left"></i> Cancelar y volver
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


      <form class="row g-3" action="{{ url('membresias/'.$membresias->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PUT')



        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-paper-diploma"></i></span>
            </div>
            <input class="form-control" placeholder="Nombre" type="text" name="name" value="{{ old('name', $membresias->name) }}" required autocomplete="name" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-active-40"></i></span>
            </div>
            <input class="form-control" placeholder="Estado" type="text" name="isActive" value="{{ old('isActive', $membresias->isActive) }}" required autocomplete="isActive" autofocus>
         </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
            </div>            
            <input class="form-control" placeholder="Detalle" type="text" name="detail" value="{{ old('detail', $membresias->detail) }}" required autocomplete="detail" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">

              <span class="input-group-text"><i class="ni ni-image"></i>&nbsp; Imagen</span>
            </div>
            <input class="form-control" placeholder="image" value=""  type="file" name="image"  autocomplete="image" autofocus>
          </div>
        </div>


        <div class="col-md-4">
          <button type="submit" class="btn btn-outline-default" ><i class="ni ni-satisfied"></i> Editar membresía</button>
        </div>



      </form>

      </div>
    </div>
  </div>
@endsection





