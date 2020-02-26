<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */



if ( ! function_exists( 'flexia_widgets_init' ) ) :
/**
 * Register widgetized area and update sidebar with default widgets
 */
add_action( 'widgets_init', 'flexia_widgets_init' );
function flexia_widgets_init() {
	// Set up our array of widgets	
	$widgets = array(
		'sidebar-left' => __( 'Sidebar Left', 'flexia' ),
		'sidebar-right' => __( 'Sidebar Right', 'flexia' ),
		'header-1' => __( 'Header 1', 'flexia' ),
		'header-2' => __( 'Header 2', 'flexia' ),
		'header-3' => __( 'Header 3', 'flexia' ),
		'header-4' => __( 'Header 4', 'flexia' ),
		'footer-1' => __( 'Footer 1', 'flexia' ),
		'footer-2' => __( 'Footer 2', 'flexia' ),
		'footer-3' => __( 'Footer 3', 'flexia' ),
		'footer-4' => __( 'Footer 4', 'flexia' ),

	);

	if ( class_exists( 'WooCommerce' ) ) {
		$widgets['woo-sidebar'] = __( 'WooCommerce Sidebar', 'flexia' );
	}
	
	// Loop through them to create our widget areas
	foreach ( $widgets as $id => $name ) {
		register_sidebar( array(
			'name'          => $name,
			'id'            => $id,
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => apply_filters( 'flexia_before_widget_title', '<h2 class="widget-title">' ),
			'after_title'   => apply_filters( 'flexia_after_widget_title', '</h2>' ),
		) );
	}
}
endif;


