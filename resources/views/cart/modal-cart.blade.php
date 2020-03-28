 <?php
$data = [];
$sumqty = 0;
if( !Auth::guest()){
    $temp = Auth::user()->OrderTemp;
    if(!empty($temp)){
        $data = unserialize($temp->data);
    }
}else{
    if (Cookie::get('cart') !== null){ 
        $data = Cookie::get('cart');        
    }
}
if(isset($ajax_data)){
    $data = $ajax_data;
}
$sum = 0;
?>
        
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="cartModalLabel">Shopping Cart : <span id="sum_qty2"><?=$sumqty?></span> items</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <?php 

        if(!empty($data)){
            foreach ($data as $key => $value) {
                $product_attr = App\Model\ProductAttribute::with('product')->find($value['attr_id']);       
                if(empty($product_attr)){
                    continue;
                }
                $product = $product_attr->product;
                $price = $value['qty'] * $product_attr->p_price;
                $sum += $price;
                $sumqty += $value['qty'];
                if(array_key_exists($value['attr_id'], $data)){
                    $data[$value['attr_id']]['qty'] += $value['qty'];
                }
                if(isset($request_data)){
                    foreach ($request_data as $key_request => $value_request) {
                        if($value_request['attr_id'] == $value['attr_id']){
                            $request_data[$key_request]['price'] = $product_attr->p_price;
                        }
                    }
                }
                ?>
            <div class="media">
                <a href="{{ url(UrlProduct($product->id, $product->slug_url)) }}" class="mr-2">
                    <?php 
                    $arrimg = $product->image_stores()->orderBy('product_images.position', "asc")->take(1)->get()->toArray();
                    if(!empty($arrimg)){ ?>                                
                        <img class="img-fluid rounded" src="<?= ImgProduct($arrimg[0]['id'], $arrimg[0]['new_name350'])?>" width="70" >
                    <?php }else{ ?>
                        <img class="img-fluid rounded" src="{{ URL::asset('image/nopicture.png') }}" width="70">
                    <?php }
                    ?>
                </a>                        
                <div class="media-body">
                    <div><a href="{{ url(UrlProduct($product->id, $product->slug_url)) }}" class="text-dark">{{ $product->p_name }}</a></div>
                    <div style="color:#d94848;">{{ $product_attr->option1." ".$product_attr->option2 }}</div>
                    <span class="text-secondary"><span class="mr-3">{{ $value['qty']." ".trans('cart.item') }}</span>{{  number_format($price,2)." ".trans('cart.baht') }}</span>
                    <button class="close text-danger remove-dropdown-cart" data-attr="{{ $value['attr_id'] }}" ><i class="material-icons">close</i></button>
                </div>
            </div>
            <?php } ?>
        <?php }else{ ?>
        <div class="text-center">
            <div style="padding: 20px">
                {{ trans('cart.no_product_in_cart') }}
            </div>    
        </div>
        <?php } ?>

    </div>
    <div class="modal-footer justify-content-center border-top-0">
        <div class="btn-group" role="group" aria-label="Cart Action">
            <!--<a href="{{ url(UrlCheckoutCart()) }}" class="btn btn-outline-theme" role="button">{{ trans('cart.View Cart') }}</a>-->
            <a href="{{ url(UrlCheckoutCart()) }}" class="btn btn-theme" role="button">{{ trans('cart.Checkout') }}</a>
        </div>
    </div>
    </div>
    
    <div class="overlay" id="overlay" style="display: none">
        <i class="fa fa-refresh fa-spin"></i>
    </div>    
    
<script  type="text/javascript" >
    document.getElementById("sum_qty").innerHTML = "<?=$sumqty?>"; 
    document.getElementById("sum_qty2").innerHTML = "<?=$sumqty?>"; 
    <?php if(isset($request_data)){ ?>
        madal_add_to_cart(<?= json_encode($request_data) ?>);
    <?php } ?>
</script>

@section('script-custom2')
<script  type="text/javascript" >
    
    $(document).ready(function(){
        $('body').on('click', 'button.remove-dropdown-cart', function(event) {
            event.preventDefault();
            $('#overlay').show();
            var product_attr_id = $(this).attr('data-attr');           
            $.ajax({
                url: '{{ url(UrlRemoveCart()) }}/' + product_attr_id,
                success: function(ret)
                {
                    $('#dropdown-cart').empty().html(ret);
                    $('#overlay').hide();
                }
            });
            return false;
            
        });
    });
</script>
@endsection
