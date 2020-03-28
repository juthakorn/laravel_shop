@extends('layouts.standard_v2')

@section('content')
<div class="container-fluid limited mb-5">
    <div class="row">

        <!-- Account Sidebar -->
        @include("user.account-sidebar_v2")
        <!-- End Account Sidebar -->

        <div class="col-lg-9 col-md-8">
            <div class="title">
                <span>{{ trans('user.My Address') }}</span>
                <button class="btn btn-sm btn-outline-theme float-right" onclick="$('#form-add-address').show();$('#box-address').hide();return false;"  ><i class="material-icons">mode_edit</i> {{ trans('user.Add Address') }}</button>
            </div>
            @include("partials.alert-session")


            <div class="row" id="box-address">
                <?php
                foreach ($address_data as $key => $value) {
                    $txttombon = "ตำบล";
                    $txtumpher = "อำเภอ";
                    if (preg_match("/กรุงเทพ/i", $value->province)) {
                        $txttombon = "แขวง";
                        $txtumpher = "เขต";
                    }
                    ?>
                    <div class="col-md-12">
                        <div class="box-address well">                        
                            <strong>{{ $value->firstname." ".$value->lastname }}</strong>
                            <p>{{ $value->address." ".$txttombon.$value->sub_district." ".$txtumpher.$value->district." จังหวัด".$value->province." ".$value->postcode." โทร.".$value->tel }}</p>
                            <div class="box-address-action">
                                <a href="{{ url(customer_address_edit($value->id)) }}" class="btn btn-theme"><i class="fa fa-pencil"></i> {{ trans('common.Edit') }}</a>                            
                                <a href="{{ route('address.remove', $value->id) }}" class="show-confirm-modal btn btn-danger"><i class="fa fa-trash"></i> {{ trans('common.Delete') }}</a>
                            </div>                        
                        </div>
                    </div>
<?php } ?>
            </div>

            <div id="form-add-address" style="display: none;">
                
                @include("user.form_address_v2")   
            </div>
        </div>
    </div>
</div>


@include("partials.confirm-modal")   

@endsection


@section('script')
<script src="{{ URL::asset('shop-v2/js/customer.js') }}"></script>
@endsection