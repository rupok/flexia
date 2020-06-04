<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Flexia Theme Customizer outout for header
 *
 * @package Flexia
 */

/**
 * Flexia Custom Header
 */

function flexia_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'flexia_custom_header_args', array(
		'default-image' 		 => get_template_directory_uri() . '/framework/assets/img/flexia-blog-header-banner.svg',
		'default-text-color'     => 'F56A6A',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'flexia_customizer_style',
	) ) );
}
add_action( 'after_setup_theme', 'flexia_custom_header_setup' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function flexia_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function flexia_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
