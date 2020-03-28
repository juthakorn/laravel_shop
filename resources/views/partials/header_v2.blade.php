
<div class="top-header">
    <div class="container-fluid limited">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <nav class="nav d-none d-lg-flex">
                        <a class="nav-link" href="javascript:void(0)" > <i class="fa fa-money"></i> มีบริการเก็บเงินปลายทาง</a> 
                        <a class="nav-link" href="javascript:void(0)" > <i class="fa fa-lock"></i> ปลอดภัย 100%</a> 
                        <a class="nav-link" href="javascript:void(0)" > <i class="fa fa-phone"></i> 086-2081943</a> 
                    </nav>
                    <nav class="nav ml-auto">
                        <a class="nav-link d-none d-sm-block" href="#"><i class="material-icons">help_outline</i> Help</a>
                        
                        
                        <div class="nav-item dropdown dropdown-lang">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
                                <?= App::getLocale() == 'en' ? "<img src=\"". URL::asset('shop-v2/img/lang_en.jpg'). "\" alt=\"French\"> English" : "<img src=\"". URL::asset('shop-v2/img/lang_th.jpg'). "\" alt=\"Thai\"> Thai" ?>
                            </a>
                            <div class="dropdown-menu animate" data-select="lang">
                                <button class="dropdown-item" type="button" data-value="th" onclick="insertParam('lang','th')"><img src="{{ URL::asset('shop-v2/img/lang_th.jpg') }}" alt="Thai"> Thai</button>
                                <button class="dropdown-item" type="button" data-value="en" onclick="insertParam('lang','en')"><img src="{{ URL::asset('shop-v2/img/lang_en.jpg') }}" alt="English"> English</button>                                
                            </div>
                        </div>
                        
                        @if( !Auth::guest())
                        
                            <div class="nav-item dropdown ">
                                <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name." ".Auth::user()->lastname }} </a>
                                <div class="dropdown-menu animate">
                                    @if( Auth::user()->isAdmin() )
                                    <a class="dropdown-item" href="{{ url("/admin/product") }}"><i class="fa fa-list"></i> {{ trans('common.storemanagement') }}</a>
                                    @endif 
                                    <a class="dropdown-item" href="{{ url(UrlCheckoutCart()) }}"><i class="fa fa-shopping-cart"></i> {{ trans('cart.Shopping Cart') }}</a>
                                    <a class="dropdown-item" href="{{ url(customer()) }}"><i class="fa fa-user"></i> {{ trans('common.profile') }}</a>
                                    <a class="dropdown-item" href="{{ url(customer_order()) }}"><i class="fa fa-shopping-cart"></i> {{ trans('common.my_order') }}</a>                            
                                    <a class="dropdown-item" href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> {{ trans('common.logout') }}</a>                                    
                                </div>
                            </div>
                        
                          
                        @else  
                            <a class="nav-link" href="{{ url(login()) }}"><i class="material-icons">person_outline</i> {{ trans('common.login') }}</a>
                            <a class="nav-link" href="{{ url(register()) }}"><i class="material-icons">create</i> {{ trans('common.register') }}</a>
                        @endif 
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>