<?php
/**
 * The template for displaying the Logobar
 *
 * Contains the logobar part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

<div class="flexia-logobar flexia-logobar-stacked">
	<div class="flexia-logobar-container">
		<div class="flexia-container max width flexia-logobar-inner">

				<div class="site-branding">

					<?php if( get_theme_mod('flexia_header_logo') !== '' ) :  ?>

				       	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="flexia-header-logo"><img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo get_theme_mod('flexia_header_logo'); ?>"></a>

				    <?php else : ?>

						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php
						endif; ?>
					<?php endif; ?>

				</div><!-- .site-branding -->
		</div>
	</div>
</div><!-- .logobar -->
