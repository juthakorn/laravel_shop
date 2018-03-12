@extends('layouts.standard')

@section('content')

<div class="container m-t-3">
    <div class="row">

        <!-- Login Form -->
        <div class="col-sm-6 col-xs-12 login-register-form m-b-3">
            <div class="title"><span>{{ trans('common.login') }}</span></div>
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
                <div class="checkbox pull-left" style="margin-top: 0">
                    <label>
                        <input type="checkbox" name="remember"><span> {{ trans('common.Remember me') }}</span>
                    </label>
                </div>
                <div class="pull-right">
                    <a href="{{ url(register())}}"><i class="fa fa-edit"></i> {{ trans('common.register') }}</a>
                </div>
                <div class="clearfix"></div>
                <button type="submit" class="btn btn-default btn-theme"><i class="fa fa-long-arrow-right"></i> {{ trans('common.login2') }}</button>
                <button type="button" class="btn btn-default btn-theme pull-right"> {{ trans('common.Forgot your password') }}</button>
            </form>
        </div>
        <!-- End Login Form -->

        <!-- Alternative Login Button -->
        <div class="col-sm-6 col-xs-12">
            <div class="title"><span>เข้าสู่ระบบด้วย Facebook</span></div>
            <div style="margin: 35px 0 50px 0">
            
            <button style="width: 100%;" type="button" class="btn btn-primary btn-md"><i class="fa fa-facebook"></i> Login with Facebook</button>
            </div>
        </div>
        <!-- End Alternative Login Button -->

    </div>
</div>

@endsection