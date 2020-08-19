<?php
    function include_flexia_header() {
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
    add_action('flexia-header-main', 'include_flexia_header');
?>