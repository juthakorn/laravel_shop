@extends('layouts.standard_v2')

@section('content')
<div class="container-fluid limited mb-5">
    <div class="row">

        <!-- Account Sidebar -->
        @include("user.account-sidebar_v2")
        <!-- End Account Sidebar -->

        <div class="col-lg-9 col-md-8">
            <div class="title"><span>{{ trans('common.my_order') }}</span></div>    
            @include("partials.alert-session")
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ trans('cart.Order number') }}</th>
                            <th>{{ trans('cart.Product') }}</th>
                            <th>{{ trans('cart.Order date') }}</th>
                            <th>{{ trans('cart.Payment Channel') }}</th>
                            <th class="text-right">{{ trans('cart.Price') }} (฿)</th>
                            <th class="text-center">{{ trans('cart.Order status') }}</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($order as $key => $value) {
                            $status = status($value->status);
                            ?>
                            <tr>
                                <td><a href="{{ url(customer_order_detail($value->order_id)) }}"><span class="badge2">{{ $value->order_id }}</span></a></td>
                                <td>
                                    <?php
                                    $temp = $value->order_detail->groupBy('product_id');
//                                    prx($temp->toArray());                               
                                    foreach ($temp as $keytmp => $valuetmp) {
                                        ?>       



                                            <?php $product = App\Model\Product::find($keytmp); ?>
                                            <?php if ($product != null) { ?>
                                            <a href="{{ url(UrlProduct($valuetmp[0]->product_id, $product->slug_url)) }}" style="text-decoration: none;" title="{{ $valuetmp[0]->p_name }}">
                                                <?php
                                                if (file_exists(str_replace(url("/") . "/", "", ImgProduct(@$valuetmp[0]->image_store->id, @$valuetmp[0]->image_store->new_name150)))) {
                                                    if (!empty($valuetmp[0]->image_store->id)) {
                                                        ?>
                                                        <img src="<?= ImgProduct($valuetmp[0]->image_store->id, $valuetmp[0]->image_store->new_name150) ?>" style="height:50px">
                                                    <?php } else { ?>
                                                        <img src="<?= ImgNoProduct() ?>"  style="height:50px">
                                                    <?php } ?>                                           

                                                <?php } else { ?>
                                                    <img src="<?= ImgNoProduct() ?>"  style="height:50px">
                                            <?php } ?>
                                            </a>
                                        <?php } else { ?>

                                            <?php
                                            if (file_exists(str_replace(url("/") . "/", "", ImgProduct(@$valuetmp[0]->image_store->id, @$valuetmp[0]->image_store->new_name150)))) {
                                                if (!empty($valuetmp[0]->image_store->id)) {
                                                    ?>
                                                    <img src="<?= ImgProduct($valuetmp[0]->image_store->id, $valuetmp[0]->image_store->new_name150) ?>" style="height:50px" title="{{ $valuetmp[0]->p_name }}">
                                                <?php } else { ?>
                                                    <img src="<?= ImgNoProduct() ?>"  style="height:50px" title="{{ $valuetmp[0]->p_name }}">
                                                <?php } ?>                                              
                                            <?php } else { ?>
                                                <img src="<?= ImgNoProduct() ?>"  style="height:50px" title="{{ $valuetmp[0]->p_name }}">
                                            <?php } ?>                                        
                                        <?php
                                        }
                                    }
                                    ?>
                                </td>
                                <td>{{ DateTime($value->created_at, TRUE) }}</td>
                                <td>{{ $value->payment_name }}</td>
                                <td class="text-right">{{ number_format($value->final_sum,2) }}</td>
                                <td class="text-center">
                                    <span class="label label-<?= @$status['class'] ?>" style="<?= @$status['style'] ?>">{{ $status['text'] }}</span>
                                </td>
                            </tr>  
                    <?php } ?>


                    </tbody>
                </table>
            </div>   
            <div class=" text-center">
                <nav>
                 {!! $order->appends( Request::query() )->render() !!}
                </nav>
            </div>
        </div>
    </div>
</div>


@endsection


@section('script')
<script src="{{ URL::asset('shop-v2/js/customer.js') }}"></script>
@endsection