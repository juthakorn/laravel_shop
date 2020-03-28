@extends('layouts.standard_v2')

@section('content')

<div class="container-fluid limited mb-5">
    <div class="row justify-content-center mt-4">
        <div class="col-xs-12 col-sm-auto">
            <div class="card">
                <div class="card-body pt-2">
                    <div class="text-center">
                        <div class="d-inline-block border border-secondary rounded-circle text-center m-auto">
                            <h1 class="px-2"><i class="material-icons align-middle md-3">person</i></h1>
                        </div>
                    </div>
                    <h5 class="card-title text-center">Please Enter Your Information</h5>
                    <form class="" role="form" method="POST" action="{{ url(login()) }}">
                        {{ csrf_field() }}
                        @if (count($errors))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group{{ count($errors) ? ' has-error' : '' }}">
                            <label for="emailInputLogin">{{ trans('common.Email address') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="{{ trans('common.Email address') }}" required autofocus>
                        </div>
                        <div class="form-group {{ count($errors) ? ' has-error' : '' }}">
                            <label for="passwordInputLogin">{{ trans('common.Password') }}</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="{{ trans('common.Password') }}" required>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberMe" name="remember">
                            <label class="custom-control-label" for="rememberMe">{{ trans('common.Remember me') }}</label>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-theme btn-sm btn-block my-3">{{ trans('common.login2') }}</button>
                        <div class="form-group mb-0">
                            <a href="{{ url(register())}}" class="text-secondary"><small><u>{{ trans('common.register') }}</u></small></a>
                            <a href="#" class="float-right text-secondary"><small><u>{{ trans('common.Forgot your password') }}</u></small></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
