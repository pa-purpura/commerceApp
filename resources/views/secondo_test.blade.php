@extends('home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <a class="navbar-brand" href="{{ __('home') }}">
                  home
              </a>
                <div class="card-body">

                  <p>{{ trans('sentence.paolo')}}</p>
                  <p>{{ trans('auth.failed')}}</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
