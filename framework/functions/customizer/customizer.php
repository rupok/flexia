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
    $wp_customize->get_section('title_tagline')->title = __('Site Info', 'flexia');
    $wp_customize->get_control('blogname')->label = __('Site Name', 'flexia');
    $wp_customize->get_control('blogdescription')->label = __('Site Description', 'flexia');
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    // Customize the Front Page Settings
    $wp_customize->get_section('static_front_page')->title = __('Homepage Preferences', 'flexia');
    $wp_customize->get_section('static_front_page')->priority = 20;
    $wp_customize->get_control('show_on_front')->label = __('Choose Homepage Preference', 'flexia');
    $wp_customize->get_control('page_on_front')->label = __('Select Homepage', 'flexia');
    $wp_customize->get_control('page_for_posts')->label = __('Select Blog Homepage', 'flexia');

    // Remove some core control
	// $wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->remove_control( 'background_color' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_control( 'background_image' );

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

    /**
     * Add Options to General Settings
     * @flexia_general_settings
     */

    
    /**
     * Add "Layout Settings" Section to General Settings
     * @flexia_layout_settings
     * Parent: @flexia_general_settings
     */
    $wp_customize->add_section('flexia_layout_settings', array(
        'title' => __('Layout Settings', 'flexia'),
        'priority' => 100,
    ));        
    
    $wp_customize->add_setting(
        'flexia_container_max_width',
        array(
            'default' => $defaults['flexia_container_max_width'],
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'flexia_sanitize_integer',
        )
    );

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_container_max_width', array(
        'type' => 'range-value',
        'section' => 'flexia_layout_settings',
        'settings' => 'flexia_container_max_width',
        'label' => __('Site Max Width (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 600,
            'max' => 2000,
            'step' => 5,
            'suffix' => 'px', //optional suffix
        ),
    )));

    $wp_customize->add_setting('flexia_container_width', array(
        'default' => $defaults['flexia_container_width'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_container_width', array(
        'type' => 'range-value',
        'section' => 'flexia_layout_settings',
        'settings' => 'flexia_container_width',
        'label' => __('Site Width (%)', 'flexia'),
        'input_attrs' => array(
            'min' => 50,
            'max' => 100,
            'step' => 1,
            'suffix' => '%', //optional suffix
        ),
    )));

    //Default Page Layot Settings
    $wp_customize->add_setting('content_layout', array(
        'default' => $defaults['content_layout'],
        'sanitize_callback' => 'flexia_sanitize_choices',
    ));

    $wp_customize->add_control(
		new Flexia_Radio_Image_Control(
            $wp_customize,
            'content_layout',
            array(
                'label' => __('Content Layout', 'flexia'),
                'type'          => 'flexia-radio-image',
                'settings'		=> 'content_layout',
                'section'		=> 'flexia_layout_settings',
                'choices'		=> apply_filters(
                    'content_layout', 
                    array(
                        'content_layout1' 	=> array(
                            'image' => get_template_directory_uri() . '/admin/img/content-layouts/content-sidebar-both.jpg',
                            'label'   => 'Sidebar | Content | Sidebar',
                        ),
                        'content_layout2' 	=> array(
                            'image' => get_template_directory_uri() . '/admin/img/content-layouts/content-sidebar-left.jpg',
                            'label'   => 'Sidebar | Content',
                        ),
                        'content_layout3' 	=> array(
                            'image' => get_template_directory_uri() . '/admin/img/content-layouts/content-sidebar-right.jpg',
                            'label'   => 'Content | Sidebar',
                        ),
                        'content_layout4' 	=> array(
                            'image' => get_template_directory_uri() . '/admin/img/content-layouts/content-no-sidebar.jpg',
                            'label'   => 'No Sidebar',
                        )
                    )
                ),
            ) 
        )
    );
    
    $wp_customize->selective_refresh->add_partial( "content_layout_partial", [
        'selector'            => "#content",
        'settings'            => [
            "content_layout",
        ],
        'container_inclusive' => true,
    ] );

    //Left Sidebr Width Set
    $wp_customize->add_setting('flexia_sidebar_width_left', array(
        'default' => $defaults['flexia_sidebar_width_left'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_sidebar_width_left', array(
        'type' => 'range-value',
        'section' => 'flexia_layout_settings',
        'settings' => 'flexia_sidebar_width_left',
        'default' => '300',
        'label' => __('Left Sidebar Width (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 15,
            'max' => 100,
            'step' => 1,
            'suffix' => '%', //optional suffix
        ),
    )));

    //Right Sidbar Width Set
    $wp_customize->add_setting('flexia_sidebar_width_right', array(
        'default' => $defaults['flexia_sidebar_width_right'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_sidebar_width_right', array(
        'type' => 'range-value',
        'section' => 'flexia_layout_settings',
        'settings' => 'flexia_sidebar_width_right',
        'default' => '300',
        'label' => __('Right Sidebar Width (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 15,
            'max' => 100,
            'step' => 1,
            'suffix' => '%', //optional suffix
        ),
    )));

    /**
     * Add "Default Color" Section to General Settings
     * @flexia_default_colors_settings
     * Parent: @flexia_general_settings
     */
    $wp_customize->add_section('flexia_default_colors_settings', array(
        'title' => __('Default Colors', 'flexia'),
        'priority' => 120,
    ));

    /**
     * Default Color Section: Primary Color
     * @flexia_primary_color
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_primary_color', array(
        'default' => $defaults['flexia_primary_color'],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_primary_color',
            array(
                'label' => __('Primary Color', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                'settings' => 'flexia_primary_color',
            ))
    );

    /**
     * Default Color Section: Text Color
     * @flexia_default_text_color
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_default_text_color', array(
        'default' => $defaults['flexia_default_text_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_default_text_color',
            array(
                'label' => __('Default Text Color', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                'settings' => 'flexia_default_text_color',
            ))
    ); 
    
    /**
     * Default Color Section: Heading Color
     * @flexia_default_heading_color
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_default_heading_color', array(
        'default' => $defaults['flexia_default_heading_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_default_heading_color',
            array(
                'label' => __('Heading Color', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                'settings' => 'flexia_default_heading_color',
            ))
    );

    /**
     * Default Color Section: Site Link Separator Label
     * @flexia_link_separator_label
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_link_separator_label', array(
        'default' => $defaults['flexia_link_separator_label'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'flexia_link_separator_label', array(
        'label' => __('Site Links', 'flexia'),
        'settings' => 'flexia_link_separator_label',
        'section' => 'flexia_default_colors_settings',
    )));

    /**
     * Default Color Section: Link Color
     * @flexia_link_color
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_link_color', array(
        'default' => $defaults['flexia_link_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_link_color',
            array(
                'label' => __('Site Link Color', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                'settings' => 'flexia_link_color',
            ))
    );    

    /**
     * Default Color Section: Link Hover Color
     * @flexia_link_hover_color
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_link_hover_color', array(
        'default' => $defaults['flexia_link_hover_color'],
        'transport'   => 'reload',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_link_hover_color',
            array(
                'label' => __('Site Link Hover Color', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                'settings' => 'flexia_link_hover_color',
            ))
    );

    /**
     * Default Color Section: Site Background Separator Label
     * @flexia_background_separator_label
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_background_separator_label', array(
        'default' => $defaults['flexia_background_separator_label'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'flexia_background_separator_label', array(
        'label' => __('Site Background', 'flexia'),
        'settings' => 'flexia_background_separator_label',
        'section' => 'flexia_default_colors_settings',
    )));

    /**
     * Default Color Section: Site Background Color
     * @flexia_background_color
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_background_color', array(
        'default' => $defaults['flexia_background_color'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_background_color',
            array(
                'label' => __('Site Background Color', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                'settings' => 'flexia_background_color',
            ))
    );

    /**
     * Default Color Section: Background Image Enable/Disable
     * @flexia_background_image_enable_button
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_background_image_enable_button', array(
        'default' => $defaults['flexia_background_image_enable_button'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(
        new Customizer_Toggle_Control(
            $wp_customize, 
            'flexia_background_image_enable_button', array(
            'label' => esc_html__('Enable Background Image?', 'flexia'),
            'section' => 'flexia_default_colors_settings',
            'settings' => 'flexia_background_image_enable_button',
            'type' => 'light', // light, ios, flat
    )));

    /**
     * If Background Image Enabled:
     */

    /**
     * Default Color Section: Site Background Image
     * @flexia_background_image
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_background_image', array(
        'default' => $defaults['flexia_background_image'],
        // 'transport'   => 'postMessage',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'flexia_background_image',
            array(
                'label' => __('Upload an Image for Background', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                'settings' => 'flexia_background_image',
                // 'context' => 'flexia_blog_logo',
            )
        )
    );

    /**
     * Default Color Section: Background Image Property
     * @flexia_background_image_size
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */

    $wp_customize->add_setting( 'flexia_background_property', array(
		'default'       => $defaults['flexia_background_property'],
		'capability'    => 'edit_theme_options',
		'transport' => 'postMessage',
		'sanitize_callback' => 'flexia_sanitize_select'

	) );

	$wp_customize->add_control( new Flexia_Title_Custom_Control(
		$wp_customize, 'flexia_background_property', array(
		'type'     => 'flexia-title',
		'section'  => 'flexia_default_colors_settings',
		'settings' => 'flexia_background_property',
		'label'    => __( 'Background Property', 'flexia' ),
		'input_attrs' => array(
			'id' => 'flexia_background_property',
			'class' => 'flexia-select',
		),
	) ) );
    
    /**
     * Default Color Section: Background Image Size
     * @flexia_background_image_size
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting(
        'flexia_background_image_size',
        array(
            'default' => $defaults['flexia_background_image_size'],
            'transport'   => 'postMessage',
            'sanitize_callback' => 'flexia_sanitize_select',
        ));

    $wp_customize->add_control(
        new Flexia_Select_Control(
            $wp_customize,
            'flexia_background_image_size',
            array(
                'label' => __('Size', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                'settings' => 'flexia_background_image_size',
                'description' => '',
                'type' => 'flexia-select',
                'priority' => 10,
                'input_attrs' => array(
                    'class' => 'flexia_background_property flexia-select',
                ),
                'choices' => array(
                    'auto' => __('Auto', 'flexia'),
                    'cover' => __('Cover', 'flexia'),
                    'contain' => __('Contain', 'flexia'),
                    'initial' => __('Initial', 'flexia'),
                    'inherit' => __('Inherit', 'flexia'),
                ),
            )
        )
    );

    
    /**
     * Default Color Section: Background Image Position
     * @flexia_background_image_position
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting(
        'flexia_background_image_position',
        array(
            'default' => $defaults['flexia_background_image_position'],
            'transport'   => 'postMessage',
            'sanitize_callback' => 'flexia_sanitize_select',
        ));

    $wp_customize->add_control(
        new Flexia_Select_Control(
            $wp_customize,
            'flexia_background_image_position',
            array(
                'label' => __('Position', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                'settings' => 'flexia_background_image_position',
                'description' => '',
                'type' => 'flexia-select',
                'priority' => 10,
                'input_attrs' => array(
                    'class' => 'flexia_background_property flexia-select',
                ),
                'choices' => array(
                    'left top' => __('left top', 'flexia'),
                    'left center' => __('left center', 'flexia'),
                    'left bottom' => __('left bottom', 'flexia'),
                    'right top' => __('right top', 'flexia'),
                    'right center' => __('right center', 'flexia'),
                    'right bottom' => __('right bottom', 'flexia'),
                    'center top' => __('center top', 'flexia'),
                    'center center' => __('center center', 'flexia'),
                    'center bottom' => __('center bottom', 'flexia'),
                ),
            )
        )
    );

    /**
     * Default Color Section: Background Image Repeat
     * @flexia_background_image_repeat
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting(
        'flexia_background_image_repeat',
        array(
            'default' => $defaults['flexia_background_image_repeat'],
            'transport'   => 'postMessage',
            'sanitize_callback' => 'flexia_sanitize_select',
        ));

    $wp_customize->add_control(
        new Flexia_Select_Control(
            $wp_customize,
            'flexia_background_image_repeat',
            array(
                'label' => __('Repeat', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                'settings' => 'flexia_background_image_repeat',
                'description' => '',
                'type' => 'flexia-select',
                'priority' => 10,
                'input_attrs' => array(
                    'class' => 'flexia_background_property flexia-select',
                ),
                'choices' => array(
                    'repeat' => __('repeat', 'flexia'),
                    'repeat-x' => __('repeat-x', 'flexia'),
                    'repeat-y' => __('repeat-y', 'flexia'),
                    'no-repeat' => __('no-repeat', 'flexia'),
                    'space' => __('space', 'flexia'),
                    'round' => __('round', 'flexia'),
                ),
            )
        )
    );

    /**
     * Default Color Section: Background Image Attachment
     * @flexia_background_image_repeat
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */

    $wp_customize->add_setting( 'flexia_background_image_attachment', array(
		'default'       => $defaults['flexia_background_image_attachment'],
		'capability'    => 'edit_theme_options',
		'transport' => 'postMessage',
		'sanitize_callback' => 'flexia_sanitize_select'

	) );

	$wp_customize->add_control( new Flexia_Select_Control(
		$wp_customize, 'flexia_background_image_attachment', array(
		'type'     => 'flexia-select',
		'section'  => 'flexia_default_colors_settings',
		'settings' => 'flexia_background_image_attachment',
        'label'    => __( 'Attachment', 'flexia' ),
        'input_attrs' => array(
            'class' => 'flexia_background_property flexia-select',
        ),
		'choices'  => array(
			'initial' 	=> __( 'initial', 'flexia' ),
			'inherit'   => __( 'inherit', 'flexia' ),
			'scroll'   	=> __( 'scroll', 'flexia' ),
			'fixed'  	 => __( 'fixed', 'flexia' ),
			'local'  	=> __( 'local', 'flexia' ),
		)
	) ) );

    /**
     * If Background Color Overlay set:
     */

    //Default Color Section: Overlay Color

    //Default Color Section: Overlay Opacity


    

    /**
     * Default Color Section: Blog Heading Background Color
     * @flexia_blog_bg_heading
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_blog_bg_heading', array(
        'default' => $defaults['flexia_blog_bg_heading'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'flexia_blog_bg_heading', array(
        'label' => __('Page & Posts Backgrounds', 'flexia'),
        'settings' => 'flexia_blog_bg_heading',
        'section' => 'flexia_default_colors_settings',
    )));

    /**
     * Default Color Section: Blog Background Color
     * @flexia_blog_bg_color
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_blog_bg_color', array(
        'default' => $defaults['flexia_blog_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_blog_bg_color',
            array(
                'label' => __('Blog Body Background', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                'settings' => 'flexia_blog_bg_color',
            ))
    );

    /**
     * Default Color Section: Post Content Background Color
     * @flexia_post_content_bg_color
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_post_content_bg_color', array(
        'default' => $defaults['flexia_post_content_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_post_content_bg_color',
            array(
                'label' => __('Page/Post Content Background', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                // 'section' => 'background_image',
                'settings' => 'flexia_post_content_bg_color',
            ))
    );

    /**
     * Default Color Section: Sidebar WIdget Background Color
     * @flexia_sidebar_widget_bg_color
     * Parent: @flexia_general_settings -> @flexia_default_colors_settings
     */
    $wp_customize->add_setting('flexia_sidebar_widget_bg_color', array(
        'default' => $defaults['flexia_sidebar_widget_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_sidebar_widget_bg_color',
            array(
                'label' => __('Sidebar Widget Background', 'flexia'),
                'section' => 'flexia_default_colors_settings',
                'settings' => 'flexia_sidebar_widget_bg_color',
            ))
    );


    // Page Settings

    $wp_customize->add_section('flexia_page_settings', array(
        'title' => __('Page Settings', 'flexia'),
        'priority' => 90,
    ));


    // Show Header
    $wp_customize->add_setting('flexia_page_header', array(
        'default' => $defaults['flexia_page_header'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));
    $wp_customize->add_control(
        new Customizer_Toggle_Control(
            $wp_customize,
            'flexia_page_header',
            array(
                'label' => esc_html__('Show Header?', 'flexia'),
                'section' => 'flexia_page_settings',
                'settings' => 'flexia_page_header',
                'description' => '',
                'type' => 'light', // light, ios, flat
                'priority' => 10,
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


    //Page Header Layout
    $wp_customize->add_setting(
        'flexia_page_header_layout',
        array(
            'default' => $defaults['flexia_page_header_layout'],
            'sanitize_callback' => 'flexia_sanitize_choices',
        )
    );

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
                'priority' => 30,
                'choices' => array(
                    'flexia_page_header_default' => __('Default Header', 'flexia'),
                    'flexia_page_header_large' => __('Large Header', 'flexia'),
                    'flexia_page_header_mini' => __('Mini Header', 'flexia'),
                ),
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
        'priority' => 40,
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
                'priority' => 50,
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
                'priority' => 60,
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
        'priority' => 70,
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
        'priority' => 80,
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
                'priority' => 90,
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
                'priority' => 100,
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

    /**
     * Typography Section: Add Panel
     * @flexia_typography_settings
     */
    $wp_customize->add_panel('flexia_typography_settings',array(
        'title'=>'Typography',
        'description'=> 'Default Typography Settings',
        'priority'=> 40,
    ));

    /**
     * ......................................................
     * Typography Section: Add Section
     * @flexia_typography_body
     * Parent: @flexia_typography_settings
     */    
    $wp_customize->add_section('flexia_typography_body', array(
        'title' => __('Body', 'flexia'),
        'priority' => 10,
    ));

    /**
     * Typography Section: Body Font Size
     * @flexia_body_font_size
     * Parent: @flexia_typography_settings -> @flexia_typography_body
     */
    $wp_customize->add_setting('flexia_body_font_size', array(
        'default' => $defaults['flexia_body_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',
    ));
    $wp_customize->add_control(
        new Customizer_Range_Value_Control(
            $wp_customize, 
            'flexia_body_font_size', array(
                'type' => 'range-value',
                'section' => 'flexia_typography_body',
                'settings' => 'flexia_body_font_size',
                'label' => __('Body Font Size (px)', 'flexia'),
                'description' => __('Other font size are relative to Body Font Size. ', 'flexia'),
                'input_attrs' => array(
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                    'suffix' => 'px', //optional suffix
                ),
            )
        )
    );

    /**
     * Typography Section: Body Font Line Height
     * @flexia_body_font_line_height
     * Parent: @flexia_typography_settings -> @flexia_typography_body
     */
    $wp_customize->add_setting('flexia_body_font_line_height', array(
        'default' => $defaults['flexia_body_font_line_height'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',
    ));
    $wp_customize->add_control(
        new Customizer_Range_Value_Control(
            $wp_customize, 
            'flexia_body_font_line_height', array(
                'type' => 'range-value',
                'section' => 'flexia_typography_body',
                'settings' => 'flexia_body_font_line_height',
                'label' => __('Line Height', 'flexia'),
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.1,
                    'suffix' => '', //optional suffix
                ),
            )
        )
    );

    /**
     * Typography Section: Body Font Family
     * @flexia_body_font_family
     * Parent: @flexia_typography_settings -> @flexia_typography_body
     */  
    $wp_customize->add_setting('flexia_body_font_family', array(
        'default' => $defaults['flexia_body_font_family'],
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new Customizer_Select2_Google_Fonts(
            $wp_customize,
            'flexia_body_font_family',
            array(
                'label' => esc_html__('Body Font', 'flexia'),
                'section' => 'flexia_typography_body',
                'settings' => 'flexia_body_font_family',
                'type' => 'select2_google_fonts',
                'choices' => flexia_google_fonts(),
            )
        )
    );

    /**
     * Typography Section: Body Font Variants
     * @flexia_body_font_variants
     * Parent: @flexia_typography_settings -> @flexia_typography_body
     */ 
    $wp_customize->add_setting('flexia_body_font_variants', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_body_font_variants',
            array(
                'label' => __('Body Font Variants', 'flexia'),
                'section' => 'flexia_typography_body',
                'settings' => 'flexia_body_font_variants',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    /**
     * Typography Section: Body Font Subsets
     * @flexia_body_font_subsets
     * Parent: @flexia_typography_settings -> @flexia_typography_body
     */ 
    $wp_customize->add_setting('flexia_body_font_subsets', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_body_font_subsets',
            array(
                'label' => __('Body Font Subsets', 'flexia'),
                'section' => 'flexia_typography_body',
                'settings' => 'flexia_body_font_subsets',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    /**
     * Typography Section: Body Font Text Transform
     * @flexia_body_font_text_transform
     * Parent: @flexia_typography_settings -> @flexia_typography_body
     */ 
    $wp_customize->add_setting( 'flexia_body_font_text_transform', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_select',
        'default' => $defaults['flexia_body_font_text_transform'],
        'transport' => 'postMessage',
    ));
      
    $wp_customize->add_control(
        'flexia_body_font_text_transform', 
        array(
            'type' => 'select',
            'section' => 'flexia_typography_body', // Add a default or your own section
            'label' => __( 'Text Transform', 'flexia' ),
            'choices' => array(
                'none' => __( 'None', 'flexia' ),
                'capitalize' => __( 'Capitalize', 'flexia' ),
                'uppercase' => __( 'Uppercase', 'flexia' ),
                'lowercase' => __( 'Lowercase', 'flexia' ),
            ),
        )
    );
    /**
     * ..............................................................
     */


    /**
     * ..............................................................
     * Typography Section: Add Section: Site Linksgraph
     * @flexia_typography_paragraph
     * Parent: @flexia_typography_settings
     */
    $wp_customize->add_section('flexia_typography_paragraph', array(
        'title' => __('Paragraph', 'flexia'),
        'priority' => 10,
    ));

    /**
     * Typography Section: Paragraph Font Size
     * @flexia_paragraph_font_size
     * Parent: @flexia_typography_settings -> @flexia_typography_paragraph
     */
    $wp_customize->add_setting('flexia_paragraph_font_size', array(
        'default' => $defaults['flexia_paragraph_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',
    ));
    $wp_customize->add_control(
        new Customizer_Range_Value_Control(
            $wp_customize, 
            'flexia_paragraph_font_size', array(
                'type' => 'range-value',
                'section' => 'flexia_typography_paragraph',
                'settings' => 'flexia_paragraph_font_size',
                'label' => __('Paragraph Font Size (em)', 'flexia'),
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 5,
                    'step' => 0.01,
                    'suffix' => 'em', //optional suffix
                ),
            )
        )
    );

    /**
     * Typography Section: Paragraph Font Line Height
     * @flexia_paragraph_font_line_height
     * Parent: @flexia_typography_settings -> @flexia_typography_paragraph
     */
    $wp_customize->add_setting('flexia_paragraph_font_line_height', array(
        'default' => $defaults['flexia_paragraph_font_line_height'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',
    ));
    $wp_customize->add_control(
        new Customizer_Range_Value_Control(
            $wp_customize, 
            'flexia_paragraph_font_line_height', array(
                'type' => 'range-value',
                'section' => 'flexia_typography_paragraph',
                'settings' => 'flexia_paragraph_font_line_height',
                'label' => __('Line Height', 'flexia'),
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.1,
                    'suffix' => '', //optional suffix
                ),
            )
        )
    );

    /**
     * Typography Section: Paragraph Font Family
     * @flexia_paragraph_font_family
     * Parent: @flexia_typography_settings -> @flexia_typography_paragraph
     */  
    $wp_customize->add_setting('flexia_paragraph_font_family', array(
        'default' => $defaults['flexia_paragraph_font_family'],
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new Customizer_Select2_Google_Fonts(
            $wp_customize,
            'flexia_paragraph_font_family',
            array(
                'label' => esc_html__('Paragraph Font', 'flexia'),
                'section' => 'flexia_typography_paragraph',
                'settings' => 'flexia_paragraph_font_family',
                'type' => 'select2_google_fonts',
                'choices' => flexia_google_fonts(),
            )
        )
    );
    
    /**
     * Typography Section: Paragraph Font Variants
     * @flexia_paragraph_font_variants
     * Parent: @flexia_typography_settings -> @flexia_typography_paragraph
     */
    $wp_customize->add_setting('flexia_paragraph_font_variants', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_paragraph_font_variants',
            array(
                'label' => __('Paragraph Font Variants', 'flexia'),
                'section' => 'flexia_typography_paragraph',
                'settings' => 'flexia_paragraph_font_variants',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    /**
     * Typography Section: Paragraph Font Subsets
     * @flexia_paragraph_font_subsets
     * Parent: @flexia_typography_settings -> @flexia_typography_paragraph
     */ 
    $wp_customize->add_setting('flexia_paragraph_font_subsets', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_paragraph_font_subsets',
            array(
                'label' => __('Paragraph Font Subsets', 'flexia'),
                'section' => 'flexia_typography_paragraph',
                'settings' => 'flexia_paragraph_font_subsets',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    /**
     * Typography Section: Paragraph Font Text Transform
     * @flexia_paragraph_font_text_transform
     * Parent: @flexia_typography_settings -> @flexia_typography_paragraph
     */ 
    $wp_customize->add_setting( 'flexia_paragraph_font_text_transform', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_select',
        'default' => $defaults['flexia_paragraph_font_text_transform'],
        'transport' => 'postMessage',
    ));
      
    $wp_customize->add_control(
        'flexia_paragraph_font_text_transform', 
        array(
            'type' => 'select',
            'section' => 'flexia_typography_paragraph', // Add a default or your own section
            'label' => __( 'Text Transform', 'flexia' ),
            'choices' => array(
                'none' => __( 'None', 'flexia' ),
                'capitalize' => __( 'Capitalize', 'flexia' ),
                'uppercase' => __( 'Uppercase', 'flexia' ),
                'lowercase' => __( 'Lowercase', 'flexia' ),
            ),
        )
    );
    /**
     * ..............................................................
     */


    /**
     * ..............................................................
     * Typography Section: Add Section: Heading
     * @flexia_typography_heading
     * Parent: @flexia_typography_settings
     */    
    $wp_customize->add_section('flexia_typography_heading', array(
        'title' => __('Heading', 'flexia'),
        'priority' => 10,
    ));

    /**
     * Typography Section: Heading 1 Font Size
     * @flexia_heading1_font_size
     * Parent: @flexia_typography_settings -> @flexia_typography_heading
     */
    $wp_customize->add_setting('flexia_heading1_font_size', array(
        'default' => $defaults['flexia_heading1_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));
    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_heading1_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_heading',
        'settings' => 'flexia_heading1_font_size',
        'label' => __('H1 Font Size (em)', 'flexia'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 10,
            'step' => .05,
            'suffix' => 'em', //optional suffix
        ),
    )));

    /**
     * Typography Section: Heading 2 Font Size
     * @flexia_heading2_font_size
     * Parent: @flexia_typography_settings -> @flexia_typography_heading
     */
    $wp_customize->add_setting('flexia_heading2_font_size', array(
        'default' => $defaults['flexia_heading2_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));
    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_heading2_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_heading',
        'settings' => 'flexia_heading2_font_size',
        'label' => __('H2 Font Size (em)', 'flexia'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 10,
            'step' => .05,
            'suffix' => 'em', //optional suffix
        ),
    )));

    /**
     * Typography Section: Heading 3 Font Size
     * @flexia_heading3_font_size
     * Parent: @flexia_typography_settings -> @flexia_typography_heading
     */
    $wp_customize->add_setting('flexia_heading3_font_size', array(
        'default' => $defaults['flexia_heading3_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));
    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_heading3_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_heading',
        'settings' => 'flexia_heading3_font_size',
        'label' => __('H3 Font Size (em)', 'flexia'),
        'input_attrs' => array(
            'min' => .5,
            'max' => 10,
            'step' => .05,
            'suffix' => 'em', //optional suffix
        ),
    )));

    /**
     * Typography Section: Heading 4 Font Size
     * @flexia_heading4_font_size
     * Parent: @flexia_typography_settings -> @flexia_typography_heading
     */
    $wp_customize->add_setting('flexia_heading4_font_size', array(
        'default' => $defaults['flexia_heading4_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));
    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_heading4_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_heading',
        'settings' => 'flexia_heading4_font_size',
        'label' => __('H4 Font Size (em)', 'flexia'),
        'input_attrs' => array(
            'min' => .1,
            'max' => 10,
            'step' => .01,
            'suffix' => 'em', //optional suffix
        ),
    )));

    /**
     * Typography Section: Heading 5 Font Size
     * @flexia_heading5_font_size
     * Parent: @flexia_typography_settings -> @flexia_typography_heading
     */
    $wp_customize->add_setting('flexia_heading5_font_size', array(
        'default' => $defaults['flexia_heading5_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));
    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_heading5_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_heading',
        'settings' => 'flexia_heading5_font_size',
        'label' => __('H5 Font Size (em)', 'flexia'),
        'input_attrs' => array(
            'min' => .1,
            'max' => 10,
            'step' => .01,
            'suffix' => 'em', //optional suffix
        ),
    )));

    /**
     * Typography Section: Heading 6 Font Size
     * @flexia_heading6_font_size
     * Parent: @flexia_typography_settings -> @flexia_typography_heading
     */
    $wp_customize->add_setting('flexia_heading6_font_size', array(
        'default' => $defaults['flexia_heading6_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));
    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_heading6_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_typography_heading',
        'settings' => 'flexia_heading6_font_size',
        'label' => __('H6 Font Size (em)', 'flexia'),
        'input_attrs' => array(
            'min' => .1,
            'max' => 10,
            'step' => .01,
            'suffix' => 'em', //optional suffix
        ),
    )));

    /**
     * Typography Section: Heading Font Line Height
     * @flexia_heading_font_line_height
     * Parent: @flexia_typography_settings -> @flexia_typography_heading
     */
    $wp_customize->add_setting('flexia_heading_font_line_height', array(
        'default' => $defaults['flexia_heading_font_line_height'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',
    ));
    $wp_customize->add_control(
        new Customizer_Range_Value_Control(
            $wp_customize, 
            'flexia_heading_font_line_height', array(
                'type' => 'range-value',
                'section' => 'flexia_typography_heading',
                'settings' => 'flexia_heading_font_line_height',
                'label' => __('Line Height', 'flexia'),
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.1,
                    'suffix' => '', //optional suffix
                ),
            )
        )
    );

    /**
     * Typography Section: Heading Font Family
     * @flexia_heading_font_family
     * Parent: @flexia_typography_settings -> @flexia_typography_heading
     */  
    $wp_customize->add_setting('flexia_heading_font_family', array(
        'default' => $defaults['flexia_heading_font_family'],
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new Customizer_Select2_Google_Fonts(
            $wp_customize,
            'flexia_heading_font_family',
            array(
                'label' => esc_html__('Heading Font', 'flexia'),
                'section' => 'flexia_typography_heading',
                'settings' => 'flexia_heading_font_family',
                'type' => 'select2_google_fonts',
                'choices' => flexia_google_fonts(),
            )
        )
    );

    /**
     * Typography Section: Heading Font Variants
     * @flexia_heading_font_variants
     * Parent: @flexia_typography_settings -> @flexia_typography_heading
     */ 
    $wp_customize->add_setting('flexia_heading_font_variants', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_heading_font_variants',
            array(
                'label' => __('Heading Font Variants', 'flexia'),
                'section' => 'flexia_typography_heading',
                'settings' => 'flexia_heading_font_variants',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    /**
     * Typography Section: Heading Font Subsets
     * @flexia_heading_font_subsets
     * Parent: @flexia_typography_settings -> @flexia_typography_heading
     */ 
    $wp_customize->add_setting('flexia_heading_font_subsets', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_heading_font_subsets',
            array(
                'label' => __('Heading Font Subsets', 'flexia'),
                'section' => 'flexia_typography_heading',
                'settings' => 'flexia_heading_font_subsets',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    /**
     * Typography Section: Heading Font Text Transform
     * @flexia_heading_font_text_transform
     * Parent: @flexia_typography_settings -> @flexia_typography_heading
     */ 
    $wp_customize->add_setting( 'flexia_heading_font_text_transform', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_select',
        'default' => $defaults['flexia_heading_font_text_transform'],
        'transport' => 'postMessage',
    ));
      
    $wp_customize->add_control(
        'flexia_heading_font_text_transform', 
        array(
            'type' => 'select',
            'section' => 'flexia_typography_heading', // Add a default or your own section
            'label' => __( 'Text Transform', 'flexia' ),
            'choices' => array(
                'none' => __( 'None', 'flexia' ),
                'capitalize' => __( 'Capitalize', 'flexia' ),
                'uppercase' => __( 'Uppercase', 'flexia' ),
                'lowercase' => __( 'Lowercase', 'flexia' ),
            ),
        )
    );
    /**
     * ..............................................................
     */


    /**
     * ..............................................................
     * Typography Section: Add Section: Link
     * @flexia_typography_link
     * Parent: @flexia_typography_settings
     */    
    $wp_customize->add_section('flexia_typography_link', array(
        'title' => __('Link', 'flexia'),
        'priority' => 10,
    ));
    /**
     * Typography Section: Link Font Size
     * @flexia_link_font_size
     * Parent: @flexia_typography_settings -> @flexia_typography_link
     */
    $wp_customize->add_setting('flexia_link_font_size', array(
        'default' => $defaults['flexia_link_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',
    ));
    $wp_customize->add_control(
        new Customizer_Range_Value_Control(
            $wp_customize, 
            'flexia_link_font_size', array(
                'type' => 'range-value',
                'section' => 'flexia_typography_link',
                'settings' => 'flexia_link_font_size',
                'label' => __('Link Font Size (px)', 'flexia'),
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 5,
                    'step' => 0.1,
                    'suffix' => 'em', //optional suffix
                ),
            )
        )
    );

    /**
     * Typography Section: Link Font Line Height
     * @flexia_link_font_line_height
     * Parent: @flexia_typography_settings -> @flexia_typography_link
     */
    $wp_customize->add_setting('flexia_link_font_line_height', array(
        'default' => $defaults['flexia_link_font_line_height'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',
    ));
    $wp_customize->add_control(
        new Customizer_Range_Value_Control(
            $wp_customize, 
            'flexia_link_font_line_height', array(
                'type' => 'range-value',
                'section' => 'flexia_typography_link',
                'settings' => 'flexia_link_font_line_height',
                'label' => __('Line Height', 'flexia'),
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.1,
                    'suffix' => '', //optional suffix
                ),
            )
        )
    );

    /**
     * Typography Section: Link Font Family
     * @flexia_link_font_family
     * Parent: @flexia_typography_settings -> @flexia_typography_link
     */  
    $wp_customize->add_setting('flexia_link_font_family', array(
        'default' => $defaults['flexia_link_font_family'],
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new Customizer_Select2_Google_Fonts(
            $wp_customize,
            'flexia_link_font_family',
            array(
                'label' => esc_html__('Link Font', 'flexia'),
                'section' => 'flexia_typography_link',
                'settings' => 'flexia_link_font_family',
                'type' => 'select2_google_fonts',
                'choices' => flexia_google_fonts(),
            )
        )
    );

    /**
     * Typography Section: Link Font Variants
     * @flexia_link_font_variants
     * Parent: @flexia_typography_settings -> @flexia_typography_link
     */ 
    $wp_customize->add_setting('flexia_link_font_variants', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_link_font_variants',
            array(
                'label' => __('Link Font Variants', 'flexia'),
                'section' => 'flexia_typography_link',
                'settings' => 'flexia_link_font_variants',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    /**
     * Typography Section: Link Font Subsets
     * @flexia_link_font_subsets
     * Parent: @flexia_typography_settings -> @flexia_typography_link
     */ 
    $wp_customize->add_setting('flexia_link_font_subsets', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_link_font_subsets',
            array(
                'label' => __('Link Font Subsets', 'flexia'),
                'section' => 'flexia_typography_link',
                'settings' => 'flexia_link_font_subsets',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    /**
     * Typography Section: Link Font Text Transform
     * @flexia_link_font_text_transform
     * Parent: @flexia_typography_settings -> @flexia_typography_link
     */ 
    $wp_customize->add_setting( 'flexia_link_font_text_transform', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_select',
        'default' => $defaults['flexia_link_font_text_transform'],
        'transport' => 'postMessage',
    ));
      
    $wp_customize->add_control(
        'flexia_link_font_text_transform', 
        array(
            'type' => 'select',
            'section' => 'flexia_typography_link', // Add a default or your own section
            'label' => __( 'Text Transform', 'flexia' ),
            'choices' => array(
                'none' => __( 'None', 'flexia' ),
                'capitalize' => __( 'Capitalize', 'flexia' ),
                'uppercase' => __( 'Uppercase', 'flexia' ),
                'lowercase' => __( 'Lowercase', 'flexia' ),
            ),
        )
    );
    /**
     * ..............................................................
     */


    /**
     * ..............................................................
     * Typography Section: Add Section: Button
     * @flexia_typography_button
     * Parent: @flexia_typography_settings
     */    
    $wp_customize->add_section('flexia_typography_button', array(
        'title' => __('Button', 'flexia'),
        'priority' => 10,
    ));
    /**
     * Typography Section: Button Font Size
     * @flexia_button_font_size
     * Parent: @flexia_typography_settings -> @flexia_typography_button
     */
    $wp_customize->add_setting('flexia_button_font_size', array(
        'default' => $defaults['flexia_button_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',
    ));
    $wp_customize->add_control(
        new Customizer_Range_Value_Control(
            $wp_customize, 
            'flexia_button_font_size', array(
                'type' => 'range-value',
                'section' => 'flexia_typography_button',
                'settings' => 'flexia_button_font_size',
                'label' => __('Button Font Size (px)', 'flexia'),
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 5,
                    'step' => 0.01,
                    'suffix' => 'em', //optional suffix
                ),
            )
        )
    );

    /**
     * Typography Section: Button Font Line Height
     * @flexia_button_font_line_height
     * Parent: @flexia_typography_settings -> @flexia_typography_button
     */
    $wp_customize->add_setting('flexia_button_font_line_height', array(
        'default' => $defaults['flexia_button_font_line_height'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',
    ));
    $wp_customize->add_control(
        new Customizer_Range_Value_Control(
            $wp_customize, 
            'flexia_button_font_line_height', array(
                'type' => 'range-value',
                'section' => 'flexia_typography_button',
                'settings' => 'flexia_button_font_line_height',
                'label' => __('Line Height', 'flexia'),
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.1,
                    'suffix' => '', //optional suffix
                ),
            )
        )
    );

    /**
     * Typography Section: Button Font Family
     * @flexia_button_font_family
     * Parent: @flexia_typography_settings -> @flexia_typography_button
     */  
    $wp_customize->add_setting('flexia_button_font_family', array(
        'default' => $defaults['flexia_button_font_family'],
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new Customizer_Select2_Google_Fonts(
            $wp_customize,
            'flexia_button_font_family',
            array(
                'label' => esc_html__('Button Font', 'flexia'),
                'section' => 'flexia_typography_button',
                'settings' => 'flexia_button_font_family',
                'type' => 'select2_google_fonts',
                'choices' => flexia_google_fonts(),
            )
        )
    );

    /**
     * Typography Section: Button Font Variants
     * @flexia_button_font_variants
     * Parent: @flexia_typography_settings -> @flexia_typography_button
     */ 
    $wp_customize->add_setting('flexia_button_font_variants', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_button_font_variants',
            array(
                'label' => __('Button Font Variants', 'flexia'),
                'section' => 'flexia_typography_button',
                'settings' => 'flexia_button_font_variants',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    /**
     * Typography Section: Button Font Subsets
     * @flexia_button_font_subsets
     * Parent: @flexia_typography_settings -> @flexia_typography_button
     */ 
    $wp_customize->add_setting('flexia_button_font_subsets', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_button_font_subsets',
            array(
                'label' => __('Button Font Subsets', 'flexia'),
                'section' => 'flexia_typography_button',
                'settings' => 'flexia_button_font_subsets',
                'description' => '',
                'type' => 'select',
                'choices' => array(),
            )
        )
    );

    /**
     * Typography Section: Button Font Text Transform
     * @flexia_button_font_text_transform
     * Parent: @flexia_typography_settings -> @flexia_typography_button
     */ 
    $wp_customize->add_setting( 'flexia_button_font_text_transform', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_select',
        'default' => $defaults['flexia_button_font_text_transform'],
        'transport' => 'postMessage',
    ));
      
    $wp_customize->add_control(
        'flexia_button_font_text_transform', 
        array(
            'type' => 'select',
            'section' => 'flexia_typography_button', // Add a default or your own section
            'label' => __( 'Text Transform', 'flexia' ),
            'choices' => array(
                'none' => __( 'None', 'flexia' ),
                'capitalize' => __( 'Capitalize', 'flexia' ),
                'uppercase' => __( 'Uppercase', 'flexia' ),
                'lowercase' => __( 'Lowercase', 'flexia' ),
            ),
        )
    );
    /**
     * ..............................................................
     */
        

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

    $wp_customize->add_setting('flexia_blog_logo_width', array(
        'default' => $defaults['flexia_blog_logo_width'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_blog_logo_width',
            array(
                'label' => __('Blog Logo width (px)', 'flexia'),
                'section' => 'flexia_blog_header_settings',
                'settings' => 'flexia_blog_logo_width',
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

    //Flexia Blog Title Font Size
    $wp_customize->add_setting('flexia_blog_title_font_size', array(
        'default' => $defaults['flexia_blog_title_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_blog_title_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_blog_header_settings',
        'settings' => 'flexia_blog_title_font_size',
        'label' => __('Blog Title Font Size (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 160,
            'step' => 1,
            'suffix' => 'px', //optional suffix
        ),
    )));

    //Flexia Blog Title Font Color
    $wp_customize->add_setting('flexia_blog_title_font_color', array(
        'default' => $defaults['flexia_blog_title_font_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_blog_title_font_color',
            array(
                'label' => __('Blog Title Font Color', 'flexia'),
                'section' => 'flexia_blog_header_settings',
                'settings' => 'flexia_blog_title_font_color',
            ))
    );


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

    //Flexia Blog Description Font Size
    $wp_customize->add_setting('flexia_blog_desc_font_size', array(
        'default' => $defaults['flexia_blog_desc_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_blog_desc_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_blog_header_settings',
        'settings' => 'flexia_blog_desc_font_size',
        'label' => __('Blog Description Font Size (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 72,
            'step' => 1,
            'suffix' => 'px', //optional suffix
        ),
    )));

    //Flexia Blog Title Font Color
    $wp_customize->add_setting('flexia_blog_desc_font_color', array(
        'default' => $defaults['flexia_blog_desc_font_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_blog_desc_font_color',
            array(
                'label' => __('Blog Description Font Color', 'flexia'),
                'section' => 'flexia_blog_header_settings',
                'settings' => 'flexia_blog_desc_font_color',
            ))
    );

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
                'label' => __('Post Header Layout', 'flexia'),
                'section' => 'flexia_single_posts_settings',
                'settings' => 'flexia_single_posts_layout',
                'description' => 'Set the default post layout (global). You can control for individual posts from Flexia Post Settings.',
                'type' => 'radio',
                'choices' => array(
                    'flexia_single_posts_layout_large' => __('Large Header (Featured Image Background)', 'flexia'),
                    'flexia_single_posts_layout_simple' => __('Simple Header', 'flexia'),
                    'flexia_single_posts_layout_simple_no_container' => __('Simple Header No Container', 'flexia'),
                    'flexia_single_posts_layout_no_header' => __('No Header', 'flexia'),
                ),
            )
        )
    );
    
    //Blog Single Sidebar Control
    $wp_customize->add_setting(
        'flexia_single_content_layout',
        array(
            'default' => $defaults['flexia_single_content_layout'],
            'sanitize_callback' => 'flexia_sanitize_choices',
        ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_single_content_layout',
            array(
                'label' => __('Post Sidebar', 'flexia'),
                'section' => 'flexia_single_posts_settings',
                'settings' => 'flexia_single_content_layout',
                'description' => 'Set the default Sidebar for Single blog posts and other Single post types.',
                'type' => 'radio',
                'choices' => array(
                    'content_layout2' => __('Left Sidebar', 'flexia'),
                    'content_layout3' => __('Right Sidebar', 'flexia'),
                    'content_layout4' => __('No Sidebar', 'flexia'),
                ),
            )
        )
    );

    $wp_customize->add_setting('flexia_post_meta_bg_color', array(
        'default' => $defaults['flexia_post_meta_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_post_meta_bg_color',
            array(
                'label' => __('Post Meta Background', 'flexia'),
                'section' => 'flexia_single_posts_settings',
                'settings' => 'flexia_post_meta_bg_color',
            ))
    );

    $wp_customize->add_setting('flexia_post_max_width', array(
        'default' => $defaults['flexia_post_max_width'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_post_max_width', array(
        'type' => 'range-value',
        'section' => 'flexia_single_posts_settings',
        'settings' => 'flexia_post_max_width',
        'label' => __('Post Max Width (px)', 'flexia'),
        'input_attrs' => array(
            'min' => 600,
            'max' => 2000,
            'step' => 5,
            'suffix' => 'px', //optional suffix
        ),
    )));

    $wp_customize->add_setting('flexia_post_width', array(
        'default' => $defaults['flexia_post_width'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',

    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_post_width', array(
        'type' => 'range-value',
        'section' => 'flexia_single_posts_settings',
        'settings' => 'flexia_post_width',
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


    /**
     * ......................................................
     * ......................................................
     * Add Panel: Header
     * @flexia_header_panel
     */
    $wp_customize->add_panel('flexia_header_panel',array(
        'title'=>'Header',
        'description'=> 'Header Settings',
        'priority'=> 50,
    ));

    /**
     * ......................................................
     * Header Panel: Add Section - Layout
     * @flexia_header_layout
     * Parent: @flexia_header_panel
     */
    $wp_customize->add_section('flexia_header_layout', array(
        'title' => __('Layout', 'flexia'),
        'priority' => 10,
    ));

    /**
     * Header Layout Section: Layout Type
     * @flexia_header_layout_type
     * Parent: @flexia_header_panel -> flexia_header_layout
     */
    
    $wp_customize->add_setting( 'flexia_header_layout_type', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_select',
        'default' => $defaults['flexia_header_layout_type'],
    ));
      
    $wp_customize->add_control(
        'flexia_header_layout_type',
        array(
            'type' => 'select',
            'section' => 'flexia_header_layout', // Add a default or your own section
            'label' => __( 'Header Layout Type', 'flexia' ),
            'choices' => array(
                'boxed' => __('Boxed/ Container', 'flexia'),
                'full-width' => __('Full Width', 'flexia'),
            ),
        )
    );

    /**
     * Header Layout Section: Navbar Position
     * @flexia_navbar_position
     * Parent: @flexia_header_panel -> flexia_header_layout
     */
    $wp_customize->add_setting('flexia_navbar_position', array(
        'default' => $defaults['flexia_navbar_position'],
        'sanitize_callback' => 'flexia_sanitize_select',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_navbar_position',
            array(
                'label' => __('Navbar Position', 'flexia'),
                'section' => 'flexia_header_layout',
                'settings' => 'flexia_navbar_position',
                'type' => 'select',
                'choices' => array(
                    'flexia-navbar-static-top' => __('Default Top', 'flexia'),
                    'flexia-navbar-fixed-top' => __('Sticky Top', 'flexia'),
                    'flexia-navbar-transparent-top' => __('Transparent Default Top', 'flexia'),
                    'flexia-navbar-transparent-sticky-top' => __('Transparent Sticky Top', 'flexia'),
                ),
            )
        )
    );

    /**
     * Header Layout Section: Header Layouts
     * @flexia_header_layouts
     * Parent: @flexia_header_panel -> flexia_header_layout
     */
    $wp_customize->add_setting('flexia_header_layouts', array(
        'default' => $defaults['flexia_header_layouts'],
        'sanitize_callback' => 'flexia_sanitize_choices',
    ));

    $wp_customize->add_control(
		new Flexia_Radio_Image_Control(
            $wp_customize,
            'flexia_header_layouts',
            array(
                'type'          => 'flexia-radio-image',
                'settings'		=> 'flexia_header_layouts',
                'section'		=> 'flexia_header_layout',
                'label'			=> __('Header Styles', 'flexia'),
                'choices'		=> apply_filters(
                    'flexia_header_layouts', 
                    array(
                        '1' 	=> array(
                            'image' => get_template_directory_uri() . '/admin/img/header-layouts/header-01.png',
                        ),
                        '2' 	=> array(
                            'image' => get_template_directory_uri() . '/admin/img/header-layouts/header-02.png',
                        ),
                        '3' 	=> array(
                            'image' => get_template_directory_uri() . '/admin/img/header-layouts/header-03.png',
                        ),
                        '4' 	=> array(
                            'image' => get_template_directory_uri() . '/admin/img/header-layouts/header-04.png',
                        ),                        
                        // '5' 	=> array(
                        //     'image' => get_template_directory_uri() . '/admin/img/header-layouts/header-06.png',
                        //     'pro'   => true,
                        //     'url'   => 'https://flexia.pro/pricing/',
                        // ),
                        // '6' 	=> array(
                        //     'image' => get_template_directory_uri() . '/admin/img/header-layouts/header-07.png',
                        //     'pro'   => true,
                        //     'url'   => 'https://flexia.pro/pricing/',
                        // ),
                    )
                ),
            ) 
        )
    );
    
    $wp_customize->selective_refresh->add_partial( "flexia_header_layouts_partial", [
        'selector'            => "#masthead",
        'settings'            => [
            "flexia_header_layouts",
        ],
        'container_inclusive' => true,
    ] );

    /**
     * Header Layout Section: Mobile Layouts
     * @flexia_header_mobile_layouts
     * Parent: @flexia_header_panel -> flexia_header_layout
     */
    // $wp_customize->add_setting('flexia_header_mobile_layouts', array(
    //     'default' => $defaults['flexia_header_mobile_layouts'],
    //     'sanitize_callback' => 'flexia_sanitize_choices',
    // ));

    // $wp_customize->add_control(
    //     new Flexia_Radio_Image_Control(
    //         $wp_customize,
    //         'flexia_header_mobile_layouts',
    //         array(
    //             'label' => __('Mobile Layouts', 'flexia'),
    //             'section' => 'flexia_header_layout',
    //             'settings' => 'flexia_header_mobile_layouts',
    //             'type'          => 'flexia-radio-image',
    //             'choices'		=> apply_filters(
    //                 'mobile_flexia_header_layouts', 
    //                 array(
    //                     '1' 	=> array(
    //                         'image' => get_template_directory_uri() . '/admin/img/header-layouts/mobile-1.png',
    //                     ),
    //                     '2' 	=> array(
    //                         'image' => get_template_directory_uri() . '/admin/img/header-layouts/mobile-2.png',
    //                     ),
    //                     '3' 	=> array(
    //                         'image' => get_template_directory_uri() . '/admin/img/header-layouts/mobile-3.png',
    //                     ),
    //                     '4' 	=> array(
    //                         'image' => get_template_directory_uri() . '/admin/img/header-layouts/mobile-4.png',
    //                         'pro'   => true,
    //                         'url'   => 'https://flexia.pro/pricing/',
    //                     ),
    //                 )
    //             )
    //         )
    //     )
    // );


    /**
     * ......................................................
     */

    /**
     * ......................................................
     * Header Panel: Add Section - Logo
     * @flexia_header_logo
     * Parent: @flexia_general_settings
     */    
    // $wp_customize->add_section('flexia_header_logo', array(
    //     'title' => __('Logo', 'flexia'),
    //     'priority' => 10,
    // ));

    /**
     * Header Logo Section: Text Logo Color
     * @header_textcolor
     * Parent: @flexia_general_settings -> title_tagline
     */
    $wp_customize->get_control('header_textcolor')->default = ($defaults['flexia_primary_color']);
    $wp_customize->get_control('header_textcolor')->section = ('title_tagline');
    $wp_customize->get_control('header_textcolor')->label = __('Logo Text Color (if no logo image)', 'flexia');
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->priority = '5';

    /**
     * Header Logo Section: Primary Logo Label
     * @flexia_primary_logo_label
     * Parent: @flexia_general_settings -> title_tagline
     */
    $wp_customize->add_setting('flexia_primary_logo_label', array(
        'default' => $defaults['flexia_primary_logo_label'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'flexia_primary_logo_label', array(
        'priority' => 10,
        'label' => __('Primary Logo', 'flexia'),
        'settings' => 'flexia_primary_logo_label',
        'section' => 'title_tagline',
    )));

    /**
     * Header Logo Section: Display Site Title and Tagline
     * @display_header_text
     * Parent: @flexia_general_settings -> title_tagline
     */
    $wp_customize->get_control( 'display_header_text' )->priority = '9';

    /**
     * Header Logo Section: Default Logo
     * @custom_logo
     * Parent: @flexia_general_settings -> title_tagline
     */
    $wp_customize->get_control( 'custom_logo' )->section = 'title_tagline';
    $wp_customize->get_control( 'custom_logo' )->priority = '15';
    $wp_customize->get_control( 'custom_logo' )->label = 'Upload Primary Logo';

    /**
     * Header Logo Section: Default Logo Width
     * @flexia_header_logo_height
     * Parent: @flexia_general_settings -> title_tagline
     */
    $wp_customize->add_setting('flexia_header_logo_height', array(
        'default' => $defaults['flexia_header_logo_height'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',
    ));

    $wp_customize->add_control(
        new Customizer_Range_Value_Control(
            $wp_customize, 
            'flexia_header_logo_height', array(
                'priority' => 20,
                'type' => 'range-value',
                'section' => 'title_tagline',
                'settings' => 'flexia_header_logo_height',
                'label' => __('Logo Height (px)', 'flexia'),
                'input_attrs' => array(
                    'min' => 20,
                    'max' => 400,
                    'step' => 1,
                    'suffix' => 'px', //optional suffix
                ),
            )
        )
    );


    /**
     * Header Logo Section: Sticky Logo Label
     * @flexia_sticky_logo_label
     * Parent: @flexia_general_settings -> title_tagline
     */
    $wp_customize->add_setting('flexia_sticky_logo_label', array(
        'default' => $defaults['flexia_sticky_logo_label'],
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'flexia_sticky_logo_label', array(
        'label' => __('Sticky Logo', 'flexia'),
        'priority' => 29,
        'settings' => 'flexia_sticky_logo_label',
        'section' => 'title_tagline',
    )));

    /**
     * Header Logo Section: Sticky Logo
     * @flexia_custom_sticky_logo
     * Parent: @flexia_general_settings -> title_tagline
     */

    $wp_customize->add_setting('flexia_custom_sticky_logo', array(
        'default' => $defaults['flexia_custom_sticky_logo'],
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'flexia_custom_sticky_logo',
            array(
                'label'      => __( 'Upload Sticky Logo', 'flexia' ),
                'priority' => 30,
                'section'    => 'title_tagline',
                'settings'   => 'flexia_custom_sticky_logo',
                'context'    => 'flexia_flexia_custom_sticky_logo'
            )
        )
    );

    /**
     * Header Logo Section: Sticky Logo Width
     * @flexia_sticky_header_logo_height
     * Parent: @flexia_general_settings -> title_tagline
     */
    $wp_customize->add_setting('flexia_sticky_header_logo_height', array(
        'default' => $defaults['flexia_sticky_header_logo_height'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_integer',
    ));

    $wp_customize->add_control(
        new Customizer_Range_Value_Control(
            $wp_customize, 
            'flexia_sticky_header_logo_height', array(
                'priority' => 40,
                'type' => 'range-value',
                'section' => 'title_tagline',
                'settings' => 'flexia_sticky_header_logo_height',
                'label' => __('Sticky Header Logo Height (px)', 'flexia'),
                'input_attrs' => array(
                    'min' => 20,
                    'max' => 400,
                    'step' => 1,
                    'suffix' => 'px', //optional suffix
                ),
            )
        )
    );

    /**
     * ......................................................
     */

    /**
     * ......................................................
     * Header Panel: Add Section - Navbar
     * @flexia_header_navbar
     * Parent: @flexia_header_panel
     */    
    $wp_customize->add_section('flexia_header_navbar', array(
        'title' => __('Navbar', 'flexia'),
        'priority' => 10,
    ));

    // Navabr Separator

    $wp_customize->add_setting('navbar_settings_title', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'navbar_settings_title', array(
        'label' => __('Navbar Settings', 'flexia'),
        'settings' => 'navbar_settings_title',
        'section' => 'flexia_header_navbar',
        'priority' => 10,
    )));

    // Enable Navbar

    $wp_customize->add_setting('flexia_navbar', array(
        'default' => $defaults['flexia_navbar'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_navbar', array(
        'label' => esc_html__('Enable Navbar?', 'flexia'),
        'section' => 'flexia_header_navbar',
        'settings' => 'flexia_navbar',
        'type' => 'light', // light, ios, flat
        'priority' => 20,
    )));    

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
                'section' => 'flexia_header_navbar',
                'settings' => 'flexia_logobar_position',
                'type' => 'radio',
                'choices' => array(
                    'flexia-logobar-inline' => __('Inline', 'flexia'),
                    'flexia-logobar-stacked' => __('Stacked', 'flexia'),
                ),
                'priority' => 30,
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
                'section' => 'flexia_header_navbar',
                'settings' => 'flexia_logobar_bg_color',
                'priority' => 40,
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
                'label' => __('Navbar Background Color', 'flexia'),
                'section' => 'flexia_header_navbar',
                'settings' => 'flexia_navbar_bg_color',
                'priority' => 50,
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
        'section' => 'flexia_header_navbar',
        'priority' => 60,
    )));

    // Enable Navmenu Search
    $wp_customize->add_setting('flexia_nav_menu_search', array(
        'default' => $defaults['flexia_nav_menu_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_nav_menu_search', array(
        'label' => esc_html__('Enable Search Menu?', 'flexia'),
        'section' => 'flexia_header_navbar',
        'settings' => 'flexia_nav_menu_search',
        'type' => 'light', // light, ios, flat
        'priority' => 70,
    )));

    // Enable Cart in menu
    $wp_customize->add_setting('flexia_woo_cart_menu', array(
        'default' => $defaults['flexia_woo_cart_menu'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_woo_cart_menu', array(
        'label' => esc_html__('Enable Cart Menu?', 'flexia'),
        'section' => 'flexia_header_navbar',
        'settings' => 'flexia_woo_cart_menu',
        'type' => 'light', // light, ios, flat
        'priority' => 80,
    )));

    // Enable Nav Login Button
    $wp_customize->add_setting('flexia_enable_login_button', array(
        'default' => $defaults['flexia_enable_login_button'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_enable_login_button', array(
        'label' => esc_html__('Enable Login Button?', 'flexia'),
        'section' => 'flexia_header_navbar',
        'settings' => 'flexia_enable_login_button',
        'type' => 'light', // light, ios, flat
        'priority' => 90,
    )));

    //Custom Login URL
    $wp_customize->add_setting( 'flexia_custom_login_url', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_custom_login_url'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_custom_login_url',
            array(
                'label' => __('Custom Login URL', 'flexia'),
                'description' => __('Leave empty to use default login URL', 'flexia'),
                'section' => 'flexia_header_navbar',
                'settings' => 'flexia_custom_login_url',
                'type' => 'text',
                'priority' => 10,
                'input_attrs' => array(
                    'placeholder' => __( 'Your Login Page URL', 'flexia' ),
                ),
                'priority' => 100,
            )
        )
    );

    //Nav menu link color
    $wp_customize->add_setting('flexia_main_nav_menu_link_color', array(
        'default' => $defaults['flexia_main_nav_menu_link_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_link_color',
            array(
                'label' => __('Links color', 'flexia'),
                'section' => 'flexia_header_navbar',
                'settings' => 'flexia_main_nav_menu_link_color',
                'priority' => 110,
            ))
    );

    $wp_customize->add_setting('flexia_main_nav_menu_link_hover_color', array(
        'default' => $defaults['flexia_main_nav_menu_link_hover_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_link_hover_color',
            array(
                'label' => __('Links hover color', 'flexia'),
                'section' => 'flexia_header_navbar',
                'settings' => 'flexia_main_nav_menu_link_hover_color',
                'priority' => 120,
            ))
    );
    
    $wp_customize->add_setting('flexia_main_nav_menu_link_hover_bg', array(
        'default' => $defaults['flexia_main_nav_menu_link_hover_bg'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_link_hover_bg',
            array(
                'label' => __('Links hover background', 'flexia'),
                'section' => 'flexia_header_navbar',
                'settings' => 'flexia_main_nav_menu_link_hover_bg',
                'priority' => 130,
            ))
    );

    $wp_customize->add_setting('flexia_main_nav_menu_submenu_bg_color', array(
        'default' => $defaults['flexia_main_nav_menu_submenu_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_submenu_bg_color',
            array(
                'label' => __('Dropdown background', 'flexia'),
                'section' => 'flexia_header_navbar',
                'settings' => 'flexia_main_nav_menu_submenu_bg_color',
                'priority' => 140,
            ))
    );

    $wp_customize->add_setting('flexia_main_nav_menu_submenu_link_color', array(
        'default' => $defaults['flexia_main_nav_menu_submenu_link_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_submenu_link_color',
            array(
                'label' => __('Dropdown links color', 'flexia'),
                'section' => 'flexia_header_navbar',
                'settings' => 'flexia_main_nav_menu_submenu_link_color',
                'priority' => 150,
            ))
    );

    $wp_customize->add_setting('flexia_main_nav_menu_submenu_link_hover_color', array(
        'default' => $defaults['flexia_main_nav_menu_submenu_link_hover_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_submenu_link_hover_color',
            array(
                'label' => __('Dropdown links hover color', 'flexia'),
                'section' => 'flexia_header_navbar',
                'settings' => 'flexia_main_nav_menu_submenu_link_hover_color',
                'priority' => 150,
            ))
    );
    
    $wp_customize->add_setting('flexia_main_nav_menu_submenu_link_hover_bg', array(
        'default' => $defaults['flexia_main_nav_menu_submenu_link_hover_bg'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_main_nav_menu_submenu_link_hover_bg',
            array(
                'label' => __('Dropdown links hover background', 'flexia'),
                'section' => 'flexia_header_navbar',
                'settings' => 'flexia_main_nav_menu_submenu_link_hover_bg',
                'priority' => 160,
            ))
    );

    $wp_customize->add_setting('flexia_main_nav_menu_dropdown_animation', array(
        'default' => 'to-top',
        'transport' => 'postMessage',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control('flexia_main_nav_menu_dropdown_animation_control', array(
        'label' => 'Dropdown animation',
        'section' => 'flexia_header_navbar',
        'settings' => 'flexia_main_nav_menu_dropdown_animation',
        'type' => 'select',
        'priority' => 18,
        'choices' => array(
            'fade' => 'Fade',
            'to-top' => 'To Top',
            'zoom-in' => 'Zoom In',
            'zoom-out' => 'Zoom Out',
        ),
        'priority' => 170,
    ));

    // Header widget area Separator
    $wp_customize->add_setting('flexia_header_widget_area_settings_title', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'flexia_header_widget_area_settings_title', array(
        'label' => __('Header Widget Area', 'flexia'),
        'settings' => 'flexia_header_widget_area_settings_title',
        'section' => 'flexia_header_navbar',
        'priority' => 180,
    )));

    // Enable Header widget area
    $wp_customize->add_setting('flexia_header_widget_area', array(
        'default' => $defaults['flexia_header_widget_area'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_header_widget_area', array(
        'label' => esc_html__('Enable Header Widget Area?', 'flexia'),
        'section' => 'flexia_header_navbar',
        'settings' => 'flexia_header_widget_area',
        'type' => 'light', // light, ios, flat
        'priority' => 190,
    )));

    // Header widget area background
    $wp_customize->add_setting('flexia_header_widget_area_bg_color', array(
        'default' => $defaults['flexia_header_widget_area_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_header_widget_area_bg_color',
            array(
                'label' => __('Header Widget Area Background', 'flexia'),
                'section' => 'flexia_header_navbar',
                'settings' => 'flexia_header_widget_area_bg_color',
                'priority' => 200,
            ))
    );


    /**
     * ......................................................
     */

    /**
     * ......................................................
     * Header Panel: Add Section - Top Bar
     * @flexia_header_top
     * Parent: @flexia_header_panel
     */    
    $wp_customize->add_section('flexia_header_top', array(
        'title' => __('Top Bar', 'flexia'),
        'priority' => 10,
    ));

    // Topbar Separator
    $wp_customize->add_setting('topbar_settings_title', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'topbar_settings_title', array(
        'label' => __('Topbar Settings', 'flexia'),
        'settings' => 'topbar_settings_title',
        'section' => 'flexia_header_top',
    )));

    // Enable Topbar
    $wp_customize->add_setting('flexia_enable_topbar', array(
        'default' => $defaults['flexia_enable_topbar'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_enable_topbar', array(
        'label' => esc_html__('Enable Topbar?', 'flexia'),
        'section' => 'flexia_header_top',
        'settings' => 'flexia_enable_topbar',
        'type' => 'light', // light, ios, flat
    )));

    // Enable Topbar On Mobile
    $wp_customize->add_setting('flexia_enable_topbar_on_mobile', array(
        'default' => $defaults['flexia_enable_topbar_on_mobile'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_enable_topbar_on_mobile', array(
        'label' => esc_html__('Enable Topbar on Mobile?', 'flexia'),
        'section' => 'flexia_header_top',
        'settings' => 'flexia_enable_topbar_on_mobile',
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
                'label' => __('Topbar Background Color', 'flexia'),
                'section' => 'flexia_header_top',
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
                'section' => 'flexia_header_top',
                'settings' => 'flexia_topbar_content',
                'type' => 'textarea',
            )
        )
    );
     
    /**
     * Topbar Contact Info Separator
     * @top_contact_settings_title
     * Parent: @flexia_header_top
     */  
    $wp_customize->add_setting('top_contact_settings_title', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'top_contact_settings_title', array(
        'label' => __('Topbar Contact Info Settings', 'flexia'),
        'settings' => 'top_contact_settings_title',
        'section' => 'flexia_header_top',
    )));

    /**
     * Header Top: Topbar Phone Number
     * @flexia_header_top_phone
     * Parent: @flexia_header_top
     */  
    $wp_customize->add_setting( 'flexia_header_top_phone', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_header_top_phone'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_top_phone',
            array(
                'label' => __('Phone Number', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_header_top_phone',
                'type' => 'text',
                'input_attrs' => array(
                    'placeholder' => __( 'XXX XXX XXXX', 'flexia' ),
                )
            )
        )
    );

    /**
     * Header Top: Topbar Email Address
     * @flexia_header_top_email
     * Parent: @flexia_header_top
     */  
    $wp_customize->add_setting( 'flexia_header_top_email', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_header_top_email'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_top_email',
            array(
                'label' => __('Email Address', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_header_top_email',
                'type' => 'text',
                'input_attrs' => array(
                    'placeholder' => __( 'info@wpdeveloper.net', 'flexia' ),
                )
            )
        )
    );

    /**
     * Header Top: Topbar Location
     * @flexia_header_top_location
     * Parent: @flexia_header_top
     */  
    $wp_customize->add_setting( 'flexia_header_top_location', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_header_top_location'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_top_location',
            array(
                'label' => __('Location', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_header_top_location',
                'type' => 'text',
                'input_attrs' => array(
                    'placeholder' => __( 'Display name of your location', 'flexia' ),
                )
            )
        )
    );

    /**
     * Header Top: Topbar Location Link
     * @flexia_header_top_location_link
     * Parent: @flexia_header_top
     */  
    $wp_customize->add_setting( 'flexia_header_top_location_link', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_header_top_location_link'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_top_location_link',
            array(
                'label' => __('Location Link', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_header_top_location_link',
                'type' => 'text',
                'input_attrs' => array(
                    'placeholder' => __( 'Link of your Google Map Location', 'flexia' ),
                )
            )
        )
    );

    /**
     * Header Top: Topbar Contact Text Size
     * @flexia_header_top_contact_font_size
     * Parent: @flexia_header_top
     */  
    $wp_customize->add_setting('flexia_header_top_contact_font_size', array(
        'default' => $defaults['flexia_header_top_contact_font_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));
    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_header_top_contact_font_size', array(
        'type' => 'range-value',
        'section' => 'flexia_header_top',
        'settings' => 'flexia_header_top_contact_font_size',
        'label' => __('Font Size', 'flexia'),
        'input_attrs' => array(
            'min' => .5,
            'max' => 3,
            'step' => .1,
            'suffix' => 'em', //optional suffix
        ),
    )));

    /**
     * Header Top: Topbar Contact Text Color
     * @flexia_header_top_contact_font_color
     * Parent: @flexia_header_top
     */  
    $wp_customize->add_setting('flexia_header_top_contact_font_color', array(
        'default' => $defaults['flexia_header_top_contact_font_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_header_top_contact_font_color',
            array(
                'label' => __('Text Color', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_header_top_contact_font_color',
            ))
    );

    /**
     * Header Top: Topbar Contact Text Hover Color
     * @flexia_header_top_contact_font_hover_color
     * Parent: @flexia_header_top
     */  
    $wp_customize->add_setting('flexia_header_top_contact_font_hover_color', array(
        'default' => $defaults['flexia_header_top_contact_font_hover_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_header_top_contact_font_hover_color',
            array(
                'label' => __('Hover Color', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_header_top_contact_font_hover_color',
            ))
    );

    // Topbar Menu Separator
    $wp_customize->add_setting('top_nav_settings_title', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'top_nav_settings_title', array(
        'label' => __('Topbar Menu Settings', 'flexia'),
        'settings' => 'top_nav_settings_title',
        'section' => 'flexia_header_top',
    )));

    // Enable Topbar Menu
    $wp_customize->add_setting('flexia_enable_topbar_menu', array(
        'default' => $defaults['flexia_enable_topbar_menu'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_enable_topbar_menu', array(
        'label' => esc_html__('Enable Topbar Menu?', 'flexia'),
        'section' => 'flexia_header_top',
        'settings' => 'flexia_enable_topbar_menu',
        'type' => 'light', // light, ios, flat
    )));

    $wp_customize->add_setting('flexia_top_nav_menu_link_color', array(
        'default' => $defaults['flexia_top_nav_menu_link_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_link_color',
            array(
                'label' => __('Links color', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_top_nav_menu_link_color',
            ))
    );

    $wp_customize->add_setting('flexia_top_nav_menu_link_hover_color', array(
        'default' => $defaults['flexia_top_nav_menu_link_hover_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_link_hover_color',
            array(
                'label' => __('Links hover color', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_top_nav_menu_link_hover_color',
            ))
    );
    
    $wp_customize->add_setting('flexia_top_nav_menu_link_hover_bg', array(
        'default' => $defaults['flexia_top_nav_menu_link_hover_bg'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_link_hover_bg',
            array(
                'label' => __('Links hover background', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_top_nav_menu_link_hover_bg',
            ))
    );

    $wp_customize->add_setting('flexia_top_nav_menu_submenu_bg_color', array(
        'default' => $defaults['flexia_top_nav_menu_submenu_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_submenu_bg_color',
            array(
                'label' => __('Dropdown background', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_top_nav_menu_submenu_bg_color',
            ))
    );

    $wp_customize->add_setting('flexia_top_nav_menu_submenu_link_color', array(
        'default' => $defaults['flexia_top_nav_menu_submenu_link_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_submenu_link_color',
            array(
                'label' => __('Dropdown links color', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_top_nav_menu_submenu_link_color',
            ))
    );

    $wp_customize->add_setting('flexia_top_nav_menu_submenu_link_hover_color', array(
        'default' => $defaults['flexia_top_nav_menu_submenu_link_hover_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_submenu_link_hover_color',
            array(
                'label' => __('Dropdown links hover color', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_top_nav_menu_submenu_link_hover_color',
            ))
    );
    
    $wp_customize->add_setting('flexia_top_nav_menu_submenu_link_hover_bg', array(
        'default' => $defaults['flexia_top_nav_menu_submenu_link_hover_bg'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_top_nav_menu_submenu_link_hover_bg',
            array(
                'label' => __('Dropdown links hover background', 'flexia'),
                'section' => 'flexia_header_top',
                'settings' => 'flexia_top_nav_menu_submenu_link_hover_bg',
            ))
    );

    $wp_customize->add_setting('flexia_top_nav_menu_dropdown_animation', array(
        'default' => 'to-top',
        'transport' => 'postMessage',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control('flexia_top_nav_menu_dropdown_animation_control', array(
        'label' => 'Dropdown animation',
        'section' => 'flexia_header_top',
        'settings' => 'flexia_top_nav_menu_dropdown_animation',
        'type' => 'select',
        'choices' => array(
            'fade' => 'Fade',
            'to-top' => 'To Top',
            'zoom-in' => 'Zoom In',
            'zoom-out' => 'Zoom Out',
        ),
    ));


    /**
     * ......................................................
     */

     /**
     * ......................................................
     * Header Panel: Add Section - Social
     * @flexia_header_social
     * Parent: @flexia_header_panel
     */    
    $wp_customize->add_section('flexia_header_social', array(
        'title' => __('Social Media', 'flexia'),
        'priority' => 10,
    ));

    /**
     * Header Social: Enable Topbar?
     * @flexia_enable_header_social
     * Parent: @flexia_header_panel -> @flexia_header_social
     */    
    $wp_customize->add_setting(
        'flexia_enable_header_social', 
        array(
            'default' => $defaults['flexia_enable_header_social'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'flexia_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Customizer_Toggle_Control(
            $wp_customize, 
            'flexia_enable_header_social', 
            array(
                'label' => esc_html__('Enable Header Social?', 'flexia'),
                'section' => 'flexia_header_social',
                'settings' => 'flexia_enable_header_social',
                'type' => 'light', // light, ios, flat
            )
        )
    );

    /**
     * Header Social: Header Social Position
     * @flexia_header_social_position
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting( 'flexia_header_social_position', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_select',
        'default' => $defaults['flexia_header_social_position'],
    ));
      
    $wp_customize->add_control(
        'flexia_header_social_position',
        array(
            'type' => 'select',
            'section' => 'flexia_header_social', // Add a default or your own section
            'label' => __( 'Social Links Position', 'flexia' ),
            'choices' => array(
                'topbar' => __( 'Top Bar', 'flexia' ),
                'header_main' => __( 'Header Main', 'flexia' ),
            ),
        )
    );

    /**
     * Header Social: Header Social Alighnment
     * @flexia_header_social_alignment
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting( 'flexia_header_social_alignment', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_select',
        'default' => $defaults['flexia_header_social_alignment'],
    ));
      
    $wp_customize->add_control(
        'flexia_header_social_alignment',
        array(
            'type' => 'select',
            'section' => 'flexia_header_social', // Add a default or your own section
            'label' => __( 'Social Links Alignment', 'flexia' ),
            'choices' => array(
                'left' => __( 'Left', 'flexia' ),
                'right' => __( 'Right', 'flexia' ),
                'center' => __( 'Center', 'flexia' ),
            ),
        )
    );

    /**
     * Header Social: Header Social Icon Size
     * @flexia_header_social_icon_size
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting('flexia_header_social_icon_size', array(
        'default' => $defaults['flexia_header_social_icon_size'],
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'sanitize_callback' => 'flexia_sanitize_float',

    ));
    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'flexia_header_social_icon_size', array(
        'type' => 'range-value',
        'section' => 'flexia_header_social',
        'settings' => 'flexia_header_social_icon_size',
        'label' => __('Icon Size', 'flexia'),
        'input_attrs' => array(
            'min' => .5,
            'max' => 3,
            'step' => .1,
            'suffix' => 'em', //optional suffix
        ),
    )));

    /**
     * Header Social: Header Social Icon Color
     * @flexia_header_social_icon_color
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting('flexia_header_social_icon_color', array(
        'default' => $defaults['flexia_header_social_icon_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_header_social_icon_color',
            array(
                'label' => __('Icon Color', 'flexia'),
                'section' => 'flexia_header_social',
                'settings' => 'flexia_header_social_icon_color',
            ))
    );

    /**
     * Header Social: Header Social Icon Hover Color
     * @flexia_header_social_icon_hover_color
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting('flexia_header_social_icon_hover_color', array(
        'default' => $defaults['flexia_header_social_icon_hover_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_header_social_icon_hover_color',
            array(
                'label' => __('Icon Hover Color', 'flexia'),
                'section' => 'flexia_header_social',
                'settings' => 'flexia_header_social_icon_hover_color',
            ))
    );

    /**
     * Header Social: Header Social Link Open
     * @flexia_header_social_open_tab
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting( 'flexia_header_social_open_tab', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_select',
        'default' => $defaults['flexia_header_social_open_tab'],
    ));
      
    $wp_customize->add_control(
        'flexia_header_social_open_tab',
        array(
            'type' => 'select',
            'section' => 'flexia_header_social', // Add a default or your own section
            'label' => __( 'Social Links Open in?', 'flexia' ),
            'choices' => array(
                '_blank' => __( 'Open in New Tab', 'flexia' ),
                'header_main' => __( 'Open in same Tab', 'flexia' ),
            ),
        )
    );

    /**
     * Header Social: Header Social Link Separator
     * @flexia_header_social_link_separator
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting(
        'flexia_header_social_link_separator', 
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );

    $wp_customize->add_control(
        new Separator_Custom_control(
            $wp_customize, 
            'flexia_header_social_link_separator', 
            array(
                'label' => __('Social Media Links', 'flexia'),
                'description' => __('Leave Empty to hide any social media', 'flexia'),
                'settings' => 'flexia_header_social_link_separator',
                'section' => 'flexia_header_social',
            )
        )
    );

    /**
     * Header Social: Header Social Link Facebook
     * @flexia_header_social_link_facebook
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting( 'flexia_header_social_link_facebook', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_header_social_link_facebook'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_social_link_facebook',
            array(
                'label' => __('Facebook URL', 'flexia'),
                'section' => 'flexia_header_social',
                'settings' => 'flexia_header_social_link_facebook',
                'type' => 'text',
                'input_attrs' => array(
                    'placeholder' => __( 'https://www.facebook.com/', 'flexia' ),
                )
            )
        )
    );

    /**
     * Header Social: Header Social Link Instagram
     * @flexia_header_social_link_instagram
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting( 'flexia_header_social_link_instagram', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_header_social_link_instagram'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_social_link_instagram',
            array(
                'label' => __('Instagram URL', 'flexia'),
                'section' => 'flexia_header_social',
                'settings' => 'flexia_header_social_link_instagram',
                'type' => 'text',
                'input_attrs' => array(
                    'placeholder' => __( 'https://www.instagram.com/', 'flexia' ),
                )
            )
        )
    );

    /**
     * Header Social: Header Social Link Twitter
     * @flexia_header_social_link_twitter
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting( 'flexia_header_social_link_twitter', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_header_social_link_twitter'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_social_link_twitter',
            array(
                'label' => __('Twitter URL', 'flexia'),
                'section' => 'flexia_header_social',
                'settings' => 'flexia_header_social_link_twitter',
                'type' => 'text',
                'input_attrs' => array(
                    'placeholder' => __( 'https://www.twitter.com/', 'flexia' ),
                )
            )
        )
    );

    /**
     * Header Social: Header Social Link Linkedin
     * @flexia_header_social_link_linkedin
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting( 'flexia_header_social_link_linkedin', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_header_social_link_linkedin'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_social_link_linkedin',
            array(
                'label' => __('Linkedin URL', 'flexia'),
                'section' => 'flexia_header_social',
                'settings' => 'flexia_header_social_link_linkedin',
                'type' => 'text',
                'input_attrs' => array(
                    'placeholder' => __( 'https://www.linkedin.com/', 'flexia' ),
                )
            )
        )
    );

    /**
     * Header Social: Header Social Link YouTube
     * @flexia_header_social_link_youtube
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting( 'flexia_header_social_link_youtube', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_header_social_link_youtube'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_social_link_youtube',
            array(
                'label' => __('YouTube URL', 'flexia'),
                'section' => 'flexia_header_social',
                'settings' => 'flexia_header_social_link_youtube',
                'type' => 'text',
                'input_attrs' => array(
                    'placeholder' => __( 'https://www.youtube.com/', 'flexia' ),
                )
            )
        )
    );

    /**
     * Header Social: Header Social Link Pinterest
     * @flexia_header_social_link_pinterest
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting( 'flexia_header_social_link_pinterest', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_header_social_link_pinterest'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_social_link_pinterest',
            array(
                'label' => __('Pinterest URL', 'flexia'),
                'section' => 'flexia_header_social',
                'settings' => 'flexia_header_social_link_pinterest',
                'type' => 'text',
                'input_attrs' => array(
                    'placeholder' => __( 'https://www.pinterest.com/', 'flexia' ),
                )
            )
        )
    );

    /**
     * Header Social: Header Social Link Reddit
     * @flexia_header_social_link_reddit
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting( 'flexia_header_social_link_reddit', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_header_social_link_reddit'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_social_link_reddit',
            array(
                'label' => __('Reddit URL', 'flexia'),
                'section' => 'flexia_header_social',
                'settings' => 'flexia_header_social_link_reddit',
                'type' => 'text',
                'input_attrs' => array(
                    'placeholder' => __( 'https://www.reddit.com/', 'flexia' ),
                )
            )
        )
    );

    /**
     * Header Social: Header Social Link RSS
     * @flexia_header_social_link_rss
     * Parent: @flexia_header_panel -> @flexia_header_social
     */  
    $wp_customize->add_setting( 'flexia_header_social_link_rss', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $defaults['flexia_header_social_link_rss'],
    ));
      
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_header_social_link_rss',
            array(
                'label' => __('RSS URL', 'flexia'),
                'section' => 'flexia_header_social',
                'settings' => 'flexia_header_social_link_rss',
                'type' => 'text',
                'input_attrs' => array(
                    'placeholder' => __( 'Your RSS Feed Link', 'flexia' ),
                )
            )
        )
    );


    /**
     * ......................................................
     */

    

    // Footer Settings
    $wp_customize->add_section('flexia_footer_settings', array(
        'title' => __('Footer', 'flexia'),
        'priority' => 60,
    ));

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
        'priority' => 10,
    )));

    $wp_customize->add_setting('flexia_footer_widget_settings_title', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'flexia_footer_widget_settings_title', array(
        'label' => __('Footer Widget', 'flexia'),
        'settings' => 'flexia_footer_widget_settings_title',
        'section' => 'flexia_footer_settings',
        'priority' => 20,
    )));

    // Enable Footer widget area
    $wp_customize->add_setting('flexia_footer_widget_area', array(
        'default' => $defaults['flexia_footer_widget_area'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'flexia_footer_widget_area', array(
        'label' => esc_html__('Enable Footer Widget Area?', 'flexia'),
        'section' => 'flexia_footer_settings',
        'settings' => 'flexia_footer_widget_area',
        'type' => 'light', // light, ios, flat
        'priority' => 30,
    )));

    /**
     * Footer Layout Section: Widget Number of Columns
     * @flexia_footer_widget_column
     * Parent: @flexia_footer_settings
     */
    $wp_customize->add_setting('flexia_footer_widget_column', array(
        'default' => $defaults['flexia_footer_widget_column'],
        'sanitize_callback' => 'flexia_sanitize_choices',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'flexia_footer_widget_column',
            array(
                'label' => __('Widget Columns', 'flexia'),
                'section' => 'flexia_footer_settings',
                'settings' => 'flexia_footer_widget_column',
                'type' => 'radio',
                'choices' => array(
                    'one-column' => __('One Column', 'flexia'),
                    'two-column' => __('Two Columns', 'flexia'),
                    'three-column' => __('Three Columns', 'flexia'),
                    'four-column' => __('Four Columns', 'flexia'),
                ),
                'priority' => 40,
            )
        )
    );

    $wp_customize->add_setting('flexia_footer_widget_area_bg_color', array(
        'default' => $defaults['flexia_footer_widget_area_bg_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_footer_widget_area_bg_color',
            array(
                'label' => __('Footer Widget Area Background Color', 'flexia'),
                'section' => 'flexia_footer_settings',
                'settings' => 'flexia_footer_widget_area_bg_color',
                'priority' => 50,
            ))
    );

    $wp_customize->add_setting('flexia_footer_widget_area_content_color', array(
        'default' => $defaults['flexia_footer_widget_area_content_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_footer_widget_area_content_color',
            array(
                'label' => __('Footer Widget Content Color', 'flexia'),
                'section' => 'flexia_footer_settings',
                'settings' => 'flexia_footer_widget_area_content_color',
                'priority' => 60,
            ))
    );

    $wp_customize->add_setting('flexia_footer_widget_area_link_color', array(
        'default' => $defaults['flexia_footer_widget_area_link_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_footer_widget_area_link_color',
            array(
                'label' => __('Footer Widget Link Color', 'flexia'),
                'section' => 'flexia_footer_settings',
                'settings' => 'flexia_footer_widget_area_link_color',
                'priority' => 70,
            ))
    );

    $wp_customize->add_setting('flexia_footer_widget_area_link_hover_color', array(
        'default' => $defaults['flexia_footer_widget_area_link_hover_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexia_footer_widget_area_link_hover_color',
            array(
                'label' => __('Footer Widget Link Hover Color', 'flexia'),
                'section' => 'flexia_footer_settings',
                'settings' => 'flexia_footer_widget_area_link_hover_color',
                'priority' => 80,
            ))
    );
    
    $wp_customize->add_setting('footer_copyright_settings_title', array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    ));

    $wp_customize->add_control(new Separator_Custom_control($wp_customize, 'footer_copyright_settings_title', array(
        'label' => __('Copyright Area', 'flexia'),
        'settings' => 'footer_copyright_settings_title',
        'section' => 'flexia_footer_settings',
        'priority' => 90,
    )));

    // Enable Bottom Footer
    $wp_customize->add_setting('footer_bottom', array(
        'default' => $defaults['footer_bottom'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(new Customizer_Toggle_Control($wp_customize, 'footer_bottom', array(
        'label' => esc_html__('Enable Bottom Footer?', 'flexia'),
        'section' => 'flexia_footer_settings',
        'settings' => 'footer_bottom',
        'type' => 'light', // light, ios, flat
        'priority' => 100,
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
        'priority' => 120,
    )));

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
                'priority' => 130,
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
                'priority' => 140,
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
                'priority' => 150,
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
                'priority' => 160,
            ))
    );

    $wp_customize->add_setting('flexia_footer_content', 
    array(
        'default' => $defaults['flexia_footer_content'],
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
                'priority' => 170,
            )
        )
    );

    /**
     * Add Sidebar Area Settings in WooCommerce Panel
     * @flexia_woo_sidebar_section
     * Parent: @woocommerce
     */
    $wp_customize->add_section('flexia_woo_sidebar_section', array(
        'title' => __('WooCommerce Sidebar', 'flexia')
    ));

    /**
     * WooCommerce Default Widget Selection
     * @flexia_woo_sidebar_default
     * Parent: @woocommerce -> @flexia_woo_sidebar_section
     */
    $wp_customize->add_setting( 'flexia_woo_sidebar_default', array(              
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_select',
        'default' => $defaults['flexia_woo_sidebar_default'],
        'transport' => 'postMessage',
    ));

    $widget_list = array();
    foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
        $widget_list[$sidebar['id']] = ucwords( $sidebar['name'] );
    }
      
    $wp_customize->add_control(
        'flexia_woo_sidebar_default', 
        array(
            'type' => 'select',
            'section' => 'flexia_woo_sidebar_section',
            'label' => __( 'Default Sidebar for WooCommerce', 'flexia' ),
            'choices' => $widget_list,
        )
    );

    /**
     * Enable Sidebar in Shop Page
     * @flexia_woo_sidebar_shop_page
     * Parent: @woocommerce -> @flexia_woo_sidebar_section
     */
    $wp_customize->add_setting('flexia_woo_sidebar_shop_page', array(
        'default' => $defaults['flexia_woo_sidebar_shop_page'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(
        new Customizer_Toggle_Control(
            $wp_customize, 
            'flexia_woo_sidebar_shop_page', array(
            'label' => esc_html__('Enable Sidebar in Shop Page?', 'flexia'),
            'section' => 'flexia_woo_sidebar_section',
            'settings' => 'flexia_woo_sidebar_shop_page',
            'type' => 'light', // light, ios, flat
    )));

    /**
     * Enable Sidebar in Product Single
     * @flexia_woo_sidebar_product_single
     * Parent: @woocommerce -> @flexia_woo_sidebar_section
     */
    $wp_customize->add_setting('flexia_woo_sidebar_product_single', array(
        'default' => $defaults['flexia_woo_sidebar_product_single'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(
        new Customizer_Toggle_Control(
            $wp_customize, 
            'flexia_woo_sidebar_product_single', array(
            'label' => esc_html__('Enable Sidebar in Single Product Page?', 'flexia'),
            'section' => 'flexia_woo_sidebar_section',
            'settings' => 'flexia_woo_sidebar_product_single',
            'type' => 'light', // light, ios, flat
    )));

    /**
     * Enable Sidebar in Cart Page
     * @flexia_woo_sidebar_cart_page
     * Parent: @woocommerce -> @flexia_woo_sidebar_section
     */
    $wp_customize->add_setting('flexia_woo_sidebar_cart_page', array(
        'default' => $defaults['flexia_woo_sidebar_cart_page'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(
        new Customizer_Toggle_Control(
            $wp_customize, 
            'flexia_woo_sidebar_cart_page', array(
            'label' => esc_html__('Enable Sidebar in Cart Page?', 'flexia'),
            'section' => 'flexia_woo_sidebar_section',
            'settings' => 'flexia_woo_sidebar_cart_page',
            'type' => 'light', // light, ios, flat
    )));

    /**
     * Enable Sidebar in Checkout Page
     * @flexia_woo_sidebar_checkout_page
     * Parent: @woocommerce -> @flexia_woo_sidebar_section
     */
    $wp_customize->add_setting('flexia_woo_sidebar_checkout_page', array(
        'default' => $defaults['flexia_woo_sidebar_checkout_page'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(
        new Customizer_Toggle_Control(
            $wp_customize, 
            'flexia_woo_sidebar_checkout_page', array(
            'label' => esc_html__('Enable Sidebar in Checkout Page?', 'flexia'),
            'section' => 'flexia_woo_sidebar_section',
            'settings' => 'flexia_woo_sidebar_checkout_page',
            'type' => 'light', // light, ios, flat
    )));

    /**
     * Enable Sidebar in Product Arcive Page
     * @flexia_woo_sidebar_archive_page
     * Parent: @woocommerce -> @flexia_woo_sidebar_section
     */
    $wp_customize->add_setting('flexia_woo_sidebar_archive_page', array(
        'default' => $defaults['flexia_woo_sidebar_archive_page'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexia_sanitize_checkbox',
    ));

    $wp_customize->add_control(
        new Customizer_Toggle_Control(
            $wp_customize, 
            'flexia_woo_sidebar_archive_page', array(
            'label' => esc_html__('Enable Sidebar in Product Archive Page?', 'flexia'),
            'section' => 'flexia_woo_sidebar_section',
            'settings' => 'flexia_woo_sidebar_archive_page',
            'type' => 'light', // light, ios, flat
    )));





    // Create custom panels
    $wp_customize->add_panel('flexia_general_settings', array(
        'priority' => 10,
        'theme_supports' => '',
        'title' => __('Global', 'flexia'),
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
    $wp_customize->get_section('flexia_layout_settings')->panel = 'flexia_general_settings';
    $wp_customize->get_section('flexia_default_colors_settings')->panel = 'flexia_design_settings';
    $wp_customize->get_section('flexia_default_colors_settings')->priority = 100;
    // $wp_customize->get_section('background_image')->panel = 'flexia_design_settings';
    // $wp_customize->get_section('background_image')->priority = 1000;
    $wp_customize->get_section('flexia_blog_content_settings')->panel = 'flexia_blog_settings';
    $wp_customize->get_section('flexia_blog_header_settings')->panel = 'flexia_blog_settings';
    $wp_customize->get_section('flexia_single_posts_settings')->panel = 'flexia_blog_settings';
    $wp_customize->get_section('flexia_page_settings')->panel = 'flexia_design_settings';
    $wp_customize->get_section('flexia_overlay_search_settings')->panel = 'flexia_design_settings';
    //Add Sections to Typography Panel
    $wp_customize->get_section('flexia_typography_body')->panel = 'flexia_typography_settings';
    $wp_customize->get_section('flexia_typography_paragraph')->panel = 'flexia_typography_settings';
    $wp_customize->get_section('flexia_typography_heading')->panel = 'flexia_typography_settings';
    $wp_customize->get_section('flexia_typography_link')->panel = 'flexia_typography_settings';
    $wp_customize->get_section('flexia_typography_button')->panel = 'flexia_typography_settings';
    //Add Sections to Header Section
    $wp_customize->get_section('header_image')->panel = 'flexia_blog_settings';
    $wp_customize->get_section('header_image')->priority = '1';
    $wp_customize->get_section('flexia_header_layout')->panel = 'flexia_header_panel';
    // $wp_customize->get_section('flexia_header_logo')->panel = 'flexia_header_panel';
    $wp_customize->get_section('flexia_header_navbar')->panel = 'flexia_header_panel';
    $wp_customize->get_section('flexia_header_top')->panel = 'flexia_header_panel';
    $wp_customize->get_section('flexia_header_social')->panel = 'flexia_header_panel';
    //Add Section to Blog Styles
    $wp_customize->get_section('header_image')->panel = 'flexia_blog_settings';
    $wp_customize->get_section('header_image')->label = __('Blog Page Header Image', 'flexia');    
    //Add Section to WooCommerce
    $wp_customize->get_section('flexia_woo_sidebar_section')->panel = 'woocommerce';
}
add_action('customize_register', 'flexia_customize_register');

require get_template_directory() . '/framework/functions/customizer/output/header.php';
require get_template_directory() . '/framework/functions/customizer/output/output-css.php';