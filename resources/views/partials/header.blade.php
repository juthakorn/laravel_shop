<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="list-inline pull-left">
                    <li>
                        <select class="selectpicker" data-width="95px" data-style="btn-default" onchange="insertParam('lang',$(this).val())">
                            <option value="th" <?= App::getLocale() == 'th' ? "selected" : "" ?> data-content="<img alt='Thai' src='{{ url('shop/images/th.jpg') }}'> Thai">Thai</option>
                            <option value="en" <?= App::getLocale() == 'en' ? "selected" : "" ?> data-content="<img alt='English' src='{{ url('shop/images/en.jpg') }}'> English">English</option>                            
                        </select>
                    </li>                    
                    <li class="hidden-xs"><a href="#"><i class="fa fa-phone"></i> 086-2081943</a></li>
                    <li class="hidden-xs"><a href="mailto:cs@domain.tld"><i class="fa fa-envelope"></i> tommai0809@gmail.com</a></li>
                </ul>
                <ul class="list-inline pull-right">
                    <!--<li class="hidden-xs"><a href="wishlist.html"><i class="fa fa-heart"></i> {{ trans('common.wishlist') }} (3)</a></li>-->       
                    @if( !Auth::guest())                    
                    <li>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownLogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              {{ Auth::user()->name." ".Auth::user()->lastname }} <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                @if( Auth::user()->isAdmin() )
                                <li><a href="{{ url("/admin/product") }}"><i class="fa fa-list"></i> {{ trans('common.storemanagement') }}</a></li>
                                @endif 
                                <li><a href="{{ url(UrlCheckoutCart()) }}"><i class="fa fa-shopping-cart"></i> {{ trans('cart.Shopping Cart') }}</a></li>
                                <li><a href="{{ url(customer()) }}"><i class="fa fa-user"></i> {{ trans('common.profile') }}</a></li>
                                <li><a href="{{ url(customer_order()) }}"><i class="fa fa-shopping-cart"></i> {{ trans('common.my_order') }}</a></li>                                
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> {{ trans('common.logout') }}</a></li>
                            </ul>
                        </div>
                      </li>
                    @else                    
                        <li class="hidden-xs"><a href="{{ url(register()) }}"><i class="fa fa-edit"></i> {{ trans('common.register') }}</a></li>
                        <li class="hidden-xs"><a href="{{ url(login()) }}"><i class="fa fa-sign-in"></i> {{ trans('common.login') }}</a></li>
                    @endif 
                </ul>
            </div>
        </div>
    </div>
</div>