<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexia
 */

$flexia_blog_content_display = get_theme_mod('flexia_blog_content_display', 'flexia_blog_content_layout_full');
$flexia_blog_excerpt_count = get_theme_mod('flexia_blog_excerpt_count', '60');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'flexia-featured-image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<header class="entry-header single-blog-meta">
		<?php	

		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

		<?php
		if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php flexia_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php
		endif;
		?>

	</header><!-- .entry-header -->	

	<?php if( $flexia_blog_content_display == 'flexia_blog_content_display_excerpt' ) :  ?>
    <div class="entry-content excerpt-only">
       <?php
            $content = get_the_content();
            $trimmed_content = wp_trim_words( $content, $flexia_blog_excerpt_count);
            echo wp_kses_post($trimmed_content);
        ?>
        <p><a href="<?php the_permalink() ?>" class="more-link"> <?php echo esc_attr( sprintf( __( 'Continue Reading', 'flexia' )))  ?></a></p>
    </div>

	<?php else : ?>

	<div class="entry-content">
		<?php
		the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'flexia' ),
			get_the_title()
		) );

		wp_link_pages( array(
			'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'flexia' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->
    <?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
