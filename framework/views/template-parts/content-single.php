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

    <header class="page-header single-blog-header" <?php if ( ! empty( $thumbnail ) ) : ?> 
    style="background-image: url('<?php echo esc_attr($thumbnail); ?>');" <?php endif; ?> <?php if ( empty( $thumbnail ) ) : ?> 
    style="background-image: url('<?php echo esc_attr(get_header_image()); ?>');" <?php endif; ?>>
        <div class="header-inner">
            <div class="header-content">
                <?php the_title( '<h1 class="blog-title">', '</h1>' ); ?>
                <div class="blog-author">
                    <div class="author-avatar">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 'flexia-thumbnail-avatar' ); ?> 
                        <div class="author-body">
                            <h4 class="author-heading"><?php the_author(); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-overlay"></div>
    </header>

    <header class="entry-header single-blog-meta">
        <?php
        if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php flexia_updated_on(); ?>
        </div><!-- .entry-meta -->
        <?php
        endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content-wrapper">
        <div class="entry-content single-post-entry">
            <div class="entry-content-inner flexia-container">
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

                the_post_navigation(); 

            endif; ?>

            <?php if( $post_author == false ) : 

                get_template_part( 'framework/views/template-parts/content', 'post-author' );

            endif; ?>

            <?php if( $post_social_share == false ) : 

                get_template_part( 'framework/views/template-parts/content', 'social-sharer' );

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
