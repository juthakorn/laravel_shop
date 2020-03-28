@extends('layouts.standard_v2')

@section('content')
<div class="container-fluid limited mb-5">
    <div class="row">

        <!-- Account Sidebar -->
        @include("user.account-sidebar_v2")
        <!-- End Account Sidebar -->

        <div class="col-lg-9 col-md-8">
            <div class="title"><span>{{ trans('user.My Address') }}</span></div>    
            
                @include("user.form_address_v2")  
            
        </div>
    </div>
</div>


@endsection


@section('script')
<script src="{{ URL::asset('shop-v2/js/customer.js') }}"></script>
@endsection