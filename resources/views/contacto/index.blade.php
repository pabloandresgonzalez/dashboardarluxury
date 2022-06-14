@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-email-83"></i> Contactar al administrador</h3>
        </div>
        <div class="col-md-6">
          <a href="/home" class="btn btn-outline-default">
          <i class="ni ni-bold-left"></i> Cancelar y volver
          </a>
        </div>
      </div>
    </div>
    <div class="table-responsive">
    <div class="card-body">

      @if($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
          <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}
            <button type="button" class="close" data-dismiss="alert">
                <span>x</span>
            </button>
          </li>
          @endforeach
          <ul>
        </div>
      @endif


      <form class="row g-3" action="{{ route('contacto.store') }}" enctype="multipart/form-data" method="post">
        @csrf


        <div class="col-md-12">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"></span>
            </div>
            <textarea class="form-control" placeholder="Mensaje" type="textarea" name="message" value="" required autocomplete="message" autofocus rows="5"></textarea>            
          </div>
        </div>
        <div class="col-md-8">
          <div>
          <button type="submit" class="btn btn-outline-default" ><i class="ni ni-satisfied"></i> Enviar</button>
        </div>
        </div>

      </form>

      </div>
    </div>
  </div>
@endsection