<?php
/**
 *
 * @package Flexia
 */

// No direct access, please
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('flexia_site_primary_color')) {
    function flexia_site_primary_color() {
        $primary_color = '#F56A6A';
        $primary_color = get_theme_mod( 'flexia_primary_color', $primary_color );
        return $primary_color;
    }
}

if (!function_exists('flexia_get_option_defaults')) {
/**
 * Set default options
 */
    function flexia_get_option_defaults()
    {
        $primary_color = flexia_site_primary_color();
        $flexia_defaults = array(
            'flexia_primary_color' => $primary_color,
            'flexia_default_text_color' => '#4d4d4d',
            'flexia_default_heading_color' => '#333333',
            'flexia_link_separator_label' => '',
            'flexia_link_color' => $primary_color,
            'flexia_link_hover_color' => '#ff5544',
            'flexia_background_separator_label' => '',
            'flexia_background_color' => '#fff',
            'flexia_background_image_enable_button' => '',
            'flexia_background_image' => '',
            'flexia_background_property' => '',
            'flexia_background_image_size' => 'auto',
            'flexia_background_image_position' => 'center center',
            'flexia_background_image_repeat' => 'no-repeat',          
            'flexia_background_image_attachment' => 'inherit',            

            'flexia_body_font_size' => '16',
            'flexia_body_font_line_height' => '1.4',
            'flexia_body_font_family' => 'Open Sans',
            'flexia_body_font_variants' => 'Regular 400',
            'flexia_body_font_subsets' => 'Open Sans',
            'flexia_body_font_text_transform' => 'none',

            'flexia_paragraph_font_size' => '1',
            'flexia_paragraph_font_line_height' => '1.4',
            'flexia_paragraph_font_family' => 'Open Sans',
            'flexia_paragraph_font_variants' => 'Regular 400',
            'flexia_paragraph_font_subsets' => 'Open Sans',
            'flexia_paragraph_font_text_transform' => 'none',

            'flexia_heading_font_family' => 'Open Sans',
            'flexia_heading_font_variants' => 'Regular 400',
            'flexia_heading_font_subsets' => 'Open Sans',
            'flexia_heading_font_text_transform' => 'none',
            'flexia_heading_font_line_height' => '1.4',
            'flexia_heading1_font_size' => '2',
            'flexia_heading2_font_size' => '1.5',
            'flexia_heading3_font_size' => '1.17',
            'flexia_heading4_font_size' => '1',
            'flexia_heading5_font_size' => '.83',
            'flexia_heading6_font_size' => '.75',

            'flexia_link_font_size' => '1',
            'flexia_link_font_line_height' => '1',
            'flexia_link_font_family' => 'Open Sans',
            'flexia_link_font_variants' => 'Regular 400',
            'flexia_link_font_subsets' => 'Open Sans',
            'flexia_link_font_text_transform' => 'none',

            'flexia_button_text_color' => '#fff',
            'flexia_button_background_color' => $primary_color,
            'flexia_button_font_size' => '1',
            'flexia_button_font_line_height' => '1.4',
            'flexia_button_font_family' => 'Open Sans',
            'flexia_button_font_variants' => 'Regular 400',
            'flexia_button_font_subsets' => 'Open Sans',
            'flexia_button_font_text_transform' => 'none',

            'flexia_header_layout_type' => 'boxed',
            'flexia_navbar_position' => 'flexia-navbar-static-top',
            'flexia_header_layouts' => '1',
            'flexia_header_mobile_layouts' => 'flexia_header_mobile_layouts_1',            

            'flexia_primary_logo_label' => '',
            'flexia_sticky_logo_label' => '',
            'flexia_custom_sticky_logo' => '',
            'flexia_header_logo_width' => '180',
            'flexia_sticky_header_logo_width' => '150',

            'flexia_enable_header_social' => false,
            'flexia_header_social' => '',
            'flexia_header_social_position' => 'topbar',
            'flexia_header_social_alignment' => 'right',
            'flexia_header_social_icon_size' => '1',
            'flexia_header_social_icon_color' => 'inherit',
            'flexia_header_social_icon_hover_color' => 'inherit',
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
            
            'flexia_container_width' => '90',
            'flexia_page_header_layout' => 'flexia_page_header_default',
            'flexia_page_header' => true,
            'flexia_page_breadcrumb' => true,
            'flexia_page_title_heading' => 'Color & Typography',
            'flexia_page_title_bg' => '#28292e',
            'flexia_page_title_font_color' => '#333333',
            'flexia_page_title_font_size' => '36',
            'flexia_breadcrumb_font_size' => '12',
            'flexia_breadcrumb_font_color' => '#fefefe',
            'flexia_breadcrumb_active_font_color' => '#ffffff',
            'flexia_post_width' => '90',
            'flexia_container_max_width' => '1200',
            'flexia_post_max_width' => '1200',
            'flexia_sidebar_width_left' => '30',
            'flexia_sidebar_width_right' => '30',
            'flexia_blog_bg_color' => '#F2F3F6',
            'flexia_post_content_bg_color' => '#fff',
            'flexia_post_meta_bg_color' => '#fff',
            'flexia_sidebar_widget_bg_color' => '#fff',
            'flexia_blog_bg_heading' => '',
            'flexia_blog_logo_width' => '150',
            'flexia_blog_title_font_size' => '54',
            'flexia_blog_title_font_color' => '#ffffff',
            'flexia_blog_desc_font_size' => '28',
            'flexia_blog_desc_font_color' => '#ffffff',
            'flexia_blog_header_title_font_family' => 'Poppins',
            'flexia_blog_header_desc_font_family' => 'Nunito',
            'flexia_header_widget_area_bg_color' => '#262625',
            'flexia_topbar_bg_color' => $primary_color,
            'flexia_logobar_bg_color' => '#fff',
            'flexia_navbar_bg_color' => '#fff',
            'flexia_navbar_padding' => array(
                'input1'  	=> 0,
                'input2'  	=> 15,
                'input3'  	=> 0,
                'input4'  	=> 15,
                'data_unit' => 'px'
            ),
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

            'flexia_footer_widget_area' => false,
            'flexia_footer_widget_column' => 'four-column',
            'flexia_footer_widget_area_bg_color' => '#313131',
            'flexia_footer_widget_area_content_color' => '#cfcfcf',
            'flexia_footer_widget_area_link_color' => '#cbced3',
            'flexia_footer_widget_area_link_hover_color' => '#ff5544',
            'flexia_footer_bg_color' => '#262625',
            'flexia_footer_content_color' => '#9a9a9a',
            'flexia_footer_link_color' => '#ffffff',
            'flexia_footer_link_hover_color' => '#E65A50',
            'content_layout' => 'content_layout4',
            'typography_settings_title_body' => '',
            'typography_settings_title_heading' => '',
            'post_navigation' => false,
            'post_author' => false,
            'post_social_share' => false,
            'show_blog_header' => true,
            'flexia_blog_header_bg_color' => '#612ee9',
            'show_blog_logo' => 'blog_logo_none',
            'blog_logo' => '',
            'blog_title' => '',
            'blog_desc' => '',
            'flexia_blog_content_display' => 'flexia_blog_content_display_excerpt',
            'flexia_single_posts_layout' => 'flexia_single_posts_layout_large',
            'flexia_single_content_layout' => 'content_layout4',
            'single_post_settings_title_heading' => '',
            'flexia_single_posts_settings' => '',
            'flexia_social_sharing_text' => __('Share This Story','flexia'),
            'post_social_share_facebook' => true,
            'post_social_share_twitter' => true,
            'post_social_share_linkedin' => true,
            'post_social_share_gmail' => true,
            'post_social_share_pinterest' => true,
            'post_social_share_reddit' => true,
            'post_social_share_blogger' => true,
            'post_social_share_thumblr' => true,
            'flexia_blog_excerpt_count' => '60',

            'flexia_blog_content_layout' => 'flexia_blog_content_layout_grid',
            'flexia_blog_grid_column' => '3',
            'flexia_blog_per_page' => 10,
            'flexia_blog_load_more' => true,
            'flexia_blog_load_more_text' => 'Load More',
            'flexia_blog_loading_text' => 'Loading...',
            'flexia_load_more_btn_font_size' => '14',
            'flexia_load_more_btn_bg' => '#444',
            'flexia_load_more_font_color' => '#fff',
            'flexia_load_more_btn_bg_active' => '#27bdbd',
            'flexia_load_more_font_color_active' => '#fff',
            
            'flexia_navbar' => true,
            'flexia_logobar_position' => 'flexia-logobar-inline',
            'flexia_nav_menu_search' => true,
            'flexia_woo_cart_menu' => false,
            'flexia_enable_login_button' => false,
            'flexia_custom_login_url' => '',

            'flexia_enable_topbar' => false,
            'flexia_enable_topbar_on_mobile' => false,
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
            'flexia_header_widget_area' => false,
            'footer_bottom' => true,
            'flexia_enable_footer_menu' => true,
            'flexia_scroll_to_top' => false,
            'flexia_footer_content' => '&copy; Flexia ' . date('Y') . '. All right reserved by Codetic.',
            'flexia_create_sidebar_name' => '',

            'flexia_woo_sidebar_default' => 'woo-sidebar',
            'flexia_woo_sidebar_shop_page' => true,
            'flexia_woo_sidebar_product_single' => false,
            'flexia_woo_sidebar_cart_page' => false,
            'flexia_woo_sidebar_checkout_page' => false,
            'flexia_woo_sidebar_archive_page' => true,

            'flexia_call_to_action_enable' => false, 
            'flexia_call_to_action_layout' => '1',
            'flexia_call_to_action_title' => 'Write Your Title here',
            'flexia_call_to_action_subtitle' => 'Write Your Subtitle here. Leave empty for not showing',
            'flexia_call_to_action_button_text' => 'Learn More',
            'flexia_call_to_action_url' => get_site_url(),

            // archive page header settings
            'flexia_show_archive_header' => true,
            'flexia_archive_header_bg_color' => '#612ee9',
            'flexia_archive_title_font_size' => '54',
            'flexia_archive_title_font_color' => '#ffffff',
            'flexia_archive_header_title_font_family' => 'Poppins',
            'flexia_archive_desc_font_size' => '28',
            'flexia_archive_desc_font_color' => '#ffffff',
            'flexia_archive_header_desc_font_family' => 'Nunito',
            // archive page content settings
            'flexia_archive_content_display' => 'flexia_blog_content_display_excerpt',
            'flexia_archive_excerpt_count' => 60,
            'flexia_archive_content_layout' => 'flexia_blog_content_layout_grid',
            'flexia_archive_per_page' => 10,
            'flexia_archive_grid_column' => 3,
            'flexia_archive_load_more' => true,
            'flexia_archive_load_more_text' => __('Load More','flexia'),
            'flexia_archive_loading_text' => __('Loading...','flexia'),
            'flexia_archive_load_more_btn_font_size' => 14,
            'flexia_archive_load_more_btn_bg' => '#444444',
            'flexia_archive_load_more_font_color' => '#ffffff',
            'flexia_archive_load_more_btn_bg_active' => '#27bdbd',
            'flexia_archive_load_more_font_color_active' => '#ffffff',
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

        $default = flexia_get_option_defaults();
        $default_value = $default[$key];
        $theme_options = get_theme_mod( $key, $default_value );

		return $theme_options;
	}

endif;


if( ! function_exists( 'flexia_generate_defaults' ) ) : 

	function flexia_generate_defaults(){

		$default_options = flexia_get_option_defaults();

		$returned = [];

		foreach( $default_options as $key => $option ) {
            $returned[ $key ] = get_theme_mod($key, $default_options[ $key ]);
            if (empty($returned[ $key ])) {
                $returned[ $key ] = $default_options[ $key ];
            }
		}

		return $returned;

	}

endif;

if( ! function_exists( 'flexia_dimension_attr_generator' ) ) :
    function flexia_dimension_attr_generator($key, $measure = 'px', $important = false) {
        
        $important = $important ? ' !important' : '';
        $saved_options = get_theme_mods();
        if( is_array($saved_options) && array_key_exists( $key, $saved_options ) ) {
            $valueArr = (array) json_decode(flexia_get_option($key));
        } else {
            $default = flexia_get_option_defaults();
            $valueArr = $default[$key];
        }

        $dimensionArr = [];
        $dimensionAttr = '';
        $input1 = '';
        $input2 = '';
        $input3 = '';
        $input4 = '';
        $measure = isset($valueArr['data_unit']) ? $valueArr['data_unit'] : $measure;
        
        if ( $valueArr['input1'] !== '' ) {
            $input1 = $valueArr['input1'] . $measure;
        } else {
            $input1 = '0' . $measure;
        }
        if ( $input1 !== '' ) {
            $dimensionArr[] = $input1;
        }
        
        if ( $valueArr['input2'] !== '' ) {
            $input2 = $valueArr['input2'] . $measure;
        } else {
            $input2 = '0' . $measure;
        }
        if ( $input2 !== '' ) {
            $dimensionArr[] = $input2;
        }
        
        if ( $valueArr['input3'] !== '' ) {
            $input3 = $valueArr['input3'] . $measure;
        } else {
            $input3 = '0' . $measure;
        }
        if ( $input3 !== '' ) {
            $dimensionArr[] = $input3;
        }
        
        if ( $valueArr['input4'] !== '' ) {
            $input4 = $valueArr['input4'] . $measure;
        } else {
            $input4 = '0' . $measure;
        }
        if ( $input4 !== '' ) {
            $dimensionArr[] = $input4;
        }

        if ( count($dimensionArr) > 0 ) {
            $dimensionAttr = "padding: " . implode(' ', $dimensionArr) . $important . ";";
        }
        
        return $dimensionAttr;
    }
endif;