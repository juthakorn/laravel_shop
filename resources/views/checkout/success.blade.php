@extends('layouts.standard')

@section('content')

<div class="container m-t-3">
    @include("partials.alert-session") 
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="wrapstep">
                <ul class="step-li">
                    <li class="cart-li">
                        <i class="fa fa-shopping-cart"></i> 
                        <span>{{ trans('cart.Shopping Cart') }}</span>
                        <div class="icon-step-circle"><i class="glyphicon glyphicon-chevron-right"></i></div>
                    </li>
                    <li class="cart-li">
                        <i class="fa fa-truck"></i> 
                        <span>{{ trans('cart.Shipping Address') }}</span>
                        <div class="icon-step-circle"><i class="glyphicon glyphicon-chevron-right"></i></div>
                    </li>               
                    <li class="cart-li">
                        <i class="fa fa-file-text"></i> 
                        <span>{{ trans('cart.Review') }}</span>
                        <div class="icon-step-circle"><i class="glyphicon glyphicon-chevron-right"></i></div>                                      
                    </li>
                    <li class="cart-li">
                        <i class="glyphicon glyphicon-ok"></i>
                        <span>{{ trans('cart.Order Complete') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="title"><span><i class="fa fa-file-text"></i> {{ trans('cart.Order Complete') }}</span> </div>
            
        </div>

        <div class="col-xs-12 pm-success">
            <div class="cen">
                <i class="fa fa-check-square fa-5x"></i><br>
                <span class="big">การสั่งซื้อเสร็จสมบูรณ์</span><br>
                หมายเลขการสั่งซื้อคือ {{ $order->order_id }}
            </div>
        </div>
        <?php if($order->payment_price != "0.00"){ ?>
            <div class="col-sm-12 col-xs-12">
                <div class="pm-price">
                    <div class="cen">
                        <i class="fa fa-money fa-2x"></i><br>
                        <span class="big2">จำนวนเงินที่ต้องชำระ</span><br>
                        <span class="show-price">{{ number_format($order->final_sum, 2)}} บาท</span><br>
                        ดูวิธีการชำระเงินด้านล่าง
                    </div>
                </div>
            </div>
        <?php }else{ ?>
            <div class="col-sm-6 col-xs-12">
                <div class="pm-price">
                    <div class="cen">
                        <i class="fa fa-money fa-2x"></i><br>
                        <span class="big2">จำนวนเงินที่ต้องชำระ</span><br>
                        <span class="show-price">{{ number_format($order->final_sum, 2)}} บาท</span><br>
                        ดูวิธีการชำระเงินด้านล่าง
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="pm-time">
                    <div class="cen">
                        <i class="fa fa-calendar fa-2x"></i><br>
                        <span class="big2">กรุณาชำระเงินและแจ้งโอนภายใน</span><br>
                        <span class="show-date">{{ DateTime($order->limit_pay_date) }}</span><br>
                        <span class="show-time">เวลา {{ date("h:i",strtotime($order->limit_pay_date)) }} น.</span>
                    </div>
                </div>
            </div>
        <?php } ?>
        
               
        <div class="col-xs-12">
            <div class="pm-sep" >
                <span class="big">วิธีการชำระเงิน</span><br>
                <div style="text-align: left;padding-top: 8px;"> 
                <?php if($order->payment_price != "0.00"){?>
                    <p>Cash on delivery (COD) คือการเก็บเงินปลายทาง ลูกค้าสามารถชำระค่าสินค้ากับพนักงานส่ง ง่าย ปลอดภัยและไม่ยุ่งยาก</p>    
                <?php }else{ ?>    
                    <p>ลูกค้าสามารถโอนเงินเพื่อชำระเงินค่าสินค้าได้ตามบัญชีด้านล่าง จากนั้นไปที่เมนู "แจ้งชำระเงิน" เพื่อแจ้งชำระเงินค่ะ</p>    
                <?php } ?>    

                <p>หากมีข้อสงสัยติดต่อสอบถามหรือสั่งซื้อได้ที่</p>
                <p>1. Line ID : @tm_shop (มี @ ด้วยนะคะ)</p>
                <p>2. Facebook Page โดยสามารถส่งข้อความ (inbox) หาเราได้ทันที <a href="https://www.facebook.com/TM.TM.SHOP/">TM SHOP เสื้อคู่รัก</a></p>
                <p>3. โทร. 086-2081943</p> 
                คุณสามารถดูรายละเอียดการสั่งซื้อได้ที่ รายการสั่งซื้อ <a href="{{ url(customer_order_detail($order->order_id)) }}">#{{ $order->order_id }}</a> หรือดูรายการสั่งซื้อทั้งหมดที่ <a href="{{ url(customer_order()) }}">รายการสั่งซื้อ</a>

            </div>
            </div>
        </div>
                
        <?php if($order->payment_price == "0.00"){ ?>
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style=" margin-top: 20px;">
            <div class="title" style="position: relative;font-size: 18px"><span><i class="fa fa-shopping-cart"></i> ชำระเงินผ่านธนาคาร</span>
                
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-cart" id="table-cart">
                    <thead>
                        <tr class="text-center">
                            <th colspan="2">{{ trans('cart.Bank') }}</th>
                            <th >{{ trans('cart.Account No') }}</th>
                            <th >{{ trans('cart.Account Name') }}</th>
                            <th>{{ trans('cart.Branch') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banks as $key => $bank) { ?>
                            <tr>
                                <td class="img-cart" >
                                    <img class="media-object img-thumbnail" src="<?= url("image/" . imgbank($bank->bank_name)) ?>" alt="<?= $bank->bank_name ?>" style="border-radius: 32px;" >                               
                                </td>
                                <td>{{ $bank->bank_name }}</td>
                                <td class="text-center">{{ $bank->bank_number }}</td>
                                <td class="text-center">{{ $bank->ac_name }}</td>
                                <td class="text-center">{{ $bank->branch }}</td>                        
                            </tr>
                        <?php } ?>  
                    </tbody>
                </table>
            </div>
            <nav>
                <ul class="pager">
                    <li class="next">
                        {!! Form::open(['method' => 'POST', 'url' => url(UrlCheckoutSuccess()), 'style'=>'float: right;']) !!}                      
                        <button type="submit" class="btn btn-theme"> ไปหน้าแจ้งชำระเงิน</button>
                        {!! Form::close() !!} 
                    </li>
                </ul>
            </nav>
        </div>
        <?php } ?>
    </div>


</div>

@endsection


@section('script-custom')
<script>

</script>
@endsection

