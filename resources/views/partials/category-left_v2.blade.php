<button class="btn btn-light btn-block dropdown-toggle d-md-none" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
    {{ trans('common.Category') }}
</button>
<div class="collapse d-md-block" id="collapseFilter">                
    <div class="filter-sidebar">
        <div class="title"><span>{{ trans('common.Category') }}</span></div>
        <div class="list-group list-group-collapse list-group-sm list-group-tree" data-children=".sub-men">
            <a href="{{ UrlproductAll() }}" class="list-group-item list-group-item-action">{{ trans('common.All Products') }}</a>
            <a href="{{ UrlproductBestSell() }}" class="list-group-item list-group-item-action">{{ trans('common.Best Seller') }}</a>
            <a href="{{ UrlproductNew() }}" class="list-group-item list-group-item-action">{{ trans('common.New Products') }}</a>
            <a href="{{ UrlproductRecommend() }}" class="list-group-item list-group-item-action">{{ trans('common.Recommended Products') }}</a>
            
                
            <?php 
            $category = App\Model\Category::where([['active', '=', '1'] , ['parent_id', '=', '0']])->select('id', 'cat_name')->with('SubCategory')->orderBy('position', 'asc')->get();
                           
            foreach ($category as $key => $value) {
                $subcat = $value->SubCategory;
                if(!$subcat->isEmpty()){ ?>
                
                    <div class="list-group-collapse sub-men">
                        <span class="list-group-item list-group-item-action"  href="#sub-men<?=$key?>" data-toggle="collapse" aria-expanded="true" aria-controls="sub-men<?=$key?>" style="cursor: pointer;padding-top: 0; padding-bottom: 0;">
                            <a href="{{ url(UrlCategoryProduct($value->id, $value->cat_name)) }}" style="padding-left: 0.2em;" class="list-group-item list-group-item-action">{{ $value->cat_name }} <small class="text-muted">(60)</small></a>
                        </span>
                        <div class="collapse show" id="sub-men<?=$key?>" >
                            <div class="list-group">
                                <?php foreach ($subcat as $keysub => $valuesub) {?>
                                <a href="{{ url(UrlCategoryProduct($valuesub->id, $valuesub->cat_name)) }}" class="list-group-item list-group-item-action">{{ $valuesub->cat_name }} <small class="text-muted">(10)</small></a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                
                <?php }else{ ?>
                    <a class="list-group-item list-group-item-action" href="{{ url(UrlCategoryProduct($value->id, $value->cat_name)) }}" >{{ $value->cat_name }} <small class="text-muted">(11)</small></a>
                <?php }?>
                
            <?php } ?>    
            
                    
<!--            <div class="list-group-collapse sub-men">
                <span class="list-group-item list-group-item-action"  href="#sub-men2" data-toggle="collapse" aria-expanded="true" aria-controls="sub-men1" style="cursor: pointer">
                    <a href="shop.html" style="padding-left: 0.2em;" class="list-group-item list-group-item-action active">Clothing <small class="text-muted">(60)</small></a>
                </span>
                <div class="collapse show" id="sub-men2" >
                    <div class="list-group">
                        <a href="shop.html" class="list-group-item list-group-item-action active">T-Shirts <small class="text-muted">(10)</small></a>
                        <a href="shop.html" class="list-group-item list-group-item-action">Polo T-Shirts <small class="text-muted">(11)</small></a>
                        <a href="shop.html" class="list-group-item list-group-item-action">Round Neck T-Shirts <small class="text-muted">(12)</small></a>
                        <a href="shop.html" class="list-group-item list-group-item-action">V Neck T-Shirts <small class="text-muted">(13)</small></a>
                        <a href="shop.html" class="list-group-item list-group-item-action">Hooded T-Shirts <small class="text-muted">(14)</small></a>
                    </div>
                </div>
            </div>-->
            
        </div>
    </div>

</div>