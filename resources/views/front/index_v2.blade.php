@extends('layouts.standard_v2')

@section('content')
<div class="container-fluid limited mt-5">

    

    <!-- Flash Sale -->
    <div class="row mb-3 compact">
        <div class="col-12">
            <div class="title text-center"><span><i class="material-icons align-text-bottom text-warning">flash_on</i>FLASH SALE<span id="flash-sale-countdown" class="bg-theme text-white px-2 rounded ml-3 small"></span></span></div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg col-xl-2">
            <div class="card card-product">
                <a href="detail.html"><img class="card-img-top" src="{{ URL::asset('shop-v2/img/product/polo1.jpg') }}" alt="Card image cap"></a>
                <div class="card-body">
                    <div class="card-title"><a href="detail.html" title="Burberry The Plymouth Duffle Coat">Burberry The Plymouth Duffle Coat</a></div>
                    <ul class="card-text list-inline pr-2">
                        <li class="list-inline-item"><span class="price">$13.50</span></li>
                        <li class="list-inline-item"><del class="text-muted small">$15.00</del></li>
                    </ul>
                    <div class="attribute rating">
                        <i class="material-icons d-block">star_border</i>
                        <i class="material-icons d-block">star_half</i>
                        <i class="material-icons d-block">star</i>
                        <i class="material-icons d-block">star</i>
                        <i class="material-icons d-block">star</i>
                    </div>
                    <div class="action">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                            <button class="btn btn-outline-theme show-quickview"><i class="material-icons">zoom_in</i></button>
                            <button class="btn btn-theme">ADD TO CART</button>
                            <button class="btn btn-outline-theme"><i class="material-icons">favorite_border</i></button>
                        </div>
                    </div>
                    <div class="small-action d-block d-md-none">
                        <div class="btn-group dropup">
                            <span role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&#10247;</span>
                            <div class="dropdown-menu dropdown-menu-right fadeIn">
                                <a class="dropdown-item" href="#"><i class="material-icons">add_shopping_cart</i> BUY</a>
                                <a class="dropdown-item" href="#"><i class="material-icons">favorite_border</i> Wishlist</a>
                                <a class="dropdown-item" href="#"><i class="material-icons">compare_arrows</i> Compare</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg col-xl-2">
            <div class="card card-product">
                <a href="detail.html"><img class="card-img-top" src="{{ URL::asset('shop-v2/img/product/polo2.jpg') }}" alt="Card image cap"></a>
                <div class="card-body">
                    <div class="card-title"><a href="detail.html" title="Fendi Bugs Sweater">Fendi Bugs Sweater</a></div>
                    <ul class="card-text list-inline">
                        <li class="list-inline-item"><span class="price">$13.50</span></li>
                        <li class="list-inline-item"><del class="text-muted small">$15.00</del></li>
                        <li class="list-inline-item d-none d-sm-inline-block"><span class="badge badge-theme">-10%</span></li>
                    </ul>
                    <div class="action">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                            <button class="btn btn-outline-theme show-quickview"><i class="material-icons">zoom_in</i></button>
                            <button class="btn btn-theme">ADD TO CART</button>
                            <button class="btn btn-outline-theme"><i class="material-icons">favorite_border</i></button>
                        </div>
                    </div>
                    <div class="small-action d-block d-md-none">
                        <div class="btn-group dropup">
                            <span role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&#10247;</span>
                            <div class="dropdown-menu dropdown-menu-right fadeIn">
                                <a class="dropdown-item" href="#"><i class="material-icons">add_shopping_cart</i> BUY</a>
                                <a class="dropdown-item" href="#"><i class="material-icons">favorite_border</i> Wishlist</a>
                                <a class="dropdown-item" href="#"><i class="material-icons">compare_arrows</i> Compare</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg col-xl-2">
            <div class="card card-product">
                <a href="detail.html"><img class="card-img-top" src="{{ URL::asset('shop-v2/img/product/polo3.jpg') }}" alt="Card image cap"></a>
                <div class="card-body">
                    <div class="card-title"><a href="detail.html" title="Alexander McQueen Classic Piqué Polo Shirt">Alexander McQueen Classic Piqué Polo Shirt</a></div>
                    <ul class="card-text list-inline">
                        <li class="list-inline-item"><span class="price">$13.50</span></li>
                        <li class="list-inline-item"><del class="text-muted small">$15.00</del></li>
                    </ul>
                    <div class="attribute attribute-right">
                        <span class="badge badge-theme font-weight-normal">10% OFF</span>
                    </div>
                    <div class="action">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                            <button class="btn btn-outline-theme show-quickview"><i class="material-icons">zoom_in</i></button>
                            <button class="btn btn-theme">ADD TO CART</button>
                            <button class="btn btn-outline-theme"><i class="material-icons">favorite_border</i></button>
                        </div>
                    </div>
                    <div class="small-action d-block d-md-none">
                        <div class="btn-group dropup">
                            <span role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&#10247;</span>
                            <div class="dropdown-menu dropdown-menu-right fadeIn">
                                <a class="dropdown-item" href="#"><i class="material-icons">add_shopping_cart</i> BUY</a>
                                <a class="dropdown-item" href="#"><i class="material-icons">favorite_border</i> Wishlist</a>
                                <a class="dropdown-item" href="#"><i class="material-icons">compare_arrows</i> Compare</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg col-xl-2">
            <div class="card card-product">
                <a href="detail.html"><img class="card-img-top" src="{{ URL::asset('shop-v2/img/product/polo4.jpg') }}" alt="Card image cap"></a>
                <div class="card-body">
                    <div class="card-title"><a href="detail.html" title="MCQ Alexander McQueen Swallow Badge Polo Shirt">MCQ Alexander McQueen Swallow Badge Polo Shirt</a></div>
                    <ul class="card-text list-inline">
                        <li class="list-inline-item"><span class="price">$13.50</span></li>
                        <li class="list-inline-item"><del class="text-muted small">$15.00</del></li>
                        <li class="list-inline-item d-none d-sm-inline-block"><span class="badge badge-secondary">-10%</span></li>
                    </ul>
                    <div class="attribute attribute-right rating">
                        <i class="material-icons">star_border</i>
                        <i class="material-icons">star_half</i>
                        <i class="material-icons">star</i>
                        <i class="material-icons">star</i>
                        <i class="material-icons">star</i>
                    </div>
                    <div class="action">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                            <button class="btn btn-outline-theme show-quickview"><i class="material-icons">zoom_in</i></button>
                            <button class="btn btn-theme">ADD TO CART</button>
                            <button class="btn btn-outline-theme"><i class="material-icons">favorite_border</i></button>
                        </div>
                    </div>
                    <div class="small-action d-block d-md-none">
                        <div class="btn-group dropup">
                            <span role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&#10247;</span>
                            <div class="dropdown-menu dropdown-menu-right fadeIn">
                                <a class="dropdown-item" href="#"><i class="material-icons">add_shopping_cart</i> BUY</a>
                                <a class="dropdown-item" href="#"><i class="material-icons">favorite_border</i> Wishlist</a>
                                <a class="dropdown-item" href="#"><i class="material-icons">compare_arrows</i> Compare</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg col-xl-2">
            <div class="card card-product">
                <a href="detail.html"><img class="card-img-top" src="{{ URL::asset('shop-v2/img/product/polo5.jpg') }}" alt="Card image cap"></a>
                <div class="card-body">
                    <div class="card-title"><a href="detail.html" title="MCQ Alexander McQueen Mini Swallow Sweatshirt">MCQ Alexander McQueen Mini Swallow Sweatshirt</a></div>
                    <ul class="card-text list-inline">
                        <li class="list-inline-item"><span class="price">$13.50</span></li>
                        <li class="list-inline-item"><del class="text-muted small">$15.00</del></li>
                        <li class="list-inline-item d-none d-sm-inline-block"><span class="badge badge-secondary">-10%</span></li>
                    </ul>
                    <div class="attribute attribute-right rating">
                        <i class="material-icons d-block">star</i>
                        <i class="material-icons d-block">star</i>
                        <i class="material-icons d-block">star</i>
                        <i class="material-icons d-block">star</i>
                        <i class="material-icons d-block">star</i>
                    </div>
                    <div class="action">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                            <button class="btn btn-outline-theme show-quickview"><i class="material-icons">zoom_in</i></button>
                            <button class="btn btn-theme">ADD TO CART</button>
                            <button class="btn btn-outline-theme"><i class="material-icons">favorite_border</i></button>
                        </div>
                    </div>
                    <div class="small-action d-block d-md-none">
                        <div class="btn-group dropup">
                            <span role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&#10247;</span>
                            <div class="dropdown-menu dropdown-menu-right fadeIn">
                                <a class="dropdown-item" href="#"><i class="material-icons">add_shopping_cart</i> BUY</a>
                                <a class="dropdown-item" href="#"><i class="material-icons">favorite_border</i> Wishlist</a>
                                <a class="dropdown-item" href="#"><i class="material-icons">compare_arrows</i> Compare</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg col-xl-2">
            <div class="card card-product">
                <a href="detail.html"><img class="card-img-top" src="{{ URL::asset('shop-v2/img/product/vneck1.jpg') }}" alt="Card image cap"></a>
                <div class="card-body">
                    <div class="card-title"><a href="detail.html" title="Burberry Button Down Collar Check Stretch Cotton Blend Shirt">Burberry Button Down Collar Check Stretch Cotton Blend Shirt</a></div>
                    <ul class="card-text list-inline">
                        <li class="list-inline-item"><span class="price">$13.50</span></li>
                        <li class="list-inline-item"><del class="text-muted small">$15.00</del></li>
                    </ul>
                    <div class="attribute">
                        <span class="badge badge-secondary font-weight-normal">10% OFF</span>
                    </div>
                    <div class="action">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                            <button class="btn btn-outline-theme show-quickview"><i class="material-icons">zoom_in</i></button>
                            <button class="btn btn-theme">ADD TO CART</button>
                            <button class="btn btn-outline-theme"><i class="material-icons">favorite_border</i></button>
                        </div>
                    </div>
                    <div class="small-action d-block d-md-none">
                        <div class="btn-group dropup">
                            <span role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&#10247;</span>
                            <div class="dropdown-menu dropdown-menu-right fadeIn">
                                <a class="dropdown-item" href="#"><i class="material-icons">add_shopping_cart</i> BUY</a>
                                <a class="dropdown-item" href="#"><i class="material-icons">favorite_border</i> Wishlist</a>
                                <a class="dropdown-item" href="#"><i class="material-icons">compare_arrows</i> Compare</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- /Flash Sale -->

    

    

</div>
@endsection


@section('stylesheet')
<link rel="stylesheet" href="{{ URL::asset('shop-v2/css/swiper.min.css') }}">
@endsection

@section('script')
<script src="{{ URL::asset('shop-v2/js/swiper.min.js') }}"></script>
<script src="{{ URL::asset('shop-v2/js/jquery.countdown.min.js') }}"></script>
@endsection
