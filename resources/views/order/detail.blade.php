@extends('layouts.standard')

@section('content')

<div class="container m-t-3">
    <div class="row">

        <!-- Account Sidebar -->
        @include("user.account-sidebar")
        <!-- End Account Sidebar -->

        <!-- My Profile Content -->
        <div class="col-sm-8 col-md-9">
            <div class="title m-b-2" ><span>{{ trans('common.my_order')." #".$order->order_id }} </span></div>

            @include("partials.alert-session")               

            <div class="row">
                @if ($order->status == 0 || $order->status == 3)
                <div class="col-sm-12">
                    <div class="well" >                         
                        <div  class="font14 pull-left"><strong>{{ trans('cart.text_net_amount')." ".number_format($order->final_sum,2)." ".trans('cart.baht').(App::getLocale() == 'th' ? "" : ".") }}</strong></div>                       
                        <a href="{{ url(UrlPayment()) }}" class="btn btn-primary pull-right"><i class="fa fa-credit-card"></i> {{ trans('cart.Payment') }}</a>                            
                         
                        <div class="clearfix"></div>
                    </div>
                </div>
                @endif
                
                @if ($order->status == 9)
                <div class="col-sm-12">
                    <div class="well" >                         
                        <div  class="font16 pull-left"><strong>{{ trans('cart.tracking number') }} : </strong>{{ $order->delivery_number }}</div>                       
                        <a href="{{ url(customer_track($order->delivery_number)) }}" class="btn btn-primary pull-right" id="chech_track"><i class="fa fa-truck"></i> {{ trans('cart.Check status') }}</a>                            
                         
                        <div class="clearfix"></div>
                    </div>
                </div>
                
                <div class="col-md-12 box-overlay">
                    <div id="res_track" style="min-height: 70px;display: none">
                        
                    </div>
                    <div class="overlay" id="overlay_new" style="display: none;top: -12px">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                @endif
                
                <div class="col-md-6">                  
                    <table class="table table-bordered table-gray" >
                        <thead>
                          <tr>
                            <td class="center" colspan="2">รายละเอียดใบสั่งซื้อสินค้า</td>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="right" style="width: 35%;"><strong>{{ trans('cart.Order number') }} :</strong></td>
                                <td class="left" style="width: 65%;">{{ $order->order_id }}</td>
                            </tr>
                            <tr>
                                <td class="right"><strong>{{ trans('cart.Order date') }} :</strong></td>
                                <td class="left" >{{ DateTime($order->created_at, TRUE) }}</td>
                            </tr>
                            <tr>
                                <td class="right"><strong>{{ trans('cart.Order status') }} :</strong></td>
                                <td class="left" ><?php $status = status($order->status); ?>                            
                                    <span class="label label-<?= @$status['class'] ?>" style="<?= @$status['style'] ?>">{{ $status['text'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="right"><strong>{{ trans('cart.Payment Channel') }} :</strong></td>
                                <td class="left" >{{ $order->payment_name }}</td>
                            </tr>
                            <tr>
                                <td class="right"><strong>{{ trans('cart.Delivery') }} :</strong></td>
                                <td class="left" >{{ $order->delivery_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <?php 
                    $temp_address = check_province($order->delivery_province);
                    ?>
                    <table class="table table-bordered table-gray">
                        <thead>
                            <tr>
                                <td class="center" colspan="2">{{ trans('cart.Shipping Address') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="right" style="width: 35%;"><strong>{{ trans('user.First Name')."-".trans('user.Last Name') }} :</strong></td>
                                <td class="left" style="width: 65%;">{{ $order->delivery_firstname." ".$order->delivery_lastname }}</td>
                            </tr>
                            <tr>
                                <td class="right"><strong>{{ trans('user.Address') }} :</strong></td>
                                <td class="left" >{{ $order->delivery_address." ".$temp_address['txttombon'].$order->delivery_sub_district." ".$temp_address['txtumpher'].$order->delivery_district." จังหวัด".$order->delivery_province." ".$order->delivery_postcode }}</td>
                            </tr>
                            <tr>
                                <td class="right"><strong>{{ trans('user.Phone Number') }} :</strong></td>
                                <td class="left" >{{ empty($order->delivery_tel) ? "-" : $order->delivery_tel }}</td>
                            </tr>
                            
                        </tbody>
                    </table>     
<!--                    <ul class="list-group">
                        <li class="list-group-item"><span class="order-txt01"><strong>{{ trans('cart.Order number') }} :</strong> 3578572178</span></li> 
                        <li class="list-group-item"><span class="order-txt01"><strong>{{ trans('cart.Order date') }} :</strong> 25/05/2560 22:49:39</span></li>
                        <li class="list-group-item"><span class="order-txt01"><strong>{{ trans('cart.Order status') }} :</strong> ยืนยันการสั่งซื้อแล้ว</span></li>
                    </ul>-->
                </div>
            </div>
            <?php if(!$payment->isEmpty()){ ?>
            <div class="row">
                <div class=" col-md-12">    
                    <div class="title m-b-2 font16" style="border-bottom:none">{{ trans('common.Payment history') }}</div>
                    <div class="table-responsive">                        
                        <table class="table table-cart table-bordered table-gray">
                            <thead>
                                <tr class="text-center">
                                    <td>{{ trans('common.Payment notification') }}</td>
                                    <td>{{ trans('common.Bank account') }}</td>
                                    <td>{{ trans('common.Transfer Date') }}</td>
                                    <td>{{ trans('common.Amount') }}</td>
                                    <td>{{ trans('common.Status') }}</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payment as $key => $value)
                                <tr class="text-center vertical-middle" >
                                    <td>{{ DateTime($value->created_at, TRUE) }}</td>
                                    <td>
                                        
                                        <?php $bank = unserialize($value->bank_info); ?>                                        
                                        <img class="media-object img-thumbnail" src="<?= url("image/" . imgbank($bank['bank_name'])) ?>" title="<?= $bank['bank_name'] ?>" style="border-radius: 32px;width: 40px; float: left" >   
                                        <div style="float: left;margin-left: 10px;text-align: left;"><p style="margin-bottom: 0">{{ $bank['bank_name'] }}</p><p style="margin-bottom: 0">{{ $bank['bank_number'] }}</p></div>

                                    </td>
                                    <td class=" vertical">{{ DateTime($value->transfer_date)." ".$value->transfer_time.":00" }}</td>
                                    <td class="text-right">{{ number_format($value->transfer_pay,2)." ".trans('cart.baht')  }}</td>
                                    <td><?php $statuspay = statuspay($value->status); ?>                            
                                        <span class="label label-{{ $statuspay['class'] }}" >{{ $statuspay['text'] }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ url(UrlPaymentinfo($value->id))}}" target="_blank" class="btn btn-default btn-circle" title="{{ trans('common.view_detail') }}"><i class="glyphicon glyphicon-search"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="row">
                <div class=" col-md-12">
                    
                    <div class="table-responsive">
                        <table class="table table-cart table-bordered table-gray">
                            <thead>
                                <tr class="text-center">
                                    <td colspan="2">{{ trans('cart.Product') }}</td>
                                    <td style="width: 100px;">{{ trans('cart.Price') }}</td>
                                    <td style="width: 84px;">{{ trans('cart.Quantity') }}</td>
                                    <td style="width: 106px;">{{ trans('cart.SubTotal') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php                            
                           foreach ($order_detail as $key => $value) { 
                                ?>
                                <tr>
                                    <td style="width:65px;padding: 5px; " >


                                        <?php $product = App\Model\Product::find($value->product_id);  ?>
                                        <?php if($product != null) {?>
                                        <a href="{{ url(UrlProduct($value->product_id, $product->slug_url)) }}">
                                            <?php                                           

                                            if(file_exists(str_replace(url("/")."/", "", ImgProduct($value->image_store->id, $value->image_store->new_name150)))){ ?>                                           
                                            <img src="<?= ImgProduct($value->image_store->id, $value->image_store->new_name150)?>" class="media-object img-thumbnail" style="width:55px">
                                            <?php }else{ ?>
                                                <img src="<?= ImgNoProduct()?>" class="media-object img-thumbnail" style="width:55px">
                                            <?php } ?>
                                        </a>
                                        <?php }else{ ?>
                                       
                                            <?php 
                                            if(file_exists(str_replace(url("/")."/", "", ImgProduct($value->image_store->id, $value->image_store->new_name150)))){ ?>                                           
                                            <img src="<?= ImgProduct($value->image_store->id, $value->image_store->new_name150)?>" class="media-object img-thumbnail" style="width:55px">
                                            <?php }else{ ?>
                                                <img src="<?= ImgNoProduct()?>" class="media-object img-thumbnail" style="width:55px">
                                            <?php } ?>                                        
                                        <?php } ?>
                                       

                                    </td>
                                    <td>
                                        <div>
                                            <?php if($product != null) {?>
                                            <p><a href="{{ url(UrlProduct($value->product_id, $product->slug_url)) }}" class="d-block">{{ $value->p_name }}</a></p>
                                        <small>{{ $value->option1." ".$value->option2 }}</small>
                                            <?php }else{ ?>
                                            <p>{{ $value->p_name }}</p>
                                            <small>{{ $value->option1." ".$value->option2 }}</small>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td class="text-right">{{ number_format($value->p_price,2) }}</td>
                                    <td class="text-center">{{ $value->p_quantity }}</td>
                                    <td class="text-right">{{ number_format($value->sum,2) }}</td>

                                </tr>
                                <?php } ?>     
                                
                                
                                <tr class="text-right">
                                    <td colspan="3">{{ trans('cart.SubTotalProduct') }}</td>
                                    <td colspan="2"><strong>{{ number_format($order->product_price,2)." ".trans('cart.baht') }}</strong></td>
                                </tr>
                                <?php if($order->payment_price !== 0.00){?>
                                <tr class="text-right">
                                    <td colspan="3">{{ trans('cart.Destination fee') }} </td>
                                    <td colspan="2"><strong>{{ number_format($order->payment_price) }}</strong> <strong >{{ trans('cart.baht') }}</strong></td>
                                </tr>
                                <?php } ?>
                                <tr class="text-right">
                                    <td colspan="3">{{ trans('cart.Shipping Fee') }}</td>
                                    <td colspan="2"><strong>{{ number_format($order->delivery_price)." ".trans('cart.baht') }}</strong></td>
                                </tr>
                                <?php if(!empty($order->discount)){?>
                                <tr class="text-right">
                                    <td colspan="3">{{ trans('cart.Discount')." ".$order->discount."%" }} </td>
                                    <td colspan="2"><strong>-{{ number_format($order->discount_price,2)." ".trans('cart.baht') }}</strong></td>
                                </tr>
                                <?php } ?>
                                <tr class="text-right">
                                    <td colspan="3">{{ trans('cart.Total') }}</td>
                                    <td colspan="2"><strong>{{ number_format($order->final_sum,2)." ".trans('cart.baht') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <?php if(!empty($order->note)){ ?>
                    
                    <table class="table table-bordered table-gray">
                        <thead>
                            <tr>
                                <td class="center">ข้อความถึงร้านค้า</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>                                
                                <td class="left">{{ $order->note }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <?php } ?>
                    
                    <div class="text-center" style="margin-bottom: 50px;">                            
                        @if ($order->status == 0)
                        <button data-toggle="modal" data-target="#modal-cancelorder" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> {{ trans('cart.Cancel Order') }}</button>
                        @endif
                        <button type="button" class="btn btn-theme"><span class="glyphicon glyphicon-print"></span> {{ trans('cart.Print Order') }}</button>
                     </div>
                    
                </div>
            </div>

        </div>
        <!-- End My Profile Content -->

    </div>
</div>
<div class="modal fade" id="modal-cancelorder" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content report-modal-content">
            <div class="modal-header" align="left">
                <h4 class="modal-title" id="modal-title-report">{{ trans('cart.Cancel Order') }} : {{ $order->order_id }}</h4>
            </div>
            <div class="modal-body">                        
                
                {!! Form::open(['route' => 'order.cancel', 'method' => 'POST', 'id'=>'order-cancel']) !!}     
                    <div class="form-group" align="left">
                        <label><span class="order-txt02">{{ trans('cart.reason_cancel') }}</span></label>
                        <textarea class="form-control" rows="5" name="cancel_detail"  maxlength="200" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span> {{ trans('cart.Cancel Order') }}</button>
                        <button class="btn btn-default" data-dismiss="modal" id="cancel">{{ trans('common.Close') }}</button>
                    </div>
                <input type="hidden" name="id" value="{{ $order->id }}" >
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@include("partials.confirm-modal")   

@endsection



@section('script')
<script src="{{ URL::asset('shop/js/customer.js') }}"></script>
@endsection

@section('script-custom')
<script>

$('#chech_track').click(function(event) {   
        $('#overlay_new,#res_track').show();
        $('#res_track').empty();
        event.preventDefault();
        $.ajax({
            url: event.target.href,
            success: function (res) {            
                $('#res_track').html(res).slideDown("slow");
                $('#overlay_new').hide();
            }
        });
        return false;
    });
</script>
@endsection