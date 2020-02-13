<?php

// No direct access, please
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Some Definition
 */
define('FLEXIA_DEV_MODE', true);

/**
 * Flexia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Flexia
 */

if (!function_exists('flexia_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function flexia_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Flexia, use a find and replace
         * to change 'flexia' to the name of your theme in all the template files.
         */
        load_theme_textdomain('flexia', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        add_image_size('flexia-featured-image', 2000, 1200, true);

        add_image_size('flexia-thumbnail-avatar', 100, 100, true);
        /*
         * This theme styles the visual editor to resemble the theme style
         */
        add_editor_style(get_template_directory() . '/framework/assets/admin/css/editor-style.css');

        /**
         * Register primary menu
         */
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'flexia'),
            'topbar-menu' => esc_html__('Topbar Menu', 'flexia'),
            'footer-menu' => esc_html__('Footer Menu', 'flexia'),
        ));

        /**
         * Add search box to header navigation
         */

        function flexia_nav_search($items)
        {
            $flexia_nav_menu_search = get_theme_mod('flexia_nav_menu_search', true);

            if ($flexia_nav_menu_search == true ) {
                $items .= '<li class="menu-item navbar-search-menu"> <a id="btn-search" href="javascript:void(0);">';
                $items .= '<i class="fa fa-search" aria-hidden="true"></i></a></li>';
            }
            return $items;
        }
        add_filter('flexia_header_icon_items', 'flexia_nav_search', 98, 1);
        $header_layouts = get_theme_mod('flexia_header_layouts');
        if( in_array($header_layouts, array(4 ) ) ){
            add_filter('wp_nav_menu_items', 'flexia_nav_search', 98, 2);
        }

        /**
         * Enable support for Post Formats
         */
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'status', 'chat'));

        /**
         * Enable support for WooCommerce
         */
        add_theme_support('woocommerce');

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('flexia_custom_background_args', array(
            'default-color' => 'f9f9f9',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 80,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));

    }
}
add_action('after_setup_theme', 'flexia_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function flexia_content_width()
{
    $GLOBALS['content_width'] = apply_filters('flexia_content_width', 640);
}
add_action('after_setup_theme', 'flexia_content_width', 0);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Styles and Scripts enqueues.
 */

require get_template_directory() . '/framework/functions/enqueue/styles.php';
require get_template_directory() . '/framework/functions/enqueue/scripts.php';

/**
 * Widgets.
 */

require get_template_directory() . '/framework/functions/flexia/widgets.php';

/**
 * Flexia Nav Walker.
 */

require get_template_directory() . '/framework/functions/flexia/flexia-edit-nav-menu-walker.php';
require get_template_directory() . '/framework/functions/flexia/flexia-extra-menu-field.php';
require get_template_directory() . '/framework/functions/flexia/flexia-nav-walker.php';

/**
 * Breadcrumbs.
 */

require get_template_directory() . '/framework/functions/flexia/breadcrumb.php';

/**
 * Integrations.
 */

if (class_exists('WooCommerce')) {
    require get_template_directory() . '/framework/functions/flexia/integrations/woocommerce/woocommerce-integration.php';
    require get_template_directory() . '/framework/functions/flexia/integrations/woocommerce/class-flexia-woocommerce.php';
}

if (class_exists('Easy_Digital_Downloads')) {
    require get_template_directory() . '/framework/functions/flexia/integrations/edd/edd-integration.php';
}

/**
 * Customizer additions.
 */

require get_template_directory() . '/framework/functions/customizer/defaults.php';
require get_template_directory() . '/framework/functions/customizer/customizer.php';

// Admin functionalities
if (is_admin()) {
    require_once get_template_directory() . '/admin/admin.php';
    
    new Flexia_Admin();
}

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/********* Google Fonts URL function  ***********/

if (!function_exists('flexia_fonts_url')) {
    function flexia_fonts_url()
    {
        $fonts_url = '';
        $content_font = get_theme_mod('flexia_body_font_family', '');
        $content_font_variant = get_theme_mod('flexia_body_font_variants', '');
        $content_font_subset = get_theme_mod('flexia_body_font_subsets', '');

        $header_font = get_theme_mod('flexia_heading_font_family', '');
        $header_font_variant = get_theme_mod('flexia_heading_font_variants', '');
        $header_font_subset = get_theme_mod('flexia_heading_font_subsets', '');

        if ('off' !== $content_font || 'off' !== $header_font) {
            $font_families = array();

            if ('off' !== $content_font) {
                $font_families[] = $content_font . ':' . $content_font_variant . '&amp;' . $content_font_subset;
            }

            if ('off' !== $header_font) {
                $font_families[] = $header_font . ':' . $header_font_variant . '&amp;' . $header_font_subset;
            }

            $query_args = array(
                'family' => urlencode(implode('|', array_unique($font_families))),
            );

            $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
        }

        return esc_url_raw($fonts_url);
    }
}

// Mute admin notice
function flexia_nag_ignore()
{
    if (isset($_GET['flexia_nag_ignore']) && $_GET['flexia_nag_ignore'] == '0') {
        update_user_meta(get_current_user_id(), 'flexia_ignore_notice006', true);
    }
}
add_action('admin_init', 'flexia_nag_ignore');

// Flexia admin notices
function flexia_admin_notices()
{
    if (!class_exists('Flexia_Core')) {
        if (current_user_can('install_plugins')) {
            $flexia_admin_notice_text = __('Thanks for using <strong>Flexia!</strong> We have added lots of cool features through <strong>Flexia Core</strong> and we recommend to keep the plugin active for maximum features.<a href="%1$s" style="text-decoration: none;"><span class="dashicons dashicons-admin-plugins" style="margin-top: -1px;margin-left: 10px;"></span> Install Plugin</a><a href="%2$s" style="text-decoration: none; margin-left: 10px;"><span class="dashicons dashicons-dismiss"></span> Dismiss</a>', 'flexia');

            if (!get_user_meta(get_current_user_id(), 'flexia_ignore_notice006', true)) {
                echo '<div class="flexia-admin-notice updated"><p>'
                . sprintf(
                    $flexia_admin_notice_text,
                    admin_url('admin.php?page=flexia-recommended-plugins'),
                    admin_url('admin.php?page=flexia-recommended-plugins&flexia_nag_ignore=0')
                ) .
                '</p></div>';
            }
        }
    }
}
add_action('admin_notices', 'flexia_admin_notices');
