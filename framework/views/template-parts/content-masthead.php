<?php

// No direct access, please
if (!defined('ABSPATH')) exit;

/**
 * The template for displaying the header
 *
 * Contains the masthead part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */


$header_widget_area = get_theme_mod('flexia_header_widget_area', false);

$flexia_enable_topbar = get_theme_mod('flexia_enable_topbar', false);

$flexia_logobar_position = get_theme_mod('flexia_logobar_position', 'flexia-logobar-inline');

$flexia_navbar = get_theme_mod('flexia_navbar', true);

$header_layouts = get_theme_mod('flexia_header_layouts', '1');

$header_mobile_layouts = flexia_get_option('flexia_header_mobile_layouts', 'flexia_header_mobile_layouts_1');

?>

<header id="masthead" class="site-header flexia-header-<?php echo esc_attr($header_layouts); ?> <?php echo esc_attr($header_mobile_layouts); ?>">

	<?php if ($header_widget_area == true) :
		get_template_part('framework/views/template-parts/content', 'header-widgets');
	endif; ?>

	<?php if ($flexia_enable_topbar == true) :
		get_template_part('framework/views/template-parts/content', 'topbar');
	endif; ?>

	<?php if ($flexia_logobar_position == 'flexia-logobar-stacked') :
		get_template_part('framework/views/template-parts/content', 'logobar');
	endif; ?>

	<?php if ($flexia_navbar == true) :
		if ($header_layouts <= 4) {
			get_template_part('framework/views/template-parts/headers/header', $header_layouts);
		}

		if (class_exists('Flexia_Pro') && $header_layouts > 4) :
			include(FLEXIA_PRO_DIR_PATH . 'public/template-parts/headers/header-' . $header_layouts . '.php');
		endif;
	endif; ?>


</header><!-- #masthead -->