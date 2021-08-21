@extends('layouts.panel')


@section('content')
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Membresía</h3>
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
                      <a href="" class="btn btn-outline-secondary"><i class="ni ni-settings"></i> Editar</a>
                    </form>
                  </td>
                  <td>
                      <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal-default"><i class="ni ni-bullet-list-67"></i> Detalle</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>


            <div class="row">
              <div class="col-md-4">

                <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-default">Información de la membresía </h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <div class="modal-body">

                            <img src="" class="avatar"/> <br>

                            Nombre: <td scope="row">

                            </td><br>
                            Estado: <td>

                            </td><br>
                            Detalle: <td>

                            </td><br>

                            </div>

                            <div class="modal-footer">
                            <td>
                              <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="" class="btn btn-outline-secondary"><i class="ni ni-settings"></i> Editar</a>
                              </form>
                            </td>
                                <button type="button" class="btn btn-link ml-auto" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

                </div>
                <div class="card-body">
                  <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <li class="page-item"><a class="page-link" href="#"><</a></li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">></a></li>
                    </ul>
                  </nav>
                </div>

          </div>


          <div class="col-md-4">
        </div>
    </div>
  </div>

@endsection