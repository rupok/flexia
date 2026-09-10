<?php
/** Permit only WordPress.org package requests during the explicit CLI install step. */
WP_CLI::add_hook( 'after_wp_load', function() {
	remove_all_filters( 'pre_http_request' );
	add_filter( 'pre_http_request', function( $pre, $args, $url ) {
		$host = wp_parse_url( $url, PHP_URL_HOST );
		if ( ! in_array( $host, array( 'api.wordpress.org', 'downloads.wordpress.org' ), true ) || wp_parse_url( $url, PHP_URL_SCHEME ) !== 'https' ) {
			return new WP_Error( 'test_network_blocked', 'Only HTTPS WordPress.org packages may be downloaded.' );
		}
		return $pre;
	}, 100, 3 );
} );
