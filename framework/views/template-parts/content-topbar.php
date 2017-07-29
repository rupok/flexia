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
		<nav id="topbar-navigation" class="flexia-menu topbar-navigation">
			<a class="flexia-nav-btn"></a>
			
			<?php

				if ( has_nav_menu( 'topbar-menu' ) ) :
					wp_nav_menu( array(
						'theme_location' => 'topbar-menu',
						'menu_id'        => 'flexia-topbar-menu',
						'menu_class'     => 'nav-menu flexia-topbar-menu',
						'container'      => false,
					) );
				else :
				  echo '<ul class="flexia-topbar-menu"><li><a href="' . home_url( '/' ) . 'wp-admin/nav-menus.php">Assign Topbar Menu</a></li></ul>';
				endif;
			?>
		</nav><!-- #site-navigation -->
		<?php endif; ?>

	</div>
</div>