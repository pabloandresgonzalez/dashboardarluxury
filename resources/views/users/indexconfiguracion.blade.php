@extends('layouts.panel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Configuración de cuenta</div>

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

                    <!-- Page content -->

      <div class="row">
        
        <div class="col-xl-12 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">{{ Auth::user()->name }}</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="/wallet" class="btn btn-outline-secondary"><i class="ni ni-money-coins"></i> Billetera</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              
    <form class="row g-3" action="{{ url('user/updateuserconfiguracion/'.$user->id) }}" enctype="multipart/form-data" method="post">
    @csrf
    @method('PUT')


        
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
            </div>
            <input class="form-control" placeholder="Telefono" type="number" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="phone" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
            </div>
            <input class="form-control" placeholder="Movil" type="number" name="cellphone" value="{{ old('cellphone', $user->cellphone) }}" required autocomplete="cellphone" autofocus>
          </div>
        </div>
        <div class="col-md-12">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-email-83"></i></span>
            </div>
              <input class="form-control" placeholder="Email" type="email" name="email" autocomplete="email" value="{{ $user->email }}" autofocus >
          </div>
        </div>        
        <div class="col-md-12">
          <p>Ingrese una nueva contraseña, sólo si desea cambiar la contraseña.</p>
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
            </div>
            <input class="form-control" placeholder="Contraseña" type="password" name="password" autocomplete="new-password" value="" autofocus >
          </div>
        </div>
        <div class="col-md-12" hidden="true">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-camera-compact"></i>&nbsp; Documento</span>
            </div>
            <input class="form-control" placeholder="photoDoc"  type="file" name="photoDoc"  autocomplete="photoDoc" autofocus>
          </div>
        </div>
        
        
        <div class="col-md-4">
          <button type="submit" class="btn btn-outline-default" ><i class="ni ni-satisfied"></i> Guardar cambios</button>
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
    </div>
</div>
@endsection
