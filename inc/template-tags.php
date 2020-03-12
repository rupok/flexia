<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Flexia
 */


if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


if ( ! function_exists( 'flexia_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function flexia_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s"> %2$s</time><time class="entry-date updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	if( class_exists( 'CMB2_Bootstrap_230' ) ) {
		global $post;
		$post_title_header_post_date =  get_post_meta( $post->ID, '_flexia_post_meta_key_header_post_date', true );
		$post_title_header_post_category =  get_post_meta( $post->ID, '_flexia_post_meta_key_header_post_category', true );
		$post_title_header_post_author =  get_post_meta( $post->ID, '_flexia_post_meta_key_header_author_meta', true );

		// Post Title Header Post Date
		if( $post_title_header_post_date == 'yes' || $post_title_header_post_date == NULL ) {
			$posted_on = sprintf(
				/* translators: %s: post date. */
				__( '<span class="screen-reader-text">Posted on</span> %s', 'flexia' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);
			echo '<span class="posted-on"> <i class="fa fa-clock-o fa-fw"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.
		}

		// Post Title Post Author
		if( $post_title_header_post_author == 'yes' || $post_title_header_post_author == NULL ) {
			$byline = sprintf(
				/* translators: %s: post author. */
				__( '<span class="screen-reader-text">Posted by</span> %s', 'flexia' ),
				'<span class="author vcard"><i class="fa fa-user-circle-o fa-fw" aria-hidden="true"></i><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);
			echo '<span class="byline"> ' . $byline . '</span>';

		}

		// Post Title Header Post Category
		if( $post_title_header_post_category == 'yes' || $post_title_header_post_category == NULL ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'flexia' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"> <i class="fa fa-folder-o fa-fw" aria-hidden="true"></i>' . __( '<span class="screen-reader-text">Categories</span> %s', 'flexia' ) . '</span>
				', $categories_list ); // WPCS: XSS OK.
			}
		}

	}else {
		$posted_on = sprintf(
			/* translators: %s: post date. */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'flexia' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			__( '<span class="screen-reader-text">Posted by</span> %s', 'flexia' ),
			'<span class="author vcard"><i class="fa fa-user-circle-o fa-fw" aria-hidden="true"></i><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on"> <i class="fa fa-clock-o fa-fw"></i>' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		$categories_list = get_the_category_list( esc_html__( ', ', 'flexia' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links"> <i class="fa fa-folder-o fa-fw" aria-hidden="true"></i>' . __( '<span class="screen-reader-text">Categories</span> %s', 'flexia' ) . '</span>
			', $categories_list ); // WPCS: XSS OK.
		}
	}
}
endif;

if ( ! function_exists( 'flexia_updated_on' ) ) :

function flexia_updated_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="entry-date updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	if( class_exists( 'CMB2_Bootstrap_230' ) ) {
		global $post;
		$post_title_header_post_date =  get_post_meta( $post->ID, '_flexia_post_meta_key_header_post_date', true );
		$post_title_header_post_category =  get_post_meta( $post->ID, '_flexia_post_meta_key_header_post_category', true );
		$post_title_header_post_comments =  get_post_meta( $post->ID, '_flexia_post_meta_key_header_post_comments', true );
		// Post Title Header Post Date
		if( $post_title_header_post_date == 'yes' || $post_title_header_post_date == NULL ) {
			$updated_on = sprintf(
				/* translators: %s: post date. */
				esc_html_x( 'Updated on %s', 'post date', 'flexia' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);
			echo '<span class="updated-on"> <i class="fa fa-clock-o fa-fw"></i>' . $updated_on . '</span>'; // WPCS: XSS OK. // WPCS: XSS OK.
		}

		// Post Title Header Post Category
		if( $post_title_header_post_category == 'yes' || $post_title_header_post_category == NULL ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'flexia' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"> <i class="fa fa-folder-o fa-fw" aria-hidden="true"></i>' . __( '<span class="screen-reader-text">Categories</span> %s', 'flexia' ) . '</span>
				', $categories_list ); // WPCS: XSS OK.
			}
		}

		// Post Title Post Comments
		if( $post_title_header_post_comments == 'yes' || $post_title_header_post_comments == NULL ) {
			?>
			<span class="comments-count"><i class="fa fa-comments fa-fw"></i><a class="scroll-to-comments" href="#comments"><?php comments_number( 'No Responses', '1 Comment', '% Comments' ); ?></a></span>
			<?php
		}

	}else {
		$updated_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Updated on %s', 'post date', 'flexia' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="updated-on"> <i class="fa fa-clock-o fa-fw"></i>' . $updated_on . '</span>'; // WPCS: XSS OK. // WPCS: XSS OK.

			$categories_list = get_the_category_list( esc_html__( ', ', 'flexia' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"> <i class="fa fa-folder-o fa-fw" aria-hidden="true"></i>' . __( '<span class="screen-reader-text">Categories</span> %s', 'flexia' ) . '</span>
		', $categories_list ); // WPCS: XSS OK.
			}

		?>

		<span class="comments-count"><i class="fa fa-comments fa-fw"></i><a class="scroll-to-comments" href="#comments"><?php comments_number( 'No Responses', '1 Comment', '% Comments' ); ?></a></span>
		<?php
	}

}
endif;



if ( ! function_exists( 'flexia_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function flexia_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'flexia' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<i class="fa fa-tags fa-fw" aria-hidden="true"></i> <span class="tags-links">' . __( '<span class="screen-reader-text">Tags</span> %s', 'flexia' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<i class="fa fa-comment-o fa-fw" aria-hidden="true"></i> <span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'flexia' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'flexia' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;
/**
 * Fetching All Post Categories
 */
if( ! function_exists( 'flexia_get_categories' ) ) :
function flexia_get_categories() {
	$category_key = [];
	$category_name = [];
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'hide_empty' => false,
	) );

	foreach( $terms as $term ) {
		$category_key[] = $term->slug;
		$category_name[] = $term->name;
	}

	$categories = array_combine( $category_key, $category_name );
	return $categories;
}
endif;


/**
 * Load All Google Fonts
 */

function flexia_get_google_fonts() {
	return include( get_template_directory() . '/framework/functions/customizer/google-fonts.php' );
}
/**
 * Return All fonts
 */
function flexia_google_fonts() {
	$fonts = flexia_get_google_fonts();
	$processed_fonts = array();

    foreach ($fonts as $font) {
        $name = strtolower( str_replace(' ', '-', $font['family']));
        $family = '' . $font['family'] . ', ' . $font['category'] . '';

        $subsets_array = array();
        foreach( $font['subsets'] as $subsets ) {
            $subsets_array[$subsets] = $subsets;
        }

        $variants_array = array();
        foreach( $font['variants'] as $variants ) {
            $variants_array[$variants] = $variants;
        }

        $processed_fonts[$name] = array(
            'id'       => $name,
            'name'     => $font['family'],
            'label'    => $family,
            'family'   => $family,
            'category' => $font['category'],
            'subsets'  => $subsets_array,
            'variants'  => $variants_array,
        );
    }
	return $processed_fonts;
}

/**
 * Return ALl Google Font Variants
 */
function flexia_google_font_variants() {
	$google_fonts = flexia_google_fonts();
	if(isset($_POST['fontFamily'])) {
		$find_font = flexia_google_font_search($google_fonts, 'name', $_POST['fontFamily']);
		$output = array(
			'variants' => $find_font[0]['variants'],
			'subsets' => $find_font[0]['subsets'],
		);
		echo wp_json_encode( $output );
	}else {
		return;
	}

	die();
}
add_action( 'wp_ajax_load_google_font_variants', 'flexia_google_font_variants' );

/**
 * Flexia Google Font Search
 */
function flexia_google_font_search($array, $key, $value) {
    $results = array();
    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, flexia_google_font_search($subarray, $key, $value));
        }
    }

    return $results;
}