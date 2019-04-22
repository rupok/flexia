<?php

// No direct access, please
if (!defined('ABSPATH')) {
    exit;
}

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
		<?php if (flexia_get_option('flexia_enable_footer_menu') == true): ?>
			<nav id="footer-navigation" class="footer-navigation">
				<?php
				if (has_nav_menu('footer-menu')):
					wp_nav_menu(array(
						'theme_location' => 'footer-menu',
						'menu_id' => 'flexia-footer-menu',
						'menu_class' => 'nav-menu flexia-footer-menu',
						'container' => false,
						'depth' => 1,
					));
				else:
					printf('<ul class="flexia-footer-menu"><li><a href="%s">%s</a></li></ul>', esc_url(admin_url('nav-menus.php')), esc_html__('Assign Footer Menu', 'flexia'));
				endif;
				?>
			</nav><!-- #site-navigation -->
		<?php endif;?>

		<div class="site-info">
			<?php echo flexia_get_option('flexia_footer_content'); ?>
		</div><!-- .site-info -->
	</div>
</footer><!-- #site-footer -->