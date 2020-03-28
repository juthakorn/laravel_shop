
<div class="middle-header" id="middle-header">
    <div class="container-fluid limited position-relative">

        <div class="input-search-wrapper invisible">
            <form action="#" method="post">
                <input type="text" class="form-control" id="input-search" placeholder="Search" aria-label="Search">
                <span class="rounded-circle bg-dark text-white toggle-search"><i class="small material-icons">close</i></span>
                <input type="submit" hidden="hidden">
            </form>
        </div>

        <div class="row">

            <div class="col-4 d-flex d-md-none align-items-center">
                <a href="#" class="text-dark" data-toggle="modal" data-target="#menuModal"><i class="material-icons md-2">menu</i></a>
            </div>
            <div class="col-4 col-md-auto d-flex align-items-center justify-content-center justify-content-md-start">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ URL::asset('shop-v2/img/logo.svg') }}" alt="Mimity" class="d-none d-md-block">
                    <img src="{{ URL::asset('shop-v2/img/logo-text.svg') }}" alt="Mimity" class="d-block d-md-none">
                </a>
            </div>
            <div class="col d-none d-md-block position-static">
                <nav class="navbar nav main-nav justify-content-center justify-content-md-start position-static p-0">                    
                    <a class="nav-link {{ Request::is('/') ? "active" : "" }}"  href="{{ url('/') }}">{{ trans('common.Home') }}</a>
                    <a class="nav-link {{ Request::is(UrlproductAll()) ? "active" : "" }}" href="{{ url(UrlproductAll()) }}">{{ trans('common.Products') }}</a>
                    <a class="nav-link {{ Request::is(UrlPayment()) ? "active" : "" }}" href="{{ url(UrlPayment()) }}"> {{ trans('cart.Payment') }}</a>
                    <a class="nav-link {{ Request::is(UrlArticle()) ? "active" : "" }}" href="{{ url(UrlArticle()) }}">{{ trans('common.Article') }}</a>
                    <a class="nav-link {{ Request::is(Urlforums()) ? "active" : "" }}" href="{{ url(Urlforums()) }}">{{ trans('common.Forum') }}</a>
                    <a class="nav-link {{ Request::is(UrlContactUs()) ? "active" : "" }}" href="{{ url(UrlContactUs()) }}">{{ trans('common.Contact Us') }}</a>
                </nav>
            </div>
            <div class="col-4 col-md-auto d-flex align-items-center justify-content-end pl-0">
                <nav class="nav nav-counter">
                    <a href="#" class="nav-link toggle-search"><img src="{{ URL::asset('shop-v2/img/search.svg') }}" alt="search"></a>
                    <!--<a href="account-wishlist.html" class="nav-link counter d-none d-lg-block"><span>3</span><img src="img/wishlist.svg" alt="wishlist"></a>-->
                    <a href="#" class="nav-link counter" data-toggle="modal" data-target="#cartModal"><span id="sum_qty"></span><img src="{{ URL::asset('shop-v2/img/bag.svg') }}" alt="bag"></a>
                </nav>
            </div>

        </div>
    </div>
</div>