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
                            <div class="avatar-body">
                                <h4 class="avatar-heading"><?php the_author(); ?></h4>
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

    <div class="entry-content">
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
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php flexia_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
