@extends('layouts.standard')

@section('content')
<div class="container m-t-3">
    <div class="row">

        <!-- Account Sidebar -->
        @include("user.account-sidebar")
        <!-- End Account Sidebar -->

        <!-- My Profile Content -->
        <div class="col-sm-8 col-md-9">
            <div class="title m-b-2" style="position: relative"><span>{{ trans('user.My Address') }}</span></div>    
            
            @include("user.form_address")   
            
        </div>
        <!-- End My Profile Content -->
        
    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('shop/js/customer.js') }}"></script>
@endsection