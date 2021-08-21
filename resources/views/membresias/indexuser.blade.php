@extends('layouts.panel')


@section('content')
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h1 class="mb-0">Membresías</h1>
              </div>
              @if(session('message'))
                    <div class="alert alert-success">
                      {{ session('message') }}
                    </div>
              @endif

            </div>
          </div>


      <div class="container-fluid">
        <div class="header-body">

          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia1.PNG') }}" alt="Card image cap">
                  <div class="card-body" style="text-align: center;">
                    <h4 class="card-title">REQUISITO:</h4>
                    <span> <p class="card-text">
                    Quien compra un paquete de cualquier valor.<br>
                    Tener un paquete activo.</p></span><br>
                    <a href="#" class="btn btn-outline-success btn-lg btn-block">Comprar</a><br>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia2.PNG') }}"  alt="Card image cap">
                  <div class="card-body" style="text-align: center;">
                    <h3 class="card-title" >BENEFICIO</h3>
                    <span> <p class="card-text">Bono de 50 Usd en USDT.</p></span><br>
                    <h4 class="card-title">REQUISITO:</h4>
                    <span> <p class="card-text">
                    Tener en su equipo de ventas 5<br>
                    Tener un paquete activo.</p></span><br>
                    <a href="#" class="btn btn-outline-secondary btn-lg btn-block">Comprar</a>
                     <hr class="my-3">
                     RECALIFICACIÓN: 4 MESES Evento de capacitación<br>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia3.PNG') }}" alt="Card image cap">
                  <div class="card-body" style="text-align: center;">
                    <h3 class="card-title" >BENEFICIO</h3>
                    <span> <p class="card-text">Participación seminario de 3 días en ciudad principal.
                      <br>Bono de 200 Usd en USDT.</p></span><br>
                    <h4 class="card-title">REQUISITO:</h4>
                    <span> <p class="card-text">
                    Tener en su equipo de ventas 2 Director y 30.000 Pts de V.V.<br>
                    Ó 45.000 Pts de V.V.<br>
                    Tener un paquete activo.</p></span><br>
                    <a href="#" class="btn btn-outline-primary btn-lg btn-block">Comprar</a>
                     <hr class="my-3">
                     RECALIFICACIÓN: 4 MESES Evento de capacitación<br>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <hr class="my-3">

            <div class="container-fluid">
        <div class="header-body">

          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia4.PNG') }}" alt="Card image cap">
                  <div class="card-body" style="text-align: center;">
                    <h3 class="card-title" >BENEFICIO</h3>
                    <span> <p class="card-text">Bono de 300 Usd en USDT.</p></span><br>
                    <h4 class="card-title">REQUISITO:</h4>
                    <span> <p class="card-text">
                    Tener en su equipo de ventas 2 Perla y 60.000 Pts de V.V.<br>
                    Ó 90.000 Pts de V.V.<br>
                    Tener un paquete activo.</p></span><br>
                    <a href="#" class="btn btn-outline-success btn-lg btn-block">Comprar</a>
                     <hr class="my-3">
                     RECALIFICACIÓN: 4 MESES Evento de capacitación + Netbook<br>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia5.PNG') }}"  alt="Card image cap">
                  <div class="card-body" style="text-align: center;">
                    <h3 class="card-title" >BENEFICIO</h3>
                    <span> <p class="card-text">Bono de 400 Usd en USDT.</p></span><br>
                    <h4 class="card-title">REQUISITO:</h4>
                    <span> <p class="card-text">
                    Tener en su equipo de ventas 2 Óro. y 180.000 Pts de V.V.<br>
                    Ó 330.000 Pts de V.V.<br>
                    Tener un paquete activo.</p></span><br>
                    <a href="#" class="btn btn-outline-success btn-lg btn-block">Comprar</a>
                     <hr class="my-3">
                     RECALIFICACIÓN: 4 MESES Evento de capacitación + Macbook<br>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia6.PNG') }}" alt="Card image cap">
                  <div class="card-body" style="text-align: center;">
                    <h3 class="card-title" >BENEFICIO</h3>
                    <span> <p class="card-text">Bono de liderazgo de 25.0000 Usd en BTC.</p></span><br>
                    <h4 class="card-title">REQUISITO:</h4>
                    <span> <p class="card-text">
                    Tener en su equipo de ventas 2 Rubí. Y 360.000 Pts de V.V.<br>
                    Ó más de 1'400.000 Pts de V.V.<br>
                    Tener un paquete activo.</p></span><br>
                    <a href="#" class="btn btn-outline-success btn-lg btn-block">Comprar</a>
                     <hr class="my-3">
                     RECALIFICACIÓN: 4 MESES Evento de capacitación Internacional<br>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

            <hr class="my-3">

            <div class="container-fluid">
        <div class="header-body">

          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia7.PNG') }}" alt="Card image cap">
                  <div class="card-body" style="text-align: center;">
                    <h3 class="card-title" >BENEFICIO</h3>
                    <span> <p class="card-text">Bono de liderazgo de 50.000 Usd.</p></span><br>
                    <h4 class="card-title">REQUISITO:</h4>
                    <span> <p class="card-text">
                    Tener en su equipo de ventas 2 Esmeralda. Y 900.000 Pts de V.V.<br>
                    Ó más de 2'000.000 Pts de V.V.<br>
                    Tener un paquete activo.</p></span><br>
                    <a href="#" class="btn btn-outline-success btn-lg btn-block">Comprar</a>
                     <hr class="my-3">
                     RECALIFICACIÓN: 4 MESES Evento de capacitación Internacional<br>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

        <main class="py-4">
            @yield('content')
        </main>

</div>

@endsection