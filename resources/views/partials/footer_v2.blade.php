
<!-- Footer -->
<div class="footer">
    <div class="container-fluid limited">
        <div class="row">
            <div class="col-lg-3">
                <div class="title-footer">
                    <h6>{{ trans('common.About Us') }}</h6>
                </div>                
                <div style="margin-top: 5px;">
                    {{ $addressShop->description }}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="title-footer"><h6>{{ trans('common.Contact Us') }}</h6></div>   
                <ul class="footer-icon">
                    <?php $temp_address = check_province($addressShop->province);?>
                    <li><span style="display: table-cell;"><i class="fa fa-map-marker"></i></span> <span style="display: table-cell;padding-left: 5px;vertical-align: top">{{ $addressShop->address." ".$temp_address['txttombon'].$addressShop->district." ".$temp_address['txtumpher'].$addressShop->city." จังหวัด".$addressShop->province." ".$addressShop->postcode }}</span></li>
                    <li><span><i class="fa fa-phone"></i></span> {{ $addressShop->tel }}</li>
                    <li><span><a href="{{ "mailto:".$addressShop->email }}" target="_top"><i class="fa fa-envelope"></i></a></span> <a href="{{ "mailto:".$addressShop->email }}" target="_top">{{ $addressShop->email }}</a></li>
                    <li><span><a href="{{ $addressShop->social_facebook }}" target="_blank" ><i class="fa fa-facebook"></i></a></span> <a href="{{ $addressShop->social_facebook }}" target="_blank"><?= str_replace("https://", "", $addressShop->social_facebook)?></a></li>
                    <li style="margin: 4px 0 9px 0;"><span><a href="{{ $addressShop->social_line }}" target="_blank" class="social"><i style="font-size: 0.5em;padding: 6px 5px;">Line</i></a></span> <a href="{{ $addressShop->social_line }}" target="_blank">@tm_shop</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <div class="title-footer"><h6>{{ trans('common.Category') }}</h6></div>                   
                <ul>
                    <li><i class="fa fa-angle-double-right"></i> <a href="{{ url(UrlproductAll()) }}">{{ trans('common.All Products') }}</a></li>
                    <li><i class="fa fa-angle-double-right"></i> <a href="{{ url(UrlproductBestSell()) }}">{{ trans('common.Best Seller') }}</a></li>
                    <li><i class="fa fa-angle-double-right"></i> <a href="{{ url(UrlproductNew()) }}">{{ trans('common.New Products') }}</a></li>
                    <li><i class="fa fa-angle-double-right"></i> <a href="{{ url(UrlproductRecommend()) }}">{{ trans('common.Recommended Products') }}</a></li>
                    <?php
                    $category = App\Model\Category::where([['active', '=', '1'] , ['parent_id', '=', '0']])->select('id', 'cat_name')->with('SubCategory')->orderBy('position', 'asc')->get();
                    foreach ($category as $key => $value) {
                        ?>
                        <li><i class="fa fa-angle-double-right"></i> <a href="{{ url(UrlCategoryProduct($value->id, $value->cat_name)) }}">{{ $value->cat_name }}</a></li>
                        <?php $subcat = $value->SubCategory;
                        if(!$subcat->isEmpty()){ 
                              foreach ($subcat as $keysub => $valuesub) {  ?>
                        <li style="padding-left: 24px"><i class="fa fa-angle-double-right"></i> <a  href="{{ url(UrlCategoryProduct($valuesub->id, $valuesub->cat_name)) }}">{{ $valuesub->cat_name }}</a></li>
                        <?php }} ?>
                <?php } ?>
                </ul>
            </div>
            <div class="col-lg-3" style="background-color: inherit;">
                <div class="title-footer"><h6>{{ trans('common.My Account') }}</h6></div>
                @if( !Auth::guest())                
                <ul>
                    @if( Auth::user()->isAdmin() )
                    <li><a href="{{ url("/admin/product") }}"><i class="fa fa-list"></i> {{ trans('common.storemanagement') }}</a></li>
                    @endif 
                    <li><a href="{{ url(UrlCheckoutCart()) }}"><i class="fa fa-shopping-cart"></i> {{ trans('cart.Shopping Cart') }}</a></li>
                    <li><a href="{{ url(customer()) }}"><i class="fa fa-user"></i> {{ trans('common.profile') }}</a></li>
                    <li><a href="{{ url(customer_order()) }}"><i class="fa fa-shopping-cart"></i> {{ trans('common.my_order') }}</a></li>                                
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> {{ trans('common.logout') }}</a></li>
                </ul>
                @else  
                <ul>
                    <li><a href="{{ url(register()) }}"><i class="fa fa-edit"></i> {{ trans('common.register') }}</a></li>
                    <li><a href="{{ url(login()) }}"><i class="fa fa-sign-in"></i> {{ trans('common.login') }}</a></li>
                </ul>    
                @endif 
                
            </div>
        </div>
    </div>
</div>
<!-- Copyright -->
<div class="copyright">
    Copyright &copy; 2019 {{ $addressShop->shop_name }} All right reserved
</div>
<!-- /Copyright -->

<a href="#top" class="back-top text-center" id="back-top">
    <i class="material-icons">expand_less</i>
</a>