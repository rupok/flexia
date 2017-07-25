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

  $wp_customize->add_section( 'container_settings' , array(
    'title'      => __('Container Width','flexia'), 
    'panel'      => 'layout_settings',
    'priority'   => 20    
  ) );  
  $wp_customize->add_setting(
      'flexia_container_width',
      array(          
          'sanitize_callback' => 'sanitize_text'          
      )
  );
  $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'container_width',
            array(
                'label'          => __( 'Container Width', 'flexia' ),
                'section'        => 'container_settings',
                'settings'       => 'flexia_container_width',
                'type'           => 'text',
                'default'		 => '1200'
            )
        )
   );




  // Create custom panels
  $wp_customize->add_panel( 'general_settings', array(
      'priority' => 10,
      'theme_supports' => '',
      'title' => __( 'General Settings', 'flexia' ),
      'description' => __( 'Controls the basic settings for the theme.', 'flexia' ),
  ) );
  $wp_customize->add_panel( 'layout_settings', array(
      'priority' => 20,
      'theme_supports' => '',
      'title' => __( 'Layout', 'flexia' ),
      'description' => __( 'Controls the layout of the theme.', 'flexia' ),
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
