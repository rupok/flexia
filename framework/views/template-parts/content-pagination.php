<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Template part for displaying pagination
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexia
 */

?>

<div class="post-pagination-container">
    <ul class="post-pagination">
    <?php
        global $wp_query;

        $big = 999999999; // need an unlikely integer

        $links = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'type' => 'array',
            'prev_next' => true,
            'prev_text' => '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve"> <g> <g> <path d="M101.5,245.9c0,7.2,2.8,14,7.8,19.1l219.2,219.1c5.1,5.1,11.8,7.9,19,7.9s14-2.8,19-7.9l16.1-16.1 c5.1-5.1,7.9-11.8,7.9-19c0-7.2-2.8-14-7.9-19L198.6,245.9L382.5,62c10.5-10.5,10.5-27.6,0-38.1L366.3,7.9 c-5.1-5.1-11.8-7.9-19-7.9c-7.2,0-14,2.8-19,7.9L109.3,226.8C104.3,231.9,101.5,238.7,101.5,245.9z"/> </g> </g> </svg>',
            "next_text" => '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve"> <g> <g> <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12 c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028 c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265 c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>',
            'mid_size' => 3
        ));
        //print_r($links);
        if ($links) {
            foreach ($links as $link) {
                if (strpos($link, "current") !== false)
                    echo '<li class="active"><a>' . $link . "</a></li>\n";
                else
                    echo '<li>' . $link . "</li>\n";

            }
        }
    ?>
    </ul>
</div>