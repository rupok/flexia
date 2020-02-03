<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Template part for displaying post author in post footer
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexia
 */

?>

<div class="post-author">
    <div class="author-avatar">
        <div class="avatar-container">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?> 
        </div>

        <div class="author-body">

            <?php echo '
            <span>' . __('Author', 'flexia') . '</span>
            '; ?>

            <h4 class="author-heading">
                 <?php the_author_posts_link(); ?> 
            </h4>
            <h5 class="author-bio"><?php esc_html(the_author_meta('description')); ?></h5>
        </div>
    </div>
</div> <!-- Author end -->