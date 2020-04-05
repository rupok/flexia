<?php
/**
 * Elementor pro Compatibility with Theme File.
 *
 * @package Flexia
 */

namespace Elementor;

// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) || ! class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) {
	return;
}

namespace ElementorPro\Modules\ThemeBuilder\ThemeSupport;

use Elementor\TemplateLibrary\Source_Local;
use ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager;
use ElementorPro\Modules\ThemeBuilder\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Flexia Elementor Compatibility
 */
if ( ! class_exists( 'Flexia_Elementor_Pro' ) ) :

	/**
	 * Flexia Elementor Compatibility
	 *
	 * @since 2.0.1
	 */
	class Flexia_Elementor_Pro {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 2.0.1
		 * @return object Class object.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 2.0.1
		 */
		public function __construct() {
			// Add locations.
			add_action( 'elementor/theme/register_locations', array( $this, 'register_locations' ) );

			// Override theme templates.
			add_action( 'flexia_header', array( $this, 'do_header' ), 0 );
			add_action( 'flexia_footer', array( $this, 'do_footer' ), 0 );
			// add_action( 'astra_template_parts_content_top', array( $this, 'do_template_parts' ), 0 );

			// add_action( 'astra_entry_content_404_page', array( $this, 'do_template_part_404' ), 0 );

			// add_filter( 'post_class', array( $this, 'render_post_class' ), 99 );
			// // Override post meta.
			// add_action( 'wp', array( $this, 'override_meta' ), 0 );
		}

		/**
		 * Register Locations
		 *
		 * @since 2.0.1
		 * @param object $manager Location manager.
		 * @return void
		 */
		public function register_locations( $manager ) {
			$manager->register_all_core_location();
		}

		/**
		 * Header Support
		 *
		 * @since 2.0.1
		 * @return void
		 */
		public function do_header() {
			$did_location = Module::instance()->get_locations_manager()->do_location( 'header' );
			if ( $did_location ) {
				remove_action( 'flexia_header', 'flexia_add_header' );
			}
		}

		/**
		 * Footer Support
		 *
		 * @since 2.0.1
		 * @return void
		 */
		// public function do_footer() { 
		// 	$did_location = Module::instance()->get_locations_manager()->do_location( 'footer' );
		// 	if ( $did_location ) {
		// 		remove_action( 'astra_footer', 'astra_footer_markup' );
		// 	}
		// }

	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Flexia_Elementor_Pro::get_instance();

endif;
