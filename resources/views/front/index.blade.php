@extends('layouts.standard')

@section('content')
<div class="container m-t-2">
    <div class="row">

        <!-- New Arrivals & Best Selling -->
        <div class="col-md-3 m-b-1">
            <div class="title"><span><a href="products.html">{{ trans('common.New Products') }} <i class="fa fa-chevron-circle-right"></i></a></span></div>
            <div class="widget-slider owl-controls-top-offset m-b-2">
                <?php foreach ($p_new as $key => $value) { ?>
                    <div class="box-product-outer has-border" style="margin: 0 1px 0 0;">
                        <div class="box-product">
                            <div class="img-wrapper">
                                <a href="<?= UrlProduct($value->id, $value->slug_url) ?>">
                                    <?php
                                    $arrimg = $value->image_stores()->orderBy('product_images.position', "asc")->take(1)->get()->toArray();
                                    if (!empty($arrimg)) {
                                        ?>                                
                                        <img src="<?= ImgProduct($arrimg[0]['id'], $arrimg[0]['new_name350']) ?>"  >
                                    <?php } else { ?>
                                        <img src="{{ URL::asset('image/nopicture.png') }}" >
                                    <?php }
                                    ?>
                                </a>

                            </div>
                            <h6><a href="<?= UrlProduct($value->id, $value->slug_url) ?>" title="<?= $value->p_name; ?>"> <?= $value->p_name; ?> </a></h6>
                            <div class="price">
                                <div><?= $value->p_price; ?> {{ trans('cart.baht') }}</div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="title"><span><a href="products.html">{{ trans('common.New Products') }} <i class="fa fa-chevron-circle-right"></i></a></span></div>
            <div class="widget-slider owl-controls-top-offset">
                <?php foreach ($p_new as $key => $value) { ?>
                    <div class="box-product-outer has-border" style="margin: 0 1px 0 0;">
                        <div class="box-product">
                            <div class="img-wrapper">
                                <a href="<?= UrlProduct($value->id, $value->slug_url) ?>">
                                    <?php
                                    $arrimg = $value->image_stores()->orderBy('product_images.position', "asc")->take(1)->get()->toArray();
                                    if (!empty($arrimg)) {
                                        ?>                                
                                        <img src="<?= ImgProduct($arrimg[0]['id'], $arrimg[0]['new_name350']) ?>" >
                                    <?php } else { ?>
                                        <img src="{{ URL::asset('image/nopicture.png') }}" >
                                    <?php }
                                    ?>
                                </a>

                            </div>
                            <h6><a href="<?= UrlProduct($value->id, $value->slug_url) ?>" title="<?= $value->p_name; ?>"> <?= $value->p_name; ?> </a></h6>
                            <div class="price">
                                <div><?= $value->p_price; ?> {{ trans('cart.baht') }}</div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- End New Arrivals & Best Selling -->

        <div class="clearfix visible-sm visible-xs"></div>

        <div class="col-md-9">

            <!-- Featured -->
            <div class="title"><span>{{ trans('common.Best Seller') }}</span></div>
            <div class="product-slider owl-controls-top-offset">

                <?php foreach ($best_sell as $key => $value) { ?>
                    <div class="box-product-outer has-border">
                        <div class="box-product">
                            <div class="img-wrapper">
                                <a href="<?= UrlProduct($value->id, $value->slug_url) ?>">
                                    <?php
                                    $arrimg = $value->image_stores()->orderBy('product_images.position', "asc")->take(1)->get()->toArray();
                                    if (!empty($arrimg)) {
                                        ?>                                
                                        <img src="<?= ImgProduct($arrimg[0]['id'], $arrimg[0]['new_name350']) ?>" >
                                    <?php } else { ?>
                                        <img src="{{ URL::asset('image/nopicture.png') }}" >
                                    <?php }
                                    ?>
                                </a>
                                <div class="tags">
                                    <?php if ($value->p_new) { ?>
                                        <span class="label-tags"><span class="label label-success arrowed">New</span></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <h6><a href="<?= UrlProduct($value->id, $value->slug_url) ?>" title="<?= $value->p_name; ?>"> <?= $value->p_name; ?> </a></h6>
                            <div class="price">
                                <div><?= $value->p_price; ?> {{ trans('cart.baht') }}</div>
                            </div>
                            <div class="product-addcart">
                                <a href="<?= UrlProduct($value->id, $value->slug_url) ?>" class="addcart"> <i class="fa fa-shopping-cart">&nbsp;</i> สั่งซื้อ</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <!-- End Featured -->

            <div class="clearfix visible-sm visible-xs"></div>

            <!-- Collection -->
            <div class="title m-t-2"><span>{{ trans('common.Recommended Products') }}</span></div>
            <div class="product-slider owl-controls-top-offset">
                <?php foreach ($recommend as $key => $value) { ?>
                    <div class="box-product-outer has-border">
                        <div class="box-product">
                            <div class="img-wrapper">
                                <a href="<?= UrlProduct($value->id, $value->slug_url) ?>">
                                    <?php
                                    $arrimg = $value->image_stores()->orderBy('product_images.position', "asc")->take(1)->get()->toArray();
                                    if (!empty($arrimg)) {
                                        ?>                                
                                        <img src="<?= ImgProduct($arrimg[0]['id'], $arrimg[0]['new_name350']) ?>" >
                                    <?php } else { ?>
                                        <img src="{{ URL::asset('image/nopicture.png') }}" >
                                    <?php }
                                    ?>
                                </a>
                                <div class="tags">
                                    <?php if ($value->p_new) { ?>
                                        <span class="label-tags"><span class="label label-success arrowed">New</span></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <h6><a href="<?= UrlProduct($value->id, $value->slug_url) ?>" title="<?= $value->p_name; ?>"> <?= $value->p_name; ?> </a></h6>
                            <div class="price">
                                <div><?= $value->p_price; ?> {{ trans('cart.baht') }}</div>
                            </div>
                            <div class="product-addcart">
                                <a href="<?= UrlProduct($value->id, $value->slug_url) ?>" class="addcart"> <i class="fa fa-shopping-cart">&nbsp;</i> สั่งซื้อ</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- End Collection -->

        </div>

    </div>


</div>
@endsection
