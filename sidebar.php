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

if ( is_single() ) {
	$content_layout = flexia_get_option('flexia_single_content_layout');
}

do_action('flexia_sidebar_content');

$content_layout = apply_filters('flexia_sidebar_content_layout', $content_layout);


if( $content_layout == 'content_layout1' ) :

	echo flexia_sidebar_content('sidebar-left', 'flexia-sidebar-left', '');
	echo flexia_sidebar_content('sidebar-right', 'flexia-sidebar-right', '');

elseif( $content_layout == 'content_layout2' ) : 

	echo flexia_sidebar_content('sidebar-left', 'flexia-sidebar-left', '');

elseif( $content_layout == 'content_layout3' ) : 

	echo flexia_sidebar_content('sidebar-right', 'flexia-sidebar-right', '');

else:

	// content only

endif; 


?>