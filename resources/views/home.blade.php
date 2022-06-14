@extends('layouts.panel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3 class="mb-0">Escritorio</h3>
                </div>

                <div class="card-body">

                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible">
                          {{ session('message') }}
                          <button type="button" class="close" data-dismiss="alert">
                            <span>x</span>
                          </button>
                        </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ $errors->first() }}
                        <button type="button" class="close" data-dismiss="alert">
                          <span>x</span>
                        </button>
                    </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('status') }}
                              <button type="button" class="close" data-dismiss="alert">
                                <span>x</span>
                              </button>
                        </div>
                    @endif

                    

                    {{ __('Hola!') }} 

                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
