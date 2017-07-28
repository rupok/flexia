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

if( get_theme_mod('flexia_navbar_position') == 'flexia-navbar-static-top' ) : 

	$navbar_class = 'flexia-navbar-static-top';

else:

	$navbar_class = 'flexia-navbar-fixed-top';

endif; 


?>

<div class="flexia-navbar <?php echo $navbar_class;?>">
	<div class="flexia-navbar-container">
		<div class="flexia-container max width flexia-navbar-inner">
			<div class="site-branding">

				<?php if( get_theme_mod('flexia_header_logo') !== '' ) :  ?>

	               			<img class="flexia-header-logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo get_theme_mod('flexia_header_logo'); ?>">

	             <?php endif; ?>


				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="flexia-menu main-navigation">
			  <a class="flexia-nav-btn"></a>

				<?php

					if ( has_nav_menu( 'primary' ) ) :
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_id'        => 'flexia-primary-menu',
						'menu_class'     => 'nav-menu flexia-primary-menu',
						'container'      => false,
					) );

					else :

					  echo '<ul class="flexia-primary-menu"><li><a href="' . home_url( '/' ) . 'wp-admin/nav-menus.php">Assign a Menu</a></li></ul>';
					endif;

				?>
			</nav><!-- #site-navigation -->
		</div><!-- #flexia-container -->
	</div><!-- #flexia-navbar-container -->
</div>