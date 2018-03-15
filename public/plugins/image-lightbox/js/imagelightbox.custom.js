
	var activityIndicatorOn = function () {
			$('<div id="imagelightbox-loading"><div></div></div>').appendTo('body');
		},
		activityIndicatorOff = function () {
			$('#imagelightbox-loading').remove();
		},

		overlayOn = function () {
			$('<div id="imagelightbox-overlay"></div>').appendTo('body');
		},
		overlayOff = function () {
			$('#imagelightbox-overlay').remove();
		},

		closeButtonOn = function (instance) {
			$('<a href="#" id="imagelightbox-close"></a>').appendTo('body').on('click', function () {
				$(this).remove();
				instance.quitImageLightbox();
				return false;
			});
		},
		closeButtonOff = function () {
			$('#imagelightbox-close').remove();
		},

		captionOn = function () {
			var description = $('a[href="' + $('#imagelightbox').attr('src') + '"] img').attr('alt');
			if (description.length > 0)
				$('<div id="imagelightbox-caption">' + description + '</div>').appendTo('body');
		},
		captionOff = function () {
			$('#imagelightbox-caption').remove();
		},

		navigationOn = function (instance, selector) {
			var images = $(selector);
			if (images.length) {
				var nav = $('<div id="imagelightbox-nav"></div>');
				for (var i = 0; i < images.length; i++)
					nav.append('<a href="#"></a>');

				nav.appendTo('body');
				nav.on('click touchend', function () {
					return false;
				});

				var navItems = nav.find('a');
				navItems.on('click touchend', function () {
					var $this = $(this);
					if (images.eq($this.index()).attr('href') != $('#imagelightbox').attr('src'))
						instance.switchImageLightbox($this.index());

					navItems.removeClass('active');
					navItems.eq($this.index()).addClass('active');

					return false;
				})
						.on('touchend', function () {
							return false;
						});
			}
		},
		navigationUpdate = function (selector) {
			var items = $('#imagelightbox-nav').find('a');
			items.removeClass('active');
			items.eq($(selector).filter('[href="' + $('#imagelightbox').attr('src') + '"]').index(selector)).addClass('active');
		},
		navigationOff = function () {
			$('#imagelightbox-nav').remove();
		},
		arrowsOn = function( instance, selector ) {
			var $arrows = $( '<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button>' +
							 '<button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>' );
			$arrows.appendTo( 'body' );
			$arrows.on( 'click touchend', function( e ) {
				e.preventDefault();

				var $this = $( this );

				if( $this.hasClass('imagelightbox-arrow-left')) {
					instance.loadPreviousImage();
				} else {
					instance.loadNextImage();
				}

				return false;
			});
		},
		arrowsOff = function() {
			$('.imagelightbox-arrow').remove();
		};

$(function () {	 
	//	WITH ARROWS & ACTIVITY INDICATION

	/*var selectorG = 'a[data-imagelightbox="gallery"]';
	var instanceG = $( selectorG ).imageLightbox(
		{
			onStart:		function(){ arrowsOn( instanceG, selectorG ); overlayOn(); closeButtonOn(selectorG);},
			onEnd:			function(){ arrowsOff();  overlayOff(); closeButtonOff(); },
			onLoadStart: 	function(){ activityIndicatorOn(); },
			onLoadEnd:	 	function(){ $( '.imagelightbox-arrow' ).css( 'display', 'block' ); activityIndicatorOff(); }
			  
			/*onStart:		function(){ arrowsOn( instanceG, selectorG ); overlayOn(); closeButtonOn(selectorG);},
			onEnd:			function(){ arrowsOff();  overlayOff(); closeButtonOff(); },
			onLoadStart: 	function(){ activityIndicatorOn(); },
			onLoadEnd:	 	function(){ $( '.imagelightbox-arrow' ).css( 'display', 'block' ); activityIndicatorOff(); }
			*/   
			 
		//});
	
	  
});

 