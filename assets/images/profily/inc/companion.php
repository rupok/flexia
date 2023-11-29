<?php

/**
 * profily import demo content
 */
if( !function_exists( 'profily_import_content' ) ) :
    function profily_import_content() {
        // Pages
        $pages = [
            [
                'title' => 'Front Page',
                'content' => $patterns_dir . '/pages-front.php',
                'type' => 'page', 
                'meta' => [
                    '_wp_page_template' => 'page-without-title'
                ]
            ],
        ];
        $pages = array_reverse( $pages );

        return $pages;
    }
endif;
