<?php
/**
 * The template for displaying the navbar
 *
 * Contains the navbar part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

<div class="flexia-navbar">
	<div class="flexia-container max width flexia-navbar-inner">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'flexia' ); ?></button>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'flexia-primary-menu',
					'menu_class'     => 'flexia-primary-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
	</div><!-- #flexia-container -->
</div>