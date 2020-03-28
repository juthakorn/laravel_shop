@extends('layouts.standard_v2')

@section('content')

<div class="container-fluid limited mb-5">
    <div class="row">
        
        <!-- Account Sidebar -->
        @include("user.account-sidebar_v2")
        <!-- End Account Sidebar -->
        
        <div class="col-lg-9 col-md-8">
            <div class="title"><span>{{ trans('user.Change Password') }}</span></div>
            @include("partials.alert-session") 
            {!! Form::open(['route' => 'password.update', 'method' => 'POST', 'id'=>'form-change-password']) !!} 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="InputOldPassword">{{ trans('user.Current Password') }}</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="InputNewPassword">{{ trans('user.New Password') }}</label>
                        <input type="password" minlength="6" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="InputNewPassword2">{{ trans('user.Re-type New Password') }}</label>
                        <input type="password" minlength="6" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-theme my-1"><i class="material-icons">save</i> {{ trans('common.save') }}</button>
                <a href="{{ url(customer()) }}" class="btn btn-secondary">{{ trans('common.cancel') }}</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>




@endsection

@section('script')
<script src="{{ URL::asset('shop-v2/js/customer.js') }}"></script>
@endsection