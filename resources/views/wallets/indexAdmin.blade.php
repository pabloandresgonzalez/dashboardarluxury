@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-single-02"></i> Gestíon wallets</h3>
        </div>
        <div class="col-md-6">
          <a href="/home" class="btn btn-outline-default">
          <i class="ni ni-tv-2"></i> Escritorio
          </a>
        </div>
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


          <div class="table-responsive">
            <table class="table align-items-center table-dark">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="sort">id</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Estado</th>
                  <th scope="col">$ Valor</th>
                  <th scope="col">Tarifa</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Divisa</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Detalle</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($Wallets as $Wallet)
                <tr>
                  <td scope="row">
                    {{ $Wallet->id }}
                  </td>
                  <td>
                    {{ $Wallet->user }}
                  </td>
                  <td>
                    {{ $Wallet->created_at }}
                  </td>
                  <td>
                    {{ $Wallet->status }}
                  </td>
                  <td>
                    {{ $Wallet->value }}
                  </td>
                  <td>
                    {{ $Wallet->fee }}
                  </td>
                  <td>
                    {{ $Wallet->type }}
                  </td>
                  <td>
                    {{ $Wallet->currency }}
                  </td>                
                  <td>
                    <form action="" method="POST">
                      @csrf
                      @method('DELETE')
                      <a href="{{ url('/wallet/'.$Wallet->id.'/edit') }}" class="btn btn-outline-secondary"><i class="ni ni-settings"></i> Editar</a>
                    </form>
                  </td>
                  <td>
                      <a href="" class="btn btn-outline-secondary"><i class="ni ni-bullet-list-67"></i> Detalle</a>
                  </td>
                </tr>
                 @endforeach
              </tbody>
            </table>

            <br>

            {{ $Wallets->links() }}


        </div>

    





      </div>
    </div>
  </div>
@endsection





