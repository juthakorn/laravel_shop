@extends('layouts.standard')

@section('content')
<?php
$data = [];
$select_delivery = NULL;
$select_payment = NULL;
$sumqty = 0;
$delivery_price = 0;
$payment_price = 0;
$txtnote = "";
if( !Auth::guest()){
    $temp = Auth::user()->OrderTemp;
    if(!empty($temp)){
        $txtnote = $temp->note;
        $data = unserialize($temp->data);
        if(!empty($temp->delivery_id)){
            $select_delivery = $temp->delivery_id;
            $delivery_price = $temp->delivery->price;
        }
        if(!empty($temp->payment_id)){
            $select_payment = $temp->payment_id;
        }
        //reset code_discount
        $temp->update(['code_discount' => NULL]);
    }
}else{
    if (Cookie::get('cart') !== null){ 
        $data = Cookie::get('cart'); 
    }
    if (Cookie::get('cart_info') !== null){ 
        $cart_info = Cookie::get('cart_info');
        $txtnote = @$cart_info['note'];
        if(!empty($cart_info['delivery_id'])){
            $select_delivery = $cart_info['delivery_id'];
            $Delivery = App\Model\Delivery::findOrFail($cart_info['delivery_id']);
            $delivery_price = $Delivery->price;
        }
        if(!empty($cart_info['payment_id'])){
            $select_payment = $cart_info['payment_id'];
        }
        //reset code_discount
        $cart_info['code_discount'] = NULL;
        Cookie::queue('cart_info', $cart_info, 45000);
    }    
    
}
$sum = $delivery_price;
$subtotal = 0;
?>
<div class="container m-t-3">
    <?php if(!empty($data)){ ?>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="wrapstep">
            <ul class="step-li">
                <li class="cart-li">
                     <i class="fa fa-shopping-cart"></i> 
                     <span>{{ trans('cart.Shopping Cart') }}</span>
                     <div class="icon-step-circle"><i class="glyphicon glyphicon-chevron-right"></i></div>
                </li>
                <li>
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
    <?php } ?>
    <div class="row">

        <!-- Shopping Cart List -->
        <div class="<?= empty($data) ? "col-md-12 col-lg-12" : "col-md-8 col-lg-8" ?> col-sm-12 col-xs-12">
            <div class="title"><span><i class="fa fa-shopping-cart"></i> {{ trans('cart.Shopping Cart') }}</span></div>
            <?php if(!empty($data)){ ?>
            {{ csrf_field() }}
            <div class="table-responsive">
                <table class="table table-bordered table-cart" id="table-cart">
                    <thead>
                        <tr class="text-center">
                            <th colspan="2">{{ trans('cart.Product') }}</th>
                            <th style="width: 86px;">{{ trans('cart.Price')." (".trans('cart.baht').")" }}</th>
                            <th style="width: 100px;">{{ trans('cart.Quantity') }}</th>
                            <th style="width: 105px;">{{ trans('cart.SubTotal')." (".trans('cart.baht').")" }}</th>
                            <th style="width: 30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                   foreach ($data as $key => $value) {
                        $product_attr = App\Model\ProductAttribute::find($value['attr_id']);
                        if(empty($product_attr)){
                            continue;
                        }
                        $product = $product_attr->product;
                        $price = $value['qty'] * $product_attr->p_price;
                        $sum += $price;
                        $subtotal += $price;
                        $sumqty += $value['qty'];
                        if(array_key_exists($value['attr_id'], $data)){
                            $data[$value['attr_id']]['qty'] += $value['qty'];
                        }
                        
                        ?>
                        <tr>
                            <td class="img-cart">
                                <a href="{{ url(UrlProduct($product->id, $product->slug_url)) }}">
                                    <?php 
                                    $arrimg = $product->image_stores()->orderBy('product_images.position', "asc")->take(1)->get()->toArray();
                                    if(!empty($arrimg)){ ?>                                
                                        <img class="media-object img-thumbnail" src="<?= url(ImgProduct($arrimg[0]['id'], $arrimg[0]['new_name350']))?>" >
                                    <?php }else{ ?>
                                        <img class="media-object img-thumbnail" src="{{ URL::asset('image/nopicture.png') }}" >
                                    <?php }
                                    ?>
                                </a>                               
                            </td>
                            <td>
                                <p><a href="{{ url(UrlProduct($product->id, $product->slug_url)) }}" class="d-block">{{ $product->p_name }}</a></p>
                                <small>{{ $product_attr->option1." ".$product_attr->option2 }}</small>
                            </td>
                            <td class="text-right"><span class="item_price" data-value="{{ $product_attr->p_price }}">{{ number_format($product_attr->p_price,2) }}</span></td>
                            <td>
                                <div style="width: 96px;overflow: hidden" class="main-form-num">
                                    <div class="form-num"><div class="btn-num-l delete-item">-</div><input type="text" class="input-qty" name="data_atrr_qty" value="{{ $value['qty'] }}" title="{{ trans('cart.Quantity') }}"><div class="btn-num-r add-item">+</div></div>
                                </div>
                            </td>
                            <td class="text-right"><span class="total_item_price" data-value="{{ $price }}">{{ number_format($price,2) }}</span></td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-danger btn-circle btn-remove-option" data-toggle="tooltip" data-placement="top" data-original-title="Remove"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                            <input type="hidden" name="data_product" data-limit="{{ $product_attr->p_quantity }}" data-id="{{ $product->id }}" data-attr-id="{{ $product_attr->id }}" >
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="4" class="text-right">{{ trans('cart.SubTotalProduct') }}</td>
                            <td colspan="2"><strong id="subtotal">{{  number_format($subtotal,2) }}</strong> <strong id="subtotal">{{ trans('cart.baht') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="form-group col-sm-6" style=" padding-right: 0; padding-left: 0">
                <label for="code_discounts">รหัสส่วนลด (ถ้ามี)</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="code_discounts" >
                  <span class="input-group-btn">
                      <button class="btn btn-theme" type="button" id="check_code_discounts">{{ trans('cart.code_apply')}}</button>
                  </span>
                </div>
            </div>
            {!! Form::open(['method' => 'POST','id' => 'cartform', 'url' => url('checkout/stap2')]) !!}            
            <div class="form-group col-sm-12" style=" padding-right: 0; padding-left: 0">
                <label for="addressInput">ระบุหมายเหตุ(ถ้ามี)</label>
                <textarea class="form-control" rows="3" id="note" name="note">{{ $txtnote }}</textarea>
            </div>
            {!! Form::close() !!} 
            
            <?php }else{ ?>
            <div class="box-address well" style="margin-bottom: 80px;text-align: center">                        
                <strong style="padding: 20px;">{{ trans('cart.no_product_in_cart') }}</strong>
                <a href="{{ url(UrlproductAll()) }}"><p>{{ trans('cart.Return shop') }}</p></a>
            </div>
            <?php } ?>
        </div>
        <!-- End Shopping Cart List -->

        
        
        <?php if(!empty($data)){ ?>
        <?php $payment_price = _get_payment_value($select_payment, $sum); 
            $sum += $payment_price;?>
        <!-- delivery -->
        <div class="col-md-4  col-lg-4 col-sm-12 col-xs-12">
            <div class="title"><span><i class="fa fa-truck"></i> {{ trans('cart.Payment and Delivery') }}</span></div>
            <div class="box-delivery well no-shadow">   
                <div class="form-group">
                    {!! Form::select('payment', $payment, $select_payment, ['class' => 'form-control']) !!}                     
                </div>
                <div class="form-group">
                    {!! Form::select('delivery', $delivery, $select_delivery, ['class' => 'form-control']) !!}                     
                </div>
                <div class="form-group col-sm-12 col-xs-12 wrap-delivery">
                    <label class="col-5 control-label font-normal">{{ trans('cart.Shipping Fee')." (".trans('cart.baht').")" }}</label>
                    <label class="col-7 control-label"  style="font-size: 1.3em"><span id="delivery-price" data-value="{{ $delivery_price }}">{{ $delivery_price === 0 ? "-" : number_format($delivery_price,2) }}</span></label>
                </div>
                <div class="form-group col-sm-12 col-xs-12 wrap-delivery payment-row" style="{{ $payment_price !== 0 ? "" : "display: none" }}">
                    <label class="col-5 control-label font-normal">{{ trans('cart.Destination fee')." (".trans('cart.baht').")" }}</label>
                    <label class="col-7 control-label"  style="font-size: 1.3em"><span id="payment-price" >{{ number_format($payment_price,2) }}</span></label>
                </div>
                <div class="form-group col-sm-12 col-xs-12 wrap-delivery" id="wrap-discount" style=" display: none">
                    <label class="col-5 control-label font-normal">{{ trans('cart.Discount') }} <span id="res_discount"></span></label>
                    <label class="col-7 control-label"  style="font-size: 1.3em"><span id="discount" data-value="">-</span></label>
                </div>
                <div class="form-group col-sm-12 col-xs-12 wrap-total">
                    <label class="col-5 control-label font-normal">{{ trans('cart.Total')." (".trans('cart.baht').")" }}</label>
                    <label class="col-7 control-label" style="font-size: 1.3em"><span id="sumtotal" >{{ number_format($sum,2) }}</span></label>
                </div>
                <nav>
                    <ul class="pager" style="margin-bottom:0">
                        <li class="previous"><a href="{{ url(UrlproductAll()) }}"><span aria-hidden="true"></span><i class="fa fa-fw fa-chevron-left"></i> {{ trans('cart.Continue Shopping') }}</a></li>
                        <li class="next"><a href="javascript:void(0)" onclick="Cart.chkdelivery()">{{ trans('cart.Checkout') }} <i class="fa fa-fw fa-chevron-right"></i></a></li>
                    </ul>
                </nav>                       
            </div>
        </div>
        <!-- End delivery -->
        <?php } ?>
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

@endsection

@section('script')
<script src="{{ URL::asset('shop/js/cart.js') }}"></script>
@endsection

@section('script-custom')
<script>
var ObjCart; 
$(document).ready(function(){
    ObjCart = new Cart(); 
    ObjCart.set_url_action_cart("{{ url('checkout/action_cart') }}");
    ObjCart.set_url_set_delivery("{{ url('checkout/set_delivery') }}");
    ObjCart.set_url_set_payment("{{ url('checkout/set_payment') }}");
    ObjCart.set_url_check_discounts("{{ url('checkout/check_discounts') }}");
    ObjCart.set_url_remove_cart("{{ url('product/remove_cart') }}");
});

$('body').on('click', '.delete-item', function(event) {
    $input_num = $(this).parent().find('input');
    let quantity = parseInt($input_num.val()) - 1;
    if(quantity > 0){
    ObjCart.actionItem($input_num, quantity);
    }
});

$('body').on('click', '.add-item', function(event) {
    $input_num = $(this).parent().find('input');
    let quantity = parseInt($input_num.val()) + 1;
    ObjCart.actionItem($input_num, quantity);
    
});

$('body').on('change', '.input-qty', function(event) {
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    if ($(this).val().length > 0) {
        if (!numberRegex.test($(this).val()) || $(this).val() === '0') {
            $(this).val(1);
            return false;
        }
    }
    ObjCart.actionItem($(this), parseInt($(this).val()));
});


$('body').on('change', 'select[name="delivery"]', function(event) {
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    if ($(this).val().length > 0) {
        if (!numberRegex.test($(this).val()) || $(this).val() === '0') {
            $(this).val(1);
            return false;
        }
        $(this).css({'border-color':''});
    }
    ObjCart.delivery($(this).val());
});
$('body').on('change', 'select[name="payment"]', function(event) {
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    if ($(this).val().length > 0) {
        if (!numberRegex.test($(this).val()) || $(this).val() === '0') {
            $(this).val(1);
            return false;
        }
        $(this).css({'border-color':''});
    }
    ObjCart.payment($(this).val());
});
$('body').on('click', '#check_code_discounts', function(event) {
    
    if ($('#code_discounts').val().length > 0) {
        ObjCart.discounts($('#code_discounts').val());
    }else{
        
    }
    
});
$('body').on('click', '.btn-remove-option', function(event) {   
    
    ObjCart.remove_cart($(this));
    
});
</script>
@endsection
