<?php

// No direct access, please
if (!defined('ABSPATH')) exit;


/**
 * The template for displaying the Navbar
 *
 * Contains the navbar part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

$navbar_class = get_theme_mod('flexia_navbar_position', 'flexia-navbar-static-top');
$dropdown_animation = 'flexia-menu-dropdown-animate-' . get_theme_mod('flexia_main_nav_menu_dropdown_animation', 'to-top');
$flexia_logobar_position = get_theme_mod('flexia_logobar_position', 'flexia-logobar-inline');
$flexia_logobar_position_class = 'flexia-logobar-stacked' === $flexia_logobar_position ? 'stacked-sticky-logo' : 'flexia-logobar-inline';
?>

<div class="flexia-navbar <?php echo esc_attr($navbar_class); ?>">
	<div class="flexia-navbar-container">
		<div class="flexia-container flexia-navbar-inner <?php echo (get_theme_mod('flexia_header_layout_type') == "full-width") ? "full-width" : "width max" ?>">

			<div class="<?php echo esc_attr($flexia_logobar_position_class); ?>">
				<div class="site-branding">

					<?php echo flexia_main_logo(); ?>

				</div><!-- .site-branding -->

				<!-- Header Search Box -->
				<?php get_search_form(); ?>
				<!-- Header Search Box End -->
			</div>

			<nav id="site-navigation" class="flexia-menu main-navigation">
				<?php

				if (has_nav_menu('primary')) :
					wp_nav_menu(array(
						'theme_location' => 'primary',
						'menu_id'        => 'flexia-primary-menu',
						'menu_class'     => 'nav-menu flexia-primary-menu ' . $dropdown_animation,
						'container'      => false,
					));
				else :

					echo '<ul class="flexia-primary-menu"><li><a href="' . home_url('/') . 'wp-admin/nav-menus.php">Assign a Menu</a></li></ul>';
				endif;

				?>

			</nav><!-- #site-navigation -->

			<div class="flexia-menu header-icons icon-menu">
				<ul class="nav-menu <?php echo esc_attr($dropdown_animation); ?>">
					<?php
					$items = '';
					$items = apply_filters('flexia_header_icon_items', $items);
					echo wp_kses_post($items);
					?>
				</ul>
			</div><!-- #header-icons -->

			<!-- Header Main Social Start -->
			<?php
			if (flexia_get_option('flexia_enable_header_social') == true && flexia_get_option('flexia_header_social_position') == "header_main") {
				get_template_part('framework/views/template-parts/content', 'social-links');
			}
			?>
			<!-- Header Main Social End -->

		</div><!-- #flexia-container -->
	</div><!-- #flexia-navbar-container -->
</div>