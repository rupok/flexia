<?php
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
             $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        }
    }

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="single-blog-header" style="background: url('<?php echo $thumbnail; ?>') no-repeat fixed center center / cover;">
        <div class="header-inner">
            <div class="header-content">
                <?php the_title( '<h1 class="blog-title">', '</h1>' ); ?>
                <div class="blog-author">
                    <div class="author-avatar">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?> 
                        <div class="author-body">
                            <h4 class="author-heading"><?php the_author(); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flexia' ),
                        'after'  => '</div>',
                    ) );
                ?>
            </div>

            <footer class="entry-footer">
                <?php flexia_entry_footer(); ?>
            </footer><!-- .entry-footer -->

            <?php the_post_navigation(); ?>

            <div class="post-author">
                <div class="author-avatar">
                    <div class="avatar-container">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?> 
                    </div>

                    <div class="author-body">
                        <span>Author</span>
                        <h4 class="author-heading">
                             <?php the_author_posts_link(); ?> 
                        </h4>
                        <h5 class="author-bio"><?php the_author_meta('description'); ?></h5>
                    </div>
                </div>
            </div> <!-- Author end -->

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
