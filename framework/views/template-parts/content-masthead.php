<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The template for displaying the header
 *
 * Contains the masthead part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

if (get_theme_mod('header_widget_area') == '') {
    $header_widget_area = flexia_get_option('header_widget_area');
} else {
    $header_widget_area = get_theme_mod('header_widget_area');
} 

if (get_theme_mod('flexia_enable_topbar') == '') {
    $flexia_enable_topbar = flexia_get_option('flexia_enable_topbar');
} else {
    $flexia_enable_topbar = get_theme_mod('flexia_enable_topbar');
} 

if (get_theme_mod('flexia_logobar_position') == '') {
    $flexia_logobar_position = flexia_get_option('flexia_logobar_position');
} else {
    $flexia_logobar_position = get_theme_mod('flexia_logobar_position');
} 

if (get_theme_mod('flexia_navbar') == '') {
    $flexia_navbar = flexia_get_option('flexia_navbar');
} else {
    $flexia_navbar = get_theme_mod('flexia_navbar');
} 


?>

<header id="masthead" class="site-header">

	<?php if( $header_widget_area == true ) : 
		get_template_part( 'framework/views/template-parts/content', 'header-widgets' ); 
	endif; ?>

	<?php if( $flexia_enable_topbar == true ) : 
		get_template_part( 'framework/views/template-parts/content', 'topbar' );
	endif; ?>

	<?php if( $flexia_logobar_position == 'flexia-logobar-stacked' ) : 
		get_template_part( 'framework/views/template-parts/content', 'logobar' );  
	endif; ?>

	<?php if( $flexia_navbar == false ) : 
		get_template_part( 'framework/views/template-parts/content', 'navbar' );
	endif; ?>


</header><!-- #masthead -->