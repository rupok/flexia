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
    wp_enqueue_script('flexia-navigation', get_template_directory_uri() . '/framework/assets/site/js/navigation.js', array(), '', true);
    wp_enqueue_script('flexia-skip-link-focus-fix', get_template_directory_uri() . '/framework/assets/site/js/skip-link-focus-fix.js', array(), '', true);

    wp_enqueue_script('flexia-body-js', get_template_directory_uri() . '/framework/assets/site/js/flexia-body.js', array('jquery'), '', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
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
function flexia_customizer_condition() {
    wp_enqueue_script( 'flexia-customize-condition',
    get_template_directory_uri() . '/framework/assets/admin/js/customizer-condition.js',
        array(),
        true
    );
}
add_action( 'customize_controls_enqueue_scripts', 'flexia_customizer_condition' );

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
        'body_google_font' => get_theme_mod('body_font_family', true),
        'body_font_variants' => get_theme_mod('body_font_variants', true),
        'body_font_subsets' => get_theme_mod('body_font_subsets', true),
        'heading_google_font' => get_theme_mod('heading_font_family', true),
        'heading_font_variants' => get_theme_mod('heading_font_variants', true),
        'heading_font_subsets' => get_theme_mod('heading_font_subsets', true),
    );

    wp_localize_script('flexia-admin', 'flexia_settings', $flexia_settings);
}
add_action('admin_enqueue_scripts', 'flexia_admin_js');
