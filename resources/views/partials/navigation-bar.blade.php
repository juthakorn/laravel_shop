<nav class="navbar navbar-default shadow-navbar" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ url(UrlCheckoutCart()) }}" class="btn btn-default btn-cart-xs visible-xs pull-right">
                <i class="fa fa-shopping-cart"></i> Cart : <span id="sum_qty_phone"></span> items
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/') ? "active" : "" }}"><a href="{{ url('/') }}">{{ trans('common.Home') }}</a></li>
                <li class="{{ Request::is(UrlproductAll()) ? "active" : "" }}"><a href="{{ url(UrlproductAll()) }}">{{ trans('common.Products') }}</a></li>
                <li class="{{ Request::is(UrlPayment()) ? "active" : "" }}"><a href="{{ url(UrlPayment()) }}"> {{ trans('cart.Payment') }}</a></li>
                <li class="{{ Request::is(UrlArticle()) ? "active" : "" }}"><a href="{{ url(UrlArticle()) }}">{{ trans('common.Article') }}</a></li>
                <li class="{{ Request::is(Urlforums()) ? "active" : "" }}"><a href="{{ url(Urlforums()) }}">{{ trans('common.Forum') }}</a></li>
                <li class="{{ Request::is(UrlContactUs()) ? "active" : "" }}"><a href="{{ url(UrlContactUs()) }}">{{ trans('common.Contact Us') }}</a></li>
                
            </ul>
        </div>
    </div>
</nav>