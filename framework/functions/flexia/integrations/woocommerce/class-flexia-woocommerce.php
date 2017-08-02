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
			add_filter( 'woocommerce_breadcrumb_defaults',          array( $this, 'change_breadcrumb_delimiter' ) );
			add_action( 'woocommerce_before_shop_loop_item_title',  array( $this, 'product_secondary_thumbnail' ), 11 );
			add_filter( 'post_class', 								array( $this, 'product_has_gallery' ) );

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

		/**
		 * Flip image on hover
		 */

		public function product_has_gallery( $classes ) {
			global $product;

			$post_type = get_post_type( get_the_ID() );

			if ( ! is_admin() ) {

				if ( $post_type == 'product' ) {

					$attachment_ids = $this->get_gallery_image_ids( $product );

					if ( $attachment_ids ) {
						$classes[] = 'product-has-gallery';
					}
				}
			}

			return $classes;
		}


		/**
		 * Frontend functions
		 */
		public function product_secondary_thumbnail() {
			global $product, $woocommerce;

			$attachment_ids = $this->get_gallery_image_ids( $product );

			if ( $attachment_ids ) {
				$attachment_ids     = array_values( $attachment_ids );
				$secondary_image_id = $attachment_ids['0'];

				$secondary_image_alt = get_post_meta( $secondary_image_id, '_wp_attachment_image_alt', true );
				$secondary_image_title = get_the_title($secondary_image_id);

				echo wp_get_attachment_image(
					$secondary_image_id,
					'shop_catalog',
					'',
					array(
						'class' => 'secondary-image attachment-shop-catalog wp-post-image wp-post-image--secondary',
						'alt' => $secondary_image_alt,
						'title' => $secondary_image_title
					)
				);
			}
		}


		/**
		 * WooCommerce Compatibility Functions
		 */
		public function get_gallery_image_ids( $product ) {
			if ( ! is_a( $product, 'WC_Product' ) ) {
				return;
			}

			if ( is_callable( 'WC_Product::get_gallery_image_ids' ) ) {
				return $product->get_gallery_image_ids();
			} else {
				return $product->get_gallery_attachment_ids();
			}
		}


	}

endif;

return new Flexia_WooCommerce();
