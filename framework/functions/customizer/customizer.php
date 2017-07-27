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

	$wp_customize->add_section( 'flexia_layout_settings' , array(
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
		'section'  => 'flexia_layout_settings',
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
		'section'  => 'flexia_layout_settings',
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
	            'section'        => 'flexia_layout_settings',
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
		'section'  => 'flexia_layout_settings',
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
		'section'  => 'flexia_layout_settings',
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

	$wp_customize->add_section( 'flexia_blog_settings' , array(
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
			'section'    => 'flexia_blog_settings',
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
			'section'    => 'flexia_blog_settings',
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
			'section'    => 'flexia_blog_settings',
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
			'section'    => 'flexia_blog_settings',
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
		'section'  => 'flexia_blog_settings',
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
		'section'  => 'flexia_blog_settings',
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
			'section'     => 'flexia_blog_settings',
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
			'section'     => 'flexia_blog_settings',
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
			'section'     => 'flexia_blog_settings',
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
			'section'     => 'flexia_blog_settings',
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
	            'section'        => 'flexia_blog_settings',
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
	            'section'        => 'flexia_blog_settings',
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
               'section'    => 'flexia_blog_settings',
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
	            'section'        => 'flexia_blog_settings',
	            'settings'       => 'blog_logo_width',
	            'type'           => 'text',
	        )
	    )
	);

	$wp_customize->add_setting( 'blog_title' , array(
	    'default'   => '',
	    'transport' => 'postMessage',
	) );


	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        'blog_title',
	        array(
	            'label'          => __( 'Blog Title', 'flexia' ),
	            'section'        => 'flexia_blog_settings',
	            'settings'       => 'blog_title',
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
		'section'  => 'flexia_blog_settings',
		'settings' => 'blog_title_font_size',
		'label'    => __( 'Blog Title Font Size (px)' ),
		'input_attrs' => array(
			'min'    => 1,
			'max'    => 160,
			'step'   => 1,
			'suffix' => 'px', //optional suffix
	  	),
	) ) );

	$wp_customize->add_setting( 'blog_desc' , array(
	    'default'   => '',
	    'transport' => 'postMessage',
	) );


	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        'blog_desc',
	        array(
	            'label'          => __( 'Blog Description', 'flexia' ),
	            'section'        => 'flexia_blog_settings',
	            'settings'       => 'blog_desc',
	            'type'           => 'text',
	        )
	    )
	);


	$wp_customize->add_setting( 'blog_desc_font_size', array(
			'default'       => get_theme_mod( 'blog_desc_font_size', '18' ),
			'capability'    => 'edit_theme_options',
			'transport' => 'postMessage',

	) );

	$wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, 'blog_desc_font_size', array(
		'type'     => 'range-value',
		'section'  => 'flexia_blog_settings',
		'settings' => 'blog_desc_font_size',
		'label'    => __( 'Blog Description Font Size (px)' ),
		'input_attrs' => array(
			'min'    => 1,
			'max'    => 72,
			'step'   => 1,
			'suffix' => 'px', //optional suffix
	  	),
	) ) );


  // Header Settings

	$wp_customize->add_section( 'flexia_header_settings' , array(
	'title'      => __('Header','flexia'), 
	'priority'   => 40    
	) );  

	// Enable Header widget area

	$wp_customize->add_setting( 'header_widget_area', array(
			'default'     => true,
			'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'header_widget_area', array(
			'label'	      => esc_html__( 'Enable Header Widget Area?', 'flexia' ),
			'section'     => 'flexia_header_settings',
			'settings'    => 'header_widget_area',
			'type'        => 'light',// light, ios, flat
	) ) );

	// Enable Topbar

	$wp_customize->add_setting( 'flexia_enable_topbar', array(
			'default'     => true,
			'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'flexia_enable_topbar', array(
			'label'	      => esc_html__( 'Enable Topbar?', 'flexia' ),
			'section'     => 'flexia_header_settings',
			'settings'    => 'flexia_enable_topbar',
			'type'        => 'light',// light, ios, flat
	) ) );


	// Enable Topbar Menu

	$wp_customize->add_setting( 'flexia_enable_topbar_menu', array(
			'default'     => true,
			'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'flexia_enable_topbar_menu', array(
			'label'	      => esc_html__( 'Enable Topbar Menu?', 'flexia' ),
			'section'     => 'flexia_header_settings',
			'settings'    => 'flexia_enable_topbar_menu',
			'type'        => 'light',// light, ios, flat
	) ) );


	// Enable Navbar

	$wp_customize->add_setting( 'flexia_navbar', array(
			'default'     => true,
			'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'flexia_navbar', array(
			'label'	      => esc_html__( 'Enable Navbar?', 'flexia' ),
			'section'     => 'flexia_header_settings',
			'settings'    => 'flexia_navbar',
			'type'        => 'light',// light, ios, flat
	) ) );


	// Navbar position

	$wp_customize->add_setting( 'flexia_navbar_position' , array(
	    'default'   => 'flexia-navbar-static-top',
	) );


	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        'flexia_navbar_position',
	        array(
	            'label'          => __( 'Navbar Position', 'flexia' ),
	            'section'        => 'flexia_header_settings',
	            'settings'       => 'flexia_navbar_position',
	            'type'           => 'radio',
	            'choices'        => array(
	                'flexia-navbar-static-top'   => __( 'Static Top' ),
	                'flexia-navbar-fixed-top'   => __( 'Sticky Top' ),
	            )
	        )
	    )
	);


	// Header widget, Topbar, Navbar background colors

	$wp_customize->add_setting( 'header_widget_area_bg_color' , array(
	    'default'     => '#262625',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'header_widget_area_bg_color', 
		array(
			'label'      => __( 'Header Widget Area Background', 'flexia' ),
			'section'    => 'flexia_header_settings',
			'settings'   => 'header_widget_area_bg_color',
		) ) 
	);

	$wp_customize->add_setting( 'flexia_topbar_bg_color' , array(
	    'default'     => '#262625',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'flexia_topbar_bg_color', 
		array(
			'label'      => __( 'Topbar Background', 'flexia' ),
			'section'    => 'flexia_header_settings',
			'settings'   => 'flexia_topbar_bg_color',
		) ) 
	);

	$wp_customize->add_setting( 'flexia_navbar_bg_color' , array(
	    'default'     => '#fff',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'flexia_navbar_bg_color', 
		array(
			'label'      => __( 'Navbar Background', 'flexia' ),
			'section'    => 'flexia_header_settings',
			'settings'   => 'flexia_navbar_bg_color',
		) ) 
	);


	$wp_customize->add_setting( 'flexia_topbar_content' , array(
	    'default'     => '<p>This is Topbar Content. Cutomize this from Customize &gt; Header &gt; Topbar Content</p>',
	) );

	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        'flexia_topbar_content',
	        array(
	            'label'          => __( 'Topbar Content', 'flexia' ),
	            'section'        => 'flexia_header_settings',
	            'settings'       => 'flexia_topbar_content',
	            'type'           => 'textarea',
	        )
	    )
	);


  // Footer Settings

	$wp_customize->add_section( 'flexia_footer_settings' , array(
	'title'      => __('Footer','flexia'), 
	'priority'   => 50    
	) );  

	// Enable Footer widget area

	$wp_customize->add_setting( 'footer_widget_area', array(
			'default'     => true,
			'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'footer_widget_area', array(
			'label'	      => esc_html__( 'Enable Footer Widget Area?', 'flexia' ),
			'section'     => 'flexia_footer_settings',
			'settings'    => 'footer_widget_area',
			'type'        => 'light',// light, ios, flat
	) ) );

	// Enable Bottom Footer

	$wp_customize->add_setting( 'footer_bottom', array(
			'default'     => true,
			'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'footer_bottom', array(
			'label'	      => esc_html__( 'Enable Bottom Footer?', 'flexia' ),
			'section'     => 'flexia_footer_settings',
			'settings'    => 'footer_bottom',
			'type'        => 'light',// light, ios, flat
	) ) );


	// Enable footer menu

	$wp_customize->add_setting( 'flexia_enbale_footer_menu', array(
			'default'     => true,
			'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'flexia_enbale_footer_menu', array(
			'label'	      => esc_html__( 'Enable Footer Menu?', 'flexia' ),
			'section'     => 'flexia_footer_settings',
			'settings'    => 'flexia_enbale_footer_menu',
			'type'        => 'light',// light, ios, flat
	) ) );

	// Enable Scrol to Top

	$wp_customize->add_setting( 'flexia_scroll_to_top', array(
			'default'     => true,
			'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'flexia_scroll_to_top', array(
			'label'	      => esc_html__( 'Enable Scrol to top?', 'flexia' ),
			'section'     => 'flexia_footer_settings',
			'settings'    => 'flexia_scroll_to_top',
			'type'        => 'light',// light, ios, flat
	) ) );



	$wp_customize->add_setting( 'footer_widget_area_bg_color' , array(
	    'default'     => '#fff',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'footer_widget_area_bg_color', 
		array(
			'label'      => __( 'Footer Widget Area Background', 'flexia' ),
			'section'    => 'flexia_footer_settings',
			'settings'   => 'footer_widget_area_bg_color',
		) ) 
	);


	$wp_customize->add_setting( 'flexia_footer_bg_color' , array(
	    'default'     => '#262625',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'flexia_footer_bg_color', 
		array(
			'label'      => __( 'Footer Background', 'flexia' ),
			'section'    => 'flexia_footer_settings',
			'settings'   => 'flexia_footer_bg_color',
		) ) 
	);


	$wp_customize->add_setting( 'flexia_footer_content_color' , array(
	    'default'     => '#CBCED3',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'flexia_footer_content_color', 
		array(
			'label'      => __( 'Footer Content Color', 'flexia' ),
			'section'    => 'flexia_footer_settings',
			'settings'   => 'flexia_footer_content_color',
		) ) 
	);

	$wp_customize->add_setting( 'flexia_footer_link_color' , array(
	    'default'     => '#F56A6A',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'flexia_footer_link_color', 
		array(
			'label'      => __( 'Footer Links Color', 'flexia' ),
			'section'    => 'flexia_footer_settings',
			'settings'   => 'flexia_footer_link_color',
		) ) 
	);

	$wp_customize->add_setting( 'flexia_footer_link_hover_color' , array(
	    'default'     => '#E65A50',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'flexia_footer_link_hover_color', 
		array(
			'label'      => __( 'Footer Links Hover Color', 'flexia' ),
			'section'    => 'flexia_footer_settings',
			'settings'   => 'flexia_footer_link_hover_color',
		) ) 
	);


	$wp_customize->add_setting( 'flexia_footer_content' , array(
	    'default'     => '<p>Copyright &copy; 2017 | Flexia by <a href="https://www.codetic.net" target="_blank">Codetic</a></p>',
	) );

	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        'flexia_footer_content',
	        array(
	            'label'          => __( 'Footer Content', 'flexia' ),
	            'section'        => 'flexia_footer_settings',
	            'settings'       => 'flexia_footer_content',
	            'type'           => 'textarea',
	        )
	    )
	);

  // Create custom panels
  $wp_customize->add_panel( 'flexia_general_settings', array(
      'priority' => 10,
      'theme_supports' => '',
      'title' => __( 'General Settings', 'flexia' ),
      'description' => __( 'Controls the basic settings for the theme.', 'flexia' ),
  ) );


  $wp_customize->add_panel( 'flexia_design_settings', array(
      'priority' => 30,
      'theme_supports' => '',
      'title' => __( 'Design', 'flexia' ),
      'description' => __( 'Controls the design settings for the theme.', 'flexia' ),
  ) ); 

  // Assign sections to panels
  $wp_customize->get_section('title_tagline')->panel = 'flexia_general_settings';      
  $wp_customize->get_section('static_front_page')->panel = 'flexia_general_settings';
  $wp_customize->get_section('background_image')->panel = 'flexia_design_settings';
  $wp_customize->get_section('background_image')->priority = 1000;
  $wp_customize->get_section('header_image')->panel = 'flexia_design_settings';  


}
add_action( 'customize_register', 'flexia_customize_register' );


require get_template_directory() . '/framework/functions/customizer/output/header.php';
require get_template_directory() . '/framework/functions/customizer/output/output-css.php';
