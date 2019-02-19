<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Flexia scripts
 *
 * @package Flexia
 */

/**
 * Enqueue scripts and styles.
 */

function flexia_site_scripts() {

	wp_enqueue_script( 'flexia-navigation', get_template_directory_uri() . '/framework/assets/site/js/navigation.js', array(), '', true );
	wp_enqueue_script( 'flexia-skip-link-focus-fix', get_template_directory_uri() . '/framework/assets/site/js/skip-link-focus-fix.js', array(), '', true );

	wp_enqueue_script( 'flexia-body-js', get_template_directory_uri() . '/framework/assets/site/js/flexia-body.js', array('jquery'), '', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'flexia_site_scripts' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function flexia_customize_preview_js() {
	wp_enqueue_script( 'flexia-customizer', get_template_directory_uri() . '/framework/assets/admin/js/customizer.js', array( 'customize-preview' ), '', true );
	add_action('wp_head', 'flexia_menu_css');
}
add_action( 'customize_preview_init', 'flexia_customize_preview_js' );

function flexia_menu_css() {
	echo '<style>
		@media screen and (min-width: 992px) {
			.main-navigation .nav-menu li > a {
				color: ' . get_theme_mod('flexia_main_nav_menu_link_color') . ';
			}

			.main-navigation .nav-menu li.menu-item-has-children > a:before,
			.main-navigation .nav-menu li.menu-item-has-children > a:after {
				background-color: ' . get_theme_mod('flexia_main_nav_menu_link_color') . ';
			}

			.main-navigation .nav-menu li:hover > a:not(.cart-contents),
			.main-navigation .nav-menu li.current-menu-item > a:not(.cart-contents),
			.main-navigation .nav-menu li.current-menu-ancestor > a:not(.cart-contents) {
				color: ' . get_theme_mod('flexia_main_nav_menu_link_hover_color') . ';
			}
			
			.main-navigation .nav-menu li:hover > a:not(.cart-contents),
			.main-navigation .nav-menu li.current-menu-item > a:not(.cart-contents),
			.main-navigation .nav-menu li.current-menu-ancestor > a:not(.cart-contents) {
				background-color: ' . get_theme_mod('flexia_main_nav_menu_link_hover_bg') . ';
			}

			.main-navigation .nav-menu li.menu-item-has-children:hover > a:before,
			.main-navigation .nav-menu li.menu-item-has-children:hover > a:after,
			.main-navigation .nav-menu li.menu-item-has-children.current-menu-item > a:before,
			.main-navigation .nav-menu li.menu-item-has-children.current-menu-item > a:after,
			.main-navigation .nav-menu li.menu-item-has-children.current-menu-ancestor > a:before,
			.main-navigation .nav-menu li.menu-item-has-children.current-menu-ancestor > a:after {
				background-color: ' . get_theme_mod('flexia_main_nav_menu_link_hover_color') . ';
			}

			.main-navigation .nav-menu li ul {
				background-color: ' . get_theme_mod('flexia_main_nav_menu_submenu_bg_color') . ';
			}

			.main-navigation .nav-menu li ul li.menu-item-has-children > a:before,
			.main-navigation .nav-menu li ul li.menu-item-has-children > a:after {
				background-color: ' . get_theme_mod('flexia_main_nav_menu_submenu_link_color') . ';
			}

			.main-navigation .nav-menu li ul li > a {
				color: ' . get_theme_mod('flexia_main_nav_menu_submenu_link_color') . ';
			}

			.main-navigation .nav-menu li ul li:hover > a:not(.cart-contents),
			.main-navigation .nav-menu li ul li.current-menu-item > a:not(.cart-contents),
			.main-navigation .nav-menu li ul li.current-menu-ancestor > a:not(.cart-contents) {
				color: ' . get_theme_mod('flexia_main_nav_menu_submenu_link_hover_color') . ';
			}
			
			.main-navigation .nav-menu li ul li:hover > a:not(.cart-contents),
			.main-navigation .nav-menu li ul li.current-menu-item > a:not(.cart-contents),
			.main-navigation .nav-menu li ul li.current-menu-ancestor > a:not(.cart-contents) {
				background-color: ' . get_theme_mod('flexia_main_nav_menu_submenu_link_hover_bg') . ';
			}

			.main-navigation .nav-menu li ul li.menu-item-has-children:hover > a:before,
			.main-navigation .nav-menu li ul li.menu-item-has-children:hover > a:after,
			.main-navigation .nav-menu li ul li.menu-item-has-children.current-menu-item > a:before,
			.main-navigation .nav-menu li ul li.menu-item-has-children.current-menu-item > a:after,
			.main-navigation .nav-menu li ul li.menu-item-has-children.current-menu-ancestor > a:before,
			.main-navigation .nav-menu li ul li.menu-item-has-children.current-menu-ancestor > a:after {
				background-color: ' . get_theme_mod('flexia_main_nav_menu_submenu_link_hover_color') . ';
			}

			.topbar-navigation .nav-menu li > a {
				color: ' . get_theme_mod('flexia_top_nav_menu_link_color') . ';
			}

			.topbar-navigation .nav-menu li.menu-item-has-children > a:before,
			.topbar-navigation .nav-menu li.menu-item-has-children > a:after {
				background-color: ' . get_theme_mod('flexia_top_nav_menu_link_color') . ';
			}

			.topbar-navigation .nav-menu li:hover > a,
			.topbar-navigation .nav-menu li.current-menu-item > a,
			.topbar-navigation .nav-menu li.current-menu-ancestor > a {
				color: ' . get_theme_mod('flexia_top_nav_menu_link_hover_color') . ';
			}
			
			.topbar-navigation .nav-menu li:hover > a,
			.topbar-navigation .nav-menu li.current-menu-item > a,
			.topbar-navigation .nav-menu li.current-menu-ancestor > a {
				background-color: ' . get_theme_mod('flexia_top_nav_menu_link_hover_bg') . ';
			}

			.topbar-navigation .nav-menu li.menu-item-has-children:hover > a:before,
			.topbar-navigation .nav-menu li.menu-item-has-children:hover > a:after,
			.topbar-navigation .nav-menu li.menu-item-has-children.current-menu-item > a:before,
			.topbar-navigation .nav-menu li.menu-item-has-children.current-menu-item > a:after,
			.topbar-navigation .nav-menu li.menu-item-has-children.current-menu-ancestor > a:before,
			.topbar-navigation .nav-menu li.menu-item-has-children.current-menu-ancestor > a:after {
				background-color: ' . get_theme_mod('flexia_top_nav_menu_link_hover_color') . ';
			}

			.topbar-navigation .nav-menu li ul {
				background-color: ' . get_theme_mod('flexia_top_nav_menu_submenu_bg_color') . ';
			}

			.topbar-navigation .nav-menu li ul li.menu-item-has-children > a:before,
			.topbar-navigation .nav-menu li ul li.menu-item-has-children > a:after {
				background-color: ' . get_theme_mod('flexia_top_nav_menu_submenu_link_color') . ';
			}

			.topbar-navigation .nav-menu li ul li > a {
				color: ' . get_theme_mod('flexia_top_nav_menu_submenu_link_color') . ';
			}

			.topbar-navigation .nav-menu li ul li:hover > a,
			.topbar-navigation .nav-menu li ul li.current-menu-item > a,
			.topbar-navigation .nav-menu li ul li.current-menu-ancestor > a {
				color: ' . get_theme_mod('flexia_top_nav_menu_submenu_link_hover_color') . ';
			}
			
			.topbar-navigation .nav-menu li ul li:hover > a,
			.topbar-navigation .nav-menu li ul li.current-menu-item > a,
			.topbar-navigation .nav-menu li ul li.current-menu-ancestor > a {
				background-color: ' . get_theme_mod('flexia_top_nav_menu_submenu_link_hover_bg') . ';
			}

			.topbar-navigation .nav-menu li ul li.menu-item-has-children:hover > a:before,
			.topbar-navigation .nav-menu li ul li.menu-item-has-children:hover > a:after,
			.topbar-navigation .nav-menu li ul li.menu-item-has-children.current-menu-item > a:before,
			.topbar-navigation .nav-menu li ul li.menu-item-has-children.current-menu-item > a:after,
			.topbar-navigation .nav-menu li ul li.menu-item-has-children.current-menu-ancestor > a:before,
			.topbar-navigation .nav-menu li ul li.menu-item-has-children.current-menu-ancestor > a:after {
				background-color: ' . get_theme_mod('flexia_top_nav_menu_submenu_link_hover_color') . ';
			}
		}
	</style>';
}


/**
 * Admin Script
 */
function flexia_admin_js() {
	wp_enqueue_script( 'flexia-admin', get_template_directory_uri() . '/framework/assets/admin/js/admin.js', array( 'jquery' ), '', true );

	$flexia_settings = array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'flexia_blog_content_display' => get_theme_mod( 'flexia_blog_content_display', true ),
		'flexia_navbar' => get_theme_mod( 'flexia_navbar', true ),
		'body_google_font' => get_theme_mod( 'body_font_family', true ),
		'body_font_variants' => get_theme_mod( 'body_font_variants', true ),
		'body_font_subsets' => get_theme_mod( 'body_font_subsets', true ),
		'heading_google_font' => get_theme_mod( 'heading_font_family', true ),
		'heading_font_variants' => get_theme_mod( 'heading_font_variants', true ),
		'heading_font_subsets' => get_theme_mod( 'heading_font_subsets', true ),
	);

	wp_localize_script( 'flexia-admin', 'flexia_settings', $flexia_settings );
}
add_action( 'admin_enqueue_scripts', 'flexia_admin_js' );