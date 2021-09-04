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
          <div class="card-body">
        <div class="col-md-6">
          <a href="/membresias/create" class="btn btn-outline-default">
          <i class="ni ni-trophy"></i> Nueva membresía
          </a>
        </div>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-dark">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="sort">Nombre</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Detalle</th>
                  <th scope="col">Detalle</th>
                  <th scope="col">Editar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($membresias as $membresia)
                <tr>
                  <td scope="row">
                    {{ $membresia->name }}
                  </td>
                  <td>
                    {{ $membresia->isActive }}
                  </td>
                  <td>
                    {{ $membresia->detail }}
                  </td>
                  <td>
                    <form action="" method="POST">
                      @csrf
                      @method('DELETE')
                      <a href="{{ url('/membresias/'.$membresia->id.'/edit') }}" class="btn btn-outline-secondary"><i class="ni ni-settings"></i> Editar</a>
                    </form>
                  </td>
                  <td>
                      <a href="{{ url('/membresias/'.$membresia->id.'/detail') }}" class="btn btn-outline-secondary"><i class="ni ni-bullet-list-67"></i> Detalle</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>


          <div class="col-md-4">
        </div>
    </div>
  </div>

    <br>
        <hr class="my-3">
           

        <main class="py-4">
            @yield('content')
        </main>

@endsection