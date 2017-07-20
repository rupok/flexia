<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

		</div><!-- #flexia-container -->
	</div><!-- #content --> 

	<?php get_sidebar(); ?>

	<footer id="flexia-colophon-top" class="footer-widget-area">
		<div class="flexia-colophon-inner">
			<?php dynamic_sidebar( 'footer-1' ); ?>
			<?php dynamic_sidebar( 'footer-2' ); ?>
			<?php dynamic_sidebar( 'footer-3' ); ?>
			<?php dynamic_sidebar( 'footer-4' ); ?>
		</div>
	</footer><!-- #footer-widget-area -->

	<footer id="flexia-colophon-bottom" class="site-footer">
		<div class="flexia-colophon-inner">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'flexia' ) ); ?>"><?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'flexia' ), 'WordPress' );
				?></a>
				<span class="sep"> | </span>
				<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'flexia' ), 'flexia', '<a href="https://codetic.net/">Codetic</a>' );
				?>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #site-footer -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
