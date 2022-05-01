@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-bullet-list-67"></i> &nbsp;Historial membresias</h3>
        </div>
        <div class="col-md-6">
          <a href="/home" class="btn btn-outline-default">
          <i class="ni ni-tv-2"></i> Escritorio
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



      <script>
          swal('<?php echo "Hola! ".$user->name. ", no olvides revisar el tiempo restante de tus membresías" ?>');               
      </script>

      
      <div class="card pub-prestamo">
        <div class="card-header">
          <i class="ni ni-box-2 "></i> &nbsp;Mis Membresias </h3>
        </div>


          <div class="table-responsive">
            <table class="table align-items-center table-dark">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="sort">Membresia</th>
                  <th scope="col">Dias restantes</th>
                  <th scope="col">Hash</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Fecha activada</th>
                  <th scope="col">Fecha cierre</th>
                  <th scope="col">Detalle</th>
                  <th scope="col">Pagos diarios</th>
                  <th scope="col">Pagos x activación</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($memberships as $membership)
                <tr>
                  <td scope="row">
                    {{ $membership->membership }}
                  </td>
                  <td>
                    <?php 
                      if ($membership->status === 'Activo') {
                        $fecha_actual = date("Y-m-d");
                        $fecha_final = $membership->closedAt;
                        
                        $fecha11 = strtotime($fecha_actual); 
                        $fecha22 = strtotime($fecha_final);

                          // Obtiene los dias faltantes sin sabados ni domingos 
                          for($fecha11;$fecha11<=$fecha22;$fecha11=strtotime('+1 day ' . date('Y-m-d',$fecha11))){ 
                            if((strcmp(date('D',$fecha11),'Sun')!=0) and (strcmp(date('D',$fecha11),'Sat')!=0)){
                                echo date('Y-m-d ',$fecha11). '<br>';
                                $datos[] = date('Y-m-d ',$fecha11);
                            }
                          }
                        } else {
                          echo $membership->status;
                        }

                      ?>
                  </td>
                  <td>
                    {{ $membership->hash }}
                  </td>
                  <td>

                    {{ $membership->status }}&nbsp;
                    
                    @if($membership->status == "Cerrado" )
                    <a href="{{ url('/membership/'.$membership->id.'/') }}" class=""> Renovar</a> &nbsp;&nbsp;              
                    @endif  

                    
                  </td>
                  <td>
                    {{ $membership->activedAt }}
                  </td>
                  <td>
                    {{ $membership->closedAt }}
                  </td>
                  <td>
                    {{ $membership->detail }}
                  </td>  
                  <td>
                    <a href="{{ route('networktransaction', ['id' =>$membership->id]) }}" class="btn btn-outline-secondary"><i class="ni ni-archive-2"></i> Historial diarios</a>
                  </td> 
                  <td>
                    <a href="{{ route('networktransactionactivacion', ['id' =>$membership->id]) }}" class="btn btn-outline-secondary"><i class="ni ni-archive-2"></i> Historial activación</a>
                  </td>            
                 </tr>
                 @endforeach
              </tbody>
            </table>

            <br>

            {{ $memberships->appends(request()->input())->links() }}

        </div>
      </div>


      </div>
    </div>
  </div>
  <hr class="my-3">
@endsection





