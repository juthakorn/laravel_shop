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
        <div class="media-left">
            <a href="{{ url(UrlProduct($product->id, $product->slug_url)) }}">
                <?php 
                $arrimg = $product->image_stores()->orderBy('product_images.position', "asc")->take(1)->get()->toArray();
                if(!empty($arrimg)){ ?>                                
                    <img class="media-object img-thumbnail" src="<?= ImgProduct($arrimg[0]['id'], $arrimg[0]['new_name350'])?>" width="50" >
                <?php }else{ ?>
                    <img class="media-object img-thumbnail" src="{{ URL::asset('image/nopicture.png') }}" width="50">
                <?php }
                ?>
            </a>
        </div>
        <div class="media-body">
            <a href="{{ url(UrlProduct($product->id, $product->slug_url)) }}" class="media-heading">{{ $product->p_name }}</a>
            <div style="color: #666;">{{ $product_attr->option1." ".$product_attr->option2 }}</div>
            <div>{{ $value['qty']." ".trans('cart.item') }} {{  number_format($price,2)." ".trans('cart.baht') }}</div>
        </div>
        <div class="media-right"><a href="#" data-toggle="tooltip" title="Remove" data-attr="{{ $value['attr_id'] }}" class="remove-dropdown-cart" ><i class="fa fa-remove"></i></a></div>
    </div>
<?php } ?>
<div class="subtotal-cart">{{ trans('cart.subtotal') }}: <span>{{  number_format($sum,2)." ".trans('cart.baht') }}</span></div>
<div class="text-center">
    <div class="btn-group" role="group">
        <a href="{{ url(UrlproductAll()) }}" class="btn btn-default btn-sm" type="button"><i class="fa fa-shopping-cart"></i> {{ trans('cart.View Cart') }}</a>
        <a href="{{ url(UrlCheckoutCart()) }}" class="btn btn-default btn-sm" type="button"><i class="fa fa-check"></i> {{ trans('cart.Checkout') }}</a>
    </div>
</div>

<?php }else{ ?>
<div class="text-center">
    <div style="padding: 20px">
        {{ trans('cart.no_product_in_cart') }}
    </div>    
</div>
<?php } ?>
<div class="overlay" id="overlay" style="display: none">
    <i class="fa fa-refresh fa-spin"></i>
</div>
<script  type="text/javascript" >
    document.getElementById("sum_qty").innerHTML = "<?=$sumqty?>";
    <?php if(isset($ajax_data)){ ?>
        document.getElementById("sum_qty_phone").innerHTML = "<?=$sumqty?>";
    <?php }?>
</script>
@section('script-custom2')
<script  type="text/javascript" >
    
    $(document).ready(function(){
        document.getElementById("sum_qty_phone").innerHTML = "<?=$sumqty?>";
        $('body').on('click', 'a.remove-dropdown-cart', function(event) {
            event.preventDefault();
            $('#overlay').show();
            let product_attr_id = $(this).attr('data-attr');           
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
<?php
if(isset($request_data)){ ?>
<script>
    $('#modal-option').empty();
    let json = JSON.parse('<?= json_encode($request_data) ?>');
    let txtqty = 0,txtprice = 0;
    
    
    for (let i = 0; i < json.length; i++) {
        let price = parseInt(json[i].qty) * parseFloat(json[i].price);
        txtprice += price;        
        txtqty += parseInt(json[i].qty);
        if(json[i].name === undefined){
            $('#modal-option').append(`<p>จำนวน ${json[i].qty} ชิ้น</p>`);
        }else{
            $('#modal-option').append(`<p>${json[i].name}  จำนวน ${json[i].qty} ชิ้น <span class="price">ราคา ${price.format(2)} บาท</span></p>`);
        }
    }
    $('#modal-price').text(`${txtprice.format(2)} บาท`);
    $('#modal-title').text(`เพิ่มสินค้า ${txtqty} ชิ้น`);    
    $('.madal-add-to-cart').modal();
</script>
<?php } ?>