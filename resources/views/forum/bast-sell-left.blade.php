<div class="title"><span><a href="products.html">{{ trans('common.Best Seller') }} <i class="fa fa-chevron-circle-right"></i></a></span></div>
<div class="widget-slider-left owl-controls-top-offset m-b-2">
    <?php
    $best_sell = App\Model\Product::where('p_best_sell', 1)
            ->with(['image_stores' => function($query){
                    $query->orderBy('product_images.position', "asc");//->first();
                }])->inRandomOrder()->take(10)->get();
    foreach ($best_sell as $key => $value) {
        ?>
        <div class="box-product-outer has-border" style="margin: 0 1px 0 0;">
            <div class="box-product">
                <div class="img-wrapper">
                    <a href="<?= UrlProduct($value->id, $value->slug_url) ?>">
                        <?php if (!$value->image_stores->isEmpty()) {
                             ?>                                
                             <img src="<?= ImgProduct($value->image_stores[0]->id, $value->image_stores[0]->new_name350) ?>" >
                         <?php } else { ?>
                             <img src="{{ URL::asset('image/nopicture.png') }}" >
                         <?php }
                         ?> 
                    </a>

                </div>
                <h6><a href="<?= UrlProduct($value->id, $value->slug_url) ?>" title="<?= $value->p_name; ?>"> <?= $value->p_name; ?> </a></h6>
                <div class="price">
                    <div><?= $value->p_price; ?> บาท</div>
                </div>
            </div>
        </div>
<?php } ?>
</div>