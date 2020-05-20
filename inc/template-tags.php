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
			echo '<span class="posted-on"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <path d="M256,0C114.841,0,0,114.841,0,256s114.841,256,256,256s256-114.841,256-256S397.159,0,256,0z M256,468.732 c-117.301,0-212.732-95.431-212.732-212.732S138.699,43.268,256,43.268S468.732,138.699,468.732,256S373.301,468.732,256,468.732z "/> </g> </g> <g> <g> <path d="M372.101,248.068H271.144V97.176c0-11.948-9.686-21.634-21.634-21.634c-11.948,0-21.634,9.686-21.634,21.634v172.525 c0,11.948,9.686,21.634,21.634,21.634c0.244,0,0.48-0.029,0.721-0.036c0.241,0.009,0.477,0.036,0.721,0.036h121.149 c11.948,0,21.634-9.686,21.634-21.634S384.049,248.068,372.101,248.068z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>' . $posted_on . '</span>'; // WPCS: XSS OK.
		}

		// Post Title Post Author
		if( $post_title_header_post_author == 'yes' || $post_title_header_post_author == NULL ) {
			$byline = sprintf(
				/* translators: %s: post author. */
				__( '<span class="screen-reader-text">Posted by</span> %s', 'flexia' ),
				'<span class="author vcard"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <path d="M437,75C388.7,26.6,324.4,0,256,0C187.6,0,123.3,26.6,75,75S0,187.6,0,256c0,68.4,26.6,132.7,75,181 c48.4,48.4,112.6,75,181,75c68.4,0,132.7-26.6,181-75c48.4-48.4,75-112.6,75-181C512,187.6,485.4,123.3,437,75z M184.8,224.8 c0-39.2,31.9-71.2,71.2-71.2c39.2,0,71.2,31.9,71.2,71.2c0,39.2-31.9,71.2-71.2,71.2C216.8,296,184.8,264.1,184.8,224.8z M256,340.6 c55.8,0,103.5,38.6,115.2,92.5c-34.3,22.4-74,34.2-115.2,34.2c-41.1,0-80.9-11.8-115.2-34.2C152.5,379.2,200.2,340.6,256,340.6z M365,338c-10.6-9.6-22.4-17.7-35-24.2c26.4-21.9,41.8-54.3,41.8-89c0-63.8-51.9-115.8-115.8-115.8c-63.8,0-115.8,51.9-115.8,115.8 c0,34.7,15.4,67.1,41.8,89c-12.7,6.5-24.4,14.6-35,24.2c-19.6,17.7-34.4,39.7-43.5,64.2C65.9,363,44.6,310.4,44.6,256 c0-116.6,94.8-211.4,211.4-211.4c116.6,0,211.4,94.8,211.4,211.4c0,54.4-21.3,107-58.9,146.2C399.4,377.7,384.6,355.7,365,338z"/> </svg><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);
			echo '<span class="byline"> ' . $byline . '</span>';

		}

		// Post Title Header Post Category
		if( $post_title_header_post_category == 'yes' || $post_title_header_post_category == NULL ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'flexia' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <path d="M23.5,244.3c-31.3,31.3-31.3,82.1,0,113.4l130.8,130.8c0,0,0,0,0,0c31.3,31.3,82.1,31.3,113.4,0l237.1-237.1 c4.8-4.8,7.4-11.3,7.2-18l-4.1-174.8c-0.5-29.9-24.6-54-54.5-54.5L278.6,0c-6.7-0.2-13.2,2.5-18,7.2L23.5,244.3z M58.6,279.2 L287.8,49.4l164.6,3.8c3.4,0,6.2,2.8,6.2,6.2l3.8,164.6L232.8,453.4c-12,12-31.6,12-43.6,0L58.6,322.8 C46.5,310.8,46.5,291.2,58.6,279.2z"/> <path d="M293.7,113.6c-28.9,29-28.8,75.8,0.2,104.7c28.9,28.8,75.6,28.8,104.5,0c29-28.9,29-75.7,0.2-104.7 c-28.9-29-75.7-29-104.7-0.2C293.8,113.4,293.7,113.5,293.7,113.6z M328.8,183.2c-9.6-9.6-9.6-25.3,0-34.9c9.6-9.6,25.2-9.6,34.9,0 c9.6,9.6,9.7,25.3,0,34.9C354,192.8,338.4,192.8,328.8,183.2C328.8,183.2,328.8,183.2,328.8,183.2z"/> </g> </svg>' . __( '<span class="screen-reader-text">Categories</span> %s', 'flexia' ) . '</span>
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
			'<span class="author vcard"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <path d="M437,75C388.7,26.6,324.4,0,256,0C187.6,0,123.3,26.6,75,75S0,187.6,0,256c0,68.4,26.6,132.7,75,181 c48.4,48.4,112.6,75,181,75c68.4,0,132.7-26.6,181-75c48.4-48.4,75-112.6,75-181C512,187.6,485.4,123.3,437,75z M184.8,224.8 c0-39.2,31.9-71.2,71.2-71.2c39.2,0,71.2,31.9,71.2,71.2c0,39.2-31.9,71.2-71.2,71.2C216.8,296,184.8,264.1,184.8,224.8z M256,340.6 c55.8,0,103.5,38.6,115.2,92.5c-34.3,22.4-74,34.2-115.2,34.2c-41.1,0-80.9-11.8-115.2-34.2C152.5,379.2,200.2,340.6,256,340.6z M365,338c-10.6-9.6-22.4-17.7-35-24.2c26.4-21.9,41.8-54.3,41.8-89c0-63.8-51.9-115.8-115.8-115.8c-63.8,0-115.8,51.9-115.8,115.8 c0,34.7,15.4,67.1,41.8,89c-12.7,6.5-24.4,14.6-35,24.2c-19.6,17.7-34.4,39.7-43.5,64.2C65.9,363,44.6,310.4,44.6,256 c0-116.6,94.8-211.4,211.4-211.4c116.6,0,211.4,94.8,211.4,211.4c0,54.4-21.3,107-58.9,146.2C399.4,377.7,384.6,355.7,365,338z"/> </svg><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <path d="M256,0C114.841,0,0,114.841,0,256s114.841,256,256,256s256-114.841,256-256S397.159,0,256,0z M256,468.732 c-117.301,0-212.732-95.431-212.732-212.732S138.699,43.268,256,43.268S468.732,138.699,468.732,256S373.301,468.732,256,468.732z "/> </g> </g> <g> <g> <path d="M372.101,248.068H271.144V97.176c0-11.948-9.686-21.634-21.634-21.634c-11.948,0-21.634,9.686-21.634,21.634v172.525 c0,11.948,9.686,21.634,21.634,21.634c0.244,0,0.48-0.029,0.721-0.036c0.241,0.009,0.477,0.036,0.721,0.036h121.149 c11.948,0,21.634-9.686,21.634-21.634S384.049,248.068,372.101,248.068z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		$categories_list = get_the_category_list( esc_html__( ', ', 'flexia' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <path d="M23.5,244.3c-31.3,31.3-31.3,82.1,0,113.4l130.8,130.8c0,0,0,0,0,0c31.3,31.3,82.1,31.3,113.4,0l237.1-237.1 c4.8-4.8,7.4-11.3,7.2-18l-4.1-174.8c-0.5-29.9-24.6-54-54.5-54.5L278.6,0c-6.7-0.2-13.2,2.5-18,7.2L23.5,244.3z M58.6,279.2 L287.8,49.4l164.6,3.8c3.4,0,6.2,2.8,6.2,6.2l3.8,164.6L232.8,453.4c-12,12-31.6,12-43.6,0L58.6,322.8 C46.5,310.8,46.5,291.2,58.6,279.2z"/> <path d="M293.7,113.6c-28.9,29-28.8,75.8,0.2,104.7c28.9,28.8,75.6,28.8,104.5,0c29-28.9,29-75.7,0.2-104.7 c-28.9-29-75.7-29-104.7-0.2C293.8,113.4,293.7,113.5,293.7,113.6z M328.8,183.2c-9.6-9.6-9.6-25.3,0-34.9c9.6-9.6,25.2-9.6,34.9,0 c9.6,9.6,9.7,25.3,0,34.9C354,192.8,338.4,192.8,328.8,183.2C328.8,183.2,328.8,183.2,328.8,183.2z"/> </g> </svg>' . __( '<span class="screen-reader-text">Categories</span> %s', 'flexia' ) . '</span>
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
			echo '<span class="updated-on"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <path d="M256,0C114.841,0,0,114.841,0,256s114.841,256,256,256s256-114.841,256-256S397.159,0,256,0z M256,468.732 c-117.301,0-212.732-95.431-212.732-212.732S138.699,43.268,256,43.268S468.732,138.699,468.732,256S373.301,468.732,256,468.732z "/> </g> </g> <g> <g> <path d="M372.101,248.068H271.144V97.176c0-11.948-9.686-21.634-21.634-21.634c-11.948,0-21.634,9.686-21.634,21.634v172.525 c0,11.948,9.686,21.634,21.634,21.634c0.244,0,0.48-0.029,0.721-0.036c0.241,0.009,0.477,0.036,0.721,0.036h121.149 c11.948,0,21.634-9.686,21.634-21.634S384.049,248.068,372.101,248.068z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>' . $updated_on . '</span>'; // WPCS: XSS OK. // WPCS: XSS OK.
		}

		// Post Title Header Post Category
		if( $post_title_header_post_category == 'yes' || $post_title_header_post_category == NULL ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'flexia' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <path d="M23.5,244.3c-31.3,31.3-31.3,82.1,0,113.4l130.8,130.8c0,0,0,0,0,0c31.3,31.3,82.1,31.3,113.4,0l237.1-237.1 c4.8-4.8,7.4-11.3,7.2-18l-4.1-174.8c-0.5-29.9-24.6-54-54.5-54.5L278.6,0c-6.7-0.2-13.2,2.5-18,7.2L23.5,244.3z M58.6,279.2 L287.8,49.4l164.6,3.8c3.4,0,6.2,2.8,6.2,6.2l3.8,164.6L232.8,453.4c-12,12-31.6,12-43.6,0L58.6,322.8 C46.5,310.8,46.5,291.2,58.6,279.2z"/> <path d="M293.7,113.6c-28.9,29-28.8,75.8,0.2,104.7c28.9,28.8,75.6,28.8,104.5,0c29-28.9,29-75.7,0.2-104.7 c-28.9-29-75.7-29-104.7-0.2C293.8,113.4,293.7,113.5,293.7,113.6z M328.8,183.2c-9.6-9.6-9.6-25.3,0-34.9c9.6-9.6,25.2-9.6,34.9,0 c9.6,9.6,9.7,25.3,0,34.9C354,192.8,338.4,192.8,328.8,183.2C328.8,183.2,328.8,183.2,328.8,183.2z"/> </g> </svg>' . __( '<span class="screen-reader-text">Categories</span> %s', 'flexia' ) . '</span>
				', $categories_list ); // WPCS: XSS OK.
			}
		}

		// Post Title Post Comments
		if( $post_title_header_post_comments == 'yes' || $post_title_header_post_comments == NULL ) {
			?>
			<span class="comments-count"><svg height="682pt" viewBox="-21 -47 682.66669 682" width="682pt" xmlns="http://www.w3.org/2000/svg"><path d="m552.011719-1.332031h-464.023438c-48.515625 0-87.988281 39.464843-87.988281 87.988281v283.972656c0 48.414063 39.300781 87.816406 87.675781 87.988282v128.863281l185.191407-128.863281h279.144531c48.515625 0 87.988281-39.472657 87.988281-87.988282v-283.972656c0-48.523438-39.472656-87.988281-87.988281-87.988281zm50.488281 371.960937c0 27.835938-22.648438 50.488282-50.488281 50.488282h-290.910157l-135.925781 94.585937v-94.585937h-37.1875c-27.839843 0-50.488281-22.652344-50.488281-50.488282v-283.972656c0-27.84375 22.648438-50.488281 50.488281-50.488281h464.023438c27.839843 0 50.488281 22.644531 50.488281 50.488281zm0 0"/><path d="m171.292969 131.171875h297.414062v37.5h-297.414062zm0 0"/><path d="m171.292969 211.171875h297.414062v37.5h-297.414062zm0 0"/><path d="m171.292969 291.171875h297.414062v37.5h-297.414062zm0 0"/></svg><a class="scroll-to-comments" href="#comments"><?php comments_number( 'No Responses', '1 Comment', '% Comments' ); ?></a></span>
			<?php
		}

	}else {
		$updated_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Updated on %s', 'post date', 'flexia' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="updated-on"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <path d="M256,0C114.841,0,0,114.841,0,256s114.841,256,256,256s256-114.841,256-256S397.159,0,256,0z M256,468.732 c-117.301,0-212.732-95.431-212.732-212.732S138.699,43.268,256,43.268S468.732,138.699,468.732,256S373.301,468.732,256,468.732z "/> </g> </g> <g> <g> <path d="M372.101,248.068H271.144V97.176c0-11.948-9.686-21.634-21.634-21.634c-11.948,0-21.634,9.686-21.634,21.634v172.525 c0,11.948,9.686,21.634,21.634,21.634c0.244,0,0.48-0.029,0.721-0.036c0.241,0.009,0.477,0.036,0.721,0.036h121.149 c11.948,0,21.634-9.686,21.634-21.634S384.049,248.068,372.101,248.068z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>' . $updated_on . '</span>'; // WPCS: XSS OK. // WPCS: XSS OK.

			$categories_list = get_the_category_list( esc_html__( ', ', 'flexia' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <path d="M23.5,244.3c-31.3,31.3-31.3,82.1,0,113.4l130.8,130.8c0,0,0,0,0,0c31.3,31.3,82.1,31.3,113.4,0l237.1-237.1 c4.8-4.8,7.4-11.3,7.2-18l-4.1-174.8c-0.5-29.9-24.6-54-54.5-54.5L278.6,0c-6.7-0.2-13.2,2.5-18,7.2L23.5,244.3z M58.6,279.2 L287.8,49.4l164.6,3.8c3.4,0,6.2,2.8,6.2,6.2l3.8,164.6L232.8,453.4c-12,12-31.6,12-43.6,0L58.6,322.8 C46.5,310.8,46.5,291.2,58.6,279.2z"/> <path d="M293.7,113.6c-28.9,29-28.8,75.8,0.2,104.7c28.9,28.8,75.6,28.8,104.5,0c29-28.9,29-75.7,0.2-104.7 c-28.9-29-75.7-29-104.7-0.2C293.8,113.4,293.7,113.5,293.7,113.6z M328.8,183.2c-9.6-9.6-9.6-25.3,0-34.9c9.6-9.6,25.2-9.6,34.9,0 c9.6,9.6,9.7,25.3,0,34.9C354,192.8,338.4,192.8,328.8,183.2C328.8,183.2,328.8,183.2,328.8,183.2z"/> </g> </svg>' . __( '<span class="screen-reader-text">Categories</span> %s', 'flexia' ) . '</span>
		', $categories_list ); // WPCS: XSS OK.
			}

		?>

		<span class="comments-count"><svg height="682pt" viewBox="-21 -47 682.66669 682" width="682pt" xmlns="http://www.w3.org/2000/svg"><path d="m552.011719-1.332031h-464.023438c-48.515625 0-87.988281 39.464843-87.988281 87.988281v283.972656c0 48.414063 39.300781 87.816406 87.675781 87.988282v128.863281l185.191407-128.863281h279.144531c48.515625 0 87.988281-39.472657 87.988281-87.988282v-283.972656c0-48.523438-39.472656-87.988281-87.988281-87.988281zm50.488281 371.960937c0 27.835938-22.648438 50.488282-50.488281 50.488282h-290.910157l-135.925781 94.585937v-94.585937h-37.1875c-27.839843 0-50.488281-22.652344-50.488281-50.488282v-283.972656c0-27.84375 22.648438-50.488281 50.488281-50.488281h464.023438c27.839843 0 50.488281 22.644531 50.488281 50.488281zm0 0"/><path d="m171.292969 131.171875h297.414062v37.5h-297.414062zm0 0"/><path d="m171.292969 211.171875h297.414062v37.5h-297.414062zm0 0"/><path d="m171.292969 291.171875h297.414062v37.5h-297.414062zm0 0"/></svg><a class="scroll-to-comments" href="#comments"><?php comments_number( 'No Responses', '1 Comment', '% Comments' ); ?></a></span>
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
			printf( '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <path d="M23.5,244.3c-31.3,31.3-31.3,82.1,0,113.4l130.8,130.8c0,0,0,0,0,0c31.3,31.3,82.1,31.3,113.4,0l237.1-237.1 c4.8-4.8,7.4-11.3,7.2-18l-4.1-174.8c-0.5-29.9-24.6-54-54.5-54.5L278.6,0c-6.7-0.2-13.2,2.5-18,7.2L23.5,244.3z M58.6,279.2 L287.8,49.4l164.6,3.8c3.4,0,6.2,2.8,6.2,6.2l3.8,164.6L232.8,453.4c-12,12-31.6,12-43.6,0L58.6,322.8 C46.5,310.8,46.5,291.2,58.6,279.2z"/> <path d="M293.7,113.6c-28.9,29-28.8,75.8,0.2,104.7c28.9,28.8,75.6,28.8,104.5,0c29-28.9,29-75.7,0.2-104.7 c-28.9-29-75.7-29-104.7-0.2C293.8,113.4,293.7,113.5,293.7,113.6z M328.8,183.2c-9.6-9.6-9.6-25.3,0-34.9c9.6-9.6,25.2-9.6,34.9,0 c9.6,9.6,9.7,25.3,0,34.9C354,192.8,338.4,192.8,328.8,183.2C328.8,183.2,328.8,183.2,328.8,183.2z"/> </g> </svg> <span class="tags-links">' . __( '<span class="screen-reader-text">Tags</span> %s', 'flexia' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<svg height="682pt" viewBox="-21 -47 682.66669 682" width="682pt" xmlns="http://www.w3.org/2000/svg"><path d="m552.011719-1.332031h-464.023438c-48.515625 0-87.988281 39.464843-87.988281 87.988281v283.972656c0 48.414063 39.300781 87.816406 87.675781 87.988282v128.863281l185.191407-128.863281h279.144531c48.515625 0 87.988281-39.472657 87.988281-87.988282v-283.972656c0-48.523438-39.472656-87.988281-87.988281-87.988281zm50.488281 371.960937c0 27.835938-22.648438 50.488282-50.488281 50.488282h-290.910157l-135.925781 94.585937v-94.585937h-37.1875c-27.839843 0-50.488281-22.652344-50.488281-50.488282v-283.972656c0-27.84375 22.648438-50.488281 50.488281-50.488281h464.023438c27.839843 0 50.488281 22.644531 50.488281 50.488281zm0 0"/><path d="m171.292969 131.171875h297.414062v37.5h-297.414062zm0 0"/><path d="m171.292969 211.171875h297.414062v37.5h-297.414062zm0 0"/><path d="m171.292969 291.171875h297.414062v37.5h-297.414062zm0 0"/></svg> <span class="comments-link">';
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