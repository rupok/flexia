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

function flexia_generate_css()
{
	$defaults = flexia_generate_defaults();
	$header_text_color = get_header_textcolor();

	if ((get_theme_mod('flexia_background_image_enable_button'))) {
		$flexia_background_image =  "url(" . get_theme_mod('flexia_background_image') . ")";
	} else {
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
		background-image: ' . $flexia_background_image . ';
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

	.site-content a {
		font-size: ' . $defaults['flexia_link_font_size'] . 'em;
	}
	
	a {
		color: ' . $defaults['flexia_link_color'] . ';
		font-family: "' . $defaults['flexia_link_font_family'] . '", -apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
		line-height: ' . $defaults['flexia_link_font_line_height'] . ';
		text-transform: ' . $defaults['flexia_link_font_text_transform'] . ';
	}
	
	a:hover, a:focus, a:active {
		color: ' . $defaults['flexia_link_hover_color'] . ';
	}
	
	input[type=button], button {
		color: ' . $defaults['flexia_button_text_color'] . ';
		background-color: ' . $defaults['flexia_button_background_color'] . ';
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
		width: ' . $defaults['flexia_sidebar_width_left'] . '%;
	}
	
	.flexia-sidebar-right {
		width: ' . $defaults['flexia_sidebar_width_right'] . '%;
	}
	
	body.blog, body.archive, body.single-post,
	body.blog.custom-background, body.archive.custom-background, body.single-post.custom-background, body.search, body,error404 {
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
	
	.site-branding .flexia-header-logo > img {
		width: ' . $defaults['flexia_header_logo_width'] . 'px;
	}

	.site-branding .flexia-header-sticky-logo  > img {
		width: ' . $defaults['flexia_sticky_header_logo_width'] . 'px;
	}
	
	.header-content .flexia-blog-logo {
		width: ' . $defaults['flexia_blog_logo_width'] . 'px;
	}

	.page-header.blog-header, .page-header.single-blog-header {
		background-color: ' . $defaults['flexia_blog_header_bg_color'] . ';
	}

	/* Archive page header */
	.page-header.archive-header {
		background-color: ' . $defaults['flexia_archive_header_bg_color'] . ';
	}

	.archive-header .header-content > .page-title {
		font-size: ' . $defaults['flexia_archive_title_font_size'] . 'px;
		color: ' . $defaults['flexia_archive_title_font_color'] . ';
		font-family: ' . $defaults['flexia_archive_header_title_font_family'] . ';
	}

	.header-content .archive-description > p {
		font-size: ' . $defaults['flexia_archive_desc_font_size'] . 'px;
		color: ' . $defaults['flexia_archive_desc_font_color'] . ';
		font-family: ' . $defaults['flexia_archive_header_desc_font_family'] . ';
	}

	.blog-header .header-content > .page-title {
		font-size: ' . $defaults['flexia_blog_title_font_size'] . 'px;
		color: ' . $defaults['flexia_blog_title_font_color'] . ';
		font-family: ' . $defaults['flexia_blog_header_title_font_family'] . ';
	}
	
	.paged .blog-header .header-content > .page-title, .paged .archive-header .header-content > .page-title {
		font-size: calc(' . $defaults['flexia_blog_title_font_size'] . 'px / 1.2);
	}
	
	.header-content .blog-desc, .header-content .archive-description > p {
		font-size: ' . $defaults['flexia_blog_desc_font_size'] . 'px;
		color: ' . $defaults['flexia_blog_desc_font_color'] . ';
		font-family: ' . $defaults['flexia_blog_header_desc_font_family'] . ';
	}
	
	.paged .header-content .blog-desc, .paged .header-content .archive-description > p {
		font-size: calc(' . $defaults['flexia_blog_desc_font_size'] . 'px / 1.2);
	}
	
	.page .entry-header.entry-header-large, .page .entry-header.entry-header-mini, .page-header.error-header, .page-header.search-header {
		background-color: ' . $defaults['flexia_page_title_bg'] . ';
	}
	
	.page .entry-header .entry-title, .page-header.error-header .page-title, .page-header.search-header .page-title {
		color: ' . $defaults['flexia_page_title_font_color'] . ';
		font-size: ' . $defaults['flexia_page_title_font_size'] . 'px;
	}
	
	.flexia-breadcrumb .flexia-breadcrumb-item, .flexia-breadcrumb .flexia-breadcrumb-item a, .flexia-breadcrumb .breadcrumb-delimiter {
		color: ' . $defaults['flexia_breadcrumb_font_color'] . ';
		font-size: ' . $defaults['flexia_breadcrumb_font_size'] . 'px;
	}

	.flexia-breadcrumb .flexia-breadcrumb-item, .flexia-breadcrumb .flexia-breadcrumb-item a, .flexia-breadcrumb .breadcrumb-delimiter svg,
	.woocommerce-breadcrumb .breadcrumb-separator svg {
		fill: ' . $defaults['flexia_breadcrumb_font_color'] . ';
		height: ' . ($defaults['flexia_breadcrumb_font_size']*.8) . 'px;
		width: auto;
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
	
	.flexia-topbar-content {
		color: ' . $defaults['flexia_header_top_contact_font_color'] . ';
		font-size: ' . $defaults['flexia_header_top_contact_font_size'] . 'em;
	}
	
	.flexia-topbar a, .flexia-topbar_contact a {
		color: ' . $defaults['flexia_header_top_contact_font_color'] . ';
		font-size: ' . $defaults['flexia_header_top_contact_font_size'] . 'em;
	}

	.flexia-topbar_contact a svg {
		fill: ' . $defaults['flexia_header_top_contact_font_color'] . ';
		height: ' . ($defaults['flexia_header_top_contact_font_size'] * 1.2) . 'em;
		width: auto;
		margin-right: 5px;
	}
	
	.flexia-topbar_contact a:hover {
		color: ' . $defaults['flexia_header_top_contact_font_hover_color'] . ';
	}
	
	.flexia-social-links li a svg {
		fill: ' . $defaults['flexia_header_social_icon_color'] . ';
		height: ' . $defaults['flexia_header_social_icon_size'] . 'em;
		width: auto;
	}
	
	.flexia-social-links li a:hover svg {
		fill: ' . $defaults['flexia_header_social_icon_hover_color'] . ';
	}
	
	.flexia-woo-sidebar .widget_price_filter .ui-slider .ui-slider-range,
	.flexia-woo-sidebar .widget_price_filter .ui-slider .ui-slider-handle,
	.single-product.woocommerce .product .cart .single_add_to_cart_button,
	aside .widget button, 
	.flexia-woo-sidebar .widget button,
	.widget .search-form .search-submit {
		background-color: ' . $defaults['flexia_primary_color'] . ';
	}

	.single-product.woocommerce .product .woocommerce-tabs ul.wc-tabs > li.active::before,
	input:focus, textarea:focus, select:focus,
	.widget .search-form .search-submit {
		border-color: ' . $defaults['flexia_primary_color'] . ';
	}

	.single-blog-meta .entry-meta svg {
		fill: ' . $defaults['flexia_primary_color'] . ';
		width: auto;
		height: 1em;
		margin-right: 5px;
    	margin-bottom: -3px;
	}

	.flexia-menu.header-icons ul li.navbar-login-menu a button svg {
		fill: ' . $defaults['flexia_button_text_color'] . ';
		height: ' . $defaults['flexia_button_font_size'] . 'em;
		margin-bottom: -3px;
	}

	.single .entry-footer svg {
		height: 1em;
		margin: 0 5px -3px 0;
		fill: ' . $defaults['flexia_default_text_color'] . ';
	}

	body.blog .flexia-wrapper > .content-area article .entry-content .more-link {
		color: ' . $defaults['flexia_button_text_color'] . ';
		background-color: ' . $defaults['flexia_button_background_color'] . ';
		border: 1px solid transparent;
    	border-radius: 4px;
	}
	body.blog .flexia-wrapper > .content-area article .entry-content .more-link:hover {
		background: #3f3f46;
		color: #fff;
		border: 1px solid #3f3f46;
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
		' . flexia_dimension_attr_generator('flexia_navbar_padding') . '
	}
	
	.flexia-menu.header-icons .nav-menu li > a,
	.flexia-navbar .flexia-navbar-container .flexia-navbar-inner .search-form .search-field,
	.flexia-menu.header-icons {
		color: ' . $defaults['flexia_main_nav_menu_link_color'] . ';
	}

	.flexia-navbar .flexia-navbar-container .flexia-navbar-inner .search-form .search-submit svg,
	.flexia-menu.header-icons ul li #btn-search svg,
	.widget .search-form .search-submit svg {
		fill: ' . $defaults['flexia_main_nav_menu_link_color'] . ';
		height: .9em;
		width: auto;
	}

	.main-navigation .nav-menu li a svg {
		fill: ' . $defaults['flexia_main_nav_menu_link_color'] . ';
		height: .7em;
		width: auto;
		margin-left: 5px;
	}

	.flexia-menu.header-icons .flexia-header-cart a.cart-contents .flexia-header-cart-icon svg {
		fill: ' . $defaults['flexia_main_nav_menu_link_color'] . ';
		height: 1em;
		width: auto;
	}

	.flexia-menu .flexia-menu-toggle:after {
		border-color: ' . $defaults['flexia_main_nav_menu_link_color'] . ';
	}
	.flexia-menu .flexia-menu-toggle:before, .flexia-menu .flexia-menu-toggle.flexia-menu-toggle-open::after {
		background-color: ' . $defaults['flexia_main_nav_menu_link_color'] . ';
	}

	.flexia-social-share-links li a svg {
		height: 2em;
		width: auto;
		fill: ' . $defaults['flexia_primary_color'] . ';
	}


	.blog .flexia-load-more-button {
		background-color: ' .$defaults['flexia_load_more_btn_bg'] . ';
		color: ' .$defaults['flexia_load_more_font_color'] . ';
		font-size: ' .$defaults['flexia_load_more_btn_font_size'] . 'px;
	}
	.blog .flexia-load-more-button:hover,
	.blog .flexia-load-more-button.button--loading {
		background-color: ' .$defaults['flexia_load_more_btn_bg_active'] . ';
		color: ' .$defaults['flexia_load_more_font_color_active'] . ';
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
	
		.main-navigation .nav-menu li ul li:hover > a:not(.cart-contents), 
		.main-navigation .nav-menu li ul li.current-menu-item > a:not(.cart-contents), 
		.main-navigation .nav-menu li ul li.current-menu-ancestor > a:not(.cart-contents), 
		.main-navigation .nav-menu li ul.flexia-mega-menu li > a:not(.cart-contents):hover {
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
	}
	
	.customize-partial-edit-shortcut-button {
		padding: 3px !important;
		border-radius: 50% !important;
		border: 2px solid #fff !important;
	}';


	return $css;
}

function ajax_dynamic_css()
{
	check_ajax_referer('flexia-customizer', 'security');
	wp_send_json(flexia_generate_css());
}
add_action('wp_ajax_generate_css', 'ajax_dynamic_css');
