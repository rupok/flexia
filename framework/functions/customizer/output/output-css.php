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
	
	?>
	<style type="text/css">
	<?php
	?>

	.site-title a,
	.site-description {
	color: #<?php echo esc_attr( $header_text_color ); ?>;
	}

	body, button, input, select, optgroup, textarea {
		color: <?php echo get_theme_mod('body_font_color'); ?>;
	}

	body {
		font-family: "<?php echo get_theme_mod('flexia_google_font_family'); ?>", -apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
	}

	h1, h2, h3, h4, h5, h6 {
		font-family: "<?php echo get_theme_mod('flexia_heading_font_family'); ?>", "Helvetica Neue",sans-serif;
	}

	.flexia-container.width {
	width: <?php echo get_theme_mod('container_width'); ?>%;
	}

	.flexia-container.max {
	max-width: <?php echo get_theme_mod('container_max_width'); ?>px;
	}

	.single-post .entry-content-wrapper {
	width: <?php echo get_theme_mod('container_width'); ?>%;
	max-width: <?php echo get_theme_mod('container_max_width'); ?>px;
	}

	.flexia-sidebar-left {
	width: <?php echo get_theme_mod('left_sidebar_width'); ?>px;
	}

	.flexia-sidebar-right {
	width: <?php echo get_theme_mod('right_sidebar_width'); ?>px;
	}

	body.blog, body.archive, body.single-post,
	body.blog.custom-background, body.archive.custom-background, body.single-post.custom-background {
		background-color: <?php echo get_theme_mod('blog_bg_color'); ?>;
	}

	body:not(.single-post) .flexia-wrapper > .content-area  article.hentry, .entry-content.single-post-entry {
		background-color: <?php echo get_theme_mod('post_content_bg_color'); ?>;
	}

	.single-post .entry-header.single-blog-meta {
		background-color: <?php echo get_theme_mod('post_meta_bg_color'); ?>;
	}

	.flexia-sidebar .widget {
		background-color: <?php echo get_theme_mod('sidebar_widget_bg_color'); ?>;
	}

	.flexia-header-logo {
		width: <?php echo get_theme_mod('flexia_header_logo_width'); ?>px;
	}

	.flexia-sticky-navbar .flexia-header-logo {
		width: calc(<?php echo get_theme_mod('flexia_header_logo_width'); ?>px * .65);
	}

	.header-content .flexia-blog-logo {
		width: <?php echo get_theme_mod('blog_logo_width'); ?>px;
	}

	.blog-header .header-content > .page-title, .archive-header .header-content > .page-title {
		font-size: <?php echo get_theme_mod('blog_title_font_size'); ?>px;
	}

	.paged .blog-header .header-content > .page-title, .paged .archive-header .header-content > .page-title {
		font-size: calc(<?php echo get_theme_mod('blog_title_font_size'); ?>px / 1.5);
	}

	.header-content .blog-desc, .header-content .archive-description > p {
		font-size: <?php echo get_theme_mod('blog_desc_font_size'); ?>px;
	}

	.paged .header-content .blog-desc, .paged .header-content .archive-description > p {
		font-size: calc(<?php echo get_theme_mod('blog_desc_font_size'); ?>px / 1.5);
	}

	@media all and (max-width: 959px) {
	  .blog-header .header-content > .page-title, .archive-header .header-content > .page-title {
	  	font-size: calc(<?php echo get_theme_mod('blog_title_font_size'); ?>px * .75);
	  }

	  .header-content .blog-desc, .header-content .archive-description > p {
	  	font-size: calc(<?php echo get_theme_mod('blog_desc_font_size'); ?>px * .75);
	  }
	}

	@media all and (max-width: 480px) {
	  .blog-header .header-content > .page-title, .archive-header .header-content > .page-title {
	  	font-size: calc(<?php echo get_theme_mod('blog_title_font_size'); ?>px * .5);
	  }

	  .header-content .blog-desc, .header-content .archive-description > p {
	  	font-size: calc(<?php echo get_theme_mod('blog_desc_font_size'); ?>px * .5);
	  }
	}

	.flexia-header-widget-area {
		background-color: <?php echo get_theme_mod('header_widget_area_bg_color'); ?>;
	}

	.flexia-topbar {
		background-color: <?php echo get_theme_mod('flexia_topbar_bg_color'); ?>;
	}

	.flexia-logobar {
		background-color: <?php echo get_theme_mod('flexia_logobar_bg_color'); ?>;
	}

	.flexia-navbar {
		background-color: <?php echo get_theme_mod('flexia_navbar_bg_color'); ?>;
	}

	.main-navigation > ul > li > a {
		color: <?php echo get_theme_mod('flexia_nav_menu_link_color'); ?>;
	}

	.main-navigation > ul > li.has-sub::before, .main-navigation > ul > li.has-sub::after {
		background-color: <?php echo get_theme_mod('flexia_nav_menu_link_color'); ?>;
	}

	.main-navigation > ul > li > a:hover, .main-navigation > ul > li:hover > a, .main-navigation ul li.current-menu-item a {
		color: <?php echo get_theme_mod('flexia_nav_menu_link_hover_color'); ?>;
	}

	.main-navigation > ul > li > a::after, .main-navigation > ul > li > a:hover::after, .main-navigation .current_page_item > a::after, .main-navigation .current-menu-item > a::after, .main-navigation .current_page_ancestor > a::after, .main-navigation .current-menu-ancestor > a::after {
		background-color: <?php echo get_theme_mod('flexia_nav_menu_link_hover_color'); ?>;
	}

	.main-navigation > ul > li.has-sub:hover::before, .main-navigation > ul > li.has-sub:hover::after {
		background-color: <?php echo get_theme_mod('flexia_nav_menu_link_hover_color'); ?>;
	}

	.main-navigation ul.sub-menu {
		background-color: <?php echo get_theme_mod('flexia_submenu_bg_color'); ?>;
	}

	.main-navigation ul ul li a {
		color: <?php echo get_theme_mod('flexia_submenu_link_color'); ?>;
	}

	.main-navigation ul ul li.has-sub::before, .main-navigation ul ul li.has-sub::after {
		background-color: <?php echo get_theme_mod('flexia_submenu_link_color'); ?>;
	}

	.main-navigation ul ul li a:hover {
		color: <?php echo get_theme_mod('flexia_submenu_link_hover_color'); ?>;
	}

	.main-navigation ul ul li.has-sub:hover::before, .main-navigation ul ul li.has-sub:hover::after {
		background-color: <?php echo get_theme_mod('flexia_submenu_link_hover_color'); ?>;
	}

	.flexia-footer-widget-area {
		background-color: <?php echo get_theme_mod('footer_widget_area_bg_color'); ?>;
	}

	.flexia-site-footer {
		background-color: <?php echo get_theme_mod('flexia_footer_bg_color'); ?>;
	}

	.flexia-site-footer .site-info {
		color: <?php echo get_theme_mod('flexia_footer_content_color'); ?>;
	}

	.flexia-site-footer .site-info a, .flexia-footer-menu li a {
		color: <?php echo get_theme_mod('flexia_footer_link_color'); ?>;
	}

	.flexia-site-footer .site-info a:hover, .flexia-footer-menu li a:hover {
		color: <?php echo get_theme_mod('flexia_footer_link_hover_color'); ?>;
	}

	</style>
	<?php
}
endif;