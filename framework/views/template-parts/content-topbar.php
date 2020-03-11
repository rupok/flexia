<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The template for displaying the topbar
 *
 * Contains the topbar part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

$dropdown_animation = 'flexia-menu-dropdown-animate-' . get_theme_mod('flexia_top_nav_menu_dropdown_animation', 'to-top');
?>

<div class="flexia-topbar">
	<div class="flexia-topbar-inner flexia-container 
		<?php echo (get_theme_mod( 'flexia_header_layout_type' ) == "full-width") ? "full-width" : "width max" ?>
		<?php echo (get_theme_mod( 'flexia_enable_topbar_on_mobile' )) ? "show-mobile" : "hide-mobile" ?>
	">

		<!-- Header Top Contact Start -->		
		<?php
			$html = "";
			$show = false;
			$phone = get_theme_mod('flexia_header_top_phone');
			$email = get_theme_mod('flexia_header_top_email');
			$location = get_theme_mod('flexia_header_top_location');
			$location_link = get_theme_mod('flexia_header_top_location_link');

			if (!empty($phone)) {
				$show = true;
				$html .= '<a href="tel:'.str_replace(' ', '', $phone).'"><i class="fa fa-phone"></i>'.$phone.'</a>';
			}

			if (!empty($email)) {
				$show = true;
				$html .= '<a href="mailto:'.str_replace(' ', '', $email).'"><i class="fa fa-envelope"></i>'.$email.'</a>';
			}

			if (!empty($location) && !empty($location_link)) {
				$show = true;
				$html .= '<a href="'.$location_link.'"><i class="fa fa-map-marker"></i>'.$location.'</a>';
			}

			if ($show) {
				$output = '<div class="flexia-topbar_contact">' . $html . '</div>';
				echo wp_kses_post($output);
			}
		?>
		<!-- Header Top Contact End -->

		<!-- Header Top Content Start -->
		<?php if ( !empty(get_theme_mod('flexia_topbar_content'))) : ?>
			<div class="flexia-topbar-content">
				<?php echo get_theme_mod('flexia_topbar_content'); ?>
			</div>
		<?php endif ?>
		<!-- Header Top Content End -->

		<!-- Header Top Social Start -->
		<?php
			if (flexia_get_option('flexia_enable_header_social') == true && flexia_get_option('flexia_header_social_position') == "topbar") {
				get_template_part('framework/views/template-parts/content', 'social-links');
			}
		?>
		<!-- Header Top Social End -->

		<?php if( get_theme_mod('flexia_enable_topbar_menu') == true ) : ?>
		<nav id="topbar-navigation" class="flexia-menu topbar-navigation">
			<a class="flexia-nav-btn"></a>
			
			<?php

				if ( has_nav_menu( 'topbar-menu' ) ) :
					wp_nav_menu( array(
						'theme_location' => 'topbar-menu',
						'menu_id'        => 'flexia-topbar-menu',
						'menu_class'     => 'nav-menu flexia-topbar-menu ' . $dropdown_animation,
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