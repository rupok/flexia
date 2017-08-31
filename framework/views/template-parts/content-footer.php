<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The bottom footer area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */


$footer_widget_area = get_theme_mod('footer_widget_area', false);

$footer_bottom = get_theme_mod('footer_bottom', false);



?>

<?php if( $footer_widget_area == true ) : 
	get_template_part( 'framework/views/template-parts/content', 'footer-widgets' );
endif; ?>


<?php if( $footer_bottom == false ) : 
	get_template_part( 'framework/views/template-parts/content', 'footer-bottom' );
endif; ?>


