@extends('layouts.form')



@section('content')
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-gradient-primary-formulario shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">

                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if(session('message'))
                        <div class="alert alert-success">
                          {{ session('message') }}
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


              <form class="row g-3" role="form" method="POST" action="{{ route('consultasuser') }}">
                @csrf



                <div class="col-md-12">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">                      
                      <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="Ingresa el Código de referido" id="ownerId" type="text" name="ownerId" value="{{ old('ownerId') }}" required autocomplete="ownerId" autofocus>
                  </div>
                </div>


                <div class="col-12">
                  <button type="submit" class="btn btn-primary mt-4">Ir a Registro</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection



