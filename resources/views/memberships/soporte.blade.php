@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-single-02"></i> Soporte de pago</h3>
        </div>
        <div class="col-md-6">
          <a href="/membership" class="btn btn-outline-default">
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

      <div class="card shadow"> 
        <img src="{{ route('prestamo.avatar',['filename'=>$membership->image]) }}" class="avatarsoporte" />
      </div>




      

      </div>
    </div>
  </div>
@endsection





