<?php
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