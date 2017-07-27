<?php
/**
 * The bottom footer area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

<?php if( get_theme_mod('footer_widget_area') == true ) : 
	get_template_part( 'framework/views/template-parts/content', 'footer-widgets' );
endif; ?>


<?php if( get_theme_mod('footer_bottom') == true ) : 
	get_template_part( 'framework/views/template-parts/content', 'footer-bottom' );
endif; ?>


