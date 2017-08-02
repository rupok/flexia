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
		 * @since 1.0
		 */
		public function __construct() {
			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
			add_filter( 'woocommerce_product_thumbnails_columns', 	array( $this, 'thumbnail_columns' ) );
			add_filter( 'loop_shop_columns', 						array( $this, 'shop_columns' ) );
			add_filter( 'loop_shop_per_page', 						array( $this, 'products_per_page' ) );
			add_filter( 'woocommerce_breadcrumb_defaults',          array( $this,'change_breadcrumb_delimiter' ) );

			if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.5', '<' ) ) {
				add_action( 'wp_footer', 							array( $this, 'star_rating_script' ) );
			}

			// Integrations.
			add_action( 'customize_save_after',                     array( $this, 'set_storefront_style_theme_mods' ) );
		}


		/**
		 * Star rating backwards compatibility script (WooCommerce <2.5).
		 *
		 * @since 1.6.0
		 */
		public function star_rating_script() {
			if ( wp_script_is( 'jquery', 'done' ) && is_product() ) {
		?>
			<script type="text/javascript">
				jQuery( function( $ ) {
					$( 'body' ).on( 'click', '#respond p.stars a', function() {
						var $container = $( this ).closest( '.stars' );
						$container.addClass( 'selected' );
					});
				});
			</script>
		<?php
			}
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
		 * @since  1.0.0
		 */
		public function shop_columns() {
			$columns = 4;


			return intval( apply_filters( 'flexia_shop_product_columns', $columns ) );
		}

		/**
		 * Product gallery thumnail columns
		 *
		 * @return integer number of columns
		 * @since  1.0.0
		 */
		public function thumbnail_columns() {
			$columns = 4;


			return intval( apply_filters( 'flexia_product_thumbnail_columns', $columns ) );
		}


		/**
		 * Products per page
		 */
		public function products_per_page() {
			return intval( apply_filters( 'flexia_products_per_page', 12 ) );
		}


		/**
		 * Remove the breadcrumb delimiter
		 */
		public function change_breadcrumb_delimiter( $defaults ) {
			$defaults['delimiter'] = '<span class="breadcrumb-separator"> <i class="fa fa-angle-right" aria-hidden="true"></i>
 </span>';
			return $defaults;
		}


		/**
		 * Get extension css.
		 *
		 * @see get_flexia_theme_mods()
		 * @return array $styles the css
		 */
		public function get_woocommerce_extension_css() {
			$flexia_customizer = new Storefront_Customizer();
			$flexia_theme_mods = $flexia_customizer->get_flexia_theme_mods();

			$woocommerce_extension_style 				= '';

			if ( $this->is_woocommerce_extension_activated( 'WC_Bookings' ) ) {
				$woocommerce_extension_style 					.= '
				.wc-bookings-date-picker .ui-datepicker td.bookable a {
					background-color: ' . $flexia_theme_mods['accent_color'] . ' !important;
				}

				.wc-bookings-date-picker .ui-datepicker td.bookable-range .ui-state-default {
					background-color: ' . flexia_adjust_color_brightness( $flexia_theme_mods['accent_color'], -10 ) . ' !important;
				}
				';
			}

			if ( $this->is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' ) ) {
				$woocommerce_extension_style 					.= '
				.woocommerce #reviews .product-rating .product-rating-details table td.rating-graph .bar,
				.woocommerce-page #reviews .product-rating .product-rating-details table td.rating-graph .bar {
					background-color: ' . $flexia_theme_mods['text_color'] . ' !important;
				}

				.woocommerce #reviews .contribution-actions .feedback,
				.woocommerce-page #reviews .contribution-actions .feedback,
				.star-rating-selector:not(:checked) label.checkbox {
					color: ' . $flexia_theme_mods['text_color'] . ';
				}

				.woocommerce #reviews #comments ol.commentlist li .contribution-actions a,
				.woocommerce-page #reviews #comments ol.commentlist li .contribution-actions a,
				.star-rating-selector:not(:checked) input:checked ~ label.checkbox,
				.star-rating-selector:not(:checked) label.checkbox:hover ~ label.checkbox,
				.star-rating-selector:not(:checked) label.checkbox:hover,
				.woocommerce #reviews #comments ol.commentlist li .contribution-actions a,
				.woocommerce-page #reviews #comments ol.commentlist li .contribution-actions a,
				.woocommerce #reviews .form-contribution .attachment-type:not(:checked) label.checkbox:before,
				.woocommerce-page #reviews .form-contribution .attachment-type:not(:checked) label.checkbox:before {
					color: ' . $flexia_theme_mods['accent_color'] . ' !important;
				}';
			}

			if ( $this->is_woocommerce_extension_activated( 'WC_Smart_Coupons' ) ) {
				$woocommerce_extension_style 					.= '
				.coupon-container {
					background-color: ' . $flexia_theme_mods['button_background_color'] . ' !important;
				}

				.coupon-content {
					border-color: ' . $flexia_theme_mods['button_text_color'] . ' !important;
					color: ' . $flexia_theme_mods['button_text_color'] . ';
				}

				.sd-buttons-transparent.woocommerce .coupon-content,
				.sd-buttons-transparent.woocommerce-page .coupon-content {
					border-color: ' . $flexia_theme_mods['button_background_color'] . ' !important;
				}';
			}

			return apply_filters( 'flexia_customizer_woocommerce_extension_css', $woocommerce_extension_style );
		}
	}

endif;

return new Flexia_WooCommerce();
