<?php
// No direct access, please
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Flexia Theme Customizer
 *
 * @package Flexia
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

/**
 * Check for WP_Customizer_Control existence before adding custom control because WP_Customize_Control
 * is loaded on customizer page only
 *
 * @see _wp_customize_include()
 */

function flexia_customize_register($wp_customize)
{

    // Get default customizer values
    $defaults = flexia_get_option_defaults();

    // Load custom controls
    require_once get_template_directory() . '/framework/functions/customizer/controls.php';
    require_once get_template_directory() . '/framework/functions/customizer/sanitize.php';

    // Customize title and tagline sections and labels
    $wp_customize->get_section('title_tagline')->title = __('Site Name and Description', 'flexia');
    $wp_customize->get_control('blogname')->label = __('Site Name', 'flexia');
    $wp_customize->get_control('blogdescription')->label = __('Site Description', 'flexia');
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_control('header_textcolor')->label = __('Logo Text Color (if no logo image)', 'flexia');
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    // Customize the Front Page Settings
    $wp_customize->get_section('static_front_page')->title = __('Homepage Preferences', 'flexia');
    $wp_customize->get_section('static_front_page')->priority = 20;
    $wp_customize->get_control('show_on_front')->label = __('Choose Homepage Preference', 'flexia');
    $wp_customize->get_control('page_on_front')->label = __('Select Homepage', 'flexia');
    $wp_customize->get_control('page_for_posts')->label = __('Select Blog Homepage', 'flexia');

    // Customize Background Settings
    $wp_customize->get_section('background_image')->title = __('Background Styles', 'flexia');
    $wp_customize->get_control('background_color')->section = 'background_image';
    $wp_customize->get_control('header_textcolor')->section = 'flexia_header_settings';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector' => '.site-title a',
            'render_callback' => 'flexia_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector' => '.site-description',
            'render_callback' => 'flexia_customize_partial_blogdescription',
        ));
    }

    // Layout Settings

    $wp_customize->add_section('flexia_layout_settings', array(
        'title' => __('Layout', 'flexia'),
        'priority' => 20,
    ));

    $wp_customize->add_setting(
        'container_max_width',
        array(
            'default' => $defaults['container_max_width'],
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'flexia_sanitize_integer',
        )
    );

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'container_max_width', array(
        'type' => 'range-value',
        'section' => 'flexia_layout_settings',
        'settings' => 'container_max_width',
        'label' => __('Site Max Width (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 600,
            'max' => 2000,
            'step' => 5,
            'suffix' => 'px', //optional suffix
        ),
    )));

    $wp_customize->add_setting('container_width', array(
        'default' => $defaults['container_width'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'container_width', array(
        'type' => 'range-value',
        'section' => 'flexia_layout_settings',
        'settings' => 'container_width',
        'label' => __('Site Width (%)', 'flexia'),
        'input_attrs' => array(
            'min' => 50,
            'max' => 100,
            'step' => 1,
            'suffix' => '%', //optional suffix
        ),
    )));

    $wp_customize->add_setting(
        'content_layout',
        array(
            'default' => $defaults['content_layout'],
            'sanitize_callback' => 'flexia_sanitize_choices',
        ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'content_layout',
            array(
                'label' => __('Content Layout', 'flexia'),
                'section' => 'flexia_layout_settings',
                'settings' => 'content_layout',
                'description' => 'This settings will be reflected on blog page, single posts and archives. For pages, you can use page templates.',
                'type' => 'radio',
                'choices' => array(
                    'content_layout1' => __('Sidebar | Content | Sidebar', 'flexia'),
                    'content_layout2' => __('Sidebar | Content', 'flexia'),
                    'content_layout3' => __('Content | Sidebar', 'flexia'),
                    'content_layout4' => __('Content Only', 'flexia'),
                ),
            )
        )
    );

    $wp_customize->add_setting('left_sidebar_width', array(
        'default' => $defaults['left_sidebar_width'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'left_sidebar_width', array(
        'type' => 'range-value',
        'section' => 'flexia_layout_settings',
        'settings' => 'left_sidebar_width',
        'default' => '300',
        'label' => __('Left Sidebar Width (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 100,
            'max' => 500,
            'step' => 5,
            'suffix' => 'px', //optional suffix
        ),
    )));

    $wp_customize->add_setting('right_sidebar_width', array(
        'default' => $defaults['right_sidebar_width'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'right_sidebar_width', array(
        'type' => 'range-value',
        'section' => 'flexia_layout_settings',
        'settings' => 'right_sidebar_width',
        'default' => '300',
        'label' => __('Right Sidebar Width (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 100,
            'max' => 500,
            'step' => 5,
            'suffix' => 'px', //optional suffix
        ),
    )));

    // Design Settings : Background colors

    $wp_customize->add_setting('flexia_blog_bg_heading', array(
        'default' => $defaults['flexia_blog_bg_heading'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'flexia_blog_bg_heading', array(
        'label' => __('Page & Posts Backgrounds', 'flexia'),
        'settings' => 'flexia_blog_bg_heading',
        'section' => 'background_image',
    )));

    $wp_customize->add_setting('blog_bg_color', array(
        'default' => $defaults['blog_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'blog_bg_color',
            array(
                'label' => __('Blog Body Background', 'flexia'),
                'section' => 'background_image',
                'settings' => 'blog_bg_color',
            ))
    );

    $wp_customize->add_setting('post_content_bg_color', array(
        'default' => $defaults['post_content_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'post_content_bg_color',
            array(
                'label' => __('Page/Post Content Background', 'flexia'),
                'section' => 'background_image',
                'settings' => 'post_content_bg_color',
            ))
    );

    $wp_customize->add_setting('sidebar_widget_bg_color', array(
        'default' => $defaults['sidebar_widget_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'sidebar_widget_bg_color',
            array(
                'label' => __('Sidebar Widget Background', 'flexia'),
                'section' => 'background_image',
                'settings' => 'sidebar_widget_bg_color',
            ))
    );

    // Page Settings

    $wp_customize->add_section('flexia_page_settings', array(
        'title' => __('Page Settings', 'flexia'),
        'priority' => 90,
    ));

    $wp_customize->add_setting(
        'flexia_page_header_layout',
        array(
            'default' => $defaults['flexia_page_header_layout'],
            'sanitize_callback' => 'flexia_sanitize_choices',
        ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_page_header_layout',
            array(
                'label' => __('Page Header', 'flexia'),
                'section' => 'flexia_page_settings',
                'settings' => 'flexia_page_header_layout',
                'description' => 'Set the default page header layout (global). You can control for individual posts from Flexia Page Settings.',
                'type' => 'radio',
                'priority' => 10,
                'choices' => array(
                    'flexia_page_header_default' => __('Default Header', 'flexia'),
                    'flexia_page_header_large' => __('Large Header', 'flexia'),
                    'flexia_page_header_mini' => __('Mini Header', 'flexia'),
                ),
            )
        )
    );

    // Show breadcrumbs

    $wp_customize->add_setting('flexia_page_breadcrumb', array(
        'default' => $defaults['flexia_page_breadcrumb'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));
    $wp_customize->add_control(
        new Customizer_Toggle_Control(
            $wp_customize,
            'flexia_page_breadcrumb',
            array(
                'label' => esc_html__('Show Breadcrumbs?', 'flexia'),
                'section' => 'flexia_page_settings',
                'settings' => 'flexia_page_breadcrumb',
                'description' => 'Breadcrumb works on "Large Header" and "Mini Header"',
                'type' => 'light', // light, ios, flat
                'priority' => 20,
            )
        )
    );

    // Page title styles

    $wp_customize->add_setting('flexia_page_title_heading', array(
        'default' => $defaults['flexia_page_title_heading'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'flexia_page_title_heading', array(
        'label' => esc_html__('Color & Typography', 'flexia'),
        'settings' => 'flexia_page_title_heading',
        'section' => 'flexia_page_settings',
        'priority' => 30,
    )));

    $wp_customize->add_setting('flexia_page_title_bg', array(
        'default' => $defaults['flexia_page_title_bg'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_page_title_bg',
            array(
                'label' => __('Page Title Background Color', 'flexia'),
                'section' => 'flexia_page_settings',
                'settings' => 'flexia_page_title_bg',
                'priority' => 40,
            ))
    );

    $wp_customize->add_setting('flexia_page_title_font_color', array(
        'default' => $defaults['flexia_page_title_font_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_page_title_font_color',
            array(
                'label' => __('Page Title Font Color', 'flexia'),
                'section' => 'flexia_page_settings',
                'settings' => 'flexia_page_title_font_color',
                'priority' => 50,
            ))
    );

    $wp_customize->add_setting('flexia_page_title_font_size', array(
        'default' => $defaults['flexia_page_title_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_page_title_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_page_settings',
        'settings' => 'flexia_page_title_font_size',
        'priority' => 60,
        'label' => __('Page Title Font Size (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 15,
            'max' => 150,
            'step' => 1,
            'suffix' => 'px', //optional suffix
        ),
    )));

    $wp_customize->add_setting('flexia_breadcrumb_font_size', array(
        'default' => $defaults['flexia_breadcrumb_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_breadcrumb_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_page_settings',
        'settings' => 'flexia_breadcrumb_font_size',
        'priority' => 70,
        'label' => __('Breadcrumb Font Size (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 36,
            'step' => 1,
            'suffix' => 'px', //optional suffix
        ),
    )));

    $wp_customize->add_setting('flexia_breadcrumb_font_color', array(
        'default' => $defaults['flexia_breadcrumb_font_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_breadcrumb_font_color',
            array(
                'label' => __('Breadcrumb Font Color', 'flexia'),
                'section' => 'flexia_page_settings',
                'settings' => 'flexia_breadcrumb_font_color',
                'priority' => 80,
            ))
    );

    $wp_customize->add_setting('flexia_breadcrumb_active_font_color', array(
        'default' => $defaults['flexia_breadcrumb_active_font_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_breadcrumb_active_font_color',
            array(
                'label' => __('Breadcrumb Active Font Color', 'flexia'),
                'section' => 'flexia_page_settings',
                'settings' => 'flexia_breadcrumb_active_font_color',
                'priority' => 90,
            ))
    );

    // Design Settings : Overlay Search

    $wp_customize->add_section('flexia_overlay_search_settings', array(
        'title' => __('Overlay Search', 'flexia'),
        'priority' => 100,
    ));

    $wp_customize->add_setting('flexia_overlay_search_bg_color', array(
        'default' => $defaults['flexia_overlay_search_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_overlay_search_bg_color',
            array(
                'label' => __('Search Overlay Background Color', 'flexia'),
                'section' => 'flexia_overlay_search_settings',
                'settings' => 'flexia_overlay_search_bg_color',
            ))
    );

    $wp_customize->add_setting('flexia_overlay_search_border_color', array(
        'default' => $defaults['flexia_overlay_search_border_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_overlay_search_border_color',
            array(
                'label' => __('Search Overlay Border Color', 'flexia'),
                'section' => 'flexia_overlay_search_settings',
                'settings' => 'flexia_overlay_search_border_color',
            ))
    );

    $wp_customize->add_setting('flexia_overlay_search_border_width', array(
        'default' => $defaults['flexia_overlay_search_border_width'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_overlay_search_border_width', array(
        'type' => 'range-value',
        'section' => 'flexia_overlay_search_settings',
        'settings' => 'flexia_overlay_search_border_width',
        'label' => __('Search Overlay Border width (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
            'suffix' => 'px', //optional suffix
        ),
    )));

    // Search field Separator

    $wp_customize->add_setting('flexia_overlay_search_heading', array(
        'default' => $defaults['flexia_overlay_search_heading'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'flexia_overlay_search_heading', array(
        'label' => __('Search Field', 'flexia'),
        'settings' => 'flexia_overlay_search_heading',
        'section' => 'flexia_overlay_search_settings',
    )));

    $wp_customize->add_setting('flexia_overlay_search_field_font_color', array(
        'default' => $defaults['flexia_overlay_search_field_font_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_overlay_search_field_font_color',
            array(
                'label' => __('Search Field Font Color', 'flexia'),
                'section' => 'flexia_overlay_search_settings',
                'settings' => 'flexia_overlay_search_field_font_color',
            ))
    );

    $wp_customize->add_setting('flexia_overlay_search_field_font_size', array(
        'default' => $defaults['flexia_overlay_search_field_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_overlay_search_field_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_overlay_search_settings',
        'settings' => 'flexia_overlay_search_field_font_size',
        'label' => __('Search Field Font Size (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 15,
            'max' => 150,
            'step' => 1,
            'suffix' => 'px', //optional suffix
        ),
    )));

    $wp_customize->add_setting('flexia_overlay_search_label_font_color', array(
        'default' => $defaults['flexia_overlay_search_label_font_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_overlay_search_label_font_color',
            array(
                'label' => __('Label Font Color', 'flexia'),
                'section' => 'flexia_overlay_search_settings',
                'settings' => 'flexia_overlay_search_label_font_color',
            ))
    );

    $wp_customize->add_setting('flexia_overlay_search_label_font_size', array(
        'default' => $defaults['flexia_overlay_search_label_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_overlay_search_label_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_overlay_search_settings',
        'settings' => 'flexia_overlay_search_label_font_size',
        'label' => __('Label Font Size (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 10,
            'max' => 50,
            'step' => 1,
            'suffix' => 'px', //optional suffix
        ),
    )));

    // Close button Separator

    $wp_customize->add_setting('flexia_overlay_search_close_btn_heading', array(
        'default' => $defaults['flexia_overlay_search_close_btn_heading'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'flexia_overlay_search_close_btn_heading', array(
        'label' => __('Close Button', 'flexia'),
        'settings' => 'flexia_overlay_search_close_btn_heading',
        'section' => 'flexia_overlay_search_settings',
    )));

    $wp_customize->add_setting('flexia_overlay_search_close_btn_color', array(
        'default' => $defaults['flexia_overlay_search_close_btn_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_overlay_search_close_btn_color',
            array(
                'label' => __('Close Button Color', 'flexia'),
                'section' => 'flexia_overlay_search_settings',
                'settings' => 'flexia_overlay_search_close_btn_color',
            ))
    );

    $wp_customize->add_setting('flexia_overlay_search_close_btn_hover_color', array(
        'default' => $defaults['flexia_overlay_search_close_btn_hover_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_overlay_search_close_btn_hover_color',
            array(
                'label' => __('Close Button Hover Color', 'flexia'),
                'section' => 'flexia_overlay_search_settings',
                'settings' => 'flexia_overlay_search_close_btn_hover_color',
            ))
    );

    $wp_customize->add_setting('flexia_overlay_search_close_btn_size', array(
        'default' => $defaults['flexia_overlay_search_close_btn_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_overlay_search_close_btn_size', array(
        'type' => 'range-value',
        'section' => 'flexia_overlay_search_settings',
        'settings' => 'flexia_overlay_search_close_btn_size',
        'label' => __('Close Button Size (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 10,
            'max' => 100,
            'step' => 1,
            'suffix' => 'px', //optional suffix
        ),
    )));

    // Typography Settings

    $wp_customize->add_section('flexia_typography_settings', array(
        'title' => __('Color & Typography', 'flexia'),
        'priority' => 30,
    ));

    // Typograhpy Separator

    $wp_customize->add_setting('typography_settings_title_body', array(
        'default' => $defaults['typography_settings_title_body'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'typography_settings_title_body', array(
        'label' => __('Body & Content', 'flexia'),
        'settings' => 'typography_settings_title_body',
        'section' => 'flexia_typography_settings',
    )));

    $wp_customize->add_setting('body_font_color', array(
        'default' => $defaults['body_font_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'body_font_color',
            array(
                'label' => __('Body Font Color', 'flexia'),
                'section' => 'flexia_typography_settings',
                'settings' => 'body_font_color',
            ))
    );

    $wp_customize->add_setting('body_font_size', array(
        'default' => $defaults['body_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'body_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_settings',
        'settings' => 'body_font_size',
        'label' => __('Body Font Size (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 100,
            'step' => 1,
            'suffix' => 'px', //optional suffix
        ),
    )));

    // Body Font Setting

    $wp_customize->add_setting('body_font_family', array(
        'default' => $defaults['body_font_family'],
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Customizer_Select2_Google_Fonts(
        $wp_customize,
        'body_font_family',
        array(
            'label' => esc_html__('Body Font', 'flexia'),
            'section' => 'flexia_typography_settings',
            'settings' => 'body_font_family',
            'type' => 'select2_google_fonts',
            'choices' => flexia_google_fonts(),
        ))
    );

    $wp_customize->add_setting('body_font_variants', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'body_font_variants',
            array(
                'label' => __('Body Font Variants', 'flexia'),
                'section' => 'flexia_typography_settings',
                'settings' => 'body_font_variants',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    $wp_customize->add_setting('body_font_subsets', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'body_font_subsets',
            array(
                'label' => __('Body Font Subsets', 'flexia'),
                'section' => 'flexia_typography_settings',
                'settings' => 'body_font_subsets',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    // Heading separator

    $wp_customize->add_setting('typography_settings_title_heading', array(
        'default' => $defaults['typography_settings_title_heading'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'typography_settings_title_heading', array(
        'label' => __('Headings', 'flexia'),
        'settings' => 'typography_settings_title_heading',
        'section' => 'flexia_typography_settings',
    )));

    // Heading Font Setting

    $wp_customize->add_setting('heading_font_family', array(
        'default' => $defaults['body_font_family'],
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Customizer_Select2_Google_Fonts(
        $wp_customize,
        'heading_font_family',
        array(
            'label' => esc_html__('Heading Font', 'flexia'),
            'section' => 'flexia_typography_settings',
            'settings' => 'heading_font_family',
            'type' => 'select2_google_fonts',
            'choices' => flexia_google_fonts(),
        ))
    );

    $wp_customize->add_setting('heading_font_variants', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'heading_font_variants',
            array(
                'label' => __('Heading Font Variants', 'flexia'),
                'section' => 'flexia_typography_settings',
                'settings' => 'heading_font_variants',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    $wp_customize->add_setting('heading_font_subsets', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'heading_font_subsets',
            array(
                'label' => __('Heading Font Subsets', 'flexia'),
                'section' => 'flexia_typography_settings',
                'settings' => 'heading_font_subsets',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    $wp_customize->add_setting('heading1_font_size', array(
        'default' => $defaults['heading1_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'heading1_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_settings',
        'settings' => 'heading1_font_size',
        'label' => __('H1 Font Size (em)', 'flexia'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 10,
            'step' => .05,
            'suffix' => 'em', //optional suffix
        ),
    )));

    $wp_customize->add_setting('heading2_font_size', array(
        'default' => $defaults['heading2_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'heading2_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_settings',
        'settings' => 'heading2_font_size',
        'label' => __('H2 Font Size (em)', 'flexia'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 10,
            'step' => .05,
            'suffix' => 'em', //optional suffix
        ),
    )));

    $wp_customize->add_setting('heading3_font_size', array(
        'default' => $defaults['heading3_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'heading3_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_settings',
        'settings' => 'heading3_font_size',
        'label' => __('H3 Font Size (em)', 'flexia'),
        'input_attrs' => array(
            'min' => .5,
            'max' => 10,
            'step' => .05,
            'suffix' => 'em', //optional suffix
        ),
    )));

    $wp_customize->add_setting('heading4_font_size', array(
        'default' => $defaults['heading1_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'heading4_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_settings',
        'settings' => 'heading4_font_size',
        'label' => __('H4 Font Size (em)', 'flexia'),
        'input_attrs' => array(
            'min' => .1,
            'max' => 10,
            'step' => .01,
            'suffix' => 'em', //optional suffix
        ),
    )));

    $wp_customize->add_setting('heading5_font_size', array(
        'default' => $defaults['heading5_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'heading5_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_settings',
        'settings' => 'heading5_font_size',
        'label' => __('H5 Font Size (em)', 'flexia'),
        'input_attrs' => array(
            'min' => .1,
            'max' => 10,
            'step' => .01,
            'suffix' => 'em', //optional suffix
        ),
    )));

    $wp_customize->add_setting('heading6_font_size', array(
        'default' => $defaults['heading6_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'heading6_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_settings',
        'settings' => 'heading6_font_size',
        'label' => __('H6 Font Size (em)', 'flexia'),
        'input_attrs' => array(
            'min' => .1,
            'max' => 10,
            'step' => .01,
            'suffix' => 'em', //optional suffix
        ),
    )));

    // Site Links separator

    $wp_customize->add_setting('typography_settings_title_links', array(
        'default' => $defaults['typography_settings_title_links'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'typography_settings_title_links', array(
        'label' => __('Site Links', 'flexia'),
        'settings' => 'typography_settings_title_links',
        'section' => 'flexia_typography_settings',
    )));

    $wp_customize->add_setting('site_link_color', array(
        'default' => $defaults['site_link_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_link_color',
            array(
                'label' => __('Site Link Color', 'flexia'),
                'section' => 'flexia_typography_settings',
                'settings' => 'site_link_color',
            ))
    );

    $wp_customize->add_setting('site_link_hover_color', array(
        'default' => $defaults['site_link_hover_color'],
        // 'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_link_hover_color',
            array(
                'label' => __('Site Link Hover Color', 'flexia'),
                'section' => 'flexia_typography_settings',
                'settings' => 'site_link_hover_color',
            ))
    );

    // Blog Settings

    $wp_customize->add_section('flexia_blog_content_settings', array(
        'title' => __('Blog Content Settings', 'flexia'),
        'priority' => 10,
    ));

    $wp_customize->add_setting(
        'flexia_blog_content_display',
        array(
            'default' => $defaults['flexia_blog_content_display'],
            'sanitize_callback' => 'flexia_sanitize_choices',
        ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_blog_content_display',
            array(
                'label' => __('Content Display', 'flexia'),
                'section' => 'flexia_blog_content_settings',
                'settings' => 'flexia_blog_content_display',
                'priority' => 10,
                'description' => 'Set whether you want to show full post content or excerpt only on blog page.',
                'type' => 'radio',
                'choices' => array(
                    'flexia_blog_content_display_full' => __('Show Full Post Content', 'flexia'),
                    'flexia_blog_content_display_excerpt' => __('Show Excerpt only', 'flexia'),
                ),
            )
        )
    );

    $wp_customize->add_setting('flexia_blog_excerpt_count', array(
        'default' => $defaults['flexia_blog_excerpt_count'],
        'sanitize_callback' => 'flexia_sanitize_integer',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_blog_excerpt_count',
            array(
                'label' => __('Excerpt Count (words)', 'flexia'),
                'section' => 'flexia_blog_content_settings',
                'settings' => 'flexia_blog_excerpt_count',
                'type' => 'text',
                'priority' => 20,
            )
        )
    );

    $wp_customize->add_section('flexia_blog_header_settings', array(
        'title' => __('Blog Header Settings', 'flexia'),
        'priority' => 10,
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'blog_header_settings_title_heading', array(
        'label' => __('Blog Header style', 'flexia'),
        'settings' => 'blog_header_settings_title_heading',
        'section' => 'flexia_blog_header_settings',
    )));

    // Show scroll bottom anchor

    $wp_customize->add_setting('scroll_bottom_arrow', array(
        'default' => $defaults['scroll_bottom_arrow'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'scroll_bottom_arrow', array(
        'label' => esc_html__('Hide Scroll to bottom arrow?', 'flexia'),
        'section' => 'flexia_blog_header_settings',
        'settings' => 'scroll_bottom_arrow',
        'type' => 'light', // light, ios, flat
    )));

    // Blog logo/Icon

    $wp_customize->add_setting('show_blog_logo', array(
        'default' => $defaults['show_blog_logo'],
        'sanitize_callback' => 'flexia_sanitize_choices',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'show_blog_logo',
            array(
                'label' => __('Blog Logo / Icon', 'flexia'),
                'section' => 'flexia_blog_header_settings',
                'settings' => 'show_blog_logo',
                'description' => 'Set an icon or logo for blog home page.',
                'type' => 'select',
                'choices' => array(
                    'blog_icon' => __('Icon', 'flexia'),
                    'blog_logo_image' => __('Image', 'flexia'),
                    'blog_logo_none' => __('None', 'flexia'),
                ),
            )
        )
    );

    $wp_customize->add_setting('blog_icon_class', array(
        'default' => $defaults['blog_icon_class'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'blog_icon_class',
            array(
                'label' => __('Icon Class (Font Awesome)', 'flexia'),
                'section' => 'flexia_blog_header_settings',
                'settings' => 'blog_icon_class',
                'description' => 'Enter font awesome icon class (i.e. fa-pencil)',
                'type' => 'text',
            )
        )
    );

    $wp_customize->add_setting('blog_logo', array(
        'default' => $defaults['blog_logo'],
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'blog_logo',
            array(
                'label' => __('Upload a logo for blog', 'flexia'),
                'section' => 'flexia_blog_header_settings',
                'settings' => 'blog_logo',
                'context' => 'flexia_blog_logo',
            )
        )
    );

    $wp_customize->add_setting('blog_logo_width', array(
        'default' => $defaults['blog_logo_width'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'blog_logo_width',
            array(
                'label' => __('Blog Logo width (px)', 'flexia'),
                'section' => 'flexia_blog_header_settings',
                'settings' => 'blog_logo_width',
                'type' => 'text',
            )
        )
    );

    $wp_customize->add_setting('blog_title', array(
        'default' => $defaults['blog_title'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'blog_title',
            array(
                'label' => __('Blog Title', 'flexia'),
                'section' => 'flexia_blog_header_settings',
                'settings' => 'blog_title',
                'type' => 'text',
            )
        )
    );

    $wp_customize->add_setting('blog_title_font_size', array(
        'default' => $defaults['blog_title_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'blog_title_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_blog_header_settings',
        'settings' => 'blog_title_font_size',
        'label' => __('Blog Title Font Size (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 160,
            'step' => 1,
            'suffix' => 'px', //optional suffix
        ),
    )));

    $wp_customize->add_setting('blog_desc', array(
        'default' => $defaults['blog_desc'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'blog_desc',
            array(
                'label' => __('Blog Description', 'flexia'),
                'section' => 'flexia_blog_header_settings',
                'settings' => 'blog_desc',
                'type' => 'text',
            )
        )
    );

    $wp_customize->add_setting('blog_desc_font_size', array(
        'default' => $defaults['blog_desc_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'blog_desc_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_blog_header_settings',
        'settings' => 'blog_desc_font_size',
        'label' => __('Blog Description Font Size (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 72,
            'step' => 1,
            'suffix' => 'px', //optional suffix
        ),
    )));

    $wp_customize->add_section('flexia_single_posts_settings', array(
        'title' => __('Single Posts Settings', 'flexia'),
        'priority' => 20,
    ));

    $wp_customize->add_setting(
        'flexia_single_posts_layout',
        array(
            'default' => $defaults['flexia_single_posts_layout'],
            'sanitize_callback' => 'flexia_sanitize_choices',
        ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_single_posts_layout',
            array(
                'label' => __('Post Layout', 'flexia'),
                'section' => 'flexia_single_posts_settings',
                'settings' => 'flexia_single_posts_layout',
                'description' => 'Set the default post layout (global). You can control for individual posts from Flexia Post Settings.',
                'type' => 'radio',
                'choices' => array(
                    'flexia_single_posts_layout_large' => __('Large Header (Featured Image Background)', 'flexia'),
                    'flexia_single_posts_layout_simple' => __('Simple Header', 'flexia'),
                    'flexia_single_posts_layout_no_header' => __('No Header', 'flexia'),
                ),
            )
        )
    );

    $wp_customize->add_setting('post_meta_bg_color', array(
        'default' => $defaults['post_meta_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'post_meta_bg_color',
            array(
                'label' => __('Post Meta Background', 'flexia'),
                'section' => 'flexia_single_posts_settings',
                'settings' => 'post_meta_bg_color',
            ))
    );

    $wp_customize->add_setting('post_max_width', array(
        'default' => $defaults['post_max_width'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'post_max_width', array(
        'type' => 'range-value',
        'section' => 'flexia_single_posts_settings',
        'settings' => 'post_max_width',
        'label' => __('Post Max Width (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 600,
            'max' => 2000,
            'step' => 5,
            'suffix' => 'px', //optional suffix
        ),
    )));

    $wp_customize->add_setting('post_width', array(
        'default' => $defaults['post_width'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'post_width', array(
        'type' => 'range-value',
        'section' => 'flexia_single_posts_settings',
        'settings' => 'post_width',
        'label' => __('Post Width (%)', 'flexia'),
        'input_attrs' => array(
            'min' => 50,
            'max' => 100,
            'step' => 1,
            'suffix' => '%', //optional suffix
        ),
    )));

    // Show post navigation

    $wp_customize->add_setting('post_navigation', array(
        'default' => $defaults['post_navigation'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'post_navigation', array(
        'label' => esc_html__('Hide Next/Prev posts?', 'flexia'),
        'section' => 'flexia_single_posts_settings',
        'settings' => 'post_navigation',
        'type' => 'light', // light, ios, flat
    )));

    // Show author under post

    $wp_customize->add_setting('post_author', array(
        'default' => $defaults['post_author'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'post_author', array(
        'label' => esc_html__('Hide Author under post?', 'flexia'),
        'section' => 'flexia_single_posts_settings',
        'settings' => 'post_author',
        'type' => 'light', // light, ios, flat
    )));

    // Social sharing Separator

    $wp_customize->add_setting('flexia_social_sharing_heading', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'flexia_social_sharing_heading', array(
        'label' => __('Social Sharing', 'flexia'),
        'settings' => 'flexia_social_sharing_heading',
        'section' => 'flexia_single_posts_settings',
    )));

    $wp_customize->add_setting('post_social_share', array(
        'default' => $defaults['post_social_share'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'post_social_share', array(
        'label' => esc_html__('Disable Social Sharing?', 'flexia'),
        'section' => 'flexia_single_posts_settings',
        'settings' => 'post_social_share',
        'type' => 'light', // light, ios, flat
    )));

    $wp_customize->add_setting('flexia_social_sharing_text', array(
        'default' => $defaults['flexia_social_sharing_text'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_social_sharing_text',
            array(
                'label' => __('Social Sharing Title', 'flexia'),
                'section' => 'flexia_single_posts_settings',
                'settings' => 'flexia_social_sharing_text',
                'type' => 'text',
            )
        )
    );

    $wp_customize->add_setting('post_social_share_facebook', array(
        'default' => $defaults['post_social_share_facebook'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'post_social_share_facebook', array(
        'label' => esc_html__('Facebook Sharing', 'flexia'),
        'section' => 'flexia_single_posts_settings',
        'settings' => 'post_social_share_facebook',
        'type' => 'light', // light, ios, flat
    )));

    $wp_customize->add_setting('post_social_share_twitter', array(
        'default' => $defaults['post_social_share_twitter'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'post_social_share_twitter', array(
        'label' => esc_html__('Twitter Sharing', 'flexia'),
        'section' => 'flexia_single_posts_settings',
        'settings' => 'post_social_share_twitter',
        'type' => 'light', // light, ios, flat
    )));

    $wp_customize->add_setting('post_social_share_linkedin', array(
        'default' => $defaults['post_social_share_linkedin'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'post_social_share_linkedin', array(
        'label' => esc_html__('Linkedin Sharing', 'flexia'),
        'section' => 'flexia_single_posts_settings',
        'settings' => 'post_social_share_linkedin',
        'type' => 'light', // light, ios, flat
    )));

    $wp_customize->add_setting('post_social_share_gplus', array(
        'default' => $defaults['post_social_share_gplus'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'post_social_share_gplus', array(
        'label' => esc_html__('Google Plus Sharing', 'flexia'),
        'section' => 'flexia_single_posts_settings',
        'settings' => 'post_social_share_gplus',
        'type' => 'light', // light, ios, flat
    )));

    $wp_customize->add_setting('post_social_share_pinterest', array(
        'default' => $defaults['post_social_share_pinterest'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'post_social_share_pinterest', array(
        'label' => esc_html__('Pinterest Sharing', 'flexia'),
        'section' => 'flexia_single_posts_settings',
        'settings' => 'post_social_share_pinterest',
        'type' => 'light', // light, ios, flat
    )));

    // Header Settings

    $wp_customize->add_section('flexia_header_settings', array(
        'title' => __('Header', 'flexia'),
        'priority' => 50,
    ));

    // Header Logo width

    $wp_customize->add_setting('flexia_header_logo_width', array(
        'default' => $defaults['flexia_header_logo_width'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_logo_width',
            array(
                'label' => __('Logo width (px)', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_header_logo_width',
                'type' => 'text',
            )
        )
    );

    // Navabr Separator

    $wp_customize->add_setting('navbar_settings_title', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'navbar_settings_title', array(
        'label' => __('Navbar Settings', 'flexia'),
        'settings' => 'navbar_settings_title',
        'section' => 'flexia_header_settings',
    )));

    // Enable Navbar

    $wp_customize->add_setting('flexia_navbar', array(
        'default' => $defaults['flexia_navbar'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_navbar', array(
        'label' => esc_html__('Disable Navbar?', 'flexia'),
        'section' => 'flexia_header_settings',
        'settings' => 'flexia_navbar',
        'type' => 'light', // light, ios, flat
    )));

    // Navbar position

    $wp_customize->add_setting('flexia_navbar_position', array(
        'default' => $defaults['flexia_navbar_position'],
        'sanitize_callback' => 'flexia_sanitize_choices',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_navbar_position',
            array(
                'label' => __('Navbar Position', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_navbar_position',
                'type' => 'radio',
                'choices' => array(
                    'flexia-navbar-static-top' => __('Static Top', 'flexia'),
                    'flexia-navbar-fixed-top' => __('Sticky Top', 'flexia'),
                    'flexia-navbar-transparent-top' => __('Transparent Static Top', 'flexia'),
                    'flexia-navbar-transparent-sticky-top' => __('Transparent Sticky Top', 'flexia'),
                ),
            )
        )
    );

    // Logobar position

    $wp_customize->add_setting('flexia_logobar_position', array(
        'default' => $defaults['flexia_logobar_position'],
        'sanitize_callback' => 'flexia_sanitize_choices',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_logobar_position',
            array(
                'label' => __('Logobar Position', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_logobar_position',
                'type' => 'radio',
                'choices' => array(
                    'flexia-logobar-inline' => __('Inline', 'flexia'),
                    'flexia-logobar-stacked' => __('Stacked', 'flexia'),
                ),
            )
        )
    );

    // Navbar background colors

    $wp_customize->add_setting('flexia_logobar_bg_color', array(
        'default' => $defaults['flexia_logobar_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_logobar_bg_color',
            array(
                'label' => __('Logobar Background', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_logobar_bg_color',
            ))
    );

    $wp_customize->add_setting('flexia_navbar_bg_color', array(
        'default' => $defaults['flexia_navbar_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_navbar_bg_color',
            array(
                'label' => __('Navbar Background', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_navbar_bg_color',
            ))
    );

    // Primary Menu Separator
    $wp_customize->add_setting('main_nav_settings_title', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'main_nav_settings_title', array(
        'label' => __('Primary Menu Settings', 'flexia'),
        'settings' => 'main_nav_settings_title',
        'section' => 'flexia_header_settings',
    )));

    // Enable Navmenu Search
    $wp_customize->add_setting('flexia_nav_menu_search', array(
        'default' => $defaults['flexia_nav_menu_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_nav_menu_search', array(
        'label' => esc_html__('Enable Search Menu?', 'flexia'),
        'section' => 'flexia_header_settings',
        'settings' => 'flexia_nav_menu_search',
        'type' => 'light', // light, ios, flat
    )));

    // Enable Cart in menu
    $wp_customize->add_setting('flexia_woo_cart_menu', array(
        'default' => $defaults['flexia_woo_cart_menu'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_woo_cart_menu', array(
        'label' => esc_html__('Enable Cart Menu?', 'flexia'),
        'section' => 'flexia_header_settings',
        'settings' => 'flexia_woo_cart_menu',
        'type' => 'light', // light, ios, flat
    )));

    $wp_customize->add_setting('flexia_main_nav_menu_link_color', array(
        'default' => $defaults['flexia_main_nav_menu_link_color'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_link_color',
            array(
                'label' => __('Links color', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_main_nav_menu_link_color',
            ))
    );

    $wp_customize->add_setting('flexia_main_nav_menu_link_hover_color', array(
        'default' => $defaults['flexia_main_nav_menu_link_hover_color'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_link_hover_color',
            array(
                'label' => __('Links hover color', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_main_nav_menu_link_hover_color',
            ))
    );
    
    $wp_customize->add_setting('flexia_main_nav_menu_link_hover_bg', array(
        'default' => $defaults['flexia_main_nav_menu_link_hover_bg'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_link_hover_bg',
            array(
                'label' => __('Links hover background', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_main_nav_menu_link_hover_bg',
            ))
    );

    $wp_customize->add_setting('flexia_main_nav_menu_submenu_bg_color', array(
        'default' => $defaults['flexia_main_nav_menu_submenu_bg_color'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_submenu_bg_color',
            array(
                'label' => __('Dropdown background', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_main_nav_menu_submenu_bg_color',
            ))
    );

    $wp_customize->add_setting('flexia_main_nav_menu_submenu_link_color', array(
        'default' => $defaults['flexia_main_nav_menu_submenu_link_color'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_submenu_link_color',
            array(
                'label' => __('Dropdown links color', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_main_nav_menu_submenu_link_color',
            ))
    );

    $wp_customize->add_setting('flexia_main_nav_menu_submenu_link_hover_color', array(
        'default' => $defaults['flexia_main_nav_menu_submenu_link_hover_color'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_submenu_link_hover_color',
            array(
                'label' => __('Dropdown links hover color', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_main_nav_menu_submenu_link_hover_color',
            ))
    );
    
    $wp_customize->add_setting('flexia_main_nav_menu_submenu_link_hover_bg', array(
        'default' => $defaults['flexia_main_nav_menu_submenu_link_hover_bg'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_submenu_link_hover_bg',
            array(
                'label' => __('Dropdown links hover background', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_main_nav_menu_submenu_link_hover_bg',
            ))
    );

    $wp_customize->add_setting('flexia_main_nav_menu_dropdown_animation', array(
        'default' => 'to-top',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('flexia_main_nav_menu_dropdown_animation_control', array(
        'label' => 'Dropdown animation',
        'section' => 'flexia_header_settings',
        'settings' => 'flexia_main_nav_menu_dropdown_animation',
        'type' => 'select',
        'choices' => array(
            'fade' => 'Fade',
            'to-top' => 'To Top',
            'zoom-in' => 'Zoom In',
            'zoom-out' => 'Zoom Out',
        ),
    ));

    // Topbar Separator
    $wp_customize->add_setting('topbar_settings_title', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'topbar_settings_title', array(
        'label' => __('Topbar Settings', 'flexia'),
        'settings' => 'topbar_settings_title',
        'section' => 'flexia_header_settings',
    )));

    // Enable Topbar
    $wp_customize->add_setting('flexia_enable_topbar', array(
        'default' => $defaults['flexia_enable_topbar'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_enable_topbar', array(
        'label' => esc_html__('Enable Topbar?', 'flexia'),
        'section' => 'flexia_header_settings',
        'settings' => 'flexia_enable_topbar',
        'type' => 'light', // light, ios, flat
    )));

    // Enable Topbar Menu
    $wp_customize->add_setting('flexia_enable_topbar_menu', array(
        'default' => $defaults['flexia_enable_topbar_menu'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_enable_topbar_menu', array(
        'label' => esc_html__('Enable Topbar Menu?', 'flexia'),
        'section' => 'flexia_header_settings',
        'settings' => 'flexia_enable_topbar_menu',
        'type' => 'light', // light, ios, flat
    )));

    $wp_customize->add_setting('flexia_topbar_bg_color', array(
        'default' => $defaults['flexia_topbar_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_topbar_bg_color',
            array(
                'label' => __('Topbar Background', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_topbar_bg_color',
            ))
    );

    $wp_customize->add_setting('flexia_topbar_content', array(
        'default' => __('This is Topbar Content. Cutomize this from Customize > Header > Topbar Content', 'flexia'),
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_topbar_content',
            array(
                'label' => __('Topbar Content', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_topbar_content',
                'type' => 'textarea',
            )
        )
    );

    // Topbar Menu Separator
    $wp_customize->add_setting('top_nav_settings_title', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'top_nav_settings_title', array(
        'label' => __('Topbar Menu Settings', 'flexia'),
        'settings' => 'top_nav_settings_title',
        'section' => 'flexia_header_settings',
    )));

    $wp_customize->add_setting('flexia_top_nav_menu_link_color', array(
        'default' => $defaults['flexia_top_nav_menu_link_color'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_link_color',
            array(
                'label' => __('Links color', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_top_nav_menu_link_color',
            ))
    );

    $wp_customize->add_setting('flexia_top_nav_menu_link_hover_color', array(
        'default' => $defaults['flexia_top_nav_menu_link_hover_color'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_link_hover_color',
            array(
                'label' => __('Links hover color', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_top_nav_menu_link_hover_color',
            ))
    );
    
    $wp_customize->add_setting('flexia_top_nav_menu_link_hover_bg', array(
        'default' => $defaults['flexia_top_nav_menu_link_hover_bg'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_link_hover_bg',
            array(
                'label' => __('Links hover background', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_top_nav_menu_link_hover_bg',
            ))
    );

    $wp_customize->add_setting('flexia_top_nav_menu_submenu_bg_color', array(
        'default' => $defaults['flexia_top_nav_menu_submenu_bg_color'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_submenu_bg_color',
            array(
                'label' => __('Dropdown background', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_top_nav_menu_submenu_bg_color',
            ))
    );

    $wp_customize->add_setting('flexia_top_nav_menu_submenu_link_color', array(
        'default' => $defaults['flexia_top_nav_menu_submenu_link_color'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_submenu_link_color',
            array(
                'label' => __('Dropdown links color', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_top_nav_menu_submenu_link_color',
            ))
    );

    $wp_customize->add_setting('flexia_top_nav_menu_submenu_link_hover_color', array(
        'default' => $defaults['flexia_top_nav_menu_submenu_link_hover_color'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_submenu_link_hover_color',
            array(
                'label' => __('Dropdown links hover color', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_top_nav_menu_submenu_link_hover_color',
            ))
    );
    
    $wp_customize->add_setting('flexia_top_nav_menu_submenu_link_hover_bg', array(
        'default' => $defaults['flexia_top_nav_menu_submenu_link_hover_bg'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_submenu_link_hover_bg',
            array(
                'label' => __('Dropdown links hover background', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'flexia_top_nav_menu_submenu_link_hover_bg',
            ))
    );

    $wp_customize->add_setting('flexia_top_nav_menu_dropdown_animation', array(
        'default' => 'to-top',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('flexia_top_nav_menu_dropdown_animation_control', array(
        'label' => 'Dropdown animation',
        'section' => 'flexia_header_settings',
        'settings' => 'flexia_top_nav_menu_dropdown_animation',
        'type' => 'select',
        'choices' => array(
            'fade' => 'Fade',
            'to-top' => 'To Top',
            'zoom-in' => 'Zoom In',
            'zoom-out' => 'Zoom Out',
        ),
    ));

    // Header widget area Separator
    $wp_customize->add_setting('header_widget_area_settings_title', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'header_widget_area_settings_title', array(
        'label' => __('Header Widget Area', 'flexia'),
        'settings' => 'header_widget_area_settings_title',
        'section' => 'flexia_header_settings',
    )));

    // Enable Header widget area

    $wp_customize->add_setting('header_widget_area', array(
        'default' => $defaults['header_widget_area'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'header_widget_area', array(
        'label' => esc_html__('Enable Header Widget Area?', 'flexia'),
        'section' => 'flexia_header_settings',
        'settings' => 'header_widget_area',
        'type' => 'light', // light, ios, flat
    )));

    // Header widget area background

    $wp_customize->add_setting('header_widget_area_bg_color', array(
        'default' => $defaults['header_widget_area_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_widget_area_bg_color',
            array(
                'label' => __('Header Widget Area Background', 'flexia'),
                'section' => 'flexia_header_settings',
                'settings' => 'header_widget_area_bg_color',
            ))
    );

    // s Settings

    $wp_customize->add_section('flexia_footer_settings', array(
        'title' => __('Footer', 'flexia'),
        'priority' => 60,
    ));

    // Enable Footer widget area

    $wp_customize->add_setting('footer_widget_area', array(
        'default' => $defaults['footer_widget_area'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'footer_widget_area', array(
        'label' => esc_html__('Enable Footer Widget Area?', 'flexia'),
        'section' => 'flexia_footer_settings',
        'settings' => 'footer_widget_area',
        'type' => 'light', // light, ios, flat
    )));

    // Enable Bottom Footer

    $wp_customize->add_setting('footer_bottom', array(
        'default' => $defaults['footer_bottom'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'footer_bottom', array(
        'label' => esc_html__('Disable Bottom Footer?', 'flexia'),
        'section' => 'flexia_footer_settings',
        'settings' => 'footer_bottom',
        'type' => 'light', // light, ios, flat
    )));

    // Enable footer menu

    $wp_customize->add_setting('flexia_enable_footer_menu', array(
        'default' => $defaults['flexia_enable_footer_menu'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_enable_footer_menu', array(
        'label' => esc_html__('Enable Footer Menu?', 'flexia'),
        'section' => 'flexia_footer_settings',
        'settings' => 'flexia_enable_footer_menu',
        'type' => 'light', // light, ios, flat
    )));

    // Enable Scrol to Top

    $wp_customize->add_setting('flexia_scroll_to_top', array(
        'default' => $defaults['flexia_scroll_to_top'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_scroll_to_top', array(
        'label' => esc_html__('Enable Scrol to top?', 'flexia'),
        'section' => 'flexia_footer_settings',
        'settings' => 'flexia_scroll_to_top',
        'type' => 'light', // light, ios, flat
    )));

    $wp_customize->add_setting('footer_widget_area_bg_color', array(
        'default' => $defaults['footer_widget_area_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_widget_area_bg_color',
            array(
                'label' => __('Footer Widget Area Background', 'flexia'),
                'section' => 'flexia_footer_settings',
                'settings' => 'footer_widget_area_bg_color',
            ))
    );

    $wp_customize->add_setting('flexia_footer_bg_color', array(
        'default' => $defaults['flexia_footer_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_footer_bg_color',
            array(
                'label' => __('Footer Background', 'flexia'),
                'section' => 'flexia_footer_settings',
                'settings' => 'flexia_footer_bg_color',
            ))
    );

    $wp_customize->add_setting('flexia_footer_content_color', array(
        'default' => $defaults['flexia_footer_content_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_footer_content_color',
            array(
                'label' => __('Footer Content Color', 'flexia'),
                'section' => 'flexia_footer_settings',
                'settings' => 'flexia_footer_content_color',
            ))
    );

    $wp_customize->add_setting('flexia_footer_link_color', array(
        'default' => $defaults['flexia_footer_link_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_footer_link_color',
            array(
                'label' => __('Footer Links Color', 'flexia'),
                'section' => 'flexia_footer_settings',
                'settings' => 'flexia_footer_link_color',
            ))
    );

    $wp_customize->add_setting('flexia_footer_link_hover_color', array(
        'default' => $defaults['flexia_footer_link_hover_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_footer_link_hover_color',
            array(
                'label' => __('Footer Links Hover Color', 'flexia'),
                'section' => 'flexia_footer_settings',
                'settings' => 'flexia_footer_link_hover_color',
            ))
    );

    $wp_customize->add_setting('flexia_footer_content', array(
        'default' => __('Copyright 2017 | Flexia by Codetic', 'flexia'),
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_footer_content',
            array(
                'label' => __('Footer Content', 'flexia'),
                'section' => 'flexia_footer_settings',
                'settings' => 'flexia_footer_content',
                'type' => 'textarea',
            )
        )
    );

    // Create custom panels
    $wp_customize->add_panel('flexia_general_settings', array(
        'priority' => 10,
        'theme_supports' => '',
        'title' => __('General Settings', 'flexia'),
        'description' => __('Controls the basic settings for the theme.', 'flexia'),
    ));

    $wp_customize->add_panel('flexia_design_settings', array(
        'priority' => 30,
        'theme_supports' => '',
        'title' => __('Design', 'flexia'),
        'description' => __('Controls the design settings for the theme.', 'flexia'),
    ));

    $wp_customize->add_panel('flexia_blog_settings', array(
        'priority' => 70,
        'theme_supports' => '',
        'title' => __('Blog Styles', 'flexia'),
        'description' => __('Controls the blog settings for the theme.', 'flexia'),
    ));

    // Assign sections to panels
    $wp_customize->get_section('title_tagline')->panel = 'flexia_general_settings';
    $wp_customize->get_section('static_front_page')->panel = 'flexia_general_settings';
    $wp_customize->get_section('background_image')->panel = 'flexia_design_settings';
    $wp_customize->get_section('background_image')->priority = 1000;
    $wp_customize->get_section('flexia_blog_content_settings')->panel = 'flexia_blog_settings';
    $wp_customize->get_section('flexia_blog_header_settings')->panel = 'flexia_blog_settings';
    $wp_customize->get_section('flexia_single_posts_settings')->panel = 'flexia_blog_settings';
    $wp_customize->get_section('header_image')->panel = 'flexia_design_settings';
    $wp_customize->get_section('flexia_page_settings')->panel = 'flexia_design_settings';
    $wp_customize->get_section('flexia_overlay_search_settings')->panel = 'flexia_design_settings';
}
add_action('customize_register', 'flexia_customize_register');

require get_template_directory() . '/framework/functions/customizer/output/header.php';
require get_template_directory() . '/framework/functions/customizer/output/output-css.php';
