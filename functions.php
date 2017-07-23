<?php
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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'flexia' ),
	) );

	// Flexia megamenu

	function flexia_nav_menu_args($args = '')
	{
	    $args['container'] = false;
	    return $args;
	}

	// Remove Injected classes, ID's and Page ID's from Navigation <li> items
	function flexia_css_attributes_filter($var)
	{
	    return is_array($var) ? array() : '';
	}

	add_filter('wp_nav_menu_args', 'flexia_nav_menu_args'); // Remove surrounding <div> from WP Navigation
	add_filter('nav_menu_css_class', 'flexia_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes
	add_filter('nav_menu_item_id', 'flexia_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID
	add_filter('page_css_class', 'flexia_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'flexia_custom_background_args', array(
		'default-color' => 'ffffff',
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
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
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
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
