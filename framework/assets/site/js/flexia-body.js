jQuery( document ).ready( function($) {
	'use strict';
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


	// smooth scroll for anchors
   $('.nav-menu a[href^=#]:not([href=#])').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash,
	    $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top 
	    }, 800, 'swing');

	    return false;

	});


	// smooth scroll for anchors
   $('a.scroll-down, a.scroll-to-comments').on('click',function (e) {
	    e.preventDefault();
	    var stickyNavbarHeight = $('.flexia-navbar-fixed-top').height();
	    var target = this.hash,
	    $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top - stickyNavbarHeight
	    }, 800, 'swing');

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


	// Calculate blog header height

	var topbarHeight = $('.flexia-topbar').height();
	var logobarHeight = $('.flexia-logobar').height();
	var navbarHeight = $('.flexia-navbar:not(.flexia-navbar-transparent-top)').height();
	var transparentNavbarHeight = $('.flexia-navbar-transparent-top').height();
	var headerHeight = (topbarHeight + logobarHeight + navbarHeight) + 50;
	var transparentHeaderHeight = (topbarHeight + logobarHeight + transparentNavbarHeight);

   $('.blog-header').css({ 'height': $(window).height() - headerHeight });
   $(window).on('resize', function() {

        $('.blog-header').css({ 'height': $(window).height() - headerHeight });
        $('body').css({ 'width': $(window).width() })
   });

	// Transparent menu
	
	// $('body:not(.single-post) .site-header + *, .single-blog-header').css({ 'padding-top': transparentHeaderHeight });


   // Header parallax

	$(window).scroll(function(e){
	  parallax();
	});


	function parallax() {
	  var scrollPosition = $(window).scrollTop();
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