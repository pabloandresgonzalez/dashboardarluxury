@extends('layouts.panel')



@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-bullet-list-67"></i> &nbsp;Detalle</h3>
        </div>
        <div class="col-md-6">
          <a href="/user" class="btn btn-outline-default">
          <i class="ni ni-bold-left"></i> Volver
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

      <div class="col-xl-10 order-xl-2 mb-5 mb-xl-0">
      <div class="card pub-prestamo">
        <div class="card-header">
          <h3 class="mb-0"><i class="ni ni-single-02"></i> &nbsp;Información de {{ $user->name }}</h3>
        </div>

        
        <div class="card-body">
          <div class="list-inline-item">
            <ul>
              Nombre:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->name }} {{ $user->lastname }}</h4></li><br>
              Id: &nbsp;
              <li class="list-inline-item"><h4>{{ $user->id }}</h4></li><br>
              Estado:  &nbsp;
              <li class="list-inline-item">
                <h4>
                @if($user->isActive == 1)
                    Activo
                  @elseif($user->isActive == 0)
                    Desactivado
                  @endif
                </h4>
              </li><br>
              Tipo de documento:  &nbsp
              <li class="list-inline-item"><h4>{{ $user->typeDoc }}</h4></li><br>
              Numero de documento:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->numberDoc }}</h4></li><br>
              Rol:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->role }}</h4></li><br>
              Email:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->email }}</h4></li><br>
              Telefono:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->phone }}</h4></li><br>
              Celular:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->numberDoc }}</h4></li><br>
              País:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->country }}</h4></li><br>
              Nivel:  &nbsp;
              <li class="list-inline-item">
                <h4>
                  @if($user->level == 1)
                     USUARIO
                  @elseif($user->level == 2)
                    DIRECTOR
                  @elseif($user->level == 3)
                    DIRECTOR JUNIOR
                  @elseif($user->level == 4)
                    DIRECTOR SENIOR
                  @elseif($user->level == 5)
                    VICE PRESIDENTE
                  @endif
                </h4>
              </li><br>
              Id de referido:  &nbsp;
              <li class="list-inline-item"><h4>{{ $user->ownerId }}</h4></li>
            </ul>

            </div>
          
      </div>
      </div>
      </div>

   <hr style="width:50%;" />

   <div class="col-xl-10 order-xl-2 mb-5 mb-xl-0">
                <div class="card pub-prestamo">
                  <div class="card-header">
                    <h3 class="mb-0"><i class="ni ni-single-02"></i> &nbsp;Balance - {{ $user->name }}</h3>
                  </div>

                  
                    <div class="card-body">
                    
                      <div class="list-inline-item">                        
                        <ul>
                          Balance:  &nbsp;
                          <?php 
                            if ($result) {
                              $url = ($result);
                                    $data = json_decode($url, true);
                              if (isset($data['balance'])) {
                                
                                  $balancecho = $data['balance']; 
                                  echo $balancecho;
                              }else {
                                echo '*';
                              } 
                            }    
                          ?>
                        </ul>
                        <ul>
                          En canje: &nbsp;
                          <?php 
                            if ($result) {
                              $url = ($result);
                                    $data = json_decode($url, true);
                              if (isset($data['exhange'])) {
                                
                                  $balancecho = $data['exhange']; 
                                  echo $balancecho;
                              }else {
                                echo '*';
                              } 
                            }    
                          ?>
                        </ul>
                        <ul>
                          Traslados:  &nbsp;
                          <?php 
                            if ($result) {
                              $url = ($result);
                                    $data = json_decode($url, true);
                              if (isset($data['withdrawals'])) {
                                
                                  //$balancecho = $data['balance']; 
                                  //$exhange = $data['exhange']; 
                                  $withdrawals = $data['withdrawals'];
                                  echo $withdrawals;
                              }else {
                                echo '*';
                              } 
                            }    
                          ?>
                          </li>
                        </ul> 
                        <ul>
                          Saldo :  &nbsp;
                          <?php 
                            if ($result) {
                              $url = ($result);
                                    $data = json_decode($url, true);
                              if (isset($data['total'])) {
                                
                                  //$balancecho = $data['balance']; 
                                  //$exhange = $data['exhange']; 
                                  $saldo = $data['total'];
                                  echo $saldo;
                              }else {
                                echo '*';
                              } 
                            }    
                          ?>
                          </li>
                        </ul>          

                      </div>
                    
                    </div>
                </div> 

  </div>

  <hr style="width:50%;" />

  <div class="col-xl-10 order-xl-2 mb-5 mb-xl-0">
    <div class="card pub-prestamo">
      <div class="card-header">
        <h3 class="mb-0"><i class="ni ni-single-02"></i> &nbsp;Membresias - {{ $user->name }}</h3>
      </div>

        <div class="card-body">
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
                  <th scope="col">+ Detalles</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($membreshipsactivas as $membership)
                <tr>
                  <td scope="row">
                    {{ $membership->membership }}
                  </td>
                  <td>


      <a  title="<?php
                      if ($membership->status === 'Activo') {
                        $fecha_actual = date("Y-m-d");
                        $fecha_final = $membership->closedAt;

                        
                        $fecha11 = strtotime($fecha_actual); 
                        $fecha22 = strtotime($fecha_final);

                        $fecha1= new DateTime($fecha_actual);
                        $fecha2= new DateTime($fecha_final);
                        $diff = $fecha1->diff($fecha2);

                        echo $diff->days . ' Días calendario, si quieres ver los días hábiles haz clic en el botón';

                        }
 
                    ?>" data-toggle="modal" data-target="#modal-form-{{$membership->id}}" href="#" class="btn btn-outline-secondary"><i class="ni ni-time-alarm"></i>&nbsp; 
                      <?php
                      if ($membership->status === 'Activo') {
                        $fecha_actual = date("Y-m-d");
                        $fecha_final = $membership->closedAt;

                        
                        $fecha11 = strtotime($fecha_actual); 
                        $fecha22 = strtotime($fecha_final);

                        $fecha1= new DateTime($fecha_actual);
                        $fecha2= new DateTime($fecha_final);
                        $diff = $fecha1->diff($fecha2);

                        //echo $diff->days . ' ';

                        }
 
                    ?>
                  días restantes</a>


      <div class="modal fade" id="modal-form-{{$membership->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
              
              <div class="modal-body p-0">
                  
                      
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center">
                          <br><i class="ni ni-calendar-grid-58"></i><br><br>
                          <strong>Días hábiles restantes de tu membresía </h4></strong>                   
                        </div>                                          
                    </div>

                    <div class="text-center text-muted mb-4">                     
                        <br>
                          <strong>
                            <?php
                              //echo $membership->id;
                              $fecha_actual = date("Y-m-d");
                              $fecha_final = $membership->closedAt;

                              
                              $fecha11 = strtotime($fecha_actual); 
                              $fecha22 = strtotime($fecha_final);

                              $fecha1= new DateTime($fecha_actual);
                              $fecha2= new DateTime($fecha_final);
                              $diff = $fecha1->diff($fecha2);

                              $diff->days . ' days ';

                              
                                // Obtiene los dias faltantes sin sabados ni domingos 
                                for($fecha11;$fecha11<=$fecha22;$fecha11=strtotime('+1 day ' . date('Y-m-d',$fecha11))){ 
                                  if((strcmp(date('D',$fecha11),'Sun')!=0) and (strcmp(date('D',$fecha11),'Sat')!=0)){
                                      echo '<i class="ni ni-watch-time"></i> ' . $dias = date('Y-m-d ',$fecha11). '<br>';
                                      $datos[] = date('Y-m-d ',$fecha11). '<br>';
                                      $string = implode(" ",$datos);
                                      //echo $dias = count($datos);

                                      

                                      /*
                                      // Declare an ArrayIterator
                                      $arrItr = new ArrayIterator(
                                          $datos, 
                                          ArrayIterator::STD_PROP_LIST
                                      );
                                      */
                                         
                                      // Count the array element                                  
                                      //echo $arrItr->count();                                   

                                         //echo $arrItr->count();                               
                                                                    
                                  }

                                }
                                //echo $dias = count($datos);

                            ?>

                    <br><br></strong>                            
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>




                    
                      <!-- <span id="session_timeout"></span> -->
                    
                  </td>
                  <td>
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
                  <td> 
                  <a href="{{ url('/membership/'.$membership->id.'/detail') }}" class="btn btn-outline-secondary"><i class="ni ni-bullet-list-67"></i> + Detalles</a>
                  </td>          
                 </tr>
                 @endforeach
              </tbody>
            </table>

            <br>

            

        </div>
      </div>


      </div>
      </div>
    </div>
  </div>
  

  <hr style="width:50%;" />

  <div class="col-xl-10 order-xl-2 mb-5 mb-xl-0">
                <div class="card pub-prestamo">
                  <div class="card-header">
                    <h3 class="mb-0"><i class="ni ni-delivery-fast"></i> &nbsp;Movimientos</h3>
                  </div>

                  
                    <div class="card-body">
                    
                      <div class="table-responsive">
            <table class="table align-items-center table-dark">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="sort">Fecha</th>
                  <th scope="col">Estado</th>
                  <th scope="col">$ Valor</th>
                  <th scope="col">Tarifa</th>
                  <th scope="col">Detalle</th>
                  <th scope="col">Tipo movimiento</th>
                  <th scope="col">Divisa</th>
                </tr>
              </thead>


              <tbody>
                @foreach ($Wallets as $Wallet)
                <tr>
                  <td scope="row">
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
                    {{ $Wallet->detail }}
                  </td>
                  <td>
                    {{ $Wallet->type }}
                  </td>
                  <td>
                    {{ $Wallet->currency }}
                  </td>                            
                 </tr>
                 @endforeach
                 </tbody>
            </table>

                    
                    </div> <br>
                    <div>
              <a href="{{ url('users/export-excel/movimientos') }}" class="btn btn-outline-secondary"><i class="ni ni-single-copy-04"></i> Exportar</a>              
            </div>                  

                {{ $Wallets->links() }}  
              </div> 
            </div>  
          </div>  
        </div>  
      </div>    
    </div>   
    <hr class="my-3"> 

@endsection





