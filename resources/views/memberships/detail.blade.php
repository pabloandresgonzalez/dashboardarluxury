@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-bullet-list-67"></i> &nbsp;Detalle</h3>
        </div>
        <div class="col-md-6">
          <a href="/membership" class="btn btn-outline-default">
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


      <div class="card pub-prestamo">
        <div class="card-header">
          <h3 class="mb-0"><i class="ni ni-single-02"></i> &nbsp; Información de la membership </h3>
        </div>

        
        <div class="card-body">
          <div class="list-inline-item">
            <ul>
              @if($membership->status === 'Activo')
              Dias restnates:  &nbsp;
              <li class="list-inline-item"><h4><?php
                    //echo $membership->id;
                    $fecha_actual = date("Y-m-d");
                    $fecha_final = $membership->closedAt;

                    
                    $fecha11 = strtotime($fecha_actual); 
                    $fecha22 = strtotime($fecha_final);

                    $fecha1= new DateTime($fecha_actual);
                    $fecha2= new DateTime($fecha_final);
                    $diff = $fecha1->diff($fecha2);

                    //echo $diff->days . ' days ';

                    
                      // Obtiene los dias faltantes sin sabados ni domingos 
                      for($fecha11;$fecha11<=$fecha22;$fecha11=strtotime('+1 day ' . date('Y-m-d',$fecha11))){ 
                        if((strcmp(date('D',$fecha11),'Sun')!=0) and (strcmp(date('D',$fecha11),'Sat')!=0)){
                            $dias = date('Y-m-d ',$fecha11). '<br>';
                            $datos[] = date('Y-m-d ',$fecha11). '<br>';
                            //echo $string = implode(" ",$datos);
                            //$dias = end($datos);

                            // Declare an ArrayIterator
                            $arrItr = new ArrayIterator(
                                $datos, 
                                ArrayIterator::STD_PROP_LIST
                            );
                            
                               
                            // Count the array element                                  
                            //echo $arrItr->count();                                   

                               //echo $arrItr->count();                               
                                                          
                        }

                      }
                      echo count($datos) . ' días';
                  ?></h4></li><br>
                  @else
                    
                @endif
              Nombre usuario:  &nbsp;
              <li class="list-inline-item"><h4>{{ $membership->user_name }}</h4></li><br>            
              Email de usuario:  &nbsp;
              <li class="list-inline-item"><h4>{{ $membership->user_email }}</h4></li><br>            
              Membresia: &nbsp;
              <li class="list-inline-item"><h4>{{ $membership->membership }}</h4></li><br>            
              Estado: &nbsp;
              <li class="list-inline-item"><h4>{{ $membership->status }}</h4></li><br>            
              Hash de pago: &nbsp;
              <li class="list-inline-item"><h4>{{ $membership->hash }}</h4></li><br>          
              Creada: &nbsp;
              <li class="list-inline-item"><h4>{{ $membership->created_at }}</h4></li><br>            
              Detalle:  &nbsp
              <li class="list-inline-item"><h4>{{ $membership->detail }}</h4></li><br>            
              Fecha activada :  &nbsp
              <li class="list-inline-item"><h4>{{ $membership->activedAt }}</h4></li><br>
              Fecha de cierre:  &nbsp
              <li class="list-inline-item"><h4>{{ $membership->closedAt }}</h4></li>
            </ul>
                     
         </div>
       </div>
      </div>
    </div>
  </div>
</div>

        <hr class="my-3">
@endsection





