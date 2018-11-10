@extends('layouts.standard')

@section('content')
<div class="container m-t-3">
    <div class="row">

        <!-- Account Sidebar -->
        @include("user.account-sidebar")
        <!-- End Account Sidebar -->

        <!-- My Profile Content -->
        <div class="col-sm-8 col-md-9">
            <div class="title m-b-2" ><span>{{ trans('common.my_order') }}</span></div>

            @include("partials.alert-session")               

            <div class="row">
                <div class="col-xs-12">
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order as $key => $value) {
                                        $status = status($value->status);
                                    ?>
                                <tr>
                                    <td><a href="{{ url(customer_order_detail($value->order_id)) }}"><span class="badge">{{ $value->order_id }}</span></a></td>
                                    <td>
                                    <?php
                                    $temp = $value->order_detail->groupBy('product_id');     
//                                    prx($temp->toArray());                               
                                    foreach ($temp as $keytmp => $valuetmp) {  ?>       



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
                                    </td>
                                </tr>  
                                <?php }?>
                                
                                
                            </tbody>
                        </table>
                    </div>
                    <div class=" pull-right">
                        <nav>
                         {!! $order->appends( Request::query() )->render() !!}
                        </nav>
                    </div>
                </div>
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
