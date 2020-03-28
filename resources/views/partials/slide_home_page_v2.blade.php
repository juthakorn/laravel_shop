<!-- Home Slider -->
<div class="container-fluid">
    <div class="row">
        <div class="swiper-container home-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide" data-cover="{{ URL::asset('shop-v2/img/slider/1.jpg') }}" data-xs-height="220px" data-sm-height="350px" data-md-height="400px" data-lg-height="430px" data-xl-height="460px">
                    <div class="swiper-overlay">
                        <div class="text-center ml-3 ml-sm-5">
                            <div class="d-inline-block h1 bg-theme text-white px-2 animate" data-animate="fadeRight">TOP BRANDS</div>
                            <div class="display-4 text-white font-weight-bold text-shadow animate duration-2" data-animate="fadeUp">MINIMUM<br/>30% - 70% OFF</div>
                            <a href="shop.html" class="btn btn-theme btn-sm mt-3 animate delay-1" data-animate="fadeDown">SHOP NOW</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-cover="{{ URL::asset('shop-v2/img/slider/2.jpg') }}" data-xs-height="220px" data-sm-height="350px" data-md-height="400px" data-lg-height="430px" data-xl-height="460px">
                    <div class="swiper-overlay justify-content-end">
                        <div class="text-center mr-3 mr-sm-5">
                            <div class="d-inline-block display-4 bg-dark text-white px-2 animate mb-3" data-animate="fadeLeft">T-LOVE</div>
                            <div class="h3 text-white font-weight-bold text-shadow animate duration-2" data-animate="fadeUp">A COMPLETE SHOPPING GUIDE ON WHAT AND<br/>HOW TO WEAR THE BEST T-SHIRTS</div>
                            <a href="shop.html" class="btn btn-warning btn-sm mt-3 animate delay-1" data-animate="fadeDown">SHOP NOW</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-cover="{{ URL::asset('shop-v2/img/slider/3.jpg') }}" data-xs-height="220px" data-sm-height="350px" data-md-height="400px" data-lg-height="430px" data-xl-height="460px">
                    <div class="swiper-overlay justify-content-center">
                        <div class="text-center">
                            <div class="d-inline-block h1 bg-warning font-weight-normal text-secondary px-2 animate duration-2" data-animate="fadeDown">YOUR PRAYERS ANSWERED!</div>
                            <div class="display-4 text-white font-weight-bold text-shadow animate duration-2" data-animate="fadeLeft">UPTO 70% OFF</div>
                            <div class="d-inline-block h1 bg-dark text-white px-2 animate mb-3 duration-2" data-animate="fadeRight">+ EXTRA 10% OFF</div>
                            <div><a href="shop.html" class="btn btn-theme btn-sm mt-3 animate delay-1" data-animate="fadeDown">SHOP NOW</a></div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-cover="{{ URL::asset('shop-v2/img/slider/4.jpg') }}" data-xs-height="220px" data-sm-height="350px" data-md-height="400px" data-lg-height="430px" data-xl-height="460px">
                    <div class="swiper-overlay justify-content-between">
                        <div class="text-center w-100">
                            <div class="text-danger animate duration-2" data-animate="fadeLeft"><i class="material-icons md-5">local_shipping</i></div>
                            <div class="h3 bg-white px-2 animate d-inline-block text-secondary font-weight-normal delay-1" data-animate="fadeUp">FREE SHIPPING</div>
                            <div><div class="h1 bg-dark px-2 animate d-inline-block text-white font-weight-normal delay-1" data-animate="fadeRight">ON ALL ORDERS !</div></div>
                        </div>
                        <div class="text-center w-100">
                            <div class="text-info animate duration-2 delay-1" data-animate="fadeRight"><i class="material-icons md-5">phone</i></div>
                            <div class="h3 bg-white px-2 animate d-inline-block text-secondary font-weight-normal delay-2" data-animate="fadeDown">24 HOURS</div>
                            <div><div class="h1 bg-dark px-2 animate d-inline-block text-white font-weight-normal delay-2" data-animate="fadeUp">ONLINE SUPPORT</div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev d-none d-sm-flex" id="home-slider-prev"><i class="material-icons md-3">keyboard_arrow_left</i></div>
            <div class="swiper-button-next d-none d-sm-flex" id="home-slider-next"><i class="material-icons md-3">keyboard_arrow_right</i></div>
        </div>
    </div>
</div>
<!-- /Home Slider -->