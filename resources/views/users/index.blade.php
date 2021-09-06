@extends('layouts.panel')


@section('content')
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Usuarios</h3>
              </div>
              @if(session('message'))
                    <div class="alert alert-success">
                      {{ session('message') }}
                    </div>
              @endif


              <!-- Form -->
            <form class="">
              <div class="form-group mb-0">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text thead-dark"><i class="fas fa-search"></i></span>
                  </div>
                  <input name="buscarpor" class="form-control" placeholder="Buscar" type="text">
                    <!-- <button class="btn btn-secondary btn-sm" type="submit">Buscar</button> -->
                  </div>
              </div>
            </form>


            </div>
          </div>
          <div class="card-body">
            <div class="col-md-6">
          <a href="/user/create" class="btn btn-outline-default">
          <i class="ni ni-single-02"></i> Nuevo usuario
          </a>
        </div>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-dark">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="sort">Nombre</th>
                  <th scope="col">Apellido</th>
                  <th scope="col"># Identificación</th>
                  <th scope="col">Celular</th>
                  <th scope="col">Nivel</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Id de propietario</th>
                  <th scope="col">Id de referido</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Detalle</th>                  
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                  <td scope="row">
                    {{ $user->name }}
                  </td>
                  <td>
                    {{ $user->lastname }}
                  </td>
                  <td>
                    {{ $user->numberDoc }}
                  </td>
                  <td>
                    {{ $user->cellphone }}
                  </td>
                  <td>
                    {{ $user->level }}
                  </td>
                  <td>
                    {{ $user->isActive }}
                  </td>
                  <td>
                    {{ $user->id }}
                  </td>
                  <td>
                    {{ $user->ownerId }}
                  </td>
                  <td>
                    <form action="" method="POST">
                      @csrf
                      @method('')
                      <a href="{{ url('/user/'.$user->id.'/edit') }}" class="btn btn-outline-secondary"><i class="ni ni-settings"></i> Editar</a>
                    </form>
                  </td>
                  <td>
                      <a href="{{ url('/user/'.$user->id.'/detail') }}" class="btn btn-outline-secondary"><i class="ni ni-bullet-list-67"></i> Detalle</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <br>

            {{ $users->links() }}

           
          
    </div>
  </div>

  <br>
        <hr class="my-3">

        <main class="py-4">
            @yield('content')
        </main>

@endsection