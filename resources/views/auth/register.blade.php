@extends('layouts.standard_v2')

@section('content')

<div class="container-fluid limited mb-5">
    <div class="row justify-content-center mt-4">
        <div class="col-xs-12 col-lg-6 col-md-8">
            <div class="card">
                <div class="card-body pt-2">
                    <div class="text-center">
                        <div class="d-inline-block border border-secondary rounded-circle text-center m-auto">
                            <h1 class="px-2"><i class="material-icons align-middle md-3">person</i></h1>
                        </div>
                    </div>
                    <h5 class="card-title text-center">{{ trans('common.register2') }}</h5>
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
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="nameInput">{{ trans('common.Name') }}</label>
                                <input type="text" class="form-control" id="nameInput" name="name" placeholder="{{ trans('common.Name') }}" value="{{ old('name') }}" required autofocus>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="nameInput">{{ trans('common.Lastname') }}</label>
                                <input type="text" class="form-control" id="lastnameInput" name="lastname" placeholder="{{ trans('common.Lastname') }}" value="{{ old('lastname') }}" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="emailInput">{{ trans('common.Email address') }}</label>
                                <input type="email" class="form-control" id="emailInput" name="email" placeholder="{{ trans('common.Email address') }}" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="passwordInput">{{ trans('common.Password') }}</label>
                                <input type="password" class="form-control" id="passwordInput" placeholder="{{ trans('common.Password') }}" name="password" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="passwordConfirmInput">{{ trans('common.Confirm Password') }}</label>
                                <input type="password" class="form-control" id="passwordConfirmInput" placeholder="{{ trans('common.Confirm Password') }}" name="password_confirmation" required>
                            </div>
                            
                            
                        </div>
                        
                        <button type="submit" class="btn btn-theme btn-sm btn-block my-3">{{ trans('common.register') }}</button>
                        <div class="form-group text-right">
                            <a href="{{ url(login()) }}" class="text-secondary"><small><u>{{ trans('common.Already Registered') }}</u></small></a>
                        </div>
                        <div class="form-group mt-3 text-center">Or Register using</div>
                        <div class="text-center share-link">
                            <button type="button" class="btn btn-primary btn-sm" style="width: 100%;"><svg fill="#fff" viewBox="0 0 24 24"><path d="M17,2V2H17V6H15C14.31,6 14,6.81 14,7.5V10H14L17,10V14H14V22H10V14H7V10H10V6A4,4 0 0,1 14,2H17Z" /></svg> Facebook</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection