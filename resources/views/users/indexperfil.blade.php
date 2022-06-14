@extends('layouts.panel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Mi cuenta</div>

                <div class="card-body">
                   @if($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                      <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>x</span>
                        </button>
                      </li>
                      @endforeach
                      <ul>
                    </div>
                  @endif

                    <!-- Page content -->

      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="{{ route('user.avatar',['filename'=>Auth::user()->photo]) }}"/>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4" data-toggle="modal" data-target="#exampleModal"><i class="ni ni-tag"></i> Link</a>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Link para registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        https://dashboard.lifearluxury.com/register?ownerId={{ $user->id }}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                      </div>
                    </div>
                  </div>
                </div>


                <a href="#" class="btn btn-sm btn-default float-right"><i class="ni ni-chat-round"></i> Mensaje</a>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading"><?php echo $totalusers;  ?></span>
                      <span class="description">Referidos</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  {{ $user->name }}<span class="font-weight-light"></span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>{{ $user->email }}
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>{{ Auth::user()->phone }}
                </div>
                <hr class="my-4" />

                <a href="/newsuser">Noticias</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">{{ Auth::user()->name }}</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="/wallet" class="btn btn-outline-secondary"><i class="ni ni-money-coins"></i> Billetera</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              
    <form class="row g-3" action="{{ url('user/updateuser/'.$user->id) }}" enctype="multipart/form-data" method="post">
    @csrf
    @method('PUT')


        
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
            </div>
            <input class="form-control" placeholder="Telefono" type="number" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="phone" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
            </div>
            <input class="form-control" placeholder="Movil" type="number" name="cellphone" value="{{ old('cellphone', $user->cellphone) }}" required autocomplete="cellphone" autofocus>
          </div>
        </div>        
        <div class="col-md-12">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">

              <span class="input-group-text"><i class="ni ni-camera-compact"></i>&nbsp; Avatar</span>
            </div>
            <input class="form-control" placeholder="photo"  type="file" name="photo"  autocomplete="photo" autofocus>
          </div>
        </div>
        <div class="col-md-12" hidden="true">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-camera-compact"></i>&nbsp; Documento</span>
            </div>
            <input class="form-control" placeholder="photoDoc"  type="file" name="photoDoc"  autocomplete="photoDoc" autofocus>
          </div>
        </div>
        
        
        <div class="col-md-4">
          <button type="submit" class="btn btn-outline-default" ><i class="ni ni-satisfied"></i> Editar Usuario</button>
        </div>
        </div>

        <div class="col-md-4">
            

  </form>
            </div>
          </div>
        </div>


    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
