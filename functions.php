<?php
/**
 * Flexia block theme setup. Optional plugins own their lifecycle and policy.
 *
 * @package Flexia
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FLEXIA_DEV_MODE', false );
define( 'FLEXIA_VERSION', '3.2.1' );
define( 'FLEXIA_SLUG', 'flexia' );
define( 'FLEXIA_NAME', 'flexia' );
define( 'FLEXIA_DIR_PATH', get_template_directory() );

if ( ! function_exists( 'flexia_support' ) ) {
	/** Use the same styles in the editor and frontend. */
	function flexia_support() {
		add_editor_style( array( 'assets/css/custom.css', 'assets/css/block-styles.css', 'assets/css/editor-style.css' ) );
		add_theme_support( 'wp-block-styles' );
	}
}
add_action( 'after_setup_theme', 'flexia_support' );

if ( ! function_exists( 'flexia_woocommerce_support' ) ) {
	/** Declare optional commerce support without changing plugin state. */
	function flexia_woocommerce_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content', 'flexia_woocommerce_wrapper_start', 10 );
		add_action( 'woocommerce_after_main_content', 'flexia_woocommerce_wrapper_end', 10 );
	}
}
add_action( 'after_setup_theme', 'flexia_woocommerce_support' );

if ( ! function_exists( 'flexia_woocommerce_wrapper_start' ) ) {
	/** Legacy commerce renders inside the block template's main landmark. */
	function flexia_woocommerce_wrapper_start() {
		echo '<div class="wp-block-group woocommerce-main">';
	}
}
if ( ! function_exists( 'flexia_woocommerce_wrapper_end' ) ) {
	/** Close the legacy commerce wrapper. */
	function flexia_woocommerce_wrapper_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'flexia_styles' ) ) {
	/** Load theme assets without companion plugin dependencies. */
	function flexia_styles() {
		wp_enqueue_style( 'flexia-custom', get_theme_file_uri( 'assets/css/custom.css' ), array(), FLEXIA_VERSION );
		wp_enqueue_style( 'flexia-block-styles', get_theme_file_uri( 'assets/css/block-styles.css' ), array( 'flexia-custom' ), FLEXIA_VERSION );
		wp_enqueue_style( 'flexia-style', get_stylesheet_uri(), array( 'flexia-block-styles' ), FLEXIA_VERSION );
	}
}
add_action( 'wp_enqueue_scripts', 'flexia_styles' );

if ( ! function_exists( 'flexia_register' ) ) {
	/** Register categories and styles after WordPress initializes. */
	function flexia_register() {
		register_block_pattern_category( 'flexia', array( 'label' => __( 'Flexia Patterns', 'flexia' ) ) );
		register_block_pattern_category( 'flexia-pages', array( 'label' => __( 'Flexia Pages', 'flexia' ) ) );
		$styles = array(
			'core/group'        => array(
				'flexia-hover-border' => __( 'Hover Border', 'flexia' ),
				'flexia-hover-shadow' => __( 'Hover Shadow', 'flexia' ),
				'flexia-sm-bg-shadow' => __( 'Small BG Shadow', 'flexia' ),
			),
			'core/cover'        => array( 'flexia-team' => __( 'Image Hover', 'flexia' ) ),
			'core/search'       => array( 'flexia-minimal-search' => __( 'Minimal', 'flexia' ) ),
			'core/button'       => array(
				'flexia-btn-inverse' => __( 'Inverse', 'flexia' ),
				'flexia-btn-theme'   => __( 'Primary', 'flexia' ),
			),
			'core/list'         => array( 'flexia-checkmark-list' => __( 'Checkmark', 'flexia' ) ),
			'core/post-author'  => array( 'flexia-author-rounded' => __( 'Image Rounded', 'flexia' ) ),
			'core/separator'    => array( 'flexia-separator-wide-thin-line' => __( 'Wide Thin Line', 'flexia' ) ),
			'core/social-links' => array( 'flexia-social-rounded' => __( 'Rounded Icon', 'flexia' ) ),
		);
		if ( class_exists( 'WooCommerce' ) ) {
			foreach ( array( 'woocommerce/product-collection', 'woocommerce/legacy-template', 'woocommerce/product-image-gallery', 'woocommerce/cart', 'woocommerce/checkout' ) as $commerce_block ) {
				wp_enqueue_block_style( $commerce_block, array(
					'handle' => 'flexia-commerce',
					'src'    => get_theme_file_uri( 'assets/css/woocommerce.css' ),
					'ver'    => FLEXIA_VERSION,
				) );
			}
		}
		foreach ( $styles as $block => $variations ) {
			foreach ( $variations as $name => $label ) {
				register_block_style( $block, array( 'name' => $name, 'label' => $label ) );
			}
		}
	}
}
add_action( 'init', 'flexia_register' );

// Keep the harmless legacy helper for existing child themes during migration.
require_once FLEXIA_DIR_PATH . '/includes/compatibility.php';
