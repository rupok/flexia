<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Flexia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Flexia
 */

if ( ! function_exists( 'flexia_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function flexia_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Flexia, use a find and replace
	 * to change 'flexia' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'flexia', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'flexia-featured-image', 2000, 1200, true );

	add_image_size( 'flexia-thumbnail-avatar', 100, 100, true );
	/*
	 * This theme styles the visual editor to resemble the theme style
	 */
	add_editor_style( get_template_directory() . '/framework/assets/admin/css/editor-style.css' );

	/**
	 * Register primary menu
	 */
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'flexia' ),
		'topbar-menu' => esc_html__( 'Topbar Menu', 'flexia' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'flexia' ),
	) );


	/**
	 * Add search box to primary menu
	 */

	$flexia_nav_menu_search = get_theme_mod('flexia_nav_menu_search', true);

	if( $flexia_nav_menu_search == true ) : 

	function flexia_nav_search($items, $args) {
	     if( 'primary' === $args -> theme_location ) { 
	     $items .= '<li class="menu-item navbar-search-menu"> <a id="btn-search" href="javascript:void(0);">';
	     $items .= '<i class="fa fa-search" aria-hidden="true"></i></a></li>';	        }
		return $items;

	}
	add_filter('wp_nav_menu_items', 'flexia_nav_search', 98, 2);

	endif;

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'status', 'chat' ) );
	
	/**
	 * Enable support for WooCommerce
	 */
	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'flexia_custom_background_args', array(
		'default-color' => 'f9f9f9',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
	   'height'      => 80,
	   'width'       => 250,
	   'flex-width' => true,
	   'flex-height' => true,
	) );

}
endif;
add_action( 'after_setup_theme', 'flexia_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function flexia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'flexia_content_width', 640 );
}
add_action( 'after_setup_theme', 'flexia_content_width', 0 );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Styles and Scripts enqueues.
 */

require get_template_directory() . '/framework/functions/enqueue/styles.php';
require get_template_directory() . '/framework/functions/enqueue/scripts.php';

/**
 * Widgets.
 */

require get_template_directory() . '/framework/functions/flexia/widgets.php';

/**
 * Integrations.
 */

if( class_exists('WooCommerce') )  {

	require get_template_directory() . '/framework/functions/flexia/integrations/woocommerce/woocommerce-integration.php';
	require get_template_directory() . '/framework/functions/flexia/integrations/woocommerce/class-flexia-woocommerce.php';
}

require get_template_directory() . '/framework/functions/flexia/integrations/edd/edd-integration.php';

/**
 * Customizer additions.
 */

require get_template_directory() . '/framework/functions/customizer/defaults.php';
require get_template_directory() . '/framework/functions/customizer/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/********* Google Fonts URL function  ***********/

if ( ! function_exists( 'flexia_fonts_url' ) ){
	function flexia_fonts_url() {
	    $fonts_url = '';
	    $content_font = get_theme_mod('flexia_google_font_family', '');
	    $header_font = get_theme_mod('flexia_heading_font_family', '');
 
	    if ( 'off' !== $content_font || 'off' !== $header_font ) {
	        $font_families = array();
 
	        if ( 'off' !== $content_font ) {
	            $font_families[] = $content_font . ':300,400,700';
	        }
 
	        if ( 'off' !== $header_font ) {
	            $font_families[] = $header_font . ':300,400,700';
	        }
 
	        $query_args = array(
	            'family' => urlencode( implode( '|', array_unique($font_families) ) ),
	        );
 
	        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	    }
 
	    return esc_url_raw( $fonts_url );
	}
}