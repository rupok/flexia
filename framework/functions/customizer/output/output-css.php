<?php
/**
 * Flexia Theme Customizer outout for layout settings
 *
 * @package Flexia
 */

if (!function_exists('flexia_customizer_style')) {
    /**
     * Styles the header image and text displayed on the blog.
     *
     * @see flexia_custom_header_setup().
     */
    function flexia_customizer_style()
    {
        echo '<style type="text/css" id="flexia-dynamic-css">' . flexia_generate_css() . '</style>';
    }
}

/**
 * This function adds some styles to the WordPress Customizer
 */
function flexia_customizer_custom_styles() { ?>
	<style type="text/css">
		.customize-control-flexia-title .flexia-select,
		.customize-control-flexia-title .flexia-dimension{
			display: flex;
		}
		.customize-control-flexia-range-value {
			display: flex;
		}
		.customize-control-flexia-range-value .customize-control-title,
		.customize-control-flexia-number .customize-control-title {
			float: left;
		}
		.flexia-customize-control-separator {
			display: block;
			margin: 0 -12px;
			border: 1px solid #ddd;
			border-left: 0;
			border-right: 0;
			padding: 15px;
			font-size: 11px;
			font-weight: 600;
			letter-spacing: 2px;
			line-height: 1;
			text-transform: uppercase;
			color: #555;
			background-color: #fff;
		}
		.customize-control.customize-control-flexia-dimension,
		.customize-control-flexia-select {
			width: 25%;
			float: left !important;
			clear: none !important;
			margin-top: 0;
			margin-bottom: 12px;
		}
		.customize-control.customize-control-flexia-dimension .customize-control-title,
		.customize-control-flexia-select .customize-control-title{
			font-size: 11px;
			font-weight: normal;
			color: #888b8c;
			margin-top: 0;
		}
		.flexia-customizer-reset {
			font-size: 22px;
    		line-height: 26px;
    		margin-left: 5px;
			transition: unset;
		}
		.flexia-customizer-reset:focus {
			box-shadow: none;
		}		
		.flexia-customizer-reset svg {
			width: 16px;
			fill: #FE1F4A;
		}
		.customize-control-title .customize-control-title {
			margin-bottom: 0;
		}
	</style>
	<?php

}
add_action( 'customize_controls_print_styles', 'flexia_customizer_custom_styles', 999 );

function flexia_generate_css()
{
    $defaults = flexia_generate_defaults();
	$header_text_color = get_header_textcolor();

	if ((get_theme_mod('flexia_background_image_enable_button'))) {
		$flexia_background_image =  "url(" . get_theme_mod('flexia_background_image') . ")";
	}
	else {
		$flexia_background_image = "none";
	}

    $css = '.flexia-primary-menu .customize-partial-edit-shortcut button {
		margin-left: 50px;
	  }

	  .site-title a, .site-description {
		color: #' . $header_text_color . ';
	  }

	  body, button, input, select, optgroup, textarea {
		color: ' . $defaults['flexia_default_text_color'] . ';
	  }

	  body {
		font-family: "' . $defaults['flexia_body_font_family'] . '", -apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
		font-size: ' . $defaults['flexia_body_font_size'] . 'px;
		line-height: ' . $defaults['flexia_body_font_line_height'] . ';
		text-transform: ' . $defaults['flexia_body_font_text_transform'] . ';
		background-color: ' . $defaults['flexia_background_color'] . ';
		background-image: ' .$flexia_background_image. ';
		background-size: ' . $defaults['flexia_background_image_size'] . ';
		background-position: ' . $defaults['flexia_background_image_position'] . ';
		background-repeat: ' . $defaults['flexia_background_image_repeat'] . ';
	  }

	  p {
		font-family: "' . $defaults['flexia_paragraph_font_family'] . '", -apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
		font-size: ' . $defaults['flexia_paragraph_font_size'] . 'em;
		line-height: ' . $defaults['flexia_paragraph_font_line_height'] . ';
		text-transform: ' . $defaults['flexia_paragraph_font_text_transform'] . ';
	  }

	  h1, h2, h3, h4, h5, h6 {
		font-family: "' . $defaults['flexia_heading_font_family'] . '", "Helvetica Neue",sans-serif;
		color: ' . $defaults['flexia_default_heading_color'] . ';
		line-height: ' . $defaults['flexia_heading_font_line_height'] . ';
		text-transform: ' . $defaults['flexia_heading_font_text_transform'] . ';
	  }

	  h1 {
		font-size: ' . $defaults['flexia_heading1_font_size'] . 'em;
	  }

	  h2 {
		font-size: ' . $defaults['flexia_heading2_font_size'] . 'em;
	  }

	  h3 {
		font-size: ' . $defaults['flexia_heading3_font_size'] . 'em;
	  }

	  h4 {
		font-size: ' . $defaults['flexia_heading4_font_size'] . 'em;
	  }

	  h5 {
		font-size: ' . $defaults['flexia_heading5_font_size'] . 'em;
	  }

	  h6 {
		font-size: ' . $defaults['flexia_heading6_font_size'] . 'em;
	  }

	  a {
		color: ' . $defaults['flexia_link_color'] . ';
		font-family: "' . $defaults['flexia_link_font_family'] . '", -apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
		font-size: ' . $defaults['flexia_link_font_size'] . 'em;
		line-height: ' . $defaults['flexia_link_font_line_height'] . ';
		text-transform: ' . $defaults['flexia_link_font_text_transform'] . ';
	  }

	  a:hover, a:focus, a:active {
		color: ' . $defaults['flexia_link_hover_color'] . ';
	  }

	  input[type=button], button {
		color: ' . $defaults['flexia_button_text_color'] . ';
		font-family: "' . $defaults['flexia_button_font_family'] . '", -apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
		font-size: ' . $defaults['flexia_button_font_size'] . 'em;
		line-height: ' . $defaults['flexia_button_font_line_height'] . ';
		text-transform: ' . $defaults['flexia_button_font_text_transform'] . ';
	  }

	  .flexia-container.width {
		width: ' . $defaults['flexia_container_width'] . '%;
	  }

	  .flexia-container.max {
		max-width: ' . $defaults['flexia_container_max_width'] . 'px;
	  }

	  .single .entry-content-wrapper {
		width: ' . $defaults['flexia_post_width'] . '%;
		max-width: ' . $defaults['flexia_post_max_width'] . 'px;
	  }

	  .flexia-sidebar-left {
		width: ' . $defaults['flexia_left_sidebar_width'] . 'px;
	  }

	  .flexia-sidebar-right {
		width: ' . $defaults['flexia_right_sidebar_width'] . 'px;
	  }

	  body.blog, body.archive, body.single-post,
		  body.blog.custom-background, body.archive.custom-background, body.single-post.custom-background {
		background-color: ' . $defaults['flexia_blog_bg_color'] . ';
	  }

	  .flexia-wrapper > .content-area, .entry-content.single-post-entry,
		  body.blog .flexia-wrapper > .content-area article.post,
		  body.archive .flexia-wrapper > .content-area article.post {
		background-color: ' . $defaults['flexia_post_content_bg_color'] . ';
	  }

	  .single-post .entry-header.single-blog-meta.single-post-meta-large {
		background-color: ' . $defaults['flexia_post_meta_bg_color'] . ';
	  }

	  .flexia-sidebar .widget {
		background-color: ' . $defaults['flexia_sidebar_widget_bg_color'] . ';
	  }

	  .flexia-header-logo {
		height: ' . $defaults['flexia_header_logo_height'] . 'px;
	  }

	  .flexia-sticky-navbar .flexia-header-logo {
		height: ' . $defaults['flexia_sticky_header_logo_height'] . 'px;
	  }

	  .header-content .flexia-blog-logo {
		width: ' . $defaults['flexia_blog_logo_width'] . 'px;
	  }

	  .blog-header .header-content > .page-title, .archive-header .header-content > .page-title {
		font-size: ' . $defaults['flexia_blog_title_font_size'] . 'px;
	  }

	  .paged .blog-header .header-content > .page-title, .paged .archive-header .header-content > .page-title {
		font-size: calc(' . $defaults['flexia_blog_title_font_size'] . 'px / 1.5);
	  }

	  .header-content .blog-desc, .header-content .archive-description > p {
		font-size: ' . $defaults['flexia_blog_desc_font_size'] . 'px;
	  }

	  .paged .header-content .blog-desc, .paged .header-content .archive-description > p {
		font-size: calc(' . $defaults['flexia_blog_desc_font_size'] . 'px / 1.5);
	  }

	  .page .entry-header.entry-header-large, .page .entry-header.entry-header-mini {
		background-color: ' . $defaults['flexia_page_title_bg'] . ';
	  }

	  .page .entry-header .entry-title {
		color: ' . $defaults['flexia_page_title_font_color'] . ';
		font-size: ' . $defaults['flexia_page_title_font_size'] . 'px;
	  }

	  .flexia-breadcrumb .flexia-breadcrumb-item, .flexia-breadcrumb .flexia-breadcrumb-item a, .flexia-breadcrumb .breadcrumb-delimiter {
		color: ' . $defaults['flexia_breadcrumb_font_color'] . ';
		font-size: ' . $defaults['flexia_breadcrumb_font_size'] . 'px;
	  }

	  .flexia-breadcrumb-item.current span, .breadcrumb li a:hover, .breadcrumb li a:focus {
		color: ' . $defaults['flexia_breadcrumb_active_font_color'] . ';
	  }

	  .flexia-search-overlay {
		background-color: ' . $defaults['flexia_overlay_search_bg_color'] . ';
	  }

	  .flexia-search-overlay::before, .flexia-search-overlay::after {
		border: ' . $defaults['flexia_overlay_search_border_width'] . 'px solid ' . $defaults['flexia_overlay_search_border_color'] . ';
	  }

	  .icon-search-close {
		height: ' . $defaults['flexia_overlay_search_close_btn_size'] . 'px;
		width: ' . $defaults['flexia_overlay_search_close_btn_size'] . 'px;
		fill: ' . $defaults['flexia_overlay_search_close_btn_color'] . ';
	  }

	  .btn--search-close:hover .icon-search-close {
		fill: ' . $defaults['flexia_overlay_search_close_btn_hover_color'] . ';
	  }

	  .search--input-wrapper .search__input, .search--input-wrapper .search__input:focus {
		color: ' . $defaults['flexia_overlay_search_field_font_color'] . ';
		font-size: ' . $defaults['flexia_overlay_search_field_font_size'] . 'px;
	  }

	  .search--input-wrapper::after {
		font-size: ' . $defaults['flexia_overlay_search_field_font_size'] . 'px;
	  }

	  .search--input-wrapper::after {
		border-color: ' . $defaults['flexia_overlay_search_field_font_color'] . ';
	  }

	  .search__info {
		color: ' . $defaults['flexia_overlay_search_label_font_color'] . ';
		font-size: ' . $defaults['flexia_overlay_search_label_font_size'] . 'px;
	  }

	  .flexia-topbar-content{
		color: ' . $defaults['flexia_header_top_contact_font_color'] . ';
		font-size: ' . $defaults['flexia_header_top_contact_font_size'] . 'em;
	  }

	  .flexia-topbar_contact a {
		color: ' . $defaults['flexia_header_top_contact_font_color'] . ';
		font-size: ' . $defaults['flexia_header_top_contact_font_size'] . 'em;
	  }

	  .flexia-topbar_contact a:hover {
		color: ' . $defaults['flexia_header_top_contact_font_hover_color'] . ';
	  }

	  .flexia-social-links li a {
		color: ' . $defaults['flexia_header_social_icon_color'] . ';
		font-size: ' . $defaults['flexia_header_social_icon_size'] . 'em;
	  }

	  .flexia-social-links li a:hover {
		color: ' . $defaults['flexia_header_social_icon_hover_color'] . ';
	  }

	  @media all and (max-width: 959px) {
			.blog-header .header-content > .page-title, .archive-header .header-content > .page-title {
				font-size: calc(' . $defaults['flexia_blog_title_font_size'] . 'px * .75);
			}

			.header-content .blog-desc, .header-content .archive-description > p {
				font-size: calc(' . $defaults['flexia_blog_desc_font_size'] . 'px * .75);
			}
	  }

	  @media all and (max-width: 480px) {
			.blog-header .header-content > .page-title, .archive-header .header-content > .page-title {
				font-size: calc(' . $defaults['flexia_blog_title_font_size'] . 'px * .5);
			}

			.header-content .blog-desc, .header-content .archive-description > p {
				font-size: calc(' . $defaults['flexia_blog_desc_font_size'] . 'px * .5);
			}
	  }

	  .flexia-header-widget-area {
		background-color: ' . $defaults['flexia_header_widget_area_bg_color'] . ';
	  }

	  .flexia-topbar {
		background-color: ' . $defaults['flexia_topbar_bg_color'] . ';
	  }

	  .flexia-logobar {
		background-color: ' . $defaults['flexia_logobar_bg_color'] . ';
	  }

	  .flexia-navbar {
		background-color: ' . $defaults['flexia_navbar_bg_color'] . ';
	  }

	.flexia-menu.header-icons .nav-menu li > a {
		color: ' . $defaults['flexia_main_nav_menu_link_color'] . ';
	}

	  @media screen and (min-width: 992px) {
			.main-navigation .nav-menu li > a, .flexia-menu.header-icons .nav-menu li > a {
				color: ' . $defaults['flexia_main_nav_menu_link_color'] . ';
			}

			.main-navigation .nav-menu li:hover > a:not(.cart-contents), 
			.main-navigation .nav-menu li.current-menu-item > a:not(.cart-contents), 
			.main-navigation .nav-menu li.current-menu-ancestor > a:not(.cart-contents) {
				color: ' . $defaults['flexia_main_nav_menu_link_hover_color'] . ';
			}
			.main-navigation .nav-menu > li > a:after {
				color: ' . $defaults['flexia_main_nav_menu_link_hover_color'] . ';
				background-color: ' . $defaults['flexia_main_nav_menu_link_hover_color'] . ';
			}

			.main-navigation .nav-menu li:hover > a:not(.cart-contents), 
			.main-navigation .nav-menu li.current-menu-item > a:not(.cart-contents), 
			.main-navigation .nav-menu li.current-menu-ancestor > a:not(.cart-contents) {
				background-color: ' . $defaults['flexia_main_nav_menu_link_hover_bg'] . ';
			}

			.main-navigation .nav-menu li ul {
				background-color: ' . $defaults['flexia_main_nav_menu_submenu_bg_color'] . ';
			}

			.main-navigation .nav-menu li ul li > a, 
			.main-navigation .nav-menu li ul.flexia-mega-menu li:hover > a:not(.cart-contents) {
				color: ' . $defaults['flexia_main_nav_menu_submenu_link_color'] . ';
			}

			.main-navigation .nav-menu li ul.flexia-mega-menu li:hover > a:not(.cart-contents) {
				background-color: initial;
			}

			.main-navigation .nav-menu li ul li:hover > a:not(.cart-contents), .main-navigation .nav-menu li ul li.current-menu-item > a:not(.cart-contents), .main-navigation .nav-menu li ul li.current-menu-ancestor > a:not(.cart-contents), .main-navigation .nav-menu li ul.flexia-mega-menu li > a:not(.cart-contents):hover {
				color: ' . $defaults['flexia_main_nav_menu_submenu_link_hover_color'] . ';
			}

			.main-navigation .nav-menu li ul li:hover > a:not(.cart-contents), 
			.main-navigation .nav-menu li ul li.current-menu-item > a:not(.cart-contents), 
			.main-navigation .nav-menu li ul li.current-menu-ancestor > a:not(.cart-contents), 
			.main-navigation .nav-menu li ul.flexia-mega-menu li > a:not(.cart-contents):hover {
				background-color: ' . $defaults['flexia_main_nav_menu_submenu_link_hover_bg'] . ';
			}

			.topbar-navigation .nav-menu li > a {
				color: ' . $defaults['flexia_top_nav_menu_link_color'] . ';
			}

			.topbar-navigation .nav-menu li:hover > a, .topbar-navigation .nav-menu li.current-menu-item > a, .topbar-navigation .nav-menu li.current-menu-ancestor > a {
				color: ' . $defaults['flexia_top_nav_menu_link_hover_color'] . ';
			}

			.topbar-navigation .nav-menu li:hover > a, .topbar-navigation .nav-menu li.current-menu-item > a, .topbar-navigation .nav-menu li.current-menu-ancestor > a {
				background-color: ' . $defaults['flexia_top_nav_menu_link_hover_bg'] . ';
			}

			.topbar-navigation .nav-menu li ul {
				background-color: ' . $defaults['flexia_top_nav_menu_submenu_bg_color'] . ';
			}

			.topbar-navigation .nav-menu li ul li > a {
				color: ' . $defaults['flexia_top_nav_menu_submenu_link_color'] . ';
			}

			.topbar-navigation .nav-menu li ul li:hover > a, .topbar-navigation .nav-menu li ul li.current-menu-item > a, .topbar-navigation .nav-menu li ul li.current-menu-ancestor > a {
				color: ' . $defaults['flexia_top_nav_menu_submenu_link_hover_color'] . ';
			}

			.topbar-navigation .nav-menu li ul li:hover > a, .topbar-navigation .nav-menu li ul li.current-menu-item > a, .topbar-navigation .nav-menu li ul li.current-menu-ancestor > a {
				background-color: ' . $defaults['flexia_top_nav_menu_submenu_link_hover_bg'] . ';
			}
	  }

	  .flexia-footer-widget-area {
			background-color: ' . $defaults['flexia_footer_widget_area_bg_color'] . ';
		}
		
		.flexia-colophon-inner .widget {
			color: ' . $defaults['flexia_footer_widget_area_content_color'] . ';
		}
		
		.flexia-colophon-inner .widget a {
			color: ' . $defaults['flexia_footer_widget_area_link_color'] . ';
		}
		
		.flexia-colophon-inner .widget a:hover {
			color: ' . $defaults['flexia_footer_widget_area_link_hover_color'] . ';
		}

	  .flexia-site-footer {
			background-color: ' . $defaults['flexia_footer_bg_color'] . ';
	  }

	  .flexia-site-footer .site-info {
			color: ' . $defaults['flexia_footer_content_color'] . ';
	  }

	  .flexia-site-footer .site-info a, .flexia-footer-menu li a {
			color: ' . $defaults['flexia_footer_link_color'] . ';
	  }

	  .flexia-site-footer .site-info a:hover, .flexia-footer-menu li a:hover {
			color: ' . $defaults['flexia_footer_link_hover_color'] . ';
	  }';

    return $css;
}

function ajax_dynamic_css()
{
    check_ajax_referer('flexia-customizer', 'security');
    wp_send_json(flexia_generate_css());
}
add_action('wp_ajax_generate_css', 'ajax_dynamic_css');
