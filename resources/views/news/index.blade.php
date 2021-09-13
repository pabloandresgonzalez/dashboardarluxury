@extends('layouts.panel')


@section('content')
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Gestionar las noticias</h3>
              </div>
              @if(session('message'))
                    <div class="alert alert-success">
                      {{ session('message') }}
                    </div>
              @endif

        </div>
          </div>
          <div class="card-body">
        <div class="col-md-6">
          <a href="/news/create" class="btn btn-outline-default">
          <i class="ni ni-notification-70"></i> &nbsp;Nueva noticia
          </a>
        </div>
          </div>


      </div>

      <br>
        <hr class="my-3">
           

        <main class="py-4">
            @yield('content')
        </main>

@endsection