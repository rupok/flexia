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
}
add_action( 'customize_preview_init', 'flexia_customize_preview_js' );


/**
 * Admin Script
 */
function flexia_admin_js() {
	wp_enqueue_script( 'flexia-admin', get_template_directory_uri() . '/framework/assets/admin/js/admin.js', array( 'jquery' ), '', true );

	$settings = array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'flexia_blog_content_display' => get_theme_mod( 'flexia_blog_content_display', true ),
		'flexia_navbar' => get_theme_mod( 'flexia_navbar', true ),
		'body_google_font' => get_theme_mod( 'flexia_google_font_family', true ),
		'body_font_variants' => get_theme_mod( 'flexia_google_font_family_variants', true ),
		'heading_google_font' => get_theme_mod( 'flexia_heading_font_family', true ),
		'heading_font_variants' => get_theme_mod( 'flexia_heading_font_family_variants', true ),
	);

	wp_localize_script( 'flexia-admin', 'settings', $settings );
}
add_action( 'admin_enqueue_scripts', 'flexia_admin_js' );