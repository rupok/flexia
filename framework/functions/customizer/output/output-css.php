<?php
/**
 * Flexia Theme Customizer outout for layout settings
 *
 * @package Flexia
 */


if ( ! function_exists( 'flexia_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see flexia_custom_header_setup().
 */
function flexia_header_style() {

	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>

	<?php endif; ?>

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