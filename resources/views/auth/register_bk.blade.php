@extends('layouts.standard')

@section('content')

<div class="container m-t-3">
    <div class="row">

        <!-- Register Form -->
        <div class="col-sm-8 login-register-form m-b-3">
            <div class="title"><span>{{ trans('common.register2') }}</span></div>
            <div class="row">
                <form role="form" method="POST" action="{{ url(register()) }}">
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
                    <div class="form-group col-sm-6">
                        <label for="nameInput">{{ trans('common.Name') }}</label>
                        <input type="text" class="form-control" id="nameInput" name="name" placeholder="{{ trans('common.Name') }}" value="{{ old('name') }}" required autofocus>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="nameInput">{{ trans('common.Lastname') }}</label>
                        <input type="text" class="form-control" id="lastnameInput" name="lastname" placeholder="{{ trans('common.Lastname') }}" value="{{ old('lastname') }}" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="emailInput">{{ trans('common.Email address') }}</label>
                        <input type="email" class="form-control" id="emailInput" name="email" placeholder="{{ trans('common.Email address') }}" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="passwordInput">{{ trans('common.Password') }}</label>
                        <input type="password" class="form-control" id="passwordInput" placeholder="{{ trans('common.Password') }}" name="password" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="passwordConfirmInput">{{ trans('common.Confirm Password') }}</label>
                        <input type="password" class="form-control" id="passwordConfirmInput" placeholder="{{ trans('common.Confirm Password') }}" name="password_confirmation" required>
                    </div>
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-theme"><i class="fa fa-long-arrow-right"></i> {{ trans('common.register') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Register Form -->

        <!-- Login Form -->
        <div class="col-sm-4">
            <div class="title"><span>{{ trans('common.Already Registered') }}</span></div>
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
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="{{ trans('common.Email address') }}" required>
                </div>
                <div class="form-group {{ count($errors) ? ' has-error' : '' }}">
                    <label for="passwordInputLogin">{{ trans('common.Password') }}</label>
                     <input type="password" name="password" id="password" class="form-control" placeholder="{{ trans('common.Password') }}" required>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"><span> {{ trans('common.Remember me') }}</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-theme"><i class="fa fa-long-arrow-right"></i> {{ trans('common.login2') }}</button>
                <button type="button" class="btn btn-theme pull-right"> {{ trans('common.Forgot your password') }}</button>                
            </form>
             <hr>
            <div class="title"><span>เข้าสู่ระบบด้วย Facebook</span></div>
            <div style="margin: 10px 0 30px 0">            
            <button style="width: 100%;" type="button" class="btn btn-primary btn-md"><i class="fa fa-facebook"></i> Login with Facebook</button>
            </div>
        </div>
        <!-- End Login Form -->

    </div>
</div>

@endsection