<?php
/**
 * The bottom footer area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */


if (get_theme_mod('flexia_enable_footer_menu') == '') {
    $flexia_enable_footer_menu = flexia_get_option('flexia_enable_footer_menu');
} else {
    $flexia_enable_footer_menu = get_theme_mod('flexia_enable_footer_menu');
} 

if (get_theme_mod('flexia_footer_content') == '') {
    $flexia_footer_content = flexia_get_option('flexia_footer_content');
} else {
    $flexia_footer_content = get_theme_mod('flexia_footer_content');
} 


?>

<footer id="flexia-colophon-bottom" class="flexia-site-footer">
	<div class="flexia-colophon-inner flexia-container max width">

		<?php if( $flexia_enable_footer_menu == true ) : ?>
		<nav id="footer-navigation" class="footer-navigation">
			<?php

				if ( has_nav_menu( 'footer-menu' ) ) :
								wp_nav_menu( array(
									'theme_location' => 'footer-menu',
									'menu_id'        => 'flexia-footer-menu',
									'menu_class'     => 'nav-menu flexia-footer-menu',
									'container'      => false,
								) );
				else :
				  echo '<ul class="flexia-footer-menu"><li><a href="' . home_url( '/' ) . 'wp-admin/nav-menus.php">Assign Footer Menu</a></li></ul>';
				endif;
			?>
		</nav><!-- #site-navigation -->
		<?php endif; ?>

		<div class="site-info">
			<?php echo $flexia_footer_content; ?>
		</div><!-- .site-info -->
	</div>
</footer><!-- #site-footer -->