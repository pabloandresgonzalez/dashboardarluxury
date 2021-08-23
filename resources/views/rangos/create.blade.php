@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-single-02"></i> Crear membresía</h3>
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


      <form class="row g-3" action="{{ url('membresias') }}" enctype="multipart/form-data" method="post">
        @csrf



        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-paper-diploma"></i></span>
            </div>
            <input class="form-control" placeholder="Nombre" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-active-40"></i></span>
            </div>
            <input class="form-control" placeholder="Estado" type="text" name="isActive" value="{{ old('isActive') }}" required autocomplete="isActive" autofocus>
         </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
            </div>
            <textarea class="form-control" id="detail" rows="3" type="text" name="detail" placeholder="Detalle" value="{{ old('detail') }}" required autocomplete="detail" autofocus></textarea> <!--
            <input class="form-control" placeholder="Detalle" type="text" name="detail" value="{{ old('detail') }}" required autocomplete="detail" autofocus>-->
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">

              <span class="input-group-text"><i class="ni ni-image"></i>&nbsp; Imagen</span>
            </div>
            <input class="form-control" placeholder="photo"  type="file" name="photo"  autocomplete="photo" autofocus>
          </div>
        </div>


        <div class="col-md-4">
          <button type="submit" class="btn btn-outline-default" ><i class="ni ni-satisfied"></i> Crear membresía</button>
        </div>



      </form>

      </div>
    </div>
  </div>
@endsection





