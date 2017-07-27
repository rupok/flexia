<?php
/**
 * The bottom footer area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

<footer id="flexia-colophon-bottom" class="flexia-site-footer">
	<div class="flexia-colophon-inner flexia-container max width">

		<nav id="site-navigation" class="footer-navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'footer-menu',
					'menu_id'        => 'footer-menu',
				) );
			?>
		</nav><!-- #site-navigation -->

		<div class="site-info">
			<?php echo get_theme_mod('flexia_footer_content'); ?>
		</div><!-- .site-info -->
	</div>
</footer><!-- #site-footer -->