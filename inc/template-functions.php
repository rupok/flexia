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

	$flexia_version = wp_get_theme();
	$classes[] = 'flexia-'.$flexia_version->display( 'Version', FALSE );

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
 * Page Title markup
 *
 * @since  v1.0.0
 */
function flexia_page_title() {
	global $post;

	if( metadata_exists( 'post', $post->ID, '_flexia_meta_key_page_header' ) ) {
		$flexia_core_page_header = get_post_meta( $post->ID, '_flexia_meta_key_page_header', true );
		if( $flexia_core_page_header == 'flexia_core_page_header_default' || $flexia_core_page_header == NULL ) {
			?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
 * Page Header Title markup
 *
 * @since  v1.0.0
 */
add_action('flexia_page_header_breadcrumb', 'flexia_page_header_markup'); // @since v2.0.1
function flexia_page_header_markup() {

	$flexia_page_header_layout 	= get_theme_mod( 'flexia_page_header_layout', 'flexia_page_header_default' );
	
	global $post;

	// If This Page has custom Header Meta
	if( metadata_exists( 'post', $post->ID, '_flexia_meta_key_page_header' ) ) {

		$flexia_core_page_header = get_post_meta( $post->ID, '_flexia_meta_key_page_header', true );

		if( $flexia_core_page_header == 'flexia_core_page_header_large' ) :

			flexia_page_header_partial( 'entry-header-large entry-header-center' );

		elseif( $flexia_core_page_header == 'flexia_core_page_header_mini' ) :

			flexia_page_header_partial( 'entry-header-mini', 'max width' );

		elseif( $flexia_core_page_header == 'flexia_core_page_header_default' || empty( $flexia_core_page_header ) ) :

			if (get_theme_mod( 'flexia_page_header', 'flexia' )) : 

				if( $flexia_page_header_layout == 'flexia_page_header_large' ) :

					flexia_page_header_partial( 'entry-header-large entry-header-center' );

				elseif( $flexia_page_header_layout == 'flexia_page_header_mini' ) :

					flexia_page_header_partial( 'entry-header-mini', 'max width' );

				endif;

			endif;

		elseif( $flexia_core_page_header == NULL ) :
			// No Header
		else :
			// No Header
		endif;
	}else {
		if( $flexia_page_header_layout == 'flexia_page_header_large' ) :

			flexia_page_header_partial( 'entry-header-large entry-header-center' );

		elseif( $flexia_page_header_layout == 'flexia_page_header_mini' ) :

			flexia_page_header_partial( 'entry-header-mini', 'max width' );

		else:

			// No header

		endif;

	}
}
// Page Header Partial
function flexia_page_header_partial( $class_name = null, $max_width = null ) {
	$flexia_page_breadcrumb = get_theme_mod( 'flexia_page_breadcrumb', true);
	?>
	<header class="entry-header <?php echo esc_attr( $class_name ); ?>">
		<div class="flexia-container <?php echo esc_attr( $max_width ); ?>">
			<div class="entry-header-inner">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<?php
					if( $flexia_page_breadcrumb == true ) {
						flexia_breadcrumbs();
					}
				?>
			</div>
		</div>
	</header>
	<?php
}

/**
 * This function contains large post title markup.
 * It is used in 'flexia_post_large_title' method.
 *
 * @since  v0.0.5
 */
function flexia_post_large_title_markup() {
	$thumbnail = '';
	    if (function_exists('has_post_thumbnail')) {
	        if ( has_post_thumbnail() ) {
	             $thumbnail = wp_get_attachment_url( get_post_thumbnail_id() );
	        }
	    }
	?>
	<header class="page-header single-blog-header" <?php if ( ! empty( $thumbnail ) ) : ?>
    style="background-image: url('<?php echo esc_attr($thumbnail); ?>');" <?php endif; ?> <?php if ( empty( $thumbnail ) ) : ?>
    style="background-image: url('<?php echo esc_attr(get_header_image()); ?>');" <?php endif; ?>>
        <div class="header-inner">
            <div class="header-content">
                <?php the_title( '<h1 class="blog-title">', '</h1>' ); ?>
				<?php flexia_post_large_title_author_avatar_markup(); ?>
            </div>
        </div>
    </header>
	<?php
}

/**
 * This function contains large post title author avatar markup.
 * It is used in 'flexia_post_large_title_markup' method.
 *
 * @since  v0.0.5
 */
function flexia_post_large_title_author_avatar_markup() {

	global $post;
	if( metadata_exists( 'post', $post->ID, '_flexia_post_meta_key_header_author_meta' ) ) {
		$post_title_header_meta = get_post_meta( $post->ID, '_flexia_post_meta_key_header_meta', true );
		$post_title_header_post_author = get_post_meta( $post->ID, '_flexia_post_meta_key_header_author_meta', true );
		if( $post_title_header_meta == 'yes' || $post_title_header_meta == NULL ) {
			if( $post_title_header_post_author == 'yes' || $post_title_header_post_author == NULL ) {
			?>
			<div class="blog-author">
		        <div class="author-avatar">
		            <?php echo get_avatar( get_the_author_meta( 'ID' ), 'flexia-thumbnail-avatar' ); ?>
		            <div class="author-body">
		                <h4 class="author-heading"><?php the_author(); ?></h4>
		            </div>
		        </div>
		    </div>
			<?php
			}else {
				return false;
			}
		}else {
			return false;
		}
	}else {
		?>
		<div class="blog-author">
	        <div class="author-avatar">
	            <?php echo get_avatar( get_the_author_meta( 'ID' ), 'flexia-thumbnail-avatar' ); ?>
	            <div class="author-body">
	                <h4 class="author-heading"><?php the_author(); ?></h4>
	            </div>
	        </div>
	    </div>
		<?php
	}
}
/**
 *
 */
function flexia_post_large_title_header_meta_markup() {
	?>
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
	global $post;
	$flexia_single_posts_layout = get_theme_mod('flexia_single_posts_layout', 'flexia_single_posts_layout_large');
	if( metadata_exists( 'post', $post->ID, '_flexia_post_meta_key_page_title' ) ) {
		$post_title = get_post_meta( $post->ID, '_flexia_post_meta_key_page_title', true );
		$post_title_header_meta = get_post_meta( $post->ID, '_flexia_post_meta_key_header_meta', true );
		if( $post_title == 'default' || $post_title == NULL ) {
			if( $flexia_single_posts_layout == 'flexia_single_posts_layout_large' ) {
				flexia_post_large_title_markup();
				if( $post_title_header_meta == 'yes' || $post_title_header_meta == NULL ) {
					flexia_post_large_title_header_meta_markup();
				}
			}else {
				return false;
			}
		}elseif( $post_title == 'large') {
			flexia_post_large_title_markup();
			if( $post_title_header_meta == 'yes' || $post_title_header_meta == NULL ) {
				flexia_post_large_title_header_meta_markup();
			}
		}else {
			return false;
		}
	} else {
		if( $flexia_single_posts_layout == NULL || $flexia_single_posts_layout == 'flexia_single_posts_layout_large' ) {
			flexia_post_large_title_markup();
			flexia_post_large_title_header_meta_markup();
		}
	}

}

/**
 * This function will generate simple post title markup
 *
 * @since  v0.0.5
 */
function flexia_post_simple_title_markup() {
		global $post;
		$post_title_header_meta = get_post_meta( $post->ID, '_flexia_post_meta_key_header_meta', true );
	?>

	<header class="entry-header single-blog-meta single-post-meta-simple">
		<?php if ( 'post' === get_post_type() ) :
			if( $post_title_header_meta == 'yes' || $post_title_header_meta == NULL ) { ?>
			<div class="entry-meta">
			    <?php flexia_posted_on(); ?>
			</div>
			<!-- .entry-meta -->
			<?php } endif;
			if ( is_singular() ) :
			    the_title( '<h1 class="entry-title">', '</h1>' );
			else :
			    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		?>
	</header>
	<?php if ( '' !== get_the_post_thumbnail()) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail( 'flexia-featured-image' ); ?>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<?php

}

/**
 * This function will generate simple post no container title markup
 *
 * @since  v0.0.5
 */
function flexia_post_simple_no_container_title_markup() {
		global $post;
		$post_title_header_meta = get_post_meta( $post->ID, '_flexia_post_meta_key_header_meta', true );
	?>

	<?php if ( '' !== get_the_post_thumbnail()) : ?>
        <div class="post-thumbnail">
			<?php the_post_thumbnail( 'flexia-featured-image' ); ?>
        </div><!-- .post-thumbnail -->
	<?php endif; ?>

	<header class="entry-header single-blog-meta single-post-meta-simple">
		<?php if ( 'post' === get_post_type() ) :
            if ( is_singular() ) :
			    the_title( '<h1 class="entry-title">', '</h1>' );
			else :
			    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if( $post_title_header_meta == 'yes' || $post_title_header_meta == NULL ) { ?>
                <div class="entry-meta">
					<?php flexia_posted_on(); ?>
                </div>
                <!-- .entry-meta -->
			<?php } endif;
		?>
	</header>

	<?php

}



/**
 * This function will show/hide simple post title
 *
 * @since  v0.0.5
 */
function flexia_post_simple_title() {
	$flexia_single_posts_layout = get_theme_mod('flexia_single_posts_layout', 'flexia_single_posts_layout_large');
	global $post;
	if( metadata_exists( 'post', $post->ID, '_flexia_post_meta_key_page_title' ) ) {
		$post_title = get_post_meta( $post->ID, '_flexia_post_meta_key_page_title', true );
		$post_title_header_meta = get_post_meta( $post->ID, '_flexia_post_meta_key_header_meta', true );
		if( $post_title == 'simple' ) {
			flexia_post_simple_title_markup();
		}elseif( $post_title == 'simple_no_container' ) {
			flexia_post_simple_no_container_title_markup();
        }elseif( $post_title == 'default' || $post_title == NULL ) {
			if( $flexia_single_posts_layout == 'flexia_single_posts_layout_simple' ) {
				flexia_post_simple_title_markup();
			}elseif( $flexia_single_posts_layout == 'flexia_single_posts_layout_simple_no_container' ){
			    flexia_post_simple_no_container_title_markup();
		    }
		}else {
			return false;
		}
	}elseif( $flexia_single_posts_layout == 'flexia_single_posts_layout_simple' ) {
		flexia_post_simple_title_markup();
	}elseif( $flexia_single_posts_layout == 'flexia_single_posts_layout_simple_no_container' ) {
		flexia_post_simple_no_container_title_markup();
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
	if( !empty( $post ) ) {
		$classes[] = get_post_meta( $post->ID, '_flexia_post_meta_key_body_class', true );
		$classes[] = get_post_meta( $post->ID, '_flexia_meta_key_body_class', true );
	}
	return $classes;

}
add_filter( 'body_class', 'flexia_add_body_class', 10, 1 );


/**
 * This method will show/hide post footer meta.
 *
 * @since  v0.0.5
 */
function flexia_post_footer_meta() {

	global $post;
	if( metadata_exists( 'post', $post->ID, '_flexia_post_meta_key_footer_meta' ) ) {
		$footer_meta = get_post_meta( $post->ID, '_flexia_post_meta_key_footer_meta', true );
		if( $footer_meta == 'yes' || $footer_meta == NULL ) {
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

	global $post;
	if( metadata_exists( 'post', $post->ID, '_flexia_post_meta_key_post_sharer' ) ) {
		$post_sharer = get_post_meta( $post->ID, '_flexia_post_meta_key_post_sharer', true );
		if( $post_sharer == 'yes' || $post_sharer == NULL ) {
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

	global $post;
	if( metadata_exists( 'post', $post->ID, '_flexia_post_meta_key_post_navigation' ) ) {
		$post_navigation = get_post_meta( $post->ID, '_flexia_post_meta_key_post_navigation', true );
		if( $post_navigation == 'yes' || $post_navigation == NULL ) {
			the_post_navigation();
		}else {
			return false;
		}
	}else {
		the_post_navigation();
	}
}

/**
 * Return Flexia Logo
 *
 * @since  v1.2.0
*/
function flexia_main_logo() {
    $html = "";
	ob_start();
	$flexia_custom_logo_id = get_theme_mod( 'custom_logo' );
    $flexia_header_logo = wp_get_attachment_image_src( $flexia_custom_logo_id , 'full' );
    if( isset($flexia_header_logo) && is_array($flexia_header_logo) && $flexia_header_logo[0] !== NULL ) {
        $html .= '<a href=" '. esc_url( home_url( '/' ) ) . '" rel="home" class="flexia-header-logo">';
		$html .= '<img alt="' . esc_html(bloginfo('name')) . '" src="' . esc_url($flexia_header_logo[0]) .'">';
		$html .= '</a>';

		if ( flexia_get_option( 'flexia_navbar_position' ) == 'flexia-navbar-fixed-top' || flexia_get_option( 'flexia_navbar_position' ) == 'flexia-navbar-transparent-sticky-top') {
			$flexia_sticky_logo = flexia_get_option( 'flexia_custom_sticky_logo' );
			if (empty($flexia_sticky_logo)) {
				$flexia_sticky_logo = $flexia_header_logo[0];
			}
			$html .= '<a href=" '. esc_url( home_url( '/' ) ) . '" rel="home" class="flexia-header-sticky-logo">';
			$html .= '<img alt="' . esc_html(bloginfo('name')) . '" src="' . esc_url($flexia_sticky_logo) .'">';
			$html .= '</a>';
		}
	}
	else {
		if ( is_front_page() && is_home() ) {
			$html .= '<h1 class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ).'</a></h1>';
		}
			
		else {
			$html .= '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ).'</a></p>';
		}
		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) {
			$html .= '<p class="site-description">'. wp_kses_post($description) .'</p>';
		}
	}

	ob_get_clean();
	return $html;
}