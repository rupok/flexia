<?php

// No direct access, please
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define Constants
 */
define('FLEXIA_DEV_MODE', false);
define('FLEXIA_VERSION', '3.0.0');
define('FLEXIA_SLUG', 'flexia');
define('FLEXIA_NAME', 'Flexia FSE');



if ( ! function_exists( 'flexia_support' ) ) :

	function flexia_support() {

        // Custom editor styling
		add_editor_style( 'assets/css/editor-style.css' );
	}

endif;

add_action( 'after_setup_theme', 'flexia_support' );


if ( ! function_exists( 'flexia_styles' ) ) :
	/**
	 * Enqueue styles.
	 */
	function flexia_styles() {
		// Register theme stylesheet.
		wp_register_style(
			'flexia-style', get_template_directory_uri() . '/style.css', array(), FLEXIA_VERSION
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'flexia-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'flexia_styles' );

/**
 * Register block categories
 */
if( !function_exists( 'flexia_register' ) ) :
    function flexia_register() {

        /**
         * Register block styles
         */

        if( function_exists( 'register_block_style' ) ) {
            register_block_style(
                'core/heading',
                [
                    'name'         => 'sub-heading',
                    'label'        => __( 'Sub Heading', 'flexia' ),
                    'is_default'   => false,
                ]
            );
            register_block_style(
                'core/group',
                [
                    'name'         => 'hover-border',
                    'label'        => __( 'Hover Border', 'flexia' ),
                    'is_default'   => false,
                ]
            );

           
        }
    }
    add_action( 'init', 'flexia_register' );
endif;