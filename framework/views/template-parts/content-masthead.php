<?php
/**
 * The template for displaying the header
 *
 * Contains the masthead part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

<header id="masthead" class="site-header">

	<?php if( get_theme_mod('header_widget_area') == true ) : 
		get_template_part( 'framework/views/template-parts/content', 'header-widgets' ); 
	endif; ?>

	<?php if( get_theme_mod('header_topbar') == true ) : 
		get_template_part( 'framework/views/template-parts/content', 'topbar' );
	endif; ?>

	<?php if( get_theme_mod('header_navbar') == true ) : 
		get_template_part( 'framework/views/template-parts/content', 'navbar' );
	endif; ?>


</header><!-- #masthead -->