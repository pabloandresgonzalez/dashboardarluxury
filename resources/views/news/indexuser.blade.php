@extends('layouts.panel')


@section('content')
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0"> Noticias</h3>
              </div>
              @if(session('message'))
                    <div class="alert alert-success">
                      {{ session('message') }}
                    </div>
              @endif

            </div>
          </div>

          <div class="card-body">

          </div>


        </div>

        <br>
        <hr class="my-3">
           

        <main class="py-4">
            @yield('content')
        </main>

@endsection