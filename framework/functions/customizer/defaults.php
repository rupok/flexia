<?php
/**
 *
 * @package Flexia
 */

// No direct access, please
if (!defined('ABSPATH')) {
    exit;
}


if (!function_exists('flexia_get_option_defaults')) {
/**
 * Set default options
 */
    function flexia_get_option_defaults()
    {
        $primary_color = '#F56A6A';
        $secondary_color = '#333333';
        $flexia_defaults = array(
            'site_primary_color' => $primary_color,
            'site_secondary_color' => $secondary_color,
            'default_text_color' => '#4d4d4d',
            'default_heading_color' => '#333333',
            'link_separator_label' => '',
            'site_link_color' => $primary_color,
            'site_link_hover_color' => '#ff5544',
            'background_separator_label' => '',
            'site_background_color' => '#fff',
            'site_background_image_enable_button' => '',
            'site_background_image' => '',
            'site_background_property' => '',
            'site_background_image_size' => 'auto',
            'site_background_image_position' => 'center center',
            'site_background_image_repeat' => 'no-repeat',          
            'site_background_image_attachment' => 'inherit',            

            'body_font_size' => '16',
            'body_font_line_height' => '1.4',
            'body_font_family' => 'Open Sans',
            'body_font_variants' => 'Regular 400',
            'body_font_subsets' => 'Open Sans',
            'body_font_text_transform' => 'none',

            'paragraph_font_size' => '1',
            'paragraph_font_line_height' => '1.4',
            'paragraph_font_family' => 'Open Sans',
            'paragraph_font_variants' => 'Regular 400',
            'paragraph_font_subsets' => 'Open Sans',
            'paragraph_font_text_transform' => 'none',

            'heading_font_family' => 'Open Sans',
            'heading_font_variants' => 'Regular 400',
            'heading_font_subsets' => 'Open Sans',
            'heading_font_text_transform' => 'none',
            'heading_font_line_height' => '1.4',
            'heading1_font_size' => '2',
            'heading2_font_size' => '1.5',
            'heading3_font_size' => '1.17',
            'heading4_font_size' => '1',
            'heading5_font_size' => '.83',
            'heading6_font_size' => '.75',

            'link_font_size' => '1',
            'link_font_line_height' => '1',
            'link_font_family' => 'Open Sans',
            'link_font_variants' => 'Regular 400',
            'link_font_subsets' => 'Open Sans',
            'link_font_text_transform' => 'none',

            'button_text_color' => '#fff',
            'button_background_color' => '#333',
            'button_font_size' => '1',
            'button_font_line_height' => '1.4',
            'button_font_family' => 'Open Sans',
            'button_font_variants' => 'Regular 400',
            'button_font_subsets' => 'Open Sans',
            'button_font_text_transform' => 'none',

            'header_layout_type' => 'boxed',
            'flexia_navbar_position' => 'flexia-navbar-static-top',
            'header_layouts' => '1',
            'header_mobile_layouts' => 'layout1',            

            'primary_logo_label' => '',
            'sticky_logo_label' => '',
            'custom_sticky_logo' => '',
            'flexia_header_logo_width' => '150',
            'flexia_sticky_header_logo_width' => '120',

            'flexia_enable_header_social' => false,
            'flexia_header_social' => '',
            'flexia_header_social_position' => 'topbar',
            'flexia_header_social_alignment' => 'right',
            'flexia_header_social_icon_size' => '1',
            'flexia_header_social_icon_color' => $primary_color,
            'flexia_header_social_icon_hover_color' => $secondary_color,
            'flexia_header_social_open_tab' => '_blank',
            'flexia_header_social_link_separator' => '',
            'flexia_header_social_link_facebook' => '',
            'flexia_header_social_link_instagram' => '',
            'flexia_header_social_link_twitter' => '',
            'flexia_header_social_link_linkedin' => '',
            'flexia_header_social_link_youtube' => '',
            'flexia_header_social_link_pinterest' => '',
            'flexia_header_social_link_reddit' => '',
            'flexia_header_social_link_rss' => '',
            
            'container_width' => '90',
            'flexia_page_header_layout' => 'flexia_page_header_default',
            'flexia_page_header' => true,
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
            'flexia_blog_bg_heading' => '',
            'blog_logo_width' => '150',
            'blog_title_font_size' => '54',
            'blog_desc_font_size' => '18',
            'header_widget_area_bg_color' => '#262625',
            'flexia_topbar_bg_color' => '#262625',
            'flexia_logobar_bg_color' => '#fff',
            'flexia_navbar_bg_color' => '#fff',
            'flexia_main_nav_menu_link_color' => '#4d4d4d',
            'flexia_main_nav_menu_link_hover_color' => '#1b1f21',
            'flexia_main_nav_menu_link_hover_bg' => '#ffffff',
            'flexia_main_nav_menu_submenu_bg_color' => '#ffffff',
            'flexia_main_nav_menu_submenu_link_color' => '#4d4d4d',
            'flexia_main_nav_menu_submenu_link_hover_color' => '#1b1f21',
            'flexia_main_nav_menu_submenu_link_hover_bg' => '#f4f4f4',
            'flexia_main_nav_menu_dropdown_animation' => 'to-top',
            'flexia_top_nav_menu_link_color' => '#cbced3',
            'flexia_top_nav_menu_link_hover_color' => '#ffffff',
            'flexia_top_nav_menu_link_hover_bg' => 'rgba(0, 0, 0, 0.5)',
            'flexia_top_nav_menu_submenu_bg_color' => '#262625',
            'flexia_top_nav_menu_submenu_link_color' => '#cbced3',
            'flexia_top_nav_menu_submenu_link_hover_color' => '#ffffff',
            'flexia_top_nav_menu_submenu_link_hover_bg' => 'rgba(0, 0, 0, 0.5)',
            'flexia_top_nav_menu_dropdown_animation' => 'to-top',

            'footer_widget_area' => false,
            'footer_widget_column' => 'four-column',
            'footer_widget_area_bg_color' => '#313131',
            'footer_widget_area_content_color' => '#cfcfcf',
            'footer_widget_area_link_color' => '#cbced3',
            'footer_widget_area_link_hover_color' => '#ff5544',
            'flexia_footer_bg_color' => '#262625',
            'flexia_footer_content_color' => '#9a9a9a',
            'flexia_footer_link_color' => '#ffffff',
            'flexia_footer_link_hover_color' => '#E65A50',
            'content_layout' => 'content_layout1',
            'typography_settings_title_body' => '',
            'typography_settings_title_heading' => '',
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
            'flexia_navbar' => true,
            'flexia_logobar_position' => 'flexia-logobar-inline',
            'flexia_nav_menu_search' => true,
            'flexia_woo_cart_menu' => false,

            'flexia_enable_topbar' => false,
            'flexia_enable_topbar_menu' => false,
            'flexia_header_top_phone' => '',
            'flexia_header_top_email' => '',
            'flexia_header_top_location' => '',
            'flexia_header_top_location_link' => '',
            'flexia_header_top_contact_font_size' => '.8',
            'flexia_header_top_contact_font_color' => '#ffffff',
            'flexia_header_top_contact_font_hover_color' => '#eeeeee',

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
            'footer_bottom' => true,
            'flexia_enable_footer_menu' => true,
            'flexia_scroll_to_top' => false,
            'flexia_footer_content' => '&copy; Flexia 2019. All right reserved by Codetic.',

        );

        return apply_filters('flexia_option_defaults', $flexia_defaults);
    }
}

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

        if ( empty( $key ) ) {
			return;
        }

        $value = null;
        $default = flexia_get_option_defaults();
        $default_value = $default[$key];
        $theme_options = get_theme_mod( $key, $default_value );

		return $theme_options;
	}

endif;


if( ! function_exists( 'flexia_generate_defaults' ) ) : 

	function flexia_generate_defaults(){

		$default_options = flexia_get_option_defaults();
		$saved_options = get_theme_mods();

		$returned = [];

		if( ! $saved_options ) {
			return;
		}

		foreach( $default_options as $key => $option ) {
			if( array_key_exists( $key, $saved_options ) ) {
				$returned[ $key ] = get_theme_mod( $key );				
			} else {
				switch ( $key ) {
					default:
						$returned[ $key ] = $default_options[ $key ];
						break;
				}
			}
		}

		return $returned;

	}

endif;
