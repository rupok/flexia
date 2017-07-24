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
		if ( _window.scrollTop() > 200 ) {
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
});