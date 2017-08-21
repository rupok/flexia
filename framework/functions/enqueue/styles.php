<?php
/**
 * Flexia stylesheets
 *
 * @package Flexia
 */

/**
 * Enqueue scripts and styles.
 */

function flexia_site_styles() {
	 wp_enqueue_style( 'flexia-theme-style', get_template_directory_uri() . '/framework/assets/site/css/style.css');
	 wp_enqueue_style('flexia-google-fonts', flexia_fonts_url(), array(), null);

}
add_action( 'wp_enqueue_scripts', 'flexia_site_styles' );