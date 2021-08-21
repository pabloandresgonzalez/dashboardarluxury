@extends('layouts.panel')


@section('content')
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Membresías</h3>
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
                  <div class="card-body">
                    <h5 class="card-title">1</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia1.PNG') }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">2</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia1.PNG') }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">3</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia1.PNG') }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">4</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>


    <div class="container-fluid">

      <div class="header-body">

          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia1.PNG') }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">1</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia1.PNG') }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">2</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia1.PNG') }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">3</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia1.PNG') }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">4</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia1.PNG') }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">4</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia1.PNG') }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">4</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{ asset('img/brand/membresia1.PNG') }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">4</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
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

@endsection