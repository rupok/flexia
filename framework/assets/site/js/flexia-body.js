jQuery( document ).ready( function($) {

	// Back to top
	var _amountScrolled = $( '.flexia-back-to-top' ).data( 'start-scroll' ),
		_scrollSpeed = $( '.flexia-back-to-top' ).data( 'scroll-speed' ),
		_button = $( 'a.flexia-back-to-top' ),
		_window = $( window );

	_window.scroll(function() {
		if ( _window.scrollTop() > _amountScrolled ) {
			$( _button ).css({
				'opacity': '1',
				'visibility': 'visible'
			});
		} else {
			$( _button ).css({
				'opacity': '0',
				'visibility' : 'hidden'
			});
		}
	});

	$( _button ).on( 'click', function( e ) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: 0
		}, _scrollSpeed);
	});

	// Open header widgets

	$('.header-widget-toggle').on('click', function() {
		$(this).toggleClass('toggle-collapsed');
		$('.flexia-header-widget-area').toggleClass('header-widget-open');
	});

	_window.scroll(function() {
		if ( _window.scrollTop() > 300 ) {
			$('.toggle-collapsed').css({
				'opacity': '0',
				'visibility': 'hidden'
			});
		} else {
			$('.toggle-collapsed').css({
				'opacity': '1',
				'visibility' : 'visible'
			});
		}
	});

    // Scroll to Blog

        $('a.scroll-down').click(function() {
        $('html, body').animate({ scrollTop:$('#content').offset().top }, 500);
        return false;
    });

    // Scroll to Blog Comments

        $('a.scroll-to-comments').click(function() {
        $('html, body').animate({ scrollTop:$('#comments').offset().top }, 500);
        return false;
    });

  	// Sticky menu

	  $(window).scroll(function() {
	    var scrollPos = $(window).scrollTop(),
	        navbar = $('.flexia-navbar-fixed-top');

	    if (scrollPos > 350) {
	      navbar.addClass('flexia-sticky-navbar');
	    } else {
	      navbar.removeClass('flexia-sticky-navbar');
	    }
	  });

	// Header parallax

	$(window).scroll(function(e){
	  parallax();
	});


	function parallax() {
	  var scrollPosition = $(window).scrollTop();
	  $('.page-header:not(.blog-header) .header-content').css('margin-top', (0 - (scrollPosition * .5)) + 'px');
	  $('.page-header.blog-header .header-content').css('margin-top', (0 - (scrollPosition * .8)) + 'px');
	}


	// On scroll blur header

   (function() {
      $(window).scroll(function() {
        var oVal;
        oVal = $(window).scrollTop() / 350;
        return $(".header-overlay").css("opacity", oVal);
        });

      }).call(this);


});