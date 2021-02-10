<?php

// No direct access, please
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Flexia scripts
 *
 * @package Flexia
 */

/**
 * Enqueue scripts and styles.
 */

function flexia_site_scripts()
{

    wp_enqueue_script('jquery');

    if (FLEXIA_DEV_MODE == true) {
        wp_enqueue_script('flexia-navigation', get_template_directory_uri() . '/framework/assets/site/js/flexia-scripts.js', array(), '', true);
    } else {
        wp_enqueue_script('flexia-navigation', get_template_directory_uri() . '/framework/assets/site/js/flexia-scripts.min.js', array(), '', true);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    //Set localize Script to 'flexia-navigation'
    global $wp_query;

    $flexia_archive_per_page                = get_theme_mod('flexia_archive_per_page', 10);
    $flexia_archive_layout                  = get_theme_mod('flexia_archive_content_layout', 'flexia_archive_content_layout_grid');
    $flexia_archive_grid_cols               = get_theme_mod('flexia_archive_grid_column', 3);
    $flexia_archive_post_meta               = get_theme_mod('flexia_pro_archive_post_meta', 'meta-on-bottom');
    $flexia_archive_excerpt_count           = get_theme_mod('flexia_archive_excerpt_count', 30);
    $flexia_archive_magnific_popup          = get_theme_mod('flexia_pro_archive_image_popup', false);
    $flexia_archive_show_load_more          = get_theme_mod('flexia_archive_load_more', true);
    $flexia_archive_load_more_text          = get_theme_mod('flexia_archive_load_more_text', __('Load More','flexia'));
    $flexia_archive_loading_text            = get_theme_mod('flexia_archive_loading_text', __('Loading...','flexia'));

    $flexia_blog_per_page           = get_theme_mod('flexia_blog_per_page', 10);
    $flexia_blog_layout             = get_theme_mod('flexia_blog_content_layout', 'flexia_blog_content_layout_grid');
    $flexia_blog_grid_cols          = get_theme_mod('flexia_blog_grid_column', 3);
    $flexia_blog_post_meta          = get_theme_mod('flexia_blog_post_meta', 'meta-on-bottom');
    $flexia_blog_excerpt_count      = get_theme_mod('flexia_blog_excerpt_count', 30);
    $flexia_magnific_popup          = get_theme_mod('flexia_blog_image_popup', false);
    $flexia_show_filter             = get_theme_mod('flexia_blog_filterable', false);
    $flexia_show_load_more          = get_theme_mod('flexia_blog_load_more', true);
    $flexia_load_more_text          = get_theme_mod('flexia_blog_load_more_text',  __('Load More','flexia'));
    $flexia_loading_text            = get_theme_mod('flexia_blog_loading_text', __('Loading...','flexia'));
    $flexia_blog_categories         = get_theme_mod('flexia_blog_categories', '');

    $flexia_pro_active = "false";
    if (class_exists('Flexia_Pro')) {
        $flexia_pro_active = "true";
    }

    $tax_query_args = "";
    if (!empty($flexia_blog_categories)) {
        $tax_query_args = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $flexia_blog_categories,
        );
    }
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => array(
            $tax_query_args,
        ),
    );

    $posts = new WP_Query($args);
    $posts_count = $posts->post_count;


    /**
     * Passing Localized Values JS
     */
    $settings = [
        'ajax_url'             => admin_url('admin-ajax.php'),
        'blog_layout'         => $flexia_blog_layout,
        'masonry_grid_cols' => $flexia_blog_grid_cols,
        'post_meta_position' => $flexia_blog_post_meta,
        'per_page'            => $flexia_blog_per_page,
        'offset'             => $flexia_blog_per_page,
        'excerpt_count'     => $flexia_blog_excerpt_count,
        'posts_count'         => $posts_count,
        'magnific_popup'     => $flexia_magnific_popup,
        'show_filter'        => $flexia_show_filter,
        'show_load_more'    => $flexia_show_load_more,
        'load_more_text'    => $flexia_load_more_text,
        'loading_text'        => $flexia_loading_text,
        'selected_cats'        => $flexia_blog_categories,
        'is_pro_active'        => $flexia_pro_active,
        // archive
        'archive_layout' => $flexia_archive_layout,
        'archive_per_page' => $flexia_archive_per_page,
        'archive_masonry_grid_cols' => $flexia_archive_grid_cols,
        'archive_post_meta_position' => $flexia_archive_post_meta,
        'archive_excerpt_count' => $flexia_archive_excerpt_count,
        'archive_magnific_popup' => $flexia_archive_magnific_popup,
        'archive_show_load_more' => $flexia_archive_show_load_more,
        'archive_load_more_text' => $flexia_archive_load_more_text,
        'archive_loading_text' => $flexia_archive_loading_text,
        'query_vars' => wp_json_encode( $wp_query->query ),
        'archive_total_page' => $wp_query->max_num_pages,
        'archive_count' => 2,
        'archive_nonce' => wp_create_nonce('flexia-archive-load-more-nonce'),
    ];
    wp_localize_script('flexia-navigation', 'settings', $settings);
}
add_action('wp_enqueue_scripts', 'flexia_site_scripts');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function flexia_customize_preview_js()
{
    wp_enqueue_script('flexia-customizer', get_template_directory_uri() . '/framework/assets/admin/js/customizer.js', array('customize-preview'), '', true);
    wp_localize_script('flexia-customizer', 'object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('flexia-customizer')
    ));
}
add_action('customize_preview_init', 'flexia_customize_preview_js');

/**
 * Conditional Logic on Customizer Preview
 */
function flexia_customizer_condition()
{
    wp_enqueue_style(
        'flexia-customizer-style',
        get_template_directory_uri() . '/framework/assets/admin/css/customizer-style.css'
    );
    wp_enqueue_style(
        'flexia-extend-customizer-style',
        get_template_directory_uri() . '/framework/assets/admin/css/extend-customizer.css'
    );
    // add customizer custom panel/section js
    wp_enqueue_script(
        'flexia-extend-customizer',
        get_theme_file_uri('/framework/assets/admin/js/extend-customizer.js'),
        array(),
        '1.0',
        true
    );
    wp_enqueue_script(
        'flexia-customize-condition',
        get_template_directory_uri() . '/framework/assets/admin/js/customizer-condition.js',
        array(),
        true
    );
    wp_enqueue_script(
        'flexia-customizer-dependency',
        get_template_directory_uri() . '/framework/assets/admin/js/customizer-dependency.js',
        array('customize-preview'),
        true
    );
    $config = array(
        // header layout
        'flexia_navbar_position' => array('flexia_header_layouts', '!=', 'pro-1'),
        // page settings
        'flexia_page_breadcrumb' => array('flexia_page_header', '==', true),
        'flexia_page_header_layout' => array('flexia_page_header', '==', true),
        'flexia_page_title_heading' => array('flexia_page_header', '==', true),
        'flexia_page_title_bg' => array('flexia_page_header', '==', true),
        'flexia_page_title_font_color' => array('flexia_page_header', '==', true),
        'flexia_page_title_font_size' => array('flexia_page_header', '==', true),
        'flexia_breadcrumb_font_size' => array('flexia_page_header', '==', true),
        'flexia_breadcrumb_font_color' => array('flexia_page_header', '==', true),
        'flexia_breadcrumb_active_font_color' => array('flexia_page_header', '==', true),
        // Navbar Settings
        'flexia_logobar_position' => array('flexia_navbar', '==', true),
        'flexia_logobar_bg_color' => array('flexia_navbar', '==', true),
        'flexia_navbar_bg_color' => array('flexia_navbar', '==', true),
        'flexia_navbar_padding' => array('flexia_navbar', '==', true),
        'main_nav_settings_title' => array('flexia_navbar', '==', true),
        'flexia_nav_menu_search' => array('flexia_navbar', '==', true),
        'flexia_woo_cart_menu' => array('flexia_navbar', '==', true),
        'flexia_custom_login_url' => array('flexia_woo_cart_menu', '==', true),
        'flexia_enable_login_button' => array('flexia_navbar', '==', true),
        'flexia_main_nav_menu_link_color' => array('flexia_navbar', '==', true),
        'flexia_main_nav_menu_link_hover_color' => array('flexia_navbar', '==', true),
        'flexia_main_nav_menu_link_hover_bg' => array('flexia_navbar', '==', true),
        'flexia_main_nav_menu_submenu_bg_color' => array('flexia_navbar', '==', true),
        'flexia_main_nav_menu_submenu_link_color' => array('flexia_navbar', '==', true),
        'flexia_main_nav_menu_submenu_link_hover_color' => array('flexia_navbar', '==', true),
        'flexia_main_nav_menu_submenu_link_hover_bg' => array('flexia_navbar', '==', true),
        'flexia_main_nav_menu_dropdown_animation' => array('flexia_navbar', '==', true),
        'flexia_custom_login_url' => array('flexia_enable_login_button', '==', true),
        //Header Widget Area
        'flexia_header_widget_area_bg_color' => array('flexia_header_widget_area', '==', true),
        // Top bar
        'flexia_enable_topbar_on_mobile' => array('flexia_enable_topbar', '==', true),
        'flexia_topbar_bg_color' => array('flexia_enable_topbar', '==', true),
        'flexia_topbar_content' => array('flexia_enable_topbar', '==', true),
        'top_contact_settings_title' => array('flexia_enable_topbar', '==', true),
        'flexia_header_top_phone' => array('flexia_enable_topbar', '==', true),
        'flexia_header_top_email' => array('flexia_enable_topbar', '==', true),
        'flexia_header_top_location' => array('flexia_enable_topbar', '==', true),
        'flexia_header_top_location_link' => array('flexia_enable_topbar', '==', true),
        'flexia_header_top_contact_font_size' => array('flexia_enable_topbar', '==', true),
        'flexia_header_top_contact_font_color' => array('flexia_enable_topbar', '==', true),
        'flexia_header_top_contact_font_hover_color' => array('flexia_enable_topbar', '==', true),
        'top_nav_settings_title' => array('flexia_enable_topbar', '==', true),
        'flexia_enable_topbar_menu' => array('flexia_enable_topbar', '==', true),
        'flexia_top_nav_menu_link_color' => array('flexia_enable_topbar_menu', '==', true),
        'flexia_top_nav_menu_link_hover_color' => array('flexia_enable_topbar_menu', '==', true),
        'flexia_top_nav_menu_link_hover_bg' => array('flexia_enable_topbar_menu', '==', true),
        'flexia_top_nav_menu_submenu_bg_color' => array('flexia_enable_topbar_menu', '==', true),
        'flexia_top_nav_menu_submenu_link_color' => array('flexia_enable_topbar_menu', '==', true),
        'flexia_top_nav_menu_submenu_link_hover_color' => array('flexia_enable_topbar_menu', '==', true),
        'flexia_top_nav_menu_submenu_link_hover_bg' => array('flexia_enable_topbar_menu', '==', true),
        'flexia_top_nav_menu_dropdown_animation' => array('flexia_enable_topbar_menu', '==', true),
        // Header Social
        'flexia_header_social_position' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_alignment' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_icon_size' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_icon_color' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_icon_hover_color' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_open_tab' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_link_separator' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_link_facebook' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_link_instagram' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_link_twitter' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_link_linkedin' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_link_youtube' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_link_pinterest' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_link_reddit' => array('flexia_enable_header_social', '==', true),
        'flexia_header_social_link_rss' => array('flexia_enable_header_social', '==', true),
        // blog content load more
        'flexia_blog_load_more_text' => array('flexia_blog_load_more', '==', true),
        'flexia_blog_loading_text' => array('flexia_blog_load_more', '==', true),
        'flexia_load_more_btn_font_size' => array('flexia_blog_load_more', '==', true),
        'flexia_load_more_btn_bg' => array('flexia_blog_load_more', '==', true),
        'flexia_load_more_font_color' => array('flexia_blog_load_more', '==', true),
        'flexia_load_more_btn_bg_active' => array('flexia_blog_load_more', '==', true),
        'flexia_load_more_font_color_active' => array('flexia_blog_load_more', '==', true),
        // blog header
        'flexia_blog_header_bg_color' => array('show_blog_header', '==', true),
        'show_blog_logo' => array('show_blog_header', '==', true),
        'blog_logo' => array('show_blog_logo', '==', 'blog_logo_image'),
        'flexia_blog_logo_width' => array('show_blog_logo', '==', 'blog_logo_image'),
        'blog_title' => array('show_blog_header', '==', true),
        'flexia_blog_title_font_size' => array('show_blog_header', '==', true),
        'flexia_blog_title_font_color' => array('show_blog_header', '==', true),
        'flexia_blog_header_title_font_family' => array('show_blog_header', '==', true),
        'blog_desc' => array('show_blog_header', '==', true),
        'flexia_blog_desc_font_size' => array('show_blog_header', '==', true),
        'flexia_blog_desc_font_color' => array('show_blog_header', '==', true),
        'flexia_blog_header_desc_font_family' => array('show_blog_header', '==', true),
        // archive header
        'flexia_archive_header_bg_color' => array('flexia_show_archive_header', '==', true),
        'flexia_show_archive_logo' => array('flexia_show_archive_header', '==', true),
        'flexia_archive_logo' => array('flexia_show_archive_logo', '==', 'archive_logo_image'),
        'flexia_archive_logo_width' => array('flexia_show_archive_logo', '==', 'archive_logo_image'),
        'flexia_archive_title' => array('flexia_show_archive_header', '==', true),
        'flexia_archive_title_font_size' => array('flexia_show_archive_header', '==', true),
        'flexia_archive_title_font_color' => array('flexia_show_archive_header', '==', true),
        'flexia_archive_header_title_font_family' => array('flexia_show_archive_header', '==', true),
        'flexia_archive_desc' => array('flexia_show_archive_header', '==', true),
        'flexia_archive_desc_font_size' => array('flexia_show_archive_header', '==', true),
        'flexia_archive_desc_font_color' => array('flexia_show_archive_header', '==', true),
        'flexia_archive_header_desc_font_family' => array('flexia_show_archive_header', '==', true),
        // archive content settings
        'flexia_archive_excerpt_count' => array('flexia_archive_content_display', '==', 'flexia_blog_content_display_excerpt'),
        'flexia_archive_per_page' => array('flexia_archive_content_layout', '!=', 'flexia_blog_content_layout_standard'),
        'flexia_archive_grid_column' => array('flexia_archive_content_layout', '!=', 'flexia_blog_content_layout_standard'),
        'flexia_archive_load_more_text' => array('flexia_archive_load_more', '==', true),
        'flexia_archive_loading_text' => array('flexia_archive_load_more', '==', true),
        'flexia_archive_load_more_btn_font_size' => array('flexia_archive_load_more', '==', true),
        'flexia_archive_load_more_btn_bg' => array('flexia_archive_load_more', '==', true),
        'flexia_archive_load_more_font_color' => array('flexia_archive_load_more', '==', true),
        'flexia_archive_load_more_btn_bg_active' => array('flexia_archive_load_more', '==', true),
        'flexia_archive_load_more_font_color_active' => array('flexia_archive_load_more', '==', true),
        // single post social sharing
        'flexia_social_sharing_text' => array('post_social_share', '==', false),
        'post_social_share_facebook' => array('post_social_share', '==', false),
        'post_social_share_twitter' => array('post_social_share', '==', false),
        'post_social_share_linkedin' => array('post_social_share', '==', false),
        'post_social_share_gmail' => array('post_social_share', '==', false),
        'post_social_share_pinterest' => array('post_social_share', '==', false),
        'post_social_share_reddit' => array('post_social_share', '==', false),
        'post_social_share_blogger' => array('post_social_share', '==', false),
        'post_social_share_thumblr' => array('post_social_share', '==', false),
        // call to action
        'flexia_call_to_action_layout' => array('flexia_call_to_action_enable', '==', true),
        'flexia_call_to_action_title' => array('flexia_call_to_action_enable', '==', true),
        'flexia_call_to_action_subtitle' => array('flexia_call_to_action_enable', '==', true),
        'flexia_call_to_action_button_text' => array('flexia_call_to_action_enable', '==', true),
        'flexia_call_to_action_url' => array('flexia_call_to_action_enable', '==', true),
        // footer widget area
        'flexia_footer_widget_column' => array('flexia_footer_widget_area', '==', true),
        'flexia_footer_widget_area_bg_color' => array('flexia_footer_widget_area', '==', true),
        'flexia_footer_widget_area_bg_color' => array('flexia_footer_widget_area', '==', true),
        'flexia_footer_widget_area_content_color' => array('flexia_footer_widget_area', '==', true),
        'flexia_footer_widget_area_link_color' => array('flexia_footer_widget_area', '==', true),
        'flexia_footer_widget_area_link_hover_color' => array('flexia_footer_widget_area', '==', true),
        // footer bottom area
        'flexia_enable_footer_menu' => array('footer_bottom', '==', true),
        'flexia_footer_bg_color' => array('footer_bottom', '==', true),
        'flexia_footer_content_color' => array('footer_bottom', '==', true),
        'flexia_footer_link_color' => array('footer_bottom', '==', true),
        'flexia_footer_link_hover_color' => array('footer_bottom', '==', true),
        'flexia_footer_content' => array('footer_bottom', '==', true),
    );
    wp_localize_script('flexia-customizer-dependency', 'config', apply_filters('flexia_customizer_dependency', $config));
}
add_action('customize_controls_enqueue_scripts', 'flexia_customizer_condition');

/**
 * Admin Script
 */
function flexia_admin_js()
{
    wp_enqueue_script('flexia-admin', get_template_directory_uri() . '/framework/assets/admin/js/admin.js', array('jquery'), '', true);

    $flexia_settings = array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'flexia_blog_content_display' => get_theme_mod('flexia_blog_content_display', true),
        'flexia_navbar' => get_theme_mod('flexia_navbar', true),
        'flexia_enable_topbar' => get_theme_mod('flexia_enable_topbar', false),
        'body_google_font' => get_theme_mod('flexia_body_font_family', true),
        'flexia_body_font_variants' => get_theme_mod('flexia_body_font_variants', true),
        'flexia_body_font_subsets' => get_theme_mod('flexia_body_font_subsets', true),
        'paragraph_google_font' => get_theme_mod('flexia_paragraph_font_family', true),
        'flexia_paragraph_font_variants' => get_theme_mod('flexia_paragraph_font_variants', true),
        'flexia_paragraph_font_subsets' => get_theme_mod('flexia_paragraph_font_subsets', true),
        'heading_google_font' => get_theme_mod('flexia_heading_font_family', true),
        'flexia_heading_font_variants' => get_theme_mod('flexia_heading_font_variants', true),
        'flexia_heading_font_subsets' => get_theme_mod('flexia_heading_font_subsets', true),
        'link_google_font' => get_theme_mod('flexia_link_font_family', true),
        'flexia_link_font_variants' => get_theme_mod('flexia_link_font_variants', true),
        'flexia_link_font_subsets' => get_theme_mod('flexia_link_font_subsets', true),
        'button_google_font' => get_theme_mod('flexia_button_font_family', true),
        'flexia_button_font_variants' => get_theme_mod('flexia_button_font_variants', true),
        'flexia_button_font_subsets' => get_theme_mod('flexia_button_font_subsets', true),
        'flexia_blog_content_layout' => get_theme_mod('flexia_blog_content_layout', 'flexia_blog_content_layout_standard'),
    );

    wp_localize_script('flexia-admin', 'flexia_settings', $flexia_settings);
}
add_action('admin_enqueue_scripts', 'flexia_admin_js');
