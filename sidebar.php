<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>
<?php

if( get_theme_mod('content_layout') == 'content_layout1' ) : 

	get_template_part( 'framework/views/template-parts/content', 'sidebar-left' );
	get_template_part( 'framework/views/template-parts/content', 'sidebar-right' );

elseif( get_theme_mod('content_layout') == 'content_layout2' ) : 

	get_template_part( 'framework/views/template-parts/content', 'sidebar-left' );

elseif( get_theme_mod('content_layout') == 'content_layout3' ) : 

	get_template_part( 'framework/views/template-parts/content', 'sidebar-right' );

else:
// content only

endif; 


?>