// Function to check element is exist
$.fn.exist = function(){ return $(this).length > 0; }

// Function to get window width
function get_width() {
  return $(window).width();
}



$(function(){

  // open navigation dropdown on hover (only when width >= 768px)
  $('ul.nav li.dropdown').hover(function() {
    if (get_width() >= 767) {
      $(this).addClass('open');
    }
  }, function() {
    if (get_width() >= 767) {
      $(this).removeClass('open');
    }
  });

  // Navigation submenu
  $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
    event.preventDefault();
    event.stopPropagation();
    $(this).parent().siblings().removeClass('open');
    $(this).parent().toggleClass('open');
  });

  // owlCarousel for Home Slider
  if ($('.home-slider').exist()) {
    $('.home-slider').owlCarousel({
      items:1,
      loop:true,
      autoplay:true,
      autoplayHoverPause:true,
      dots:false,
      nav:true,
      navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    });
  }

if ($('.widget-slider-left').exist()) {
    var widget_slider = $('.widget-slider-left');
    widget_slider.owlCarousel({
      items:1,
      dots: false,
      nav: true,
      navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
      responsive:{
        0:{
          items:1,
        },
        390:{
          items:2,
        },
        480:{
          items:2,
        },
        550:{
          items:3,
        },
        768:{
          items:1,
        },
        992:{
          items:1,
        }
      }
    });
  }
  
  // owlCarousel for Widget Slider
  if ($('.widget-slider').exist()) {
    var widget_slider = $('.widget-slider');
    widget_slider.owlCarousel({
      items:1,
      dots: false,
      nav: true,
      navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
      responsive:{
        0:{
          items:2,
        },
        480:{
          items:2,
        },
        768:{
          items:3,
        },
        992:{
          items:1,
        }
      }
    });
  }

  // owlCarousel for Product Slider
  if ($('.product-slider').exist()) {
    var product_slider = $('.product-slider')
    product_slider.owlCarousel({
      dots: false,
      nav: true,
      navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
      responsive:{
          0:{
            items:2,
          },
          480:{
            items:2,
          },
          768:{
            items:3,
          },
          992:{
            items:3,
          },
          1200:{
            items:4,
          }
        }
    });
  }

   // owlCarousel for Related Product Slider
  if ($('.related-product-slider').exist()) {
    var related_product_slider = $('.related-product-slider')
    related_product_slider.owlCarousel({
      dots: false,
      nav: true,
      navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
      responsive:{
          0:{
            items:2,
          },
          480:{
            items:2,
          },
          768:{
            items:3,
          },
          992:{
            items:5,
          },
          1200:{
            items:6,
          }
        }
    });
  }

  // owlCarousel for Brand Slider
  if ($('.brand-slider').exist()) {
    var brand_slider = $('.brand-slider');
    brand_slider.owlCarousel({
      dots:false,
      nav:true,
      navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
      responsive:{
        0:{
          items:1,
        },
        480:{
          items:2,
          margin:15
        },
        768:{
          items:3,
          margin:15
        },
        992:{
          items:4,
          margin: 30
        },
        1200:{
          items:6,
          margin: 30
        }
      }
    });
  }

  // Tooltip
  $('button[data-toggle="tooltip"]').tooltip({container:'body',animation:false});
  $('a[data-toggle="tooltip"]').tooltip({container:'body',animation:false});

  // Back top Top
    $(window).scroll(function(){
    if ($(this).scrollTop()>70) {
      $('.back-top').fadeIn();
    } else {
      $('.back-top').fadeOut();
    }
  });

  // Touchspin
  /*if ($('.input-qty').exist()) {
    $('.input-qty input').TouchSpin({
      verticalbuttons: true,
      prefix: 'qty'
    });
  }*/

});