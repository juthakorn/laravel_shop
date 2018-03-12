<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="shortcut icon" href="{{ URL::asset('shop-v2/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ URL::asset('shop-v2/images/favicon.ico') }}" type="image/x-icon">
    <title>@yield('title', 'เสื้อคู่รัก TM SHOP')</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('shop-v2/bootstrap/css/bootstrap.min.css') }}">

    <!-- Third Party CSS -->
    <link rel="stylesheet" href="{{ URL::asset('shop-v2/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('shop-v2/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('shop-v2/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('shop-v2/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('shop-v2/css/style.min.css') }}">
    
    @yield('stylesheet')
    <link href="{{ URL::asset('shop-v2/css/custom.css') }}" rel="stylesheet">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Kanit:300&subset=thai,latin' rel='stylesheet' type='text/css'>
  
  </head>
  <body>

    <!-- menu mobile -->
    @include("partials_v2.menu-mobile")    
    <!-- End menu mobile -->

    <!-- Top Header -->
    @include("partials_v2.header")    
    <!-- End Top Header -->

    <!-- Middle Header -->
    @include("partials_v2.middle-header")
    <!-- End Middle Header -->


    <div id="container">
        <!-- Navigation Bar -->
        @include("partials_v2.menu")
        <!-- End Navigation Bar -->
    

        <?php if(isset($slide)){?>
        <!-- Full Width Slider -->
        <div class="container-fluid mb-3">
            <div class="row">
              <div class="owl-carousel owl-theme home-slider">
                <div class="owl-cover" data-src="shop-v2/images/slider/1.jpg" data-xs-height="220px" data-sm-height="350px" data-md-height="400px" data-lg-height="430px" data-xl-height="450px">
                  <div class="container-fluid h-100">
                    <div class="row h-100 align-items-center">
                      <div class="col-8 col-lg-6 text-center">
                        <div class="animated d-none d-sm-block" data-animate="slideInRight">
                          <h1 class="bg-theme text-white d-inline-block px-2">TOP BRANDS</h1>
                        </div>
                        <div class="animated" data-animate="bounceInUp">
                          <h2 class="text-white font-weight-bold display-4 d-inline-block" remove-class-on-xs="display-4 font-weight-bold">MINIMUM<br/>30% - 70% OFF</h2>
                        </div>
                        <a href="products.html" class="btn btn-theme animated delay-1" data-animate="fadeInDown" add-class-on-xs="btn-sm">Shop Now</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="owl-cover" data-src="shop-v2/images/slider/2.jpg" data-xs-height="220px" data-sm-height="350px" data-md-height="400px" data-lg-height="430px" data-xl-height="450px">
                  <div class="container-fluid h-100">
                    <div class="row h-100 align-items-center justify-content-end">
                      <div class="col col-sm-6 text-center">
                        <div class="animated" data-animate="lightSpeedIn">
                          <h1 class="bg-dark display-4 text-white d-inline-block px-2" remove-class-on-xs="display-4">T-LOVE</h1>
                        </div>
                        <div class="animated" data-animate="rotateIn">
                          <h3 class="d-none d-sm-inline-block" add-class-on-xl="font-weight-bold">
                            A COMPLETE SHOPPING GUIDE ON WHAT AND HOW TO WEAR THE BEST T-SHIRTS
                          </h3>
                          <h5 class="d-inline-block d-sm-none" add-class-on-xs="text-white">
                            A COMPLETE SHOPPING GUIDE
                          </h5>
                        </div>
                        <a href="products.html" class="btn btn-theme animated delay-1" data-animate="fadeInUp" add-class-on-xs="btn-sm">Shop Now</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="owl-cover" data-src="shop-v2/images/slider/3.jpg" data-xs-height="220px" data-sm-height="350px" data-md-height="400px" data-lg-height="430px" data-xl-height="450px">
                  <div class="container-fluid h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                      <div class="col text-center">
                        <div class="animated d-none d-lg-block" data-animate="zoomIn">
                          <h1 class="bg-warning d-inline-block px-2">YOUR PRAYERS ANSWERED!</h1>
                        </div>
                        <div class="animated" data-animate="bounceInDown">
                          <h2 class="display-4 bg-light d-inline-block px-2" remove-class-on-xs="display-4">UPTO 70% OFF</h2>
                        </div>
                        <div class="animated d-none d-sm-block" data-animate="slideInLeft">
                          <h1 class="bg-dark text-white d-inline-block px-2">+ EXTRA 10% OFF</h1>
                        </div>
                        <a href="products.html" class="btn btn-theme animated delay-1" data-animate="flipInX" add-class-on-xs="btn-sm">Shop Now</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="owl-cover" data-src="shop-v2/images/slider/4.jpg" data-xs-height="220px" data-sm-height="350px" data-md-height="400px" data-lg-height="430px" data-xl-height="450px">
                  <div class="container-fluid h-100">
                    <div class="row h-100 align-items-center justify-content-between" remove-class-on-xs="justify-content-between">
                      <div class="d-none d-sm-block col-sm-5 text-center">
                        <div class="animated text-danger" data-animate="slideInRight">
                          <i class="fa fa-truck fa-5x"></i>
                        </div>
                        <div class="animated delay-1" data-animate="bounceInUp">
                          <h3 class="d-none d-sm-inline-block bg-white p-2" add-class-on-xl="font-weight-bold">FREE SHIPPING</h3>
                        </div>
                        <div class="animated delay-2" data-animate="rotateInDownRight">
                          <h2 class="d-none d-sm-inline-block px-2 bg-dark text-white">ON ALL ORDERS !</h2>
                        </div>
                      </div>
                      <div class="d-none d-sm-block col-sm-5 text-center">
                        <div class="animated delay-3 text-info" data-animate="fadeInLeft">
                          <i class="fa fa-phone fa-5x"></i>
                        </div>
                        <div class="animated delay-4" data-animate="bounceInDown">
                          <h2 class="d-none d-sm-inline-block px-2 bg-white">24 HOURS</h2>
                        </div>
                        <div class="animated delay-5" data-animate="lightSpeedIn">
                          <h2 class="d-none d-sm-inline-block px-2 bg-dark text-white">ONLINE SUPPORT</h2>
                        </div>
                      </div>
                      <div class="col d-sm-none text-center">
                        <div class="animated" data-animate="fadeInDown">
                          <h6 class="bg-white d-inline-block px-2">FREE SHIPPING</h6>
                        </div>
                        <div class="animated delay-1" data-animate="fadeInDown">
                          <h4 class="bg-dark text-white d-inline-block px-2">ON ALL ORDERS</h4>
                        </div>
                        <a href="products.html" class="btn btn-theme animated delay-2" data-animate="fadeInUp" add-class-on-xs="btn-sm">Shop Now</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- End Full Slider -->
        <?php } ?>

        <!-- Breadcrumbs -->
        @include("partials_v2.breadcrumb")
        <!-- End Breadcrumbs -->

        <!-- Main Content -->    
        @yield('content')
        <!-- End Main Content -->

        <!-- Footer -->
        @include("partials_v2.footer")
        <!-- End Footer -->
 
        <a href="#top" class="back-top text-center" onclick="$('body,html').animate({scrollTop:0},500); return false">
          <i class="fa fa-angle-double-up"></i>          
        </a>
    </div>
    <!-- End #container -->
    <script> var ServerName = "{{ url('/') }}"; </script>
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ URL::asset('shop-v2/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ URL::asset('shop-v2/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('shop-v2/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Third Party JS -->
    <script src="{{ URL::asset('shop-v2/js/owl.carousel.min.js') }}"></script>    
    <!-- Mimity JS -->
    <script src="{{ URL::asset('shop-v2/js/mimity.js') }}"></script>    
    @yield('script')
    <script src="{{ URL::asset('shop-v2/js/custom.js') }}"></script>    
    @yield('script-custom')
    @yield('script-custom2')
  </body>
</html>