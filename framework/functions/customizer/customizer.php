<?php
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
if ( class_exists( 'WP_Customize_Control' ) ) {
	require_once( get_template_directory() . '/framework/functions/customizer/controls.php' );
}

function flexia_customize_register( $wp_customize ) {

	// Customize title and tagline sections and labels
	$wp_customize->get_section('title_tagline')->title = __('Site Name and Description', 'flexia');  
	$wp_customize->get_control('blogname')->label = __('Site Name', 'flexia');  
	$wp_customize->get_control('blogdescription')->label = __('Site Description', 'flexia');  
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Customize the Front Page Settings
	$wp_customize->get_section('static_front_page')->title = __('Homepage Preferences', 'flexia');
	$wp_customize->get_section('static_front_page')->priority = 20;
	$wp_customize->get_control('show_on_front')->label = __('Choose Homepage Preference', 'flexia');  
	$wp_customize->get_control('page_on_front')->label = __('Select Homepage', 'flexia');  
	$wp_customize->get_control('page_for_posts')->label = __('Select Blog Homepage', 'flexia');  

	// Customize Background Settings
	$wp_customize->get_section('background_image')->title = __('Background Styles', 'flexia');  
	$wp_customize->get_control('background_color')->section = 'background_image'; 

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'flexia_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'flexia_customize_partial_blogdescription',
		) );
	}


  // Layout Settings

	$wp_customize->add_section( 'layout_settings' , array(
	'title'      => __('Layout','flexia'), 
	'priority'   => 20    
	) );  

	$wp_customize->add_setting( 'container_max_width', array(
			'default'       => get_theme_mod( 'container_max_width', '1200' ),
			'capability'    => 'edit_theme_options',
			'transport' => 'postMessage',

	) );

	$wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, 'container_max_width', array(
		'type'     => 'range-value',
		'section'  => 'layout_settings',
		'settings' => 'container_max_width',
		'label'    => __( 'Site Max Width (px)' ),
		'input_attrs' => array(
			'min'    => 600,
			'max'    => 2000,
			'step'   => 5,
			'suffix' => 'px', //optional suffix
	  	),
	) ) );

	$wp_customize->add_setting( 'container_width', array(
			'default'       => get_theme_mod( 'container_width', '90' ),
			'capability'    => 'edit_theme_options',
			'transport' => 'postMessage',

	) );

	$wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, 'container_width', array(
		'type'     => 'range-value',
		'section'  => 'layout_settings',
		'settings' => 'container_width',
		'label'    => __( 'Site Width (%)' ),
		'input_attrs' => array(
			'min'    => 50,
			'max'    => 100,
			'step'   => 1,
			'suffix' => '%', //optional suffix
	  	),
	) ) );



	$wp_customize->add_setting( 'content_layout' , array(
	    'default'   => 'content_layout1',
	) );


	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        'content_layout',
	        array(
	            'label'          => __( 'Content Layout', 'flexia' ),
	            'section'        => 'layout_settings',
	            'settings'       => 'content_layout',
	            'description'    => 'This settings will be reflected on blog page, single posts and archives. For pages, you can use page templates.',
	            'type'           => 'radio',
	            'choices'        => array(
	                'content_layout1'   => __( 'Sidebar | Content | Sidebar' ),
	                'content_layout2'   => __( 'Sidebar | Content' ),
	                'content_layout3'   => __( 'Content | Sidebar' ),
	                'content_layout4'   => __( 'Content Only' )
	            )
	        )
	    )
	);



	$wp_customize->add_setting( 'left_sidebar_width', array(
			'default'       => get_theme_mod( 'left_sidebar_width', '300' ),
			'capability'    => 'edit_theme_options',
			'transport' => 'postMessage',

	) );

	$wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, 'left_sidebar_width', array(
		'type'     => 'range-value',
		'section'  => 'layout_settings',
		'settings' => 'left_sidebar_width',
		'default' => '300',
		'label'    => __( 'Left Sidebar Width (px)' ),
		'input_attrs' => array(
			'min'    => 100,
			'max'    => 500,
			'step'   => 5,
			'suffix' => 'px', //optional suffix
	  	),
	) ) );


	$wp_customize->add_setting( 'right_sidebar_width', array(
			'default'       => get_theme_mod( 'left_sidebar_width', '300' ),
			'capability'    => 'edit_theme_options',
			'transport' => 'postMessage',

	) );

	$wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, 'right_sidebar_width', array(
		'type'     => 'range-value',
		'section'  => 'layout_settings',
		'settings' => 'right_sidebar_width',
		'default' => '300',
		'label'    => __( 'Right Sidebar Width (px)' ),
		'input_attrs' => array(
			'min'    => 100,
			'max'    => 500,
			'step'   => 5,
			'suffix' => 'px', //optional suffix
	  	),
	) ) );



  // Blog Settings

	$wp_customize->add_section( 'blog_settings' , array(
	'title'      => __('Blog Styles','flexia'), 
	'priority'   => 30    
	) );  

	$wp_customize->add_setting( 'blog_bg_color' , array(
	    'default'     => '#f9f9f9',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'blog_bg_color', 
		array(
			'label'      => __( 'Blog Body Background', 'flexia' ),
			'section'    => 'blog_settings',
			'settings'   => 'blog_bg_color',
		) ) 
	);

	$wp_customize->add_setting( 'post_content_bg_color' , array(
	    'default'     => '#fff',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'post_content_bg_color', 
		array(
			'label'      => __( 'Post Content Background', 'flexia' ),
			'section'    => 'blog_settings',
			'settings'   => 'post_content_bg_color',
		) ) 
	);

	$wp_customize->add_setting( 'post_meta_bg_color' , array(
	    'default'     => '#fff',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'post_meta_bg_color', 
		array(
			'label'      => __( 'Post Meta Background', 'flexia' ),
			'section'    => 'blog_settings',
			'settings'   => 'post_meta_bg_color',
		) ) 
	);

	$wp_customize->add_setting( 'sidebar_widget_bg_color' , array(
	    'default'     => '#fff',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'sidebar_widget_bg_color', 
		array(
			'label'      => __( 'Sidebar Widget Background', 'flexia' ),
			'section'    => 'blog_settings',
			'settings'   => 'sidebar_widget_bg_color',
		) ) 
	);


	$wp_customize->add_setting( 'post_max_width', array(
			'default'       => get_theme_mod( 'post_max_width', '1200' ),
			'capability'    => 'edit_theme_options',
			'transport' => 'postMessage',

	) );

	$wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, 'post_max_width', array(
		'type'     => 'range-value',
		'section'  => 'blog_settings',
		'settings' => 'post_max_width',
		'label'    => __( 'Post Max Width (px)' ),
		'input_attrs' => array(
			'min'    => 600,
			'max'    => 2000,
			'step'   => 5,
			'suffix' => 'px', //optional suffix
	  	),
	) ) );

	$wp_customize->add_setting( 'post_width', array(
			'default'       => get_theme_mod( 'post_width', '90' ),
			'capability'    => 'edit_theme_options',
			'transport' => 'postMessage',

	) );

	$wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, 'post_width', array(
		'type'     => 'range-value',
		'section'  => 'blog_settings',
		'settings' => 'post_width',
		'label'    => __( 'Post Width (%)' ),
		'input_attrs' => array(
			'min'    => 50,
			'max'    => 100,
			'step'   => 1,
			'suffix' => '%', //optional suffix
	  	),
	) ) );

	// Show post navigation

	$wp_customize->add_setting( 'post_navigation', array(
			'default'     => true,
			'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'post_navigation', array(
			'label'	      => esc_html__( 'Enable Next/Prev posts?', 'flexia' ),
			'section'     => 'blog_settings',
			'settings'    => 'post_navigation',
			'type'        => 'light',// light, ios, flat
	) ) );

	// Show author under post

	$wp_customize->add_setting( 'post_author', array(
			'default'     => true,
			'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'post_author', array(
			'label'	      => esc_html__( 'Show Author under post?', 'flexia' ),
			'section'     => 'blog_settings',
			'settings'    => 'post_author',
			'type'        => 'light',// light, ios, flat
	) ) );


	// Show author under post

	$wp_customize->add_setting( 'post_social_share', array(
			'default'     => true,
			'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'post_social_share', array(
			'label'	      => esc_html__( 'Show Social Share under post?', 'flexia' ),
			'section'     => 'blog_settings',
			'settings'    => 'post_social_share',
			'type'        => 'light',// light, ios, flat
	) ) );

	// Show scroll bottom anchor

	$wp_customize->add_setting( 'scroll_bottom_arrow', array(
			'default'     => true,
			'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'scroll_bottom_arrow', array(
			'label'	      => esc_html__( 'Show Scrol to bottom arrow?', 'flexia' ),
			'section'     => 'blog_settings',
			'settings'    => 'scroll_bottom_arrow',
			'type'        => 'light',// light, ios, flat
	) ) );


	// Blog logo/Icon

	$wp_customize->add_setting( 'show_blog_logo' , array(
	    'default'   => 'blog_icon',
	) );


	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        'show_blog_logo',
	        array(
	            'label'          => __( 'Blog Logo / Icon', 'flexia' ),
	            'section'        => 'blog_settings',
	            'settings'       => 'show_blog_logo',
	            'description'    => 'Set an icon or logo for blog home page.',
	            'type'           => 'select',
	            'choices'        => array(
	                'blog_icon'   => __( 'Icon' ),
	                'blog_logo_image'   => __( 'Image' ),
	                'blog_logo_none'   => __( 'None' )
	            )
	        )
	    )
	);


	$wp_customize->add_setting( 'blog_icon_class' , array(
	    'default'   => 'fa-pencil',
	) );


	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        'blog_icon_class',
	        array(
	            'label'          => __( 'Icon Class (Font Awesome)', 'flexia' ),
	            'section'        => 'blog_settings',
	            'settings'       => 'blog_icon_class',
	            'description'    => 'Enter font awesome icon class (i.e. fa-pencil)',
	            'type'           => 'text',
	        )
	    )
	);


	$wp_customize->add_setting( 'blog_logo' , array(
	    'default'   => '',
	) );


	$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'blog_logo',
           array(
               'label'      => __( 'Upload a logo for blog', 'flexia' ),
               'section'    => 'blog_settings',
               'settings'   => 'blog_logo',
               'context'    => 'flexia_blog_logo' 
           )
       )
   );


	$wp_customize->add_setting( 'blog_logo_width' , array(
	    'default'   => '150',
	    'transport' => 'postMessage',
	) );


	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        'blog_logo_width',
	        array(
	            'label'          => __( 'Blog Logo width (px)', 'flexia' ),
	            'section'        => 'blog_settings',
	            'settings'       => 'blog_logo_width',
	            'type'           => 'text',
	        )
	    )
	);

	$wp_customize->add_setting( 'blog_title_font_size', array(
			'default'       => get_theme_mod( 'blog_title_font_size', '54' ),
			'capability'    => 'edit_theme_options',
			'transport' => 'postMessage',

	) );

	$wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, 'blog_title_font_size', array(
		'type'     => 'range-value',
		'section'  => 'blog_settings',
		'settings' => 'blog_title_font_size',
		'label'    => __( 'Blog Title Font Size (px)' ),
		'input_attrs' => array(
			'min'    => 1,
			'max'    => 160,
			'step'   => 1,
			'suffix' => 'px', //optional suffix
	  	),
	) ) );

	$wp_customize->add_setting( 'blog_desc_font_size', array(
			'default'       => get_theme_mod( 'blog_desc_font_size', '18' ),
			'capability'    => 'edit_theme_options',
			'transport' => 'postMessage',

	) );

	$wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, 'blog_desc_font_size', array(
		'type'     => 'range-value',
		'section'  => 'blog_settings',
		'settings' => 'blog_desc_font_size',
		'label'    => __( 'Blog Description Font Size (px)' ),
		'input_attrs' => array(
			'min'    => 1,
			'max'    => 72,
			'step'   => 1,
			'suffix' => 'px', //optional suffix
	  	),
	) ) );


  // Create custom panels
  $wp_customize->add_panel( 'general_settings', array(
      'priority' => 10,
      'theme_supports' => '',
      'title' => __( 'General Settings', 'flexia' ),
      'description' => __( 'Controls the basic settings for the theme.', 'flexia' ),
  ) );


  $wp_customize->add_panel( 'design_settings', array(
      'priority' => 30,
      'theme_supports' => '',
      'title' => __( 'Design', 'flexia' ),
      'description' => __( 'Controls the design settings for the theme.', 'flexia' ),
  ) ); 

  // Assign sections to panels
  $wp_customize->get_section('title_tagline')->panel = 'general_settings';      
  $wp_customize->get_section('static_front_page')->panel = 'general_settings';
  $wp_customize->get_section('background_image')->panel = 'design_settings';
  $wp_customize->get_section('background_image')->priority = 1000;
  $wp_customize->get_section('header_image')->panel = 'design_settings';  


}
add_action( 'customize_register', 'flexia_customize_register' );


require get_template_directory() . '/framework/functions/customizer/output/header.php';
require get_template_directory() . '/framework/functions/customizer/output/layout.php';
require get_template_directory() . '/framework/functions/customizer/output/output-css.php';
