@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-single-02"></i> Hash de pago</h3>
        </div>
        <div class="col-md-6">
          <a href="/membresiasuser" class="btn btn-outline-default">
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


      <form class="row g-3" action="{{ url('membership') }}" enctype="multipart/form-data" method="post">
        @csrf      

        
        
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-paper-diploma"></i></span>
            </div>
              <select id="id_membresia" name="id_membresia" class="form-control" >
                @foreach($membresias as $bc)
                  <option value="{{ $bc->id }}"> {{ $bc->id }} - "{{ $bc->name }}"</option>
                @endforeach
              </select>
          </div>
        </div>     
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
            </div>
              <select id="typeHash" name="typeHash" class="form-control" required>
                  <option value=""  >Forma de pago del paquete</option>
                  <option value="USDT"  >USDT</option>
                  <option value="BTC"  >BTC</option>
              </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-key-25"></i></span>
            </div>                        
            <input class="form-control" placeholder="hash" type="text" name="hash" value="" autocomplete="hash" autofocus>             
          </div>
        </div>        
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-image"></i>&nbsp;Solo archivo de imagen</span>
            </div>
            <input class="form-control" placeholder="image"  type="file" name="image"  autocomplete="image" autofocus>

          </div>          
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-outline-default" ><i class="ni ni-satisfied"></i> Enviar</button>          
        </div>



      </form>

      </div>
    </div>
    
  </div>

    <br>
        <hr class="my-3">
           <h5 style="text-align: center;"> &nbsp; De la misma forma que pagues tu paquete, así mismo será tu pago. Ejemplo: si compras con BTC tus pagos serán en BTC<br><h5/>

        <main class="py-4">
            @yield('content')
        </main>
@endsection







