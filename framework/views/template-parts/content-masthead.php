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


$header_widget_area = get_theme_mod('header_widget_area', false);

$flexia_enable_topbar = get_theme_mod('flexia_enable_topbar', false);

$flexia_enable_topbar = get_theme_mod('flexia_enable_topbar', false);

$flexia_logobar_position = get_theme_mod('flexia_logobar_position', 'flexia-logobar-inline');

$flexia_navbar = get_theme_mod('flexia_navbar', false);


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

	<?php if( $flexia_navbar == true ) : 
		get_template_part( 'framework/views/template-parts/content', 'navbar' );
	endif; ?>


</header><!-- #masthead -->