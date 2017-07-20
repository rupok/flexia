<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Flexia
 */

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

	$posted_on =  $time_string;

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( '%s', 'post author', 'flexia' ),
		'<span class="author vcard"><i class="fa fa-user-circle-o fa-fw" aria-hidden="true"></i><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on"> <i class="fa fa-clock-o fa-fw"></i>' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		$categories_list = get_the_category_list( esc_html__( ', ', 'flexia' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links"> <i class="fa fa-folder-o fa-fw" aria-hidden="true"></i>' . esc_html__( '%1$s', 'flexia' ) . '</span>
', $categories_list ); // WPCS: XSS OK.
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

	$updated_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Updated on %s', 'post date', 'flexia' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="updated-on"> <i class="fa fa-clock-o fa-fw"></i>' . $updated_on . '</span>'; // WPCS: XSS OK. // WPCS: XSS OK.

		$categories_list = get_the_category_list( esc_html__( ', ', 'flexia' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links"> <i class="fa fa-folder-o fa-fw" aria-hidden="true"></i>' . esc_html__( '%1$s', 'flexia' ) . '</span>
', $categories_list ); // WPCS: XSS OK.
		}

	?>

	<span class="comments-count"><i class="fa fa-comments fa-fw"></i><a class="scroll-to-comments" href="#comments"><?php comments_number( 'No Responses', '1 Comment', '% Comments' ); ?></a></span>

<?php
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
			printf( '<i class="fa fa-tags fa-fw" aria-hidden="true"></i> <span class="tags-links">' . esc_html__( '%1$s', 'flexia' ) . '</span>', $tags_list ); // WPCS: XSS OK.
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
