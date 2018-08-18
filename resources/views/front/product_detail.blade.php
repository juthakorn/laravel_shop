@extends('layouts.standard')

@section('content')

<div class="container m-t-3">
    <div class="row">
        <!-- Image List -->
        <div class="col-lg-4 col-sm-5 col-md-4 col-xs-12">
            <input name="product_id" value="{{ $product->id }}" type="hidden">
            {{ csrf_field() }}
            <?php $image_products = $product->image_stores()->orderBy('product_images.position', "asc")->get(); 
            $image_product_arr = $image_products->toArray();
            ?>
            <div class="image-detail">
                <?php if(!empty($image_product_arr[0]) && file_exists(str_replace(url("/")."/", "", ImgProduct($image_product_arr[0]['id'],  $image_product_arr[0]['new_name'])))){?>  
                <img src="<?= ImgProduct($image_product_arr[0]['id'], $image_product_arr[0]['new_name'])?>" data-zoom-image="<?= ImgProduct($image_product_arr[0]['id'], $image_product_arr[0]['new_name'])?>" >
                <?php }else{ ?>
                <img src="<?= ImgNoProduct()?>" data-zoom-image="<?= ImgNoProduct()?>" title="ไม่มีรูปภาพสินค้า">
                <?php } ?>                
            </div>
            <div class="products-slider-detail m-b-2">                
                <?php if(!$image_products->isEmpty()){ 
                    foreach ($image_products as $key => $image_product) { ?>
                        <?php if(file_exists(str_replace(url("/")."/", "", ImgProduct($image_product->id, $image_product->new_name)))){?>  

                    <a href="#"><img src="<?= ImgProduct($image_product->id, $image_product->new_name)?>" data-zoom-image="<?= ImgProduct($image_product->id, $image_product->new_name)?>" class="img-thumbnail"></a>

                        <?php }else{ ?>
                     <a href="#"><img src="<?=ImgNoProduct(); ?>" data-zoom-image="<?=ImgNoProduct(); ?>" title="ไม่มีรูปภาพสินค้า" class="img-thumbnail"></a>
                        <?php } ?>
                    <?php } ?>
                <?php }else{ ?>
                     <a href="#"><img src="<?=ImgNoProduct(); ?>" data-zoom-image="<?=ImgNoProduct(); ?>" title="ไม่มีรูปภาพสินค้า" class="img-thumbnail"></a>
                <?php } ?> 
            </div>
            <div class="title"><span>Share to</span></div>
            <div class="share-button m-b-3">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i></button>
                <button type="button" class="btn btn-info"><i class="fa fa-twitter"></i></button>
                <button type="button" class="btn btn-danger"><i class="fa fa-google-plus"></i></button>
                <button type="button" class="btn btn-primary"><i class="fa fa-linkedin"></i></button>
                <button type="button" class="btn btn-warning"><i class="fa fa-envelope"></i></button>
            </div>
        </div>
        <!-- End Image List -->

        <div class="col-lg-5 col-sm-7 col-md-5 col-xs-12 box-overlay">
            <div class="title-detail">{{ $product->p_name }}</div>
            
            <div class="result-option bg-white" id="wrapper-option"> 
                <ul>
                    <li>
                        <span class="txt-title" title="ราคา">ราคา</span>
                        <span >
                           {{ $product->p_price }} บาท
                        </span>
                    </li>
                    <li>
                        <span class="txt-title" title="สถานะการขาย">สถานะการขาย</span>
                        <span >
                            <?php if($product->p_sell_status == 1){
                                $label = "success";
                            }else if($product->p_sell_status == 2){
                                $label = "danger";
                            }else if($product->p_sell_status == 3){
                                $label = "default";
                            }else if($product->p_sell_status == 4){
                                $label = "danger";
                            } ?>
                            <span class="label label-<?=$label?> arrowed"><?= trans('common.p_sell_status_'.$product->p_sell_status)?></span>
                            
                        </span>
                    </li>
                </ul>
            </div>
            <div style=" padding: 5px"></div>
            <div class="result-option" id="result-option"> 
                <ul></ul>
            </div>

            <div class="sum-price line-top-bottom" id="sum-price" style="display: none"> 
                   <ul><li><span class="txt-title" >ยอดรวม</span><span class="sum-price-option"></span></li></ul>
            </div>
            
            <div class="btn-cart line-top-bottom">
                <button class="btn btn-theme" type="button" id="btn-add-to-cart" data-href="{{ Url(UrlAddToCart()) }}"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
            </div>
            <?php if(!empty($product->p_tags)){ $arr_tags = explode(',', $product->p_tags); ?>
            <div class="product-tags">
                <i class="fa fa-tags"></i> TAGS  : 
                @foreach ($arr_tags as $tag)
                <a href="<?=Tagproduct($tag)?>"><span class="label label-primary">{{ $tag }}</span></a>
                @endforeach
            </div>
            <?php } ?>
            <div class="overlay" style="display: none">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
        
        
        <div class="col-lg-3 col-sm-4 col-md-3 col-xs-12 related-slider">
            <div class="sub-related-slider">
                <div class="title"><span>{{ trans('common.Related Products') }} <i class="fa fa-chevron-circle-right"></i></span></div>
                <div class="widget-slider owl-controls-top-offset m-b-2">
                    <?php foreach ($relate_product as $key => $value) { ?>
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

                            </div>
                            <h6><a href="<?= UrlProduct($value->id, $value->slug_url)?>" title="<?=$value->p_name;?>"> <?=$value->p_name;?> </a></h6>
                            <div class="price">
                                <div><?=$value->p_price;?> บาท</div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
        <div class="col-md-12">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#datail" aria-controls="desc" role="tab" data-toggle="tab">Description</a></li>
                 <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Reviews (2)</a></li>
            </ul>
            <!-- End Nav tabs -->

            <!-- Tab panes -->
            <div class="tab-content tab-content-detail">

                <!-- Description Tab Content -->
                <div role="tabpanel" class="tab-pane active p_detail" id="datail">
                    <div class="well">
                        <?=$product->p_detail ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>                                
                                    <tr>
                                        <td align="right">
                                            <strong>เนื้อผ้า</strong>
                                        </td>
                                        <td>คอตตอน</td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <strong>ลักษณะผ้า</strong>
                                        </td>
                                        <td>ผ้ายืด นุ่ม ใส่สบาย</td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <strong>สี</strong></td>
                                        <td>แดงเลือดหมู</td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <strong>ลวดลาย</strong>
                                        </td>
                                        <td>สกรีนข้อความสีทองเป็นรูปหัวใจ</td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <strong>ทรง</strong>
                                        </td>
                                        <td>ทรงตรง/เดรส</td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <strong>สไตล์</strong>
                                        </td>
                                        <td>แฟชั่น</td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <strong>ข้อแนะนำ</strong>
                                        </td>
                                        <td>ไม่ควรใช้น้ำยาฟอกขาวในการซัก ควรเปิดระบบปั่นแบบถนอมผ้าหรือซักด้วยมือ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>  
                        
                        <?= empty($product->size->detail) ? "" : $product->size->detail ?>
                        
                    </div>
                </div>
                <!-- End Description Tab Content -->
               

                <!-- Review Tab Content -->
                <div role="tabpanel" class="tab-pane" id="review">
                    <div class="well">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object img-thumbnail" alt="64x64" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+">
                                </a>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>John Thor</strong></h5>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object img-thumbnail" alt="64x64" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+">
                                </a>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>Michael</strong></h5>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <hr/>
                        <h4 class="m-b-2">Add your review</h4>
                        <form role="form">
                            <div class="form-group">
                                <label>Rating</label><div class="clearfix"></div>
                                <div class="input-rating"></div>
                            </div>
                            <div class="form-group">
                                <label for="Review">Your Review</label>
                                <textarea id="review" class="form-control" rows="5" placeholder="Your Review"></textarea>
                            </div>
                            <button type="submit" class="btn btn-theme">Submit Review</button>
                        </form>
                    </div>
                </div>
                <!-- End Review Tab Content -->

            </div>
            <!-- End Tab panes -->

        </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="row m-t-3">
        <div class="col-xs-12">
            <div class="title"><span>{{ trans('common.Related Products') }}</span></div>
            <div class="related-product-slider owl-controls-top-offset">
                <?php foreach ($relate_product as $key => $value) { ?>
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
    <!-- End Related Products -->

</div>

<span class="hidden hidden-shop"><?=$temp?></span>


<div class="modal fade bs-example-modal-sm madal-add-to-cart" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-cart" role="document">
    <div class="modal-content">
        <div class="box-overflow">
            <div class="popup-cart-title">
                <i class="fa fa-check-circle"></i> 
                <strong id="modal-title">เพิ่มสินค้า x ชิ้น</strong> เข้าตะกร้าสำเร็จ
            </div> 
            <a href="#" class="box-close" data-dismiss="modal"><i class="fa fa-times"></i></a>
        </div>
        <div class="row">
            <div class="col-xs-3"> 
                <?php if(!empty($image_product_arr[0])){?>  
                <img src="<?= ImgProduct($image_product_arr[0]['id'], $image_product_arr[0]['new_name150'])?>" class="item-add-cart" >
                <?php }else{ ?>
                <img src="<?= ImgNoProduct()?>" data-zoom-image="<?= ImgNoProduct()?>"  class="item-add-cart">
                <?php } ?>
            </div> 
            <div class="col-xs-9"> 
                <p class="font-16px">{{ $product->p_name }}</p> 
                <div id="modal-option">                            
                </div>                        
                <p class="font-16px">ราคารวม : <span class="price" id="modal-price"></span></p> 
            </div> 
        </div>
        <div class="row">
            <div class="col-xs-6 text-left no-padding-right">
                <a href="{{ url(UrlproductAll()) }}" class="btn btn-default" data-dismiss="modal">ดูสินค้าต่อ</a>
            </div> 
            <div class="col-xs-6 text-right no-padding-left">
                <a href="{{ url(UrlCheckoutCart()) }}" class="btn btn-theme btn-popup-add-cart">สั่งซื้อ</a>
            </div>
        </div>

    </div>
  </div>
</div>
        
@endsection



@section('stylesheet')
<link href="{{ URL::asset('shop/css/jquery.bootstrap-touchspin.css') }}" rel="stylesheet">
@endsection

@section('script')
<script src="{{ URL::asset('shop/js/jquery.ez-plus.js') }}"></script>
<script src="{{ URL::asset('shop/js/jquery.bootstrap-touchspin.js') }}"></script>
<script src="{{ URL::asset('shop/js/jquery.raty-fa.js') }}"></script>
<script src="{{ URL::asset('shop/js/mimity.detail.js') }}"></script>
<script src="{{ URL::asset('shop/js/shop.js') }}"></script>
@endsection
