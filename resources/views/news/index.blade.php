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
          <div class="table-responsive">
            <table class="table align-items-center table-dark">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="sort">Titulo</th>
                  <th scope="col">Intro</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Detalles</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($news as $new)
                <tr>
                  <td scope="row">
                    {{ $new->title }}
                  </td>
                  <td>
                    {{ $new->intro }}
                  </td>
                  <td>
                    {{ $new->isActive }}
                  </td>
                  <td>
                    <form action="" method="POST">
                      @csrf
                      @method('DELETE')
                      <a href="{{ url('/news/'.$new->id.'/edit') }}" class="btn btn-outline-secondary"><i class="ni ni-settings"></i> Editar</a>
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

            {{ $news->links() }}

            


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