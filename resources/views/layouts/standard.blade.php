<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ URL::asset('shop/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ URL::asset('shop/images/favicon.ico') }}" type="image/x-icon">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title', 'เสื้อคู่รัก TM SHOP')</title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('shop/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <!-- Plugins -->
    <link href="{{ URL::asset('shop/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('shop/css/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('shop/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('shop/css/owl.theme.default.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('shop/css/style.teal.flat.css') }}" rel="stylesheet">
    
    @yield('stylesheet')
    <link href="{{ URL::asset('shop/css/custom.css') }}" rel="stylesheet">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Kanit:300&subset=thai,latin' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- Top Header -->
    @include("partials.header")    
    <!-- End Top Header -->

    <!-- Middle Header -->
    @include("partials.middle-header")
    <!-- End Middle Header -->

    <!-- Navigation Bar -->
    @include("partials.navigation-bar")
    <!-- End Navigation Bar -->

    <?php if(isset($slide)){?>
    <!-- Full Slider -->
    <div class="container-fluid">
      <div class="row">
        <div class="home-slider">
          <div class="item">
            <a href="products.html"><img src="{{ url('shop/images/demo/slide-1-full.jpg') }}" alt="Slider"></a>
          </div>
          <div class="item">
            <a href="products.html"><img src="{{ url('shop/images/demo/slide-2-full.jpg') }}" alt="Slider"></a>
          </div>
          <div class="item">
            <a href="products.html"><img src="{{ url('shop/images/demo/slide-3-full.jpg') }}" alt="Slider"></a>
          </div>
        </div>
      </div>
    </div>
    <!-- End Full Slider -->
    <?php } ?>
    
    <!-- Breadcrumbs -->
    @include("partials.breadcrumb")
    <!-- End Breadcrumbs -->
    
    <!-- Main Content -->    
    @yield('content')
    <!-- End Main Content -->

    <!-- Footer -->
    @include("partials.footer")
    <!-- End Footer -->

    <a href="#top" class="back-top text-center" onclick="$('body,html').animate({scrollTop:0},500); return false">
      <i class="fa fa-angle-double-up"></i>
    </a>
    
    <script> var ServerName = "{{ url('/') }}"; </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ URL::asset('shop/js/jquery.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ URL::asset('shop/bootstrap/js/bootstrap.js') }}"></script>
    <!-- Plugins -->    
    <script src="{{ URL::asset('shop/js/bootstrap-select.js') }}"></script>
    <script src="{{ URL::asset('shop/js/owl.carousel.js') }}"></script>
    <script src="{{ URL::asset('shop/js/mimity.js') }}"></script>
    @yield('script')
    <script src="{{ URL::asset('shop/js/custom.js') }}"></script>    
    @yield('script-custom')
    @yield('script-custom2')
  </body>
</html>