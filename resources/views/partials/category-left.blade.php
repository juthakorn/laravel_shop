<div class="title"><span>{{ trans('common.Category') }}</span></div>
<ul class="list-group list-group-nav">
    <li class="list-group-item">» <a href="{{ UrlproductAll() }}">{{ trans('common.All Products') }}</a></li>
    <li class="list-group-item">» <a href="{{ UrlproductBestSell() }}">{{ trans('common.Best Seller') }}</a></li>
    <li class="list-group-item">» <a href="{{ UrlproductNew() }}">{{ trans('common.New Products') }}</a></li>
    <li class="list-group-item">» <a href="{{ UrlproductRecommend() }}">{{ trans('common.Recommended Products') }}</a></li>
    <?php
    $category = App\Model\Category::where([['active', '=', '1'] , ['parent_id', '=', '0']])->select('id', 'cat_name')->orderBy('position', 'asc')->get();
    foreach ($category as $key => $value) {
        ?>
        <li class="list-group-item">» <a href="{{ UrlCategoryProduct($value->id, $value->cat_name) }}">{{ $value->cat_name }}</a></li>
        <?php $subcat = $value->SubCategory;
        if(!$subcat->isEmpty()){ 
              foreach ($subcat as $keysub => $valuesub) {  ?>
        <li class="list-group-item" style="padding-left: 24px">» <a  href="{{ UrlCategoryProduct($valuesub->id, $valuesub->cat_name) }}">{{ $valuesub->cat_name }}</a></li>
        <?php }} ?>
<?php } ?>
</ul>

