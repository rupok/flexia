<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Flexia stylesheets
 *
 * @package Flexia
 */

/**
 * Enqueue scripts and styles.
 */

function flexia_site_styles() {
	if( FLEXIA_DEV_MODE == true ) {
		wp_enqueue_style( 'flexia-theme-style', get_template_directory_uri() . '/framework/assets/sass/style.css');
	} else {
		wp_enqueue_style( 'flexia-theme-style', get_template_directory_uri() . '/framework/assets/site/css/style.css');
	}
	wp_enqueue_style('flexia-google-fonts', flexia_fonts_url(), array(), null);

}
add_action( 'wp_enqueue_scripts', 'flexia_site_styles' );

//Include Gutenberg Template Style
function flexia_gutenberg_template_style() {
	if ( is_page_template('template-gutenberg.php') ) {
		wp_enqueue_style(
			'gutenberg-style',
			get_template_directory_uri() . '/framework/assets/site/css/gutenburg-style.css'
		);
		$width = flexia_get_option('flexia_container_width') . '%';
		$max_width = flexia_get_option('flexia_container_max_width') . 'px';
		$custom_css = "
		.flexia-gutenberg-container .entry-title,
		.flexia-gutenberg-container .entry-content p,
		.flexia-gutenberg-container .entry-content .wp-block-image,
		.flexia-gutenberg-container .entry-content ul {
			width: {$width};
			max-width: {$max_width};
		}			
		.flexia-gutenberg-container #main .alignwide{
			max-width: {$max_width};
		}
		.flexia-gutenberg-container #main .wp-block-pullquote.has-background blockquote{
			width: {$width};
			max-width: {$max_width};
		}";
		wp_add_inline_style( 'gutenberg-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'flexia_gutenberg_template_style' );