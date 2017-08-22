<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header single-blog-meta">
		<?php
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php flexia_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		
		endif;

		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
       <?php
            $content = get_the_content();
            $trimmed_content = strip_shortcodes(strip_tags(wp_trim_words( $content, 60)));
            echo $trimmed_content;
        ?>
	</div><!-- .entry-content -->


	<footer class="entry-footer">
		<a href="<?php the_permalink() ?>" class="btn btn-read-more"> <?php echo esc_attr( sprintf( __( 'Continue Reading', 'flexia' )))  ?></a>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
