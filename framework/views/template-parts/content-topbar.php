<?php
/**
 * The template for displaying the topbar
 *
 * Contains the topbar part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

<div class="flexia-topbar">
	<div class="flexia-topbar-inner flexia-container max width">
		<div class="flexia-topbar-content">
			<?php echo get_theme_mod('flexia_topbar_content'); ?>
		</div>

		<?php if( get_theme_mod('flexia_enable_topbar_menu') == true ) : ?>
		<nav id="site-navigation" class="topbar-navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'topbar-menu',
					'menu_id'        => 'flexia-topbar-menu',
					'menu_class'     => 'nav-menu flexia-topbar-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
		<?php endif; ?>

	</div>
</div>