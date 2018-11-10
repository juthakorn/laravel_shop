@extends('layouts.admin')
@section('title', 'จัดการสินค้า')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-tags"></i>
            Order management
            <!--<small>Preview</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">สินค้า</a></li>
            <li class="active">จัดการสินค้า</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                
                @include("partials.alert-session")
                <div class="box box-info">
                    {!! Form::model($form_search,[
                        'url' => url(UrlAdminOrder()),
                        'method' => 'GET',
                        'class'=>'form-horizontal'
                    ]) !!}      
                    <div class="box-body">    
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">สถานะ</label>

                            <div class="col-sm-3 forminline">
                                {!! Form::select('status_order', listStatus(), null, ['class' => 'form-control', 'id'=>'status_order']) !!}
                            </div>
                        </div>   
                        <div class="form-group"> 
                            <label class="col-sm-2 control-label">ค้นหาจาก</label>
                            <div class="col-sm-3 forminline">
                                {!! Form::select('key_search', $option, null, ['class' => 'form-control', 'id'=>'key_search']) !!}
                            </div>                            
                            <div class="col-sm-7 forminline">
                                {!! Form::text('keyword', null, ['class' => 'form-control', 'id'=>'keyword']) !!}                                   
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label for="start" class="col-sm-2 control-label">ช่วงวันที่</label>

                            <div class="col-sm-3 forminline">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {!! Form::date('start', null, ['class' => 'form-control date', 'id'=>'start']) !!}      
                                </div>
                            </div>
                            <label for="end" class="col-sm-1 control-label">ถึงวันที่</label>
                            <div class="col-sm-3 forminline">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {!! Form::date('end', null, ['class' => 'form-control date', 'id'=>'end']) !!}      
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>                    
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary btn-submit">Search</button>
                            <button type="reset" class="btn btn-default">Cancel</button>
                        </div>
                    </div>  
                    <!-- /.box-footer -->
                    {!! Form::close() !!}
                </div>
                
                <div class="box box-info">
<!--                    <div class="box-header with-border">
                      <h3 class="box-title">Product management</h3>
                    </div>-->
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                        <div class="table-responsive">
                            <table class="table table-order">
                                <thead>
                                    <tr>                                    
                                        <td>{{ trans('cart.Order number') }}</td>
                                        <td>{{ trans('cart.Product') }}</td>
                                        <td>{{ trans('cart.Order date') }}</td>
                                        <td>{{ trans('cart.Payment Channel') }}</td>
                                        <td class="text-right">{{ trans('cart.Price') }} (฿)</td>
                                        <td class="text-center">{{ trans('cart.Order status') }}</td>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order as $key => $value) {
                                            $status = status($value->status);
                                        ?>
                                    <tr>
                                        <td><a href="{{ url(admin_order_detail($value->order_id)) }}"><span class="badge">{{ $value->order_id }}</span></a></td>
                                        <td>
                                    <?php
                                    $temp = $value->order_detail->groupBy('product_id');     
                                    //prx($temp->toArray());                               
                                    foreach ($temp as $keytmp => $valuetmp) { ?>       



                                        <?php $product = App\Model\Product::find($keytmp);  ?>
                                        <?php if($product != null) {?>
                                        <a href="{{ url(UrlProduct($valuetmp[0]->product_id, $product->slug_url)) }}" style="text-decoration: none;" title="{{ $valuetmp[0]->p_name }}">
                                            <?php                                           

                                            if(file_exists(str_replace(url("/")."/", "", ImgProduct(@$valuetmp[0]->image_store->id, @$valuetmp[0]->image_store->new_name150)))){ 
                                                if(!empty($valuetmp[0]->image_store->id)){ ?>
                                                    <img src="<?= ImgProduct($valuetmp[0]->image_store->id, $valuetmp[0]->image_store->new_name150)?>" style="height:50px">
                                                <?php }else{ ?>
                                                    <img src="<?= ImgNoProduct()?>"  style="height:50px">
                                                <?php } ?>   
                                            <?php }else{ ?>
                                                <img src="<?= ImgNoProduct()?>"  style="height:50px">
                                            <?php } ?>
                                        </a>
                                        <?php }else{ ?>
                                       
                                            <?php 
                                            if(file_exists(str_replace(url("/")."/", "", ImgProduct(@$valuetmp[0]->image_store->id, @$valuetmp[0]->image_store->new_name150)))){
                                                if(!empty($valuetmp[0]->image_store->id)){ ?>
                                                    <img src="<?= ImgProduct($valuetmp[0]->image_store->id, $valuetmp[0]->image_store->new_name150)?>" style="height:50px" title="{{ $valuetmp[0]->p_name }}">
                                                <?php }else{ ?>
                                                    <img src="<?= ImgNoProduct()?>"  style="height:50px" title="{{ $valuetmp[0]->p_name }}">
                                                <?php } ?>                                           
                                            <?php }else{ ?>
                                                <img src="<?= ImgNoProduct()?>"  style="height:50px" title="{{ $valuetmp[0]->p_name }}">
                                            <?php } ?>                                        
                                        <?php } 


                                    }
                                    ?>
                                    </td>
                                        <td>{{ DateTime($value->created_at, TRUE) }}</td>
                                        <td>{{ $value->payment_name }}</td>
                                        <td class="text-right">{{ number_format($value->final_sum,2) }}</td>
                                        <td class="text-center">
                                            
                                            <span class="label label-{{ @$status['class'] }}" style="{{ @$status['style'] }}">{{ $status['text'] }}</span>
                                            <?php if($value->status === 9) {?>
                                            <div class="delivery_number"><a href="">{{ $value->delivery_number }}</a></div>
                                            <?php }?>
                                            
                                        </td>
                                        <td>
                                            <?php if($value->status === 9 || $value->status === 4 ) {?>
                                            <a href="{{ route('adminorder.delivery', $value->id) }}" class="btn btn-info show-delivery-modal btn-circle" data-title="{{ $value->order_id }}" data-value="{{ $value->delivery_number }}"><i class="fa fa-truck"></i></a>
                                            <?php }?>
                                            <a href="{{ url(admin_order_detail($value->order_id)) }}" target="_blank" class="btn btn-default btn-circle" title="ดูใบสั่งซื้อ"><i class="glyphicon glyphicon-search"></i></a>
                                            <a href="{{ route('adminorder.destroy', $value->id) }}" class="btn btn-danger show-confirm-modal btn-circle" data-title="{{ $value->order_id }}"><i class="glyphicon glyphicon-remove"></i></a>
                                        </td>
                                    </tr>  
                                    <?php }?>


                                </tbody>
                            </table>
                        </div>
                        <div class=" pull-left">
                            <div class="total" >
                                Total : <span class="txt-blue">{!! $order->total() !!}</span>
                             </div>
                        </div>
                        <div class=" pull-right">
                            <nav>
                             {!! $order->appends( Request::query() )->render() !!}
                            </nav>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    
                  </div>
                
                
               
              
            </div>

        </div>


    </section>    
</div><!-- /.content -->

    @include('order_admin.delivery-modal')
    @include('partials.confirm-modal')
@endsection


@section('stylesheet')
<?php /*
<link href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}" rel="stylesheet">
*/ ?>
@endsection

@section('script')
<?php /*
<script src="{{ URL::asset('shop/js/bootstrap-filestyle.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('plugins/datepicker/locales/bootstrap-datepicker.th.js') }}" charset="UTF-8"></script>
*/ ?>
@endsection

@section('script-custom')
<script>    
    
    $('body').on('click', '.show-delivery-modal', function(event) {
        event.preventDefault();
        var me = $(this),
            title = me.attr('data-title'),
            value = me.attr('data-value'),
            action = me.attr('href');

        $('#delivery-body form').attr('action', action);
        $('#delivery_number').val(value);
        $('#delivery-head').html("ฟอร์มใส่เลขพัสดุ #" + title);
        $('#delivery-modal').modal('show');
    });

    $('#btn-delivery').click(function(event) {
        event.preventDefault();
        $('#delivery-body form').submit();           
    });
    
    $('body').on('click', '.show-confirm-modal', function(event) {
        event.preventDefault();

        var me = $(this),
            title = me.attr('data-title'),
            action = me.attr('href');

        $('#confirm-body form').attr('action', action);
        $('#confirm-body p').html("คุณต้องการลบรายการสั่งซื้อ : <strong>" + title + "</strong>");
        $('#confirm-modal').modal('show');
    });
    
    $('#confirm-remove-btn').click(function(event) {
        event.preventDefault();
        $('#confirm-body form').submit();           
    });
    
    
</script>
@endsection