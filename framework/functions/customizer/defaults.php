<?php
/**
 *
 * @package Flexia
 */

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;


if ( ! function_exists( 'flexia_get_option_defaults' ) ) :
/**
 * Set default options
 */
function flexia_get_option_defaults() {

	$flexia_defaults = array(
		'body_font_color' => '#4d4d4d',
		'site_link_color' => '#F56A6A',
		'site_link_hover_color' => '#ff5544',
		'body_font_family' => 'Open Sans',
		'heading_font_family' => 'Open Sans',
		'heading1_font_size' => '2',
		'heading2_font_size' => '1.5',
		'heading3_font_size' => '1.17',
		'heading4_font_size' => '1',
		'heading5_font_size' => '.83',
		'heading6_font_size' => '.75',
		'container_width' => '90',
		'flexia_page_header_layout' => 'flexia_page_header_default',
		'flexia_page_breadcrumb' => true,
		'flexia_page_title_heading' => 'Color & Typography',
		'flexia_page_title_bg' => '',
		'flexia_page_title_font_color' => '#202021',
		'flexia_page_title_font_size' => '36',
		'flexia_breadcrumb_font_size' => '12',
		'flexia_breadcrumb_font_color' => '#7e7e7e',
		'flexia_breadcrumb_active_font_color' => '#222222',
		'post_width' => '90',
		'container_max_width' => '1200',
		'post_max_width' => '1200',
		'left_sidebar_width' => '300',
		'right_sidebar_width' => '300',
		'blog_bg_color' => '#f9f9f9',
		'post_content_bg_color' => '#fff',
		'post_meta_bg_color' => '#fff',
		'sidebar_widget_bg_color' => '#fff',
		'flexia_header_logo_width' => '150',
		'flexia_blog_bg_heading' => '',
		'blog_logo_width' => '150',
		'blog_title_font_size' => '54',
		'blog_desc_font_size' => '18',
		'header_widget_area_bg_color' => '#262625',
		'flexia_topbar_bg_color' => '#262625',
		'flexia_logobar_bg_color' => '#fff',
		'flexia_navbar_bg_color' => '#fff',
		'flexia_nav_menu_link_color' => '#4d4d4d',
		'flexia_nav_menu_link_hover_color' => '#1b1f21',
		'flexia_submenu_bg_color' => '#fff',
		'flexia_submenu_link_color' => '#4d4d4d',
		'flexia_submenu_link_hover_color' => '#1b1f21',
		'footer_widget_area_bg_color' => '#fff',
		'flexia_footer_bg_color' => '#262625',
		'flexia_footer_content_color' => '#CBCED3',
		'flexia_footer_link_color' => '#F56A6A',
		'flexia_footer_link_hover_color' => '#E65A50',
		'content_layout' => 'content_layout1',
		'typography_settings_title_body' => '',
		'body_font_size' => '16',
		'typography_settings_title_heading' => '',
		'typography_settings_title_links' => '',
		'post_navigation' => false,
		'post_author' => false,
		'post_social_share' => false,
		'scroll_bottom_arrow' => false,
		'show_blog_logo' => 'blog_logo_none',
		'blog_icon_class' => 'fa-pencil',
		'blog_logo' => '',
		'blog_title' => '',
		'blog_desc' => '',
		'flexia_blog_content_display' => 'flexia_blog_content_display_full',
		'flexia_single_posts_layout' => 'flexia_single_posts_layout_large',
		'single_post_settings_title_heading' => '',
		'flexia_single_posts_settings' => '',
		'flexia_social_sharing_text' => 'Share This Story',
		'post_social_share_facebook' => true,
		'post_social_share_twitter' => true,
		'post_social_share_linkedin' => true,
		'post_social_share_gplus' => true,
		'post_social_share_pinterest' => true,
		'flexia_blog_excerpt_count' => '60',
		'flexia_navbar' => false,
		'flexia_navbar_position' => 'flexia-navbar-static-top',
		'flexia_logobar_position' => 'flexia-logobar-inline',
		'flexia_nav_menu_search' => true,
		'flexia_woo_cart_menu' => false,
		'flexia_enable_topbar' => false,
		'flexia_enable_topbar_menu' => false,
		'flexia_overlay_search_bg_color' => '#121738',
		'flexia_overlay_search_border_color' => '#121738',
		'flexia_overlay_search_border_width' => '10',
		'flexia_overlay_search_heading' => '',
		'flexia_overlay_search_close_btn_heading' => '',
		'flexia_overlay_search_close_btn_color' => '#fff',
		'flexia_overlay_search_close_btn_hover_color' => '#fff',
		'flexia_overlay_search_close_btn_size' => '50',
		'flexia_overlay_search_field_font_size' => '48',
		'flexia_overlay_search_field_font_color' => '#fff',
		'flexia_overlay_search_label_font_size' => '16',
		'flexia_overlay_search_label_font_color' => '#fff',
		'header_widget_area' => false,
		'footer_widget_area' => false,
		'footer_bottom' => false,
		'flexia_enable_footer_menu' => false,
		'flexia_scroll_to_top' => false,
		'flexia_footer_content' => 'Copyright 2017 | Flexia by Codetic',

	);
	
	return apply_filters( 'flexia_option_defaults', $flexia_defaults );
}
endif;


/**
*  Get default customizer option
*/
if ( ! function_exists( 'flexia_get_option' ) ) :

	/**
	 * Get default customizer option
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function flexia_get_option( $key ) {

		$default_options = flexia_get_option_defaults();

		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array)get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;
	}

endif;