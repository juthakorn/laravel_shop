@extends('layouts.standard')

@section('content')
<div class="container m-t-3">
    <div class="row">

        <!-- Account Sidebar -->
        @include("user.account-sidebar")
        <!-- End Account Sidebar -->

        <!-- My Profile Content -->
        <div class="col-sm-8 col-md-9">
            <div class="title m-b-2" style="position: relative"><span>{{ trans('user.My Address') }}</span>
                <div class="btn-add-address">
                    <a href="javascript:void(0)" id="show-form-user" onclick="$('#form-add-address').show();$('#box-address').hide();return false;"  class="btn btn-theme"><i class="fa fa-plus-circle"></i> {{ trans('user.Add Address') }}</a>
                </div>
            </div>
            
            @include("partials.alert-session")               
            
            <div class="row" id="box-address">
                <?php foreach ($address_data as $key => $value) {                   
                $txttombon = "ตำบล";
                $txtumpher = "อำเภอ";
                if(preg_match("/กรุงเทพ/i", $value->province)){
                    $txttombon = "แขวง";
                    $txtumpher = "เขต";
                }
                ?>
                <div class="col-sm-12">
                    <div class="box-address well">                        
                        <strong>{{ $value->firstname." ".$value->lastname }}</strong>
                        <p>{{ $value->address." ".$txttombon.$value->sub_district." ".$txtumpher.$value->district." จังหวัด".$value->province." ".$value->postcode." โทร.".$value->tel }}</p>
                        <div class="box-address-action">
                            <a href="{{ url(customer_address_edit($value->id)) }}" class="btn btn-theme"><i class="fa fa-pencil"></i> {{ trans('common.Edit') }}</a>                            
                            <a href="{{ route('address.remove', $value->id) }}" class="show-confirm-modal btn btn-danger"><i class="fa fa-trash"></i> {{ trans('common.Delete') }}</a>
                        </div>                        
                    </div>
                </div>
                <?php }?>
            </div>
            
                
            <div id="form-add-address" style="display: none;">
                @include("user.form_address")   
            </div>
        </div>
        <!-- End My Profile Content -->
        
    </div>
</div>

@include("partials.confirm-modal")   

@endsection


@section('script')
<script src="{{ URL::asset('shop/js/customer.js') }}"></script>
@endsection