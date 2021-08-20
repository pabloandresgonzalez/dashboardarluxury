@extends('layouts.panel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Mi cuenta</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
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
                <a href="#" class="btn btn-sm btn-info mr-4"><i class="ni ni-email-83"></i> ar_luxury</a>
                <a href="#" class="btn btn-sm btn-default float-right"><i class="ni ni-chat-round"></i> Mensaje</a>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading">22</span>
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

                <a href="#">Noticias</a>
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
                  <a href="#" class="btn btn-outline-secondary"><i class="ni ni-money-coins"></i> Billetera</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')


                <h6 class="heading-small text-muted mb-4">información de usuario</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="photo">Imagen avatar</label>
                        <input type="file" id="photo" name="photo" class="form-control form-control-alternative" placeholder="" value="lucky.jesse">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="photoDoc">Imagen documento</label>
                        <input type="file" id="photoDoc" name="photo" class="form-control form-control-alternative" placeholder="">
                      </div>
                    </div>
                  </div>
                </div>
                    <div class="col-lg-12">
                    <div class="form-group">

                    <button type="" class="btn btn-outline-default" ><i class="ni ni-image"></i> Cambiar iamgen</button>
                </div>
                </div>
                <hr class="my-4" />

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
