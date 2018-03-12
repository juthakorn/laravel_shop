@extends('layouts.standard')

@section('content')
<div class="container m-t-3">
    <div class="row">

        <!-- Account Sidebar -->
        @include("user.account-sidebar")
        <!-- End Account Sidebar -->

        <!-- My Profile Content -->
        <div class="col-sm-8 col-md-9">
            <div class="title m-b-2" style="position: relative"><span>{{ trans('user.Change Password') }}</span></div>    
            @include("partials.alert-session") 
            
            
            <div class="row">
                <div class="col-xs-12">
                    {!! Form::open(['route' => 'password.update', 'method' => 'POST', 'id'=>'form-change-password']) !!}                         
                        <div class="form-group">
                            <label class="control-label">{{ trans('user.Current Password') }}</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ trans('user.New Password') }}</label>
                            <input type="password" minlength="6" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ trans('user.Re-type New Password') }}</label>
                            <input type="password" minlength="6" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>                        
                       <button type="submit" class="btn btn-theme">{{ trans('common.save') }}</button>
                       <a href="{{ url(customer()) }}" class="btn btn-default">{{ trans('common.cancel') }}</a>
                    {!! Form::close() !!}
                </div>
            </div>


        </div>
        <!-- End My Profile Content -->

    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('shop/js/customer.js') }}"></script>
@endsection