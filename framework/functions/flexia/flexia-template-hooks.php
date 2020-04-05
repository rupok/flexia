<?php
/**
 * Flexia Function to Assign Templates Parts Through Hooks
 *
 * @package Flexia
 */

if (!function_exists('flexia_add_header')) {
    add_action('flexia_header', 'flexia_add_header');
    function flexia_add_header() {
        $no_footer_template = array(
            'template-blank-container-3.php',
            'template-no-container-2.php',
            'template-no-container-4.php'
        );
        $current_template = basename( get_page_template() ) ;
    
        if ( !in_array($current_template, $no_footer_template) ) {
    
            get_template_part( 'framework/views/template-parts/content', 'masthead' );
    
        }
    }
}

?>