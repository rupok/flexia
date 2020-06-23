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

    if( FLEXIA_DEV_MODE == true ) {
        wp_enqueue_script('flexia-navigation', get_template_directory_uri() . '/framework/assets/site/js/flexia-scripts.js', array(), '', true);
    } else {
        wp_enqueue_script('flexia-navigation', get_template_directory_uri() . '/framework/assets/site/js/flexia-scripts.min.js', array(), '', true);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    //Load Blog Scripts
    wp_enqueue_script('flexia-load-blog', get_template_directory_uri() . '/framework/assets/site/js/flexia-load-blogs.js', array(), '', true);

    //Set localize Script
    $flexia_blog_per_page 			= get_theme_mod( 'flexia_blog_per_page',		10 );
	$flexia_blog_layout 			= get_theme_mod( 'flexia_blog_content_layout', 'flexia_blog_content_layout_standard' );
	$flexia_blog_grid_cols 			= get_theme_mod( 'flexia_blog_grid_column', 	3 );
	$flexia_blog_post_meta 			= get_theme_mod( 'flexia_blog_post_meta', 		'meta-on-bottom' );
	$flexia_blog_excerpt_count 		= get_theme_mod( 'flexia_blog_excerpt_count', 	30 );
	$flexia_magnific_popup 			= get_theme_mod( 'flexia_blog_image_popup', 	true );
	$flexia_show_filter 			= get_theme_mod( 'flexia_blog_filterable', 		true );
	$flexia_show_load_more 			= get_theme_mod( 'flexia_blog_load_more', 		true );
	$flexia_load_more_text 			= get_theme_mod( 'flexia_blog_load_more_text', 	'Load More' );
	$flexia_loading_text 			= get_theme_mod( 'flexia_blog_loading_text', 	'Loading...' );
    $flexia_blog_categories			= get_theme_mod( 'flexia_blog_categories', 		'' );
    $flexia_pro_active = "false";
    if (class_exists( 'Flexia_Pro' )) {
        $flexia_pro_active = "true";
    }

    $tax_query_args = "";
	if ( !empty($flexia_blog_categories) ) {
		$tax_query_args = array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => $flexia_blog_categories,
		);
	}
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'tax_query' => array(
			$tax_query_args,
         ),
	);

	$posts = new WP_Query( $args );
	$posts_count = $posts->post_count;


	/**
	 * Passing Localized Values
	 */
	$settings = [
		'ajax_url' 			=> admin_url( 'admin-ajax.php' ),
		'blog_layout' 		=> $flexia_blog_layout,
		'masonry_grid_cols' => $flexia_blog_grid_cols,
		'post_meta_position' => $flexia_blog_post_meta,
		'per_page'			=> $flexia_blog_per_page,
		'offset' 			=> $flexia_blog_per_page,
		'excerpt_count' 	=> $flexia_blog_excerpt_count,
		'posts_count' 		=> $posts_count,
		'magnific_popup' 	=> $flexia_magnific_popup,
		'show_filter'		=> $flexia_show_filter,
		'show_load_more'	=> $flexia_show_load_more,
		'load_more_text'	=> $flexia_load_more_text,
		'loading_text'		=> $flexia_loading_text,
		'selected_cats'		=> $flexia_blog_categories,
		'is_pro_active'		=> $flexia_pro_active,
	];
	wp_localize_script( 'flexia-load-blog', 'settings', $settings );
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
    wp_enqueue_script(
        'flexia-customize-condition',
        get_template_directory_uri() . '/framework/assets/admin/js/customizer-condition.js',
        array(),
        true
    );
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
    );

    wp_localize_script('flexia-admin', 'flexia_settings', $flexia_settings);

    $settings = array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'flexia_blog_content_layout' => get_theme_mod( 'flexia_blog_content_layout', 'flexia_blog_content_layout_standard' ),
    );
    wp_localize_script( 'flexia-admin', 'customizer', $settings );
}
add_action('admin_enqueue_scripts', 'flexia_admin_js');
