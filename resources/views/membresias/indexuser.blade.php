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
                    <h4 class="card-title">100 Usd</h4> 
                    <span> <p class="card-text">
                    50 puntos<br></p></span><br>
                    <h5 class="card-title">5 % de Administración</h5>                   
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
                    <h4 class="card-title">250 Usd</h4> 
                    <span> <p class="card-text">
                    125 puntos<br></p></span><br>
                    <h5 class="card-title">5 % de Administración</h5>                   
                    <a href="#" class="btn btn-outline-success btn-lg btn-block">Comprar</a><br>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia3.PNG') }}" alt="Card image cap">
                  <div class="card-body" style="text-align: center;">
                    <h4 class="card-title">500 Usd</h4> 
                    <span> <p class="card-text">
                    250 puntos<br></p></span><br>
                    <h5 class="card-title">5 % de Administración</h5>                     
                    <a href="#" class="btn btn-outline-success btn-lg btn-block">Comprar</a><br>
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
                    <h4 class="card-title">1000 Usd</h4> 
                    <span> <p class="card-text">
                    500 puntos<br></p></span><br>
                    <h5 class="card-title">5 % de Administración</h5>                    
                    <a href="#" class="btn btn-outline-success btn-lg btn-block">Comprar</a><br>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia5.PNG') }}"  alt="Card image cap">
                  <div class="card-body" style="text-align: center;">
                    <h4 class="card-title">2000 Usd</h4> 
                    <span> <p class="card-text">
                    1000 puntos<br></p></span><br>
                    <h5 class="card-title">5 % de Administración</h5>                     
                    <a href="#" class="btn btn-outline-success btn-lg btn-block">Comprar</a><br>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia6.PNG') }}" alt="Card image cap">
                  <div class="card-body" style="text-align: center;">
                    <h4 class="card-title">2000 Usd</h4> 
                    <span> <p class="card-text">
                    1000 puntos<br></p></span><br>
                    <h5 class="card-title">5 % de Administración</h5>                    
                    <a href="#" class="btn btn-outline-success btn-lg btn-block">Comprar</a><br>
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
                    <h4 class="card-title">3000 Usd</h4> 
                    <span> <p class="card-text">
                    1500 puntos<br></p></span><br>
                    <h5 class="card-title">5 % de Administración</h5>                   
                    <a href="#" class="btn btn-outline-success btn-lg btn-block">Comprar</a><br>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia6.PNG') }}" alt="Card image cap">
                  <div class="card-body" style="text-align: center;">
                    <h4 class="card-title">5000 Usd</h4> 
                    <span> <p class="card-text">
                    2500 puntos<br></p></span><br>
                    <h5 class="card-title">5 % de Administración</h5>                    
                    <a href="#" class="btn btn-outline-success btn-lg btn-block">Comprar</a><br>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <br>
        <hr class="my-3">
           <h5> &nbsp; &nbsp; &nbsp;De la misma forma que pagues tu paquete, así mismo será tu pago. Ejemplo: si compras con Dash tus pagos serán en Dash<br><h5/>

        <main class="py-4">
            @yield('content')
        </main>

</div>

@endsection