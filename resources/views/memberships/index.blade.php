@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-single-02"></i> Gestíon Memberships</h3>
        </div>
        <div class="col-md-6">
          <a href="membresiasuser" class="btn btn-outline-default">
          <i class="ni ni-trophy"></i> Membresías
          </a>
        </div>
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
                  <th scope="col" class="sort">Nombre</th>
                  <th scope="col">Hash</th>
                  <th scope="col">Tipo de Hash</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Fecha Cierre</th>
                  <th scope="col">Soporte de pago</th>
                  <th scope="col">Detalle</th>
                  <th scope="col">+ Detalles</th>
                  <th scope="col">Editar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($memberships as $membership)
                <tr>
                  <td scope="row">
                    {{ $membership->membership }}
                  </td>
                  <td>
                    {{ $membership->hash }}
                  </td>
                  <td>
                    {{ $membership->typeHash }}
                  </td>
                  <td>
                    {{ $membership->status }}
                  </td>
                  <td>
                    {{ $membership->closedAt }}
                  </td>
                  <td>
                    {{ $membership->image }}
                  </td>   
                  <td>
                    {{ $membership->detail }}
                  </td>                
                  <td>
                    <form action="" method="POST">
                      @csrf
                      @method('DELETE')
                      <a href="{{ url('/membership/'.$membership->id.'/edit') }}" class="btn btn-outline-secondary"><i class="ni ni-settings"></i> Editar</a>
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

                            Nombre: <td scope="row">

                            </td><br>                            
                            Hash: <td>

                            </td><br>
                            Tipo de Hash: <td>

                            </td><br>
                            Fecha Cierre: <td>

                            </td><br>
                            Soporte de pago: <td>

                            </td><br>
                            Fecha Registro: <td>

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
    </div>
  </div>
@endsection





