<?php
/**
 * Flexia Theme Customizer outout for layout settings
 *
 * @package Flexia
 */


if ( ! function_exists( 'flexia_customizer_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see flexia_custom_header_setup().
 */
function flexia_customizer_style() {

	// Get default customizer values
	$defaults = flexia_generate_defaults();
	$header_text_color = get_header_textcolor();
	
	?>
	<style type="text/css" id="flexia-header-style">
	<?php
	?>
	.flexia-primary-menu .customize-partial-edit-shortcut button {
		margin-left: 50px;
	}
	.site-title a,
	.site-description {
		color: #<?php echo ! empty( $header_text_color ) ? esc_attr( $header_text_color ) : ''; ?>;
	}

	body, button, input, select, optgroup, textarea {
		color: <?php echo $defaults['body_font_color']; ?>;
	}

	body {
		font-family: "<?php echo $defaults['body_font_family']; ?>", -apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
		font-size: <?php echo $defaults['body_font_size']; ?>px;
	}

	h1, h2, h3, h4, h5, h6 {
		font-family: "<?php echo $defaults['heading_font_family']; ?>", "Helvetica Neue",sans-serif;
	}

	h1 {
		font-size: <?php echo $defaults['heading1_font_size']; ?>em;
	}

	h2 {
		font-size: <?php echo $defaults['heading2_font_size']; ?>em;
	}

	h3 {
		font-size: <?php echo $defaults['heading3_font_size']; ?>em;
	}

	h4 {
		font-size: <?php echo $defaults['heading4_font_size']; ?>em;
	}

	h5 {
		font-size: <?php echo $defaults['heading5_font_size']; ?>em;
	}

	h6 {
		font-size: <?php echo $defaults['heading6_font_size']; ?>em;
	}

	a {
		color: <?php echo $defaults['site_link_color']; ?>;
	}

	a:hover, a:focus, a:active {
		color: <?php echo $defaults['site_link_hover_color']; ?>;
	}

	.flexia-container.width {
	width: <?php echo $defaults['container_width']; ?>%;
	}

	.flexia-container.max {
	max-width: <?php echo $defaults['container_max_width']; ?>px;
	}

	.single-post .entry-content-wrapper {
	width: <?php echo $defaults['post_width']; ?>%;
	max-width: <?php echo $defaults['post_max_width']; ?>px;
	}

	.flexia-sidebar-left {
	width: <?php echo $defaults['left_sidebar_width']; ?>px;
	}

	.flexia-sidebar-right {
	width: <?php echo $defaults['right_sidebar_width']; ?>px;
	}

	body.blog, body.archive, body.single-post,
	body.blog.custom-background, body.archive.custom-background, body.single-post.custom-background {
		background-color: <?php echo $defaults['blog_bg_color']; ?>;
	}

	.flexia-wrapper > .content-area, .entry-content.single-post-entry,
	body.blog .flexia-wrapper > .content-area article.post, 
	body.archive .flexia-wrapper > .content-area article.post {
		background-color: <?php echo $defaults['post_content_bg_color']; ?>;
	}

	.single-post .entry-header.single-blog-meta.single-post-meta-large {
		background-color: <?php echo $defaults['post_meta_bg_color']; ?>;
	}

	.flexia-sidebar .widget {
		background-color: <?php echo $defaults['sidebar_widget_bg_color']; ?>;
	}

	.flexia-header-logo {
		width: <?php echo $defaults['flexia_header_logo_width']; ?>px;
	}

	.flexia-sticky-navbar .flexia-header-logo {
		width: calc(<?php echo $defaults['flexia_header_logo_width']; ?>px * .65);
	}

	.header-content .flexia-blog-logo {
		width: <?php echo $defaults['blog_logo_width']; ?>px;
	}

	.blog-header .header-content > .page-title, .archive-header .header-content > .page-title {
		font-size: <?php echo $defaults['blog_title_font_size']; ?>px;
	}

	.paged .blog-header .header-content > .page-title, .paged .archive-header .header-content > .page-title {
		font-size: calc(<?php echo $defaults['blog_title_font_size']; ?>px / 1.5);
	}

	.header-content .blog-desc, .header-content .archive-description > p {
		font-size: <?php echo $defaults['blog_desc_font_size']; ?>px;
	}

	.paged .header-content .blog-desc, .paged .header-content .archive-description > p {
		font-size: calc(<?php echo $defaults['blog_desc_font_size']; ?>px / 1.5);
	}

	.page .entry-header.entry-header-large, .page .entry-header.entry-header-mini {
		background-color: <?php echo $defaults['flexia_page_title_bg']; ?>;
	}

	.page .entry-header .entry-title {
		color: <?php echo $defaults['flexia_page_title_font_color']; ?>;
		font-size: <?php echo $defaults['flexia_page_title_font_size']; ?>px;
	}

	.flexia-breadcrumb .flexia-breadcrumb-item, .flexia-breadcrumb .flexia-breadcrumb-item a, .flexia-breadcrumb .breadcrumb-delimiter{
		color: <?php echo $defaults['flexia_breadcrumb_font_color']; ?>;
		font-size: <?php echo $defaults['flexia_breadcrumb_font_size']; ?>px;
	}
	.flexia-breadcrumb-item.current span, .breadcrumb li a:hover, .breadcrumb li a:focus{
		color: <?php echo $defaults['flexia_breadcrumb_active_font_color']; ?>;
	}

	.flexia-search-overlay {
		background-color: <?php echo $defaults['flexia_overlay_search_bg_color']; ?>;
	}

	.flexia-search-overlay::before, .flexia-search-overlay::after{
		border: <?php echo $defaults['flexia_overlay_search_border_width']; ?>px solid <?php echo $defaults['flexia_overlay_search_border_color']; ?>;
	}

	.icon-search-close {
		height: <?php echo $defaults['flexia_overlay_search_close_btn_size']; ?>px;
		width: <?php echo $defaults['flexia_overlay_search_close_btn_size']; ?>px;
		fill: <?php echo $defaults['flexia_overlay_search_close_btn_color']; ?>;
	}
	.btn--search-close:hover .icon-search-close {
		fill: <?php echo $defaults['flexia_overlay_search_close_btn_hover_color']; ?>;
	}

	.search--input-wrapper .search__input, .search--input-wrapper .search__input:focus {
		color: <?php echo $defaults['flexia_overlay_search_field_font_color']; ?>;
		font-size: <?php echo $defaults['flexia_overlay_search_field_font_size']; ?>px;
	}

	.search--input-wrapper::after {
		font-size: <?php echo $defaults['flexia_overlay_search_field_font_size']; ?>px;
	}

	.search--input-wrapper::after {
		border-color: <?php echo $defaults['flexia_overlay_search_field_font_color']; ?>;
	}

	.search__info {
		color: <?php echo $defaults['flexia_overlay_search_label_font_color']; ?>;
		font-size: <?php echo $defaults['flexia_overlay_search_label_font_size']; ?>px;
	}

	@media all and (max-width: 959px) {
	  .blog-header .header-content > .page-title, .archive-header .header-content > .page-title {
	  	font-size: calc(<?php echo $defaults['blog_title_font_size']; ?>px * .75);
	  }

	  .header-content .blog-desc, .header-content .archive-description > p {
	  	font-size: calc(<?php echo $defaults['blog_desc_font_size']; ?>px * .75);
	  }
	}

	@media all and (max-width: 480px) {
	  .blog-header .header-content > .page-title, .archive-header .header-content > .page-title {
	  	font-size: calc(<?php echo $defaults['blog_title_font_size']; ?>px * .5);
	  }

	  .header-content .blog-desc, .header-content .archive-description > p {
	  	font-size: calc(<?php echo $defaults['blog_desc_font_size']; ?>px * .5);
	  }
	}

	.flexia-header-widget-area {
		background-color: <?php echo $defaults['header_widget_area_bg_color']; ?>;
	}

	.flexia-topbar {
		background-color: <?php echo $defaults['flexia_topbar_bg_color']; ?>;
	}

	.flexia-logobar {
		background-color: <?php echo $defaults['flexia_logobar_bg_color']; ?>;
	}

	.flexia-navbar {
		background-color: <?php echo $defaults['flexia_navbar_bg_color']; ?>;
	}

	@media screen and (min-width: 992px) {
		.main-navigation .nav-menu li > a { color: <?php echo $defaults['flexia_main_nav_menu_link_color']; ?>; }
		.main-navigation .nav-menu li:hover > a:not(.cart-contents), .main-navigation .nav-menu li.current-menu-item > a:not(.cart-contents), .main-navigation .nav-menu li.current-menu-ancestor > a:not(.cart-contents) { color: <?php echo $defaults['flexia_main_nav_menu_link_hover_color']; ?>; }
		.main-navigation .nav-menu li:hover > a:not(.cart-contents), .main-navigation .nav-menu li.current-menu-item > a:not(.cart-contents), .main-navigation .nav-menu li.current-menu-ancestor > a:not(.cart-contents) { background-color: <?php echo $defaults['flexia_main_nav_menu_link_hover_bg']; ?>; }
		.main-navigation .nav-menu li ul { background-color: <?php echo $defaults['flexia_main_nav_menu_submenu_bg_color']; ?>; }
		.main-navigation .nav-menu li ul li > a, .main-navigation .nav-menu li ul.flexia-mega-menu li:hover > a:not(.cart-contents) { color: <?php echo $defaults['flexia_main_nav_menu_submenu_link_color']; ?>; }
		.main-navigation .nav-menu li ul.flexia-mega-menu li:hover > a:not(.cart-contents) { background-color: initial; }
		.main-navigation .nav-menu li ul li:hover > a:not(.cart-contents), .main-navigation .nav-menu li ul li.current-menu-item > a:not(.cart-contents), .main-navigation .nav-menu li ul li.current-menu-ancestor > a:not(.cart-contents), .main-navigation .nav-menu li ul.flexia-mega-menu li > a:not(.cart-contents):hover { color: <?php echo $defaults['flexia_main_nav_menu_submenu_link_hover_color']; ?>; }
		.main-navigation .nav-menu li ul li:hover > a:not(.cart-contents), .main-navigation .nav-menu li ul li.current-menu-item > a:not(.cart-contents), .main-navigation .nav-menu li ul li.current-menu-ancestor > a:not(.cart-contents), .main-navigation .nav-menu li ul.flexia-mega-menu li > a:not(.cart-contents):hover { background-color: <?php echo $defaults['flexia_main_nav_menu_submenu_link_hover_bg']; ?>; }
		
		.topbar-navigation .nav-menu li > a { color: <?php echo $defaults['flexia_top_nav_menu_link_color']; ?>; }
		.topbar-navigation .nav-menu li:hover > a, .topbar-navigation .nav-menu li.current-menu-item > a, .topbar-navigation .nav-menu li.current-menu-ancestor > a { color: <?php echo $defaults['flexia_top_nav_menu_link_hover_color']; ?>; }
		.topbar-navigation .nav-menu li:hover > a, .topbar-navigation .nav-menu li.current-menu-item > a, .topbar-navigation .nav-menu li.current-menu-ancestor > a { background-color: <?php echo $defaults['flexia_top_nav_menu_link_hover_bg']; ?>; }
		.topbar-navigation .nav-menu li ul { background-color: <?php echo $defaults['flexia_top_nav_menu_submenu_bg_color']; ?>; }
		.topbar-navigation .nav-menu li ul li > a { color: <?php echo $defaults['flexia_top_nav_menu_submenu_link_color']; ?>; }
		.topbar-navigation .nav-menu li ul li:hover > a, .topbar-navigation .nav-menu li ul li.current-menu-item > a, .topbar-navigation .nav-menu li ul li.current-menu-ancestor > a { color: <?php echo $defaults['flexia_top_nav_menu_submenu_link_hover_color']; ?>; }
		.topbar-navigation .nav-menu li ul li:hover > a, .topbar-navigation .nav-menu li ul li.current-menu-item > a, .topbar-navigation .nav-menu li ul li.current-menu-ancestor > a { background-color: <?php echo $defaults['flexia_top_nav_menu_submenu_link_hover_bg']; ?>; }
	}

	.flexia-footer-widget-area {
		background-color: <?php echo $defaults['footer_widget_area_bg_color']; ?>;
	}

	.flexia-site-footer {
		background-color: <?php echo $defaults['flexia_footer_bg_color']; ?>;
	}

	.flexia-site-footer .site-info {
		color: <?php echo $defaults['flexia_footer_content_color']; ?>;
	}

	.flexia-site-footer .site-info a, .flexia-footer-menu li a {
		color: <?php echo $defaults['flexia_footer_link_color']; ?>;
	}

	.flexia-site-footer .site-info a:hover, .flexia-footer-menu li a:hover {
		color: <?php echo $defaults['flexia_footer_link_hover_color']; ?>;
	}

	</style>
	<?php
}
endif;