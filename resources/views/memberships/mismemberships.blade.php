@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-bullet-list-67"></i> &nbsp;Historial </h3>
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


      <div class="card pub-prestamo">
        <div class="card-header">
          <i class="ni ni-box-2 "></i> &nbsp;Mis Membresias </h3>
        </div>
       

          <div class="table-responsive">
            <table class="table align-items-center table-dark">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="sort">Membresia</th>
                  <th scope="col">Hash</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Fecha Cierre</th>
                  <th scope="col">Detalle</th>
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
                    {{ $membership->status }}
                  </td>
                  <td>
                    {{ $membership->closedAt }}
                  </td>
                  <td>
                    {{ $membership->detail }}
                  </td>              
                 </tr>
                 @endforeach
              </tbody>
            </table>


          <div class="col-md-4">
        </div>
    </div>

    <hr>

    
      <div class="container-fluid">
        <div class="header-body">
            <div class="row-fluid ">
              <div class="row">

              @foreach($memberships as $membership)

                                
                  <div class="col-xl-4 col-lg-6">
                    
                      <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset('img/brand/membresia1.PNG') }}" alt="Card image cap">
                        <div class="card-body" style="text-align: center;">
                          <h3 class="card-title"></h3> 
                          <span> <p class="card-text">
                          {{ $membership->membership }}<br></p></span><br>
                          <h4 class="card-membership">{{ $membership->detail }}</h4> 
                          <h5 class="card-title">{{ $membership->status }}</h5>
                        </div>
                      </div>
                      <hr>
                 
                  </div>   

              @endforeach

              </div>
            </div>
          </div>
        </div>
      




  </div>

        <hr class="my-3">
@endsection





