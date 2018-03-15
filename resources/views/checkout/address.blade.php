@extends('layouts.standard')

@section('content')
<?php
$cal = cal_price($order);
?>
<div class="container m-t-3">
    @include("partials.alert-session") 
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="wrapstep">
            <ul class="step-li">
                <li class="cart-li">
                     <i class="fa fa-shopping-cart"></i> 
                     <a href="{{ url(UrlCheckoutCart()) }}"><span>{{ trans('cart.Shopping Cart') }}</span></a>
                     <div class="icon-step-circle"><i class="glyphicon glyphicon-chevron-right"></i></div>
                </li>
                <li class="cart-li">
                     <i class="fa fa-truck"></i> 
                     <span>{{ trans('cart.Shipping Address') }}</span>
                     <div class="icon-step-circle"><i class="glyphicon glyphicon-chevron-right"></i></div>
                </li>               
                <li>
                   <i class="fa fa-file-text"></i> 
                   <span>{{ trans('cart.Review') }}</span>
                   <div class="icon-step-circle"><i class="glyphicon glyphicon-chevron-right"></i></div>                                      
                </li>
                <li>
                   <i class="glyphicon glyphicon-ok"></i>
                    <span>{{ trans('cart.Order Complete') }}</span>
                </li>
            </ul>
        </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">
            <div class="title" ><span><i class="fa fa-truck"></i> {{ trans('cart.Choose delivery address') }}</span>
                
            </div>            
            <div class="row"> 
                <div class="col-sm-12">
                    <?php if($address->isEmpty()){ ?>
                        <p>กรอกข้อมูลด้านล่าง เพื่อใช้ในการจัดส่งสินค้าของคุณ</p>
                    <?php }else{ ?>
                        <div style=" margin: 0 0 10px 0">
                            <span>กรุณาเลือกที่อยู่ที่จะใช้ในการจัดส่งสินค้าของคุณ หรือ </span>     <a href="javascript:void(0)" onclick="form_address_new()"  class="btn btn-theme"><i class="fa fa-plus-circle"></i> {{ trans('user.Add Address') }}</a>
                        </div>
                    <?php } ?>
                </div>
                
                <div class="col-sm-12 box-overlay" >
                    <div class="box-address well form_address" style="min-height: 100px;<?= !$address->isEmpty() ? "display: none;" : ""?>" id="form_new" >
                        @include("checkout.form_address")                        
                    </div> 
                    <div class="overlay" id="overlay_new" style="display: none;top: -12px">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>     
                <?php 
                foreach ($address as $key => $value) {                   
                    $txttombon = "ตำบล";
                    $txtumpher = "อำเภอ";
                    if(preg_match("/กรุงเทพ/i", $value->province)){
                        $txttombon = "แขวง";
                        $txtumpher = "เขต";
                    }
                    ?>
                    <div class="col-sm-12 box-overlay" >
                        <div class="box-address well form_address" style="display: none"></div>
                        <div class="box-address well detail_address">                        
                            <strong>{{ $value->firstname." ".$value->lastname }}</strong>
                            <p>{{ $value->address." ".$txttombon.$value->sub_district." ".$txtumpher.$value->district." จังหวัด".$value->province." ".$value->postcode." โทร.".$value->tel }}</p>
                            <div class="box-address-action">
                                {!! Form::open(['method' => 'POST', 'url' => url(UrlCheckoutVerify())]) !!}
                                <input type="hidden" name="address_id" value="{{ $value->id }}">
                                <button type="submit" class="btn btn-theme"><i class="glyphicon glyphicon-ok"></i> {{ trans('cart.Select address') }}</button>
                                <a href="javascript:void(0)" onclick="form_address(<?=$value->id?>, this)" class="btn btn-default"><i class="fa fa-pencil"></i> {{ trans('common.Edit') }}</a>                            
                                <a href="{{ url(UrlCheckoutRemoveAddress($value->id)) }}" class="show-confirm-modal btn btn-danger"><i class="fa fa-trash"></i> {{ trans('common.Delete') }}</a>
                                
                                {!! Form::close() !!} 
                            </div>                        
                        </div>
                        <div class="overlay" style="display: none;top: -12px">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div>            
                <?php }?>
                    
                 
                 
            </div>
            
        </div>
        
        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
            <div class="title"><span><i class="fa fa-shopping-cart"></i> {{ trans('cart.Order summary') }}</span></div>
            <div class="table-responsive">
            <table class="table table-bordered table-cart" id="table-cart">
                <thead>
                    <tr class="text-center">
                        <th colspan="2">{{ trans('cart.Product') }}</th>
                        <th style="width: 70px;">{{ trans('cart.Price') }}</th>
                        <th style="width: 54px;">{{ trans('cart.Quantity') }}</th>
                        <th style="width: 76px;">{{ trans('cart.SubTotal') }}</th>
                    </tr>
                </thead>
                <tbody>
                <?php
               foreach ($cal['data'] as $key => $value) {
                    $product_attr = App\Model\ProductAttribute::find($value['attr_id']);
                    if(empty($product_attr)){
                        continue;
                    }
                    $product = $product_attr->product;
                    $price = $value['qty'] * $product_attr->p_price;  
                    ?>
                    <tr>
                        <td class="img-cart" style="width: 58px; padding: 3px;vertical-align: middle;padding-right: 0;">
                            <a href="{{ url(UrlProduct($product->id, $product->slug_url)) }}">
                                <?php 
                                $arrimg = $product->image_stores()->orderBy('product_images.position', "asc")->take(1)->get()->toArray();
                                if(!empty($arrimg)){ ?>                                
                                    <img class="media-object img-thumbnail" src="<?= url(ImgProduct($arrimg[0]['id'], $arrimg[0]['new_name350']))?>" style="width: 50px">
                                <?php }else{ ?>
                                    <img class="media-object img-thumbnail" src="{{ URL::asset('image/nopicture.png') }}" style="width: 50px">
                                <?php }
                                ?>
                            </a>                               
                        </td>
                        <td>
                            <div style="max-width: 100px">
                                <p><a href="{{ url(UrlProduct($product->id, $product->slug_url)) }}" class="d-block">{{ $product->p_name }}</a></p>
                            <small>{{ $product_attr->option1." ".$product_attr->option2 }}</small>
                       
                            </div>
                             </td>
                        <td class="text-right"><span class="item_price" data-value="{{ $product_attr->p_price }}">{{ number_format($product_attr->p_price,2) }}</span></td>
                        <td class="text-center">{{ $value['qty'] }}</td>
                        <td class="text-right"><span class="total_item_price" data-value="{{ $price }}">{{ number_format($price,2) }}</span></td>
                        
                        <input type="hidden" name="data_product" data-limit="{{ $product_attr->p_quantity }}" data-id="{{ $product->id }}" data-attr-id="{{ $product_attr->id }}" >
                    </tr>
                    <?php } ?>                    
                    <tr class="text-right">
                        <td colspan="3">{{ trans('cart.SubTotalProduct') }}</td>
                        <td colspan="2"><strong>{{  number_format($cal['subtotal'],2) }}</strong> <strong>{{ trans('cart.baht') }}</strong></td>
                    </tr>
                    <?php if($cal['payment_price'] !== 0){?>
                    <tr class="text-right">
                        <td colspan="3">{{ trans('cart.Destination fee') }} </td>
                        <td colspan="2"><strong>{{ number_format($cal['payment_price']) }}</strong> <strong >{{ trans('cart.baht') }}</strong></td>
                    </tr>
                    <?php } ?>
                    <tr class="text-right">
                        <td colspan="3">{{ trans('cart.Shipping Fee') }}</td>
                        <td colspan="2"><strong>{{ number_format($cal['delivery_price']) }}</strong> <strong>{{ trans('cart.baht') }}</strong></td>
                    </tr>
                    <?php if(!empty($cal['discount'])){?>
                    <tr class="text-right">
                        <td colspan="3">{{ trans('cart.Discount')." ".$cal['discount']."%" }} </td>
                        <td colspan="2"><strong>-{{ number_format($cal['discount_price'],2) }}</strong> <strong>{{ trans('cart.baht') }}</strong></td>
                    </tr>
                    <?php } ?>
                    <tr class="text-right">
                        <td colspan="3">{{ trans('cart.Total') }}</td>
                        <td colspan="2"><strong>{{ number_format($cal['sum'],2) }}</strong> <strong id="subtotal">{{ trans('cart.baht') }}</strong></td>
                    </tr>
                </tbody>
            </table>
            </div>
            <nav>
              <ul class="pager">
                <li class="previous"><a href="{{ url(UrlCheckoutCart()) }}">{{ trans('cart.Back To Previous Page') }}</a></li>
                <!--<li class="next"><a href="checkout.html">{{ trans('cart.Continue') }}</a></li>-->
              </ul>
            </nav>
        </div>
        
    </div>
    
    
    <!-- Recommend Products -->
    <div class="row m-t-3">
        <div class="col-xs-12">
            <div class="title"><span>{{ trans('common.Recommended Products') }}</span></div>
            <div class="related-product-slider owl-controls-top-offset">
                <?php foreach ($recommend as $key => $value) { ?>
                <div class="box-product-outer">
                    <div class="box-product">
                        <div class="img-wrapper">
                            <a href="<?= UrlProduct($value->id, $value->slug_url)?>">
                                <?php 
                                $arrimg = $value->image_stores()->orderBy('product_images.position', "asc")->take(1)->get()->toArray();
                                if(!empty($arrimg)){ ?>                                
                                    <img src="<?= ImgProduct($arrimg[0]['id'], $arrimg[0]['new_name350'])?>"  >
                                <?php }else{ ?>
                                    <img src="{{ URL::asset('image/nopicture.png') }}" >
                                <?php }
                                ?>
                            </a>
                            <div class="tags">
                                <?php if($value->p_new){?>
                                <span class="label-tags"><span class="label label-success arrowed">New</span></span>
                                <?php } ?>
                            </div>
                            
                        </div>
                        <h6><a href="<?= UrlProduct($value->id, $value->slug_url)?>" title="<?=$value->p_name;?>"> <?=$value->p_name;?> </a></h6>
                        <div class="price">
                            <div><?=$value->p_price;?> บาท</div>
                        </div>
                        <div class="product-addcart">
                            <a href="<?= UrlProduct($value->id, $value->slug_url)?>" class="addcart"> <i class="fa fa-shopping-cart">&nbsp;</i> สั่งซื้อ</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- End Recommend Products -->

</div>
@include("partials.confirm-modal") 
@endsection


@section('script-custom')
<script>

function form_address_new(){
    cancel_address();
    $('#form_new').show();
    $('#overlay_new').show();
     $.ajax({
        url: "{{ url('checkout/form_address') }}",
        dataType: 'html',
        success: function(response) {
            
            $('#form_new').html(response).show();
            
            $('#overlay_new').hide();
        }
    });
}

function form_address(id,event){
    cancel_address();
    let main = $(event).closest('.box-overlay');
    var overlay = main.find('.overlay');
    var form_address = main.find('.form_address');
    let detail_address = main.find('.detail_address');
    
    overlay.show();
    $.ajax({
        url: "{{ url('checkout/form_address') }}/" + id,
        dataType: 'html',
        success: function(response) {
            
            form_address.html(response).show();
            detail_address.hide();
            overlay.hide();
        }
    });
}
function cancel_address(){
    $('.form_address').empty().hide();
    $('.detail_address').show();
}
    
$('#confirm-remove-btn').click(function(event) {
    event.preventDefault();
    $('#confirm-body form').submit();           
});

$('body').on('click', '.show-confirm-modal', function(event) {
    event.preventDefault();

    var me = $(this),        
        action = me.attr('href');

    $('#confirm-body form').attr('action', action);
    $('#confirm-body p').html("คุณต้องการลบที่อยู่นี้ใช่หรือไม่ ?");
    $('#confirm-modal').modal('show');
});
</script>


@endsection

