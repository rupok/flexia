<?php
/**
 * Flexia Function to Assign Templates Parts Through Hooks
 *
 * @package Flexia
 */

//Flexia Header File Include using Hook
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

//Flexia Footer File Include using Hook
if (!function_exists('flexia_add_footer')) {
    add_action('flexia_footer', 'flexia_add_footer');
    function flexia_add_footer() {
        $no_footer_template = array(
            'template-blank-container-2.php', 
            'template-blank-container-3.php',
            'template-no-container-3.php',
            'template-no-container-4.php'
        );
        $current_template = basename( get_page_template() ) ;
    
        if ( !in_array($current_template, $no_footer_template) ) {
    
            get_template_part( 'framework/views/template-parts/content', 'footer' );
    
        }
    }
}

//Flexia Add Hook into Header using Function
if (!function_exists('flexia_page_header')) {
    function flexia_page_header() {
        do_action('flexia_page_header_breadcrumb');
    }
}

//Flexia Call To Action File Include using Hook
if (!function_exists('flexia_cta_template')) {
    add_action('flexia_before_footer', 'flexia_cta_template');
    function flexia_cta_template() {
        do_action('flexia_call_to_action_before');

        get_template_part( 'framework/views/template-parts/content', 'cta' );

        do_action('flexia_call_to_action_after');
    }
}

//Flexia Template Parts Single Include using Hook
function add_single_template() {
    get_template_part( 'framework/views/template-parts/content-single', get_post_format() );
}
add_action('flexia_single', 'add_single_template');

?>