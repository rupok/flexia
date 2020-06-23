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
				$html .= '<a href="tel:'.str_replace(' ', '', $phone).'"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 384 384" style="enable-background:new 0 0 384 384;" xml:space="preserve"> <g> <g> <path d="M353.188,252.052c-23.51,0-46.594-3.677-68.469-10.906c-10.719-3.656-23.896-0.302-30.438,6.417l-43.177,32.594 c-50.073-26.729-80.917-57.563-107.281-107.26l31.635-42.052c8.219-8.208,11.167-20.198,7.635-31.448 c-7.26-21.99-10.948-45.063-10.948-68.583C132.146,13.823,118.323,0,101.333,0H30.813C13.823,0,0,13.823,0,30.813 C0,225.563,158.438,384,353.188,384c16.99,0,30.813-13.823,30.813-30.813v-70.323C384,265.875,370.177,252.052,353.188,252.052z" /> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>'.$phone.'</a>';
			}

			if (!empty($email)) {
				$show = true;
				$html .= '<a href="mailto:'.str_replace(' ', '', $email).'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 12.713l-11.985-9.713h23.97l-11.985 9.713zm0 2.574l-12-9.725v15.438h24v-15.438l-12 9.725z"/></svg>'.$email.'</a>';
			}

			if (!empty($location) && !empty($location_link)) {
				$show = true;
				$html .= '<a href="'.$location_link.'"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <path d="M256,0C153.755,0,70.573,83.182,70.573,185.426c0,126.888,165.939,313.167,173.004,321.035 c6.636,7.391,18.222,7.378,24.846,0c7.065-7.868,173.004-194.147,173.004-321.035C441.425,83.182,358.244,0,256,0z M256,278.719 c-51.442,0-93.292-41.851-93.292-93.293S204.559,92.134,256,92.134s93.291,41.851,93.291,93.293S307.441,278.719,256,278.719z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>'.$location.'</a>';
			}

			if ($show) {
				$output = '<div class="flexia-topbar_contact">' . $html . '</div>';
				echo wp_kses_post($output);
			}
		?>
		<!-- Header Top Contact End -->

		<!-- Header Top Content Start -->
		<?php if ( !empty(get_theme_mod('flexia_topbar_content', ''))) : ?>
			<div class="flexia-topbar-content">
				<?php echo html_entity_decode(get_theme_mod('flexia_topbar_content', '')); ?>
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