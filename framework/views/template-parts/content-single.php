<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Template part for displaying single post
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexia
 */

$thumbnail = '';
    if (function_exists('has_post_thumbnail')) {
        if ( has_post_thumbnail() ) {
             $thumbnail = wp_get_attachment_url( get_post_thumbnail_id() );
        }
    }

$post_navigation = get_theme_mod('post_navigation', false);

$post_author = get_theme_mod('post_author', false);

$post_social_share = get_theme_mod('post_social_share', false);


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php flexia_post_large_title(); ?>

    <div class="entry-content-wrapper">

        <div class="entry-content single-post-entry">
            <div class="entry-content-inner flexia-container">
                <?php flexia_post_simple_title(); ?>
                <?php
                    the_content( sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'flexia' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ) );

                    wp_link_pages( array(
                        'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'flexia' ),
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ) );
                ?>
            </div>

            <footer class="entry-footer">
                <?php flexia_entry_footer(); ?>
            </footer><!-- .entry-footer -->

            <?php if( $post_navigation == false ) :

                flexia_post_navigation();

            endif; ?>

            <?php if( $post_author == false ) :

                flexia_post_footer_meta();

            endif; ?>

            <?php if( $post_social_share == false ) :

                flexia_post_sharer();

            endif; ?>

            <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            ?>

        </div>

        <?php get_sidebar(); ?>

    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
