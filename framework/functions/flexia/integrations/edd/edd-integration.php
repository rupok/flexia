<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;


// Add cart menu  to Navbar
				
if( class_exists('Easy_Digital_Downloads') )  {			  

	function add_edd_cart_menu_to_navbar ( $items, $args ) {
		if( 'primary' === $args -> theme_location ) {
			$items .= '<li class="menu-item flexia-header-cart">';
	    	$items .= '<a class="cart-contents edd-cart-contents" href="' . edd_get_checkout_uri() . '">';
	    	$items .= '<span class="flexia-header-cart-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>';
			$items .= '<span class="amount">' . wp_kses_data( edd_cart_total( false ) ) . '</span>';
			$items .= '<span class="count">' . wp_kses_data( sprintf( _n( '%d item', '%d items', edd_get_cart_quantity(), 'flexia' ), edd_get_cart_quantity() ) ) . '</span>';
			$items .= '</a>';
			$items .= '</li>';
		}
	return $items;
	}
	add_filter('wp_nav_menu_items','add_edd_cart_menu_to_navbar',99,2);

}



