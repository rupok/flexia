<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexia
 */

$skip_sidebar = ( get_post_meta( $post->ID, 'skip_sidebar', true ) == 'yes' ) ? true : false;

get_header(); ?>

<div id="page" class="site">

    <?php get_template_part( 'framework/views/template-parts/content', 'masthead' ); ?>

    <div id="content" class="site-content">

        <div class="flexia-wrapper flexia-container max width">
            <div id="primary" class="content-area">
                <main id="main" class="site-main flexia-container">

                <?php
                    /**
                     * @since 1.4
                     *
                     * @hooked wedocs_template_wrapper_start - 10
                     */
                    do_action( 'wedocs_before_main_content' );
                ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <div class="wedocs-single-wrap">

                        <?php if ( ! $skip_sidebar ) { ?>

                            <?php wedocs_get_template_part( 'docs', 'sidebar' ); ?>

                        <?php } ?>

                        <div class="wedocs-single-content">
                            <?php wedocs_breadcrumbs(); ?>

                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
                                <header class="entry-header">
                                    <?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>

                                    <?php if ( wedocs_get_option( 'print', 'wedocs_settings', 'on' ) == 'on' ): ?>
                                        <a href="#" class="wedocs-print-article wedocs-hide-print wedocs-hide-mobile" title="<?php echo esc_attr( __( 'Print this article', 'flexia' ) ); ?>"><i class="wedocs-icon wedocs-icon-print"></i></a>
                                    <?php endif; ?>
                                </header><!-- .entry-header -->

                                <div class="entry-content" itemprop="articleBody">
                                    <?php
                                        the_content( sprintf(
                                            /* translators: %s: Name of current post. */
                                            wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'flexia' ), array( 'span' => array( 'class' => array() ) ) ),
                                            the_title( '<span class="screen-reader-text">"', '"</span>', false )
                                        ) );

                                        wp_link_pages( array(
                                            'before' => '<div class="page-links">' . esc_html__( 'Docs:', 'flexia' ),
                                            'after'  => '</div>',
                                        ) );

                                        $children = wp_list_pages("title_li=&order=menu_order&child_of=". $post->ID ."&echo=0&post_type=" . $post->post_type);

                                        if ( $children ) {
                                            echo '<div class="article-child well">';
                                                echo '<h3>' . __( 'Articles', 'flexia' ) . '</h3>';
                                                echo '<ul>';
                                                    echo $children;
                                                echo '</ul>';
                                            echo '</div>';
                                        }

                                        $tags_list = wedocs_get_the_doc_tags( $post->ID, '', ', ' );

                                        if ( $tags_list ) {
                                            printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                                                _x( 'Tags', 'Used before tag names.', 'flexia' ),
                                                $tags_list
                                            );
                                        }
                                    ?>
                                </div><!-- .entry-content -->

                                <footer class="entry-footer wedocs-entry-footer">
                                    <?php if ( wedocs_get_option( 'email', 'wedocs_settings', 'on' ) == 'on' ): ?>
                                        <span class="wedocs-help-link wedocs-hide-print wedocs-hide-mobile">
                                            <i class="wedocs-icon wedocs-icon-envelope"></i>
                                            <?php printf( '%s <a id="wedocs-stuck-modal" href="%s">%s</a>', __( 'Still stuck?', 'flexia' ), '#', __( 'How can we help?', 'flexia' ) ); ?>
                                        </span>
                                    <?php endif; ?>

                                    <div class="wedocs-article-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                        <meta itemprop="name" content="<?php echo get_the_author(); ?>" />
                                        <meta itemprop="url" content="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" />
                                    </div>

                                    <meta itemprop="datePublished" content="<?php echo get_the_time( 'c' ); ?>"/>
                                    <time itemprop="dateModified" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php printf( __( 'Updated on %s', 'flexia' ), get_the_modified_date() ); ?></time>
                                </footer>

                                <?php wedocs_doc_nav(); ?>

                                <?php if ( wedocs_get_option( 'helpful', 'wedocs_settings', 'on' ) == 'on' ): ?>
                                    <?php wedocs_get_template_part( 'content', 'feedback' ); ?>
                                <?php endif; ?>

                                <?php if ( wedocs_get_option( 'email', 'wedocs_settings', 'on' ) == 'on' ): ?>
                                    <?php wedocs_get_template_part( 'content', 'modal' ); ?>
                                <?php endif; ?>

                            </article><!-- #post-## -->
                        </div><!-- .wedocs-single-content -->
                    </div><!-- .wedocs-single-wrap -->

                <?php endwhile; ?>

                <?php
                    /**
                     * @since 1.4
                     *
                     * @hooked wedocs_template_wrapper_end - 10
                     */
                    do_action( 'wedocs_after_main_content' );
                ?>

                </main><!-- #main -->
            </div><!-- #primary -->

        </div><!-- #flexia-wrapper -->
    </div><!-- #content -->
</div><!-- #page -->
<?php
get_template_part( 'framework/views/template-parts/content', 'footer' );
get_footer();
