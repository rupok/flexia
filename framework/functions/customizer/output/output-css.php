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

	$header_text_color = get_header_textcolor();

	$flexia_settings = wp_parse_args( 
		get_option( 'flexia_settings', array() ), 
		flexia_get_option_defaults() 
	);
	
	?>
	<style type="text/css">
	<?php
	?>

	.site-title a,
	.site-description {
	color: #<?php echo esc_attr( $header_text_color ); ?>;
	}

	body, button, input, select, optgroup, textarea {
		color: <?php echo esc_attr( $flexia_settings['body_font_color']); ?>;
	}

	body {
		font-family: "<?php echo esc_attr( $flexia_settings['body_font_family']); ?>", -apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
		font-size: <?php echo esc_attr( $flexia_settings['body_font_size']); ?>px;
	}

	h1, h2, h3, h4, h5, h6 {
		font-family: "<?php echo esc_attr( $flexia_settings['heading_font_family']); ?>", "Helvetica Neue",sans-serif;
	}

	.flexia-container.width {
	width: <?php echo esc_attr( $flexia_settings['container_width']); ?>%;
	}

	.flexia-container.max {
	max-width: <?php echo esc_attr( $flexia_settings['container_max_width']); ?>px;
	}

	.single-post .entry-content-wrapper {
	width: <?php echo esc_attr( $flexia_settings['post_width']); ?>%;
	max-width: <?php echo esc_attr( $flexia_settings['post_max_width']); ?>px;
	}

	.flexia-sidebar-left {
	width: <?php echo esc_attr( $flexia_settings['left_sidebar_width']); ?>px;
	}

	.flexia-sidebar-right {
	width: <?php echo esc_attr( $flexia_settings['right_sidebar_width']); ?>px;
	}

	body.blog, body.archive, body.single-post,
	body.blog.custom-background, body.archive.custom-background, body.single-post.custom-background {
		background-color: <?php echo esc_attr( $flexia_settings['blog_bg_color']); ?>
	}

	body:not(.single-post) .flexia-wrapper > .content-area  article.hentry, .entry-content.single-post-entry {
		background-color: <?php echo esc_attr( $flexia_settings['post_content_bg_color']); ?>
	}

	.single-post .entry-header.single-blog-meta {
		background-color: <?php echo esc_attr( $flexia_settings['post_meta_bg_color']); ?>
	}

	.flexia-sidebar .widget {
		background-color: <?php echo esc_attr( $flexia_settings['sidebar_widget_bg_color']); ?>
	}

	.flexia-header-logo {
		width: <?php echo esc_attr( $flexia_settings['flexia_header_logo_width']); ?>px;
	}

	.flexia-sticky-navbar .flexia-header-logo {
		width: calc(<?php echo esc_attr( $flexia_settings['flexia_header_logo_width']); ?>px * .65);
	}

	.header-content .flexia-blog-logo {
		width: <?php echo esc_attr( $flexia_settings['blog_logo_width']); ?>px;
	}

	.blog-header .header-content > .page-title, .archive-header .header-content > .page-title {
		font-size: <?php echo esc_attr( $flexia_settings['blog_title_font_size']); ?>px;
	}

	.paged .blog-header .header-content > .page-title, .paged .archive-header .header-content > .page-title {
		font-size: calc(<?php echo esc_attr( $flexia_settings['blog_title_font_size']); ?>px / 1.5);
	}

	.header-content .blog-desc, .header-content .archive-description > p {
		font-size: <?php echo esc_attr( $flexia_settings['blog_desc_font_size']); ?>px;
	}

	.paged .header-content .blog-desc, .paged .header-content .archive-description > p {
		font-size: calc(<?php echo esc_attr( $flexia_settings['blog_desc_font_size']); ?>px / 1.5);
	}

	@media all and (max-width: 959px) {
	  .blog-header .header-content > .page-title, .archive-header .header-content > .page-title {
	  	font-size: calc(<?php echo esc_attr( $flexia_settings['blog_title_font_size']); ?>px * .75);
	  }

	  .header-content .blog-desc, .header-content .archive-description > p {
	  	font-size: calc(<?php echo esc_attr( $flexia_settings['blog_desc_font_size']); ?>px * .75);
	  }
	}

	@media all and (max-width: 480px) {
	  .blog-header .header-content > .page-title, .archive-header .header-content > .page-title {
	  	font-size: calc(<?php echo esc_attr( $flexia_settings['blog_title_font_size']); ?>px * .5);
	  }

	  .header-content .blog-desc, .header-content .archive-description > p {
	  	font-size: calc(<?php echo esc_attr( $flexia_settings['blog_desc_font_size']); ?>px * .5);
	  }
	}

	.flexia-header-widget-area {
		background-color: <?php echo esc_attr( $flexia_settings['header_widget_area_bg_color']); ?>;
	}

	.flexia-topbar {
		background-color: <?php echo esc_attr( $flexia_settings['flexia_topbar_bg_color']); ?>;
	}

	.flexia-logobar {
		background-color: <?php echo esc_attr( $flexia_settings['flexia_logobar_bg_color']); ?>;
	}

	.flexia-navbar {
		background-color: <?php echo esc_attr( $flexia_settings['flexia_navbar_bg_color']); ?>;
	}

	.main-navigation > ul > li > a {
		color: <?php echo esc_attr( $flexia_settings['flexia_nav_menu_link_color']); ?>;
	}

	.main-navigation > ul > li.has-sub::before, .main-navigation > ul > li.has-sub::after {
		background-color: <?php echo esc_attr( $flexia_settings['flexia_nav_menu_link_color']); ?>;
	}

	.main-navigation > ul > li > a:hover, .main-navigation > ul > li:hover > a, .main-navigation ul li.current-menu-item a {
		color: <?php echo esc_attr( $flexia_settings['flexia_nav_menu_link_hover_color']); ?>;
	}

	.main-navigation > ul > li > a::after, .main-navigation > ul > li > a:hover::after, .main-navigation .current_page_item > a::after, .main-navigation .current-menu-item > a::after, .main-navigation .current_page_ancestor > a::after, .main-navigation .current-menu-ancestor > a::after {
		background-color: <?php echo esc_attr( $flexia_settings['flexia_nav_menu_link_hover_color']); ?>;
	}

	.main-navigation > ul > li.has-sub:hover::before, .main-navigation > ul > li.has-sub:hover::after {
		background-color: <?php echo esc_attr( $flexia_settings['flexia_nav_menu_link_hover_color']); ?>;
	}

	.main-navigation ul.sub-menu {
		background-color: <?php echo esc_attr( $flexia_settings['flexia_submenu_bg_color']); ?>;
	}

	.main-navigation ul ul li a {
		color: <?php echo esc_attr( $flexia_settings['flexia_submenu_link_color']); ?>;
	}

	.main-navigation ul ul li.has-sub::before, .main-navigation ul ul li.has-sub::after {
		background-color: <?php echo esc_attr( $flexia_settings['flexia_submenu_link_color']); ?>;
	}

	.main-navigation ul ul li a:hover {
		color: <?php echo esc_attr( $flexia_settings['flexia_submenu_link_hover_color']); ?>;
	}

	.main-navigation ul ul li.has-sub:hover::before, .main-navigation ul ul li.has-sub:hover::after {
		background-color: <?php echo esc_attr( $flexia_settings['flexia_submenu_link_hover_color']); ?>;
	}

	.flexia-footer-widget-area {
		background-color: <?php echo esc_attr( $flexia_settings['footer_widget_area_bg_color']); ?>;
	}

	.flexia-site-footer {
		background-color: <?php echo esc_attr( $flexia_settings['flexia_footer_bg_color']); ?>;
	}

	.flexia-site-footer .site-info {
		color: <?php echo esc_attr( $flexia_settings['flexia_footer_content_color']); ?>;
	}

	.flexia-site-footer .site-info a, .flexia-footer-menu li a {
		color: <?php echo esc_attr( $flexia_settings['flexia_footer_link_color']); ?>;
	}

	.flexia-site-footer .site-info a:hover, .flexia-footer-menu li a:hover {
		color: <?php echo esc_attr( $flexia_settings['flexia_footer_link_hover_color']); ?>;
	}

	</style>
	<?php
}
endif;