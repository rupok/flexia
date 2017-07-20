<?php
/**
 * The bottom footer area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

<footer id="flexia-colophon-bottom" class="site-footer">
	<div class="flexia-colophon-inner flexia-container">
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