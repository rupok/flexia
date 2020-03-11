<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The template for displaying the Logobar
 *
 * Contains the logobar part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

$flexia_custom_logo_id = get_theme_mod( 'custom_logo' );
$flexia_header_logo = wp_get_attachment_image_src( $flexia_custom_logo_id , 'full' );

?>

<div class="flexia-logobar flexia-logobar-stacked">
	<div class="flexia-logobar-container">
		<div class="flexia-container max width flexia-logobar-inner">

				<div class="site-branding">

					<?php if( $flexia_header_logo[0] !== NULL ) :  ?>

						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="flexia-header-logo">
							<img alt="<?php esc_html(bloginfo('name')); ?>" src="<?php echo esc_url($flexia_header_logo[0]); ?>">
						</a>

				    <?php else : ?>

						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo('name')); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo('name')); ?></a></p>
						<?php
						endif;

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo wp_kses_post($description); /* WPCS: xss ok. */ ?></p>
						<?php
						endif; ?>
					<?php endif; ?>

				</div><!-- .site-branding -->
		</div>
	</div>
</div><!-- .logobar -->
