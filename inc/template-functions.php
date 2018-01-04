<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Flexia
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function flexia_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if( get_theme_mod('content_layout') == 'content_layout1' ) {
		$classes[] = 'sidebar-left-right';
	}


	if( get_theme_mod('flexia_navbar_position') == 'flexia-navbar-transparent-top' ) {
		$classes[] = 'transparent-top-navbar';
	}


	return $classes;
}
add_filter( 'body_class', 'flexia_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function flexia_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'flexia_pingback_header' );

/**
 * This function will show/hide page title
 *
 * @since  v0.0.5
 */
function flexia_page_title() {

	if( class_exists( 'Flexia_Core_Global_Metabox' ) ) {
		global $post;
		$page_title = get_post_meta( $post->ID, '_flexia_meta_key_page_title', true );
		if( $page_title == 1 ) {
			?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<?php
		}
	}else {
		?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php
	}

}

/**
 * This function contains large post title markup.
 * It is used in 'flexia_post_large_title' method.
 *
 * @since  v0.0.5
 */
function felxia_post_large_title_markup() {
	?>
	<header class="page-header single-blog-header" <?php if ( ! empty( $thumbnail ) ) : ?>
    style="background-image: url('<?php echo esc_attr($thumbnail); ?>');" <?php endif; ?> <?php if ( empty( $thumbnail ) ) : ?>
    style="background-image: url('<?php echo esc_attr(get_header_image()); ?>');" <?php endif; ?>>
        <div class="header-inner">
            <div class="header-content">
                <?php the_title( '<h1 class="blog-title">', '</h1>' ); ?>
                <div class="blog-author">
                    <div class="author-avatar">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 'flexia-thumbnail-avatar' ); ?>
                        <div class="author-body">
                            <h4 class="author-heading"><?php the_author(); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-overlay"></div>
    </header>

    <header class="entry-header single-blog-meta single-post-meta-large">
        <?php
        if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php flexia_updated_on(); ?>
        </div><!-- .entry-meta -->
        <?php
        endif; ?>
    </header><!-- .entry-header -->
	<?php
}
/**
 * This function will show/hide large post title
 *
 * @since  v0.0.5
 */
function flexia_post_large_title() {

	if( class_exists( 'Flexia_Core_Post_Metabox' ) ) {
		global $post;
		$post_title = get_post_meta( $post->ID, '_flexia_post_meta_key_page_title', true );
		if( $post_title == 'large' ) {
			felxia_post_large_title_markup();
		}else {
			return false;
		}
	}else {
		felxia_post_large_title_markup();
	}

}

/**
 * This function contains simple post title markup.
 * It is used in 'flexia_post_simple_title' method.
 *
 * @since  v0.0.5
 */
function flexia_post_simple_title_markup() {
	?>
	<header class="entry-header single-blog-meta single-post-meta-simple">
	    <?php if ( 'post' === get_post_type() ) : ?>
	        <div class="entry-meta">
	            <?php flexia_posted_on(); ?>
	        </div>
	        <!-- .entry-meta -->
	    <?php endif;
	    if ( is_singular() ) :
	        the_title( '<h1 class="entry-title">', '</h1>' );
	    else :
	        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	    endif;?>
	</header>
	<?php
}

/**
 * This function will show/hide simple post title
 *
 * @since  v0.0.5
 */
function flexia_post_simple_title() {

	if( class_exists( 'Flexia_Core_Post_Metabox' ) ) {
		global $post;
		$post_title = get_post_meta( $post->ID, '_flexia_post_meta_key_page_title', true );
		if( $post_title == 'simple' ) {
			flexia_post_simple_title_markup();
		}else {
			return false;
		}
	}else {
		return false;
	}

}

/**
 *	This method will add a custom class into the body tag.
 *
 * @since  v0.0.5
 */
function flexia_add_body_class( $classes ) {

	global $post;
	$classes[] = get_post_meta( $post->ID, '_flexia_post_meta_key_body_class', true );
	$classes[] = get_post_meta( $post->ID, '_flexia_meta_key_body_class', true );
	return $classes;

}
add_filter( 'body_class', 'flexia_add_body_class', 10, 1 );

/**
 * This method will show/hide post footer meta.
 *
 * @since  v0.0.5
 */
function flexia_post_footer_meta() {

	if( class_exists( 'Flexia_Core_Post_Metabox' ) ) {
		global $post;
		$footer_meta = get_post_meta( $post->ID, '_flexia_post_meta_key_footer_meta', true );
		if( $footer_meta == 'yes' ) {
			get_template_part( 'framework/views/template-parts/content', 'post-author' );
		}else {
			return false;
		}
	}else {
		get_template_part( 'framework/views/template-parts/content', 'post-author' );
	}

}

/**
 * This method will show/hide post sharer.
 *
 * @since  v0.0.5
 */
function flexia_post_sharer() {

	if( class_exists( 'Flexia_Core_Post_Metabox' ) ) {
		global $post;
		$post_sharer = get_post_meta( $post->ID, '_flexia_post_meta_key_post_sharer', true );
		if( $post_sharer == 'yes' ) {
			get_template_part( 'framework/views/template-parts/content', 'social-sharer' );
		}else {
			return false;
		}
	}else {
		get_template_part( 'framework/views/template-parts/content', 'social-sharer' );
	}

}

/**
 * This method will show/hide post navigation.
 *
 * @since  v0.0.5
 */
function flexia_post_navigation() {

	if( class_exists( 'Flexia_Core' ) ) {
		global $post;
		$post_navigation = get_post_meta( $post->ID, '_flexia_post_meta_key_post_navigation', true );
		if( $post_navigation == 'yes' ) {
			the_post_navigation();
		}else {
			return false;
		}
	}else {
		the_post_navigation();
	}

}