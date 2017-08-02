<?php
/**
 * Flexia WooCommerce Class
 *
 * @package  flexia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Flexia_WooCommerce' ) ) :

	/**
	 * The Storefront WooCommerce Integration class
	 */
	class Flexia_WooCommerce {

		/**
		 * Setup class.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
			add_filter( 'woocommerce_product_thumbnails_columns', 	array( $this, 'thumbnail_columns' ) );
			add_filter( 'loop_shop_columns', 						array( $this, 'shop_columns' ) );
			add_filter( 'loop_shop_per_page', 						array( $this, 'products_per_page' ) );
			add_filter( 'woocommerce_breadcrumb_defaults',          array( $this,'change_breadcrumb_delimiter' ) );

		}

		/**
		 * Related Products Args
		 */
		public function related_products_args( $args ) {
			$args = apply_filters( 'flexia_related_products_args', array(
				'posts_per_page' => 4,
				'columns'        => 4,
			) );

			return $args;
		}

		/**
		 * Product gallery thumnail columns
		 *
		 * @return integer number of columns
		 *
		 */
		public function shop_columns() {
			$columns = 4;

			return intval( apply_filters( 'flexia_shop_product_columns', $columns ) );
		}

		/**
		 * Product gallery thumnail columns
		 *
		 * @return integer number of columns
		 * 
		 */
		public function thumbnail_columns() {
			$columns = 4;

			return intval( apply_filters( 'flexia_product_thumbnail_columns', $columns ) );
		}


		/**
		 * Products per page
		 * @return integer number of numbers
		 */
		public function products_per_page() {
			return intval( apply_filters( 'flexia_products_per_page', 12 ) );
		}


		/**
		 * Remove the breadcrumb delimiter
		 */
		public function change_breadcrumb_delimiter( $defaults ) {
			$defaults['delimiter'] = '<span class="breadcrumb-separator"> <i class="fa fa-angle-right" aria-hidden="true"></i></span>';
			return $defaults;
		}


	}

endif;

return new Flexia_WooCommerce();
