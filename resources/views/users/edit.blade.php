@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-single-02"></i> Editar usuario</h3>
        </div>
        <div class="col-md-6">
          <a href="/user" class="btn btn-outline-default">
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


      <form class="row g-3" action="{{ url('user/'.$user->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PUT')


        <div class="col-md-12">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
            </div>
            <input class="form-control" placeholder="Código referido" type="text" name="ownerId" value="{{ old('ownerId', $user->ownerId) }}" required autocomplete="ownerId" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-single-02"></i></span>
            </div>
            <input class="form-control" placeholder="Nombre" type="text" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

             @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-single-02"></i></span>
            </div>
            <input class="form-control" placeholder="Apellido" type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}" required autocomplete="lastname" autofocus>

             @error('lastname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-badge"></i></span>
            </div>
            <input class="form-control" placeholder="typeDoc" type="text" name="typeDoc" value="{{ old('typeDoc', $user->typeDoc) }}" required autocomplete="typeDoc" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
            </div>
            <input class="form-control" placeholder="numberDoc" type="number" name="numberDoc" value="{{ old('numberDoc', $user->numberDoc) }}" required autocomplete="numberDoc" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
            </div>
            <input class="form-control" placeholder="phone" type="number" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="phone" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
            </div>
            <input class="form-control" placeholder="cellphone" type="number" name="cellphone" value="{{ old('cellphone', $user->cellphone) }}" required autocomplete="cellphone" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-world-2"></i></span>
            </div>
            <input class="form-control" placeholder="country" type="text" name="country" value="{{ old('country', $user->country) }}" required autocomplete="country" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <img src="{{ route('user.avatar',['filename'=>$user->photo]) }}" class="avatar"/>
              <span class="input-group-text"><i class="ni ni-camera-compact"></i></span>
            </div>
            <input class="form-control" placeholder="photo"  type="file" name="photo"  autocomplete="photo" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-camera-compact"></i>&nbsp; Documento</span>
            </div>
            <input class="form-control" placeholder="photoDoc"  type="file" name="photoDoc"  autocomplete="photoDoc" autofocus>
          </div>
        </div><!--
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-active-40"></i></span>
            </div>
            <input class="form-control" placeholder="isActive" type="text" name="isActive" value="" required autocomplete="isActive" autofocus>
          </div>
        </div> -->
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-button-power"></i>&nbsp;  Desactivar</span>
            </div>
              <label class="custom-toggle" >
                  <input type="checkbox" name="isActive"  checked>
                  <span class="custom-toggle-slider rounded-circle " data-label-off="No" data-label-on="Yes"></span>
              </label><span class="input-group-text"> Activar</span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" placeholder="level" type="text" name="level" value="{{ old('level', $user->level) }}"  required autocomplete="country" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
            </div>
            <input class="form-control" placeholder="Cambiar contraseña" type="password" name="password" autocomplete="new-password" value="" autofocus>
          </div>
          <p>Ingrese un valor sólo si desea modificar la contraseña.</p>
        </div>
        <div class="col-md-4">
          <button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modal-notification"><i class="ni ni-ruler-pencil"></i> Editar Usuario</button>
        </div>
        </div>
        <div class="col-md-4">
            <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                  <div class="modal-header">
                      <h6 class="modal-title" id="modal-title-notification">Se requiere tu atención</h6>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4">¡Deberías leer esto!</h4>
                          <p>Precaución esta acción cambiara los datos del usuario.</p>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-outline-default">
                        <i class="ni ni-check-bold"></i> Guardar Cambios
                      </button>
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
        </div>

      </form>
      </div>
    </div>
  </div>
@endsection





