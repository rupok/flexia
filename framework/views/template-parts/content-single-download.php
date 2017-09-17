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


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content-wrapper">
        <div class="entry-content single-post-entry">
            <div class="entry-content-inner flexia-container">

                <div class="flexia-edd-product">
                    <div class="flexia-edd-product-thumb">
                        <?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
                    </div>

                    <div class="flexia-edd-product-details">
                        <?php the_title( '<h1 class="blog-title">', '</h1>' ); ?>

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
                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flexia' ),
                                'after'  => '</div>',
                            ) );
                        ?>
                    </div>
                </div>
            </div>

            <footer class="entry-footer">
                <?php flexia_entry_footer(); ?>
            </footer><!-- .entry-footer -->

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
