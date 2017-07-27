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

		<?php if( get_theme_mod('flexia_enbale_footer_menu') == true ) : ?>
		<nav id="site-navigation" class="footer-navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'footer-menu',
					'menu_id'        => 'flexia-footer-menu',
					'menu_class'        => 'flexia-footer-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
		<?php endif; ?>

		<div class="site-info">
			<?php echo get_theme_mod('flexia_footer_content'); ?>
		</div><!-- .site-info -->
	</div>
</footer><!-- #site-footer -->