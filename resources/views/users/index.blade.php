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
                  <th scope="col">Encender|Apagar</th>
                  <th scope="col">Detalle</th>
                  <th scope="col">Editar</th>
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
                    {{ $user->ownerId }}
                  </td>
                  <td>
                  <label class="custom-toggle">
                      <input type="checkbox" checked>
                      <span class="custom-toggle-slider rounded-circle " data-label-off="No" data-label-on="Yes"></span>
                  </label>
                  </td>
                  <td>
                    <form action="" method="POST">
                      @csrf
                      @method('DELETE')
                      <a href="{{ url('/user/'.$user->id.'/edit') }}" class="btn btn-outline-secondary"><i class="ni ni-settings"></i> Editar</a>
                    </form>
                  </td>
                  <td>
                      <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal-default">Detalle</button>
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
                                <h6 class="modal-title" id="modal-title-default">Datos del usuario {{ $user->name }}</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <div class="modal-body">


                            <img src="{{ route('user.avatar',['filename'=>$user->photo]) }}" class="avatar"/> <br>

                            Nombre completo: <td scope="row">
                              {{ $user->name }} {{ $user->lastname }}
                            </td><br>
                            Correo eletronco: <td>
                              {{ $user->email }}
                            </td><br>
                            Tipo de documento: <td>
                              {{ $user->typeDoc }}
                            </td><br>
                            Numero de identificación: <td>
                              {{ $user->numberDoc }}
                            </td><br>
                            Telefono: <td>
                              {{ $user->phone }}
                            </td><br>
                            Celular: <td>
                              {{ $user->cellphone }}
                            </td><br>
                            Pais: <td>
                              {{ $user->country }}
                            </td><br>
                            Nivel: <td>
                              {{ $user->level }}
                            </td><br>
                            Estado: <td>
                              {{ $user->isActive }}
                            </td><br>
                            Id de propietario: <td>
                              {{ $user->ownerId }}
                            </td>
                            </div>

                            <div class="modal-footer">
                            <td>
                              <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ url('/user/'.$user->id.'/edit') }}" class="btn btn-outline-secondary"><i class="ni ni-settings"></i> Editar</a>
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