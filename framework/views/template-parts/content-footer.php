<?php
/**
 * The bottom footer area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */


if (get_theme_mod('footer_widget_area') == '') {
    $footer_widget_area = flexia_get_option('footer_widget_area');
} else {
    $footer_widget_area = get_theme_mod('footer_widget_area');
} 

if (get_theme_mod('footer_bottom') == '') {
    $footer_bottom = flexia_get_option('footer_bottom');
} else {
    $footer_bottom = get_theme_mod('footer_bottom');
} 


?>

<?php if( $footer_widget_area == true ) : 
	get_template_part( 'framework/views/template-parts/content', 'footer-widgets' );
endif; ?>


<?php if( $footer_bottom == false ) : 
	get_template_part( 'framework/views/template-parts/content', 'footer-bottom' );
endif; ?>


