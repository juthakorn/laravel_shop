@extends('layouts.standard')

@section('content')

<div class="container m-t-3">
    <div class="row">

<!--        <div class="col-sm-4 col-md-3 m-b-3">
            <div class="title m-b-2" ><span>test </span></div>
            
        </div>--> 
        <div class="col-sm-3">
            @include("partials.category-left")
            @include("forum.bast-sell-left")             
        </div>
        <!-- My Profile Content -->
        <div class="col-sm-9 ">
            <div class="title" ><span>{{ trans('cart.Product') }} </span></div>

                          

            <!-- Product Sorting Bar -->
            <div class="product-sorting-bar">
                <div>Sort By
                    <select name="sortby" class="selectpicker" data-width="180px">
                        <option value="recomended">Recomended</option>
                        <option value="low">Low Price &raquo; High Price</option>
                        <option value="hight">High Price &raquo; High Price</option>
                    </select>
                </div>
                <div>Show
                    <select name="show" class="selectpicker" data-width="60px">
                        <option value="8">8</option>
                        <option value="12">12</option>
                        <option value="16">16</option>
                    </select> per page
                </div>
            </div>
            <!-- End Product Sorting Bar -->
            
            
            <?php foreach ($products as $key => $value) { //pr($value->toArray());?>
                <?php //= $key%4 == 0 ? "<div class=\"clearfix\"></div>" : "" ?>
                <div class="col-sm-4 col-md-3 col-xs-6 box-product-outer nohover" style="margin-bottom: 15px;padding: 0">
                    <div class="box-product have-border">
                        <div class="img-wrapper">
                            <a href="<?= UrlProduct($value->id, $value->slug_url) ?>">
                              <?php
                              //pr($value->image_stores->toArray());
                              //$arrimg = $value->image_stores()->orderBy('product_images.position', "asc")->take(1)->get()->toArray();
                              if (!$value->image_stores->isEmpty()) {
                                  ?>                                
                                  <img src="<?= ImgProduct($value->image_stores[0]->id, $value->image_stores[0]->new_name350) ?>" >
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
            <?php }?>
            
            
            <div class="col-xs-12 text-center">
                <nav aria-label="Page navigation">
                    {!! $products->appends( Request::query() )->render() !!}
                </nav>
            </div>
        </div>
        <!-- End My Profile Content -->

    </div>
</div>

@include("partials.confirm-modal")   

@endsection

@section('stylesheet')

@endsection

@section('script')

@endsection

@section('script-custom')
<script>
   

</script>
@endsection
