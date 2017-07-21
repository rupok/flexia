<?php
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
            'prev_text' => '<i class="fa fa-angle-left"></i>',
            "next_text" => '<i class="fa fa-angle-right"></i>',
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