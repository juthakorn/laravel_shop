@extends('layouts.standard')

@section('content')
<?php

$cal = cal_price($order);
$address = $order->address;
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
                     <a href="{{ url(UrlCheckoutAddress()) }}"><span>{{ trans('cart.Shipping Address') }}</span></a>
                     <div class="icon-step-circle"><i class="glyphicon glyphicon-chevron-right"></i></div>
                </li>               
                <li class="cart-li">
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
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="title"><span><i class="fa fa-file-text"></i> {{ trans('cart.Review') }}</span> </div>
            <div class="col-sm-12">
                <p>กรุณาตรวจสอบรายการสินค้าและข้อมูลการจัดส่งว่าถูกต้องครบถ้วน จากนั้นกดปุ่ม “{{ trans('cart.Confirm Order') }}”</p>
            </div>
        </div>
            
        
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"  style=" margin-top: 30px;">
            <div class="title" style="position: relative;font-size: 18px"><span><i class="fa fa-truck"></i> {{ trans('cart.Shipping Address') }}</span> 
                <div class="btn-add-address">
                    <a href="{{ url(UrlCheckoutAddress()) }}"  class="btn btn-theme"><i class="fa fa-pencil"></i> {{ trans('cart.Change address') }}</a>
                </div>
            </div>            
            <div class="row"> 
                 <?php
                    $temp_address = check_province($address->province);
                    ?>
                <div class="form-horizontal" >                
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label class="col-sm-4 control-label">{{ trans('user.First Name')."-".trans('user.Last Name') }}</label>
                            <div class="col-sm-8"> 
                                <label class="control-label font-normal">{{ $address->firstname." ".$address->lastname }}</label>
                            </div>
                        </div> 
                        <div class="form-group col-sm-12">
                            <label class="col-sm-4 control-label">{{ trans('user.Address') }}</label>
                            <div class="col-sm-8"> 
                                <label class="control-label font-normal">{{ $address->address." ".$temp_address['txttombon'].$address->sub_district." ".$temp_address['txtumpher'].$address->district." จังหวัด".$address->province." ".$address->postcode }}</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-4 control-label">{{ trans('user.Phone Number') }}</label>
                            <div class="col-sm-8"> 
                                <label class="control-label font-normal">{{ $address->tel }}</label>
                            </div>
                        </div>                        
                    </div>                  
                </div>
            </div>
            
        </div>
        
        <?php if(!empty($order->note)){ ?>
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"  style=" margin-top: 30px;">
            <div class="title" style="font-size: 16px"><span><i class="fa fa-send"></i> ข้อความถึงร้านค้า</span> </div>
            <div class="col-sm-12">
                <p>{{ $order->note }}</p>
            </div>        
        </div> 
        <?php } ?>
        
        
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style=" margin-top: 20px;">
            <div class="title" style="position: relative;font-size: 18px"><span><i class="fa fa-shopping-cart"></i> {{ trans('cart.Order') }}</span>
                <div class="btn-add-address">
                    <a href="{{ url(UrlCheckoutCart()) }}" class="btn btn-theme"><i class="fa fa-pencil"></i> {{ trans('cart.Edit Order') }}</a>
                </div>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered table-cart" id="table-cart">
                <thead>
                    <tr class="text-center">
                        <th colspan="2">{{ trans('cart.Product') }}</th>
                        <th style="width: 100px;">{{ trans('cart.Price') }}</th>
                        <th style="width: 84px;">{{ trans('cart.Quantity') }}</th>
                        <th style="width: 106px;">{{ trans('cart.SubTotal') }}</th>
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
                        <td class="img-cart" style="width: 78px; padding: 3px;vertical-align: middle;padding-right: 0;">
                            <a href="{{ url(UrlProduct($product->id, $product->slug_url)) }}">
                                <?php 
                                $arrimg = $product->image_stores()->orderBy('product_images.position', "asc")->take(1)->get()->toArray();
                                if(!empty($arrimg)){ ?>                                
                                    <img class="media-object img-thumbnail" src="<?= url(ImgProduct($arrimg[0]['id'], $arrimg[0]['new_name350']))?>" style="width: 70px">
                                <?php }else{ ?>
                                    <img class="media-object img-thumbnail" src="{{ URL::asset('image/nopicture.png') }}" style="width: 70px">
                                <?php }
                                ?>
                            </a>                               
                        </td>
                        <td>
                            <div>
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
                        <td colspan="2"><strong>{{  number_format($cal['subtotal'],2) }}</strong> <strong id="subtotal">{{ trans('cart.baht') }}</strong></td>
                    </tr>
                    <?php if($cal['payment_price'] !== 0){?>
                    <tr class="text-right">
                        <td colspan="3">{{ trans('cart.Destination fee') }} </td>
                        <td colspan="2"><strong>{{ number_format($cal['payment_price']) }}</strong> <strong >{{ trans('cart.baht') }}</strong></td>
                    </tr>
                    <?php } ?>
                    <tr class="text-right">
                        <td colspan="3">{{ trans('cart.Shipping Fee') }}</td>
                        <td colspan="2"><strong>{{ number_format($cal['delivery_price']) }}</strong> <strong id="subtotal">{{ trans('cart.baht') }}</strong></td>
                    </tr>
                    <?php if(!empty($cal['discount'])){?>
                    <tr class="text-right">
                        <td colspan="3">{{ trans('cart.Discount')." ".$cal['discount']."%" }} </td>
                        <td colspan="2"><strong>-{{ number_format($cal['discount_price']) }}</strong> <strong id="subtotal">{{ trans('cart.baht') }}</strong></td>
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
                <li class="previous"><a href="{{ url(UrlCheckoutAddress()) }}">{{ trans('cart.Back To Previous Page') }}</a></li>
                <li class="next">
                    {!! Form::open(['method' => 'POST', 'url' => url(UrlCheckoutSuccess()), 'style'=>'float: right;']) !!}                      
                    <button type="submit" class="btn btn-theme"> {{ trans('cart.Confirm Order') }}</button>
                    {!! Form::close() !!} 
                </li>
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
                                    <img src="<?= ImgProduct($arrimg[0]['id'], $arrimg[0]['new_name350'])?>" >
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


@section('script-custom')
<script>

</script>
@endsection

