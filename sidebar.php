<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */


$content_layout = flexia_get_option('content_layout');


?>
<?php

if( $content_layout == 'content_layout1' ) : 

	get_template_part( 'framework/views/template-parts/content', 'sidebar-left' );
	get_template_part( 'framework/views/template-parts/content', 'sidebar-right' );

elseif( $content_layout == 'content_layout2' ) : 

	get_template_part( 'framework/views/template-parts/content', 'sidebar-left' );

elseif( $content_layout == 'content_layout3' ) : 

	get_template_part( 'framework/views/template-parts/content', 'sidebar-right' );

else:
// content only

endif; 


?>