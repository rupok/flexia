<?php
/**
 * Flexia Theme Customizer outout for header
 *
 * @package Flexia
 */

/**
 * Add support for core custom logo.
 *
 * @link https://codex.wordpress.org/Theme_Logo
 */

// Set up the WordPress core custom background feature.
add_theme_support( 'custom-background', apply_filters( 'flexia_custom_background_args', array(
	'default-color' => 'f9f9f9',
	'default-image' => '',
) ) );

function flexia_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'flexia_custom_header_args', array(
		'default-image'          => '',
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


?>