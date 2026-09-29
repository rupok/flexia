<?php
/**
 * Optional Elementor Pro Theme Builder compatibility.
 *
 * @package Flexia
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'flexia_elementor_header_footer_template' ) ) {
	/**
	 * Let Elementor render Theme Builder header and footer templates itself.
	 *
	 * Elementor Pro prints header and footer documents from get_header() and
	 * get_footer(), which block templates never call. Left to Flexia's single
	 * template, the editor preview has no header/footer container and stops on
	 * "the content area was not found". Only locations Elementor registered on
	 * the theme's behalf ('overwrite') are handed back, so a child theme or
	 * plugin that registers its own header/footer location keeps control.
	 *
	 * @param bool   $need_override     Whether Elementor overrides the theme template.
	 * @param string $location          Theme Builder location of the viewed template.
	 * @param object $locations_manager Elementor Pro locations manager.
	 * @return bool
	 */
	function flexia_elementor_header_footer_template( $need_override, $location, $locations_manager = null ) {
		if ( $need_override || ! in_array( $location, array( 'header', 'footer' ), true ) || ! is_object( $locations_manager ) || ! method_exists( $locations_manager, 'get_location' ) ) {
			return $need_override;
		}
		$settings = $locations_manager->get_location( $location );
		return ! empty( $settings['overwrite'] );
	}
}
add_filter( 'elementor/theme/need_override_location', 'flexia_elementor_header_footer_template', 10, 3 );
