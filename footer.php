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

	</div><!-- #content -->

	<?php get_sidebar(); ?>

	<footer id="flexia-colophon-top" class="footer-widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</footer><!-- #colophon top -->

	<footer id="flexia-colophon-bottom" class="site-footer">
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
	</footer><!-- #colophon bottom -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
