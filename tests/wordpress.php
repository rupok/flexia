<?php
/** Run only in a disposable WordPress installation via wp eval-file. */
if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	exit( 1 );
}
if ( ! defined( 'FLEXIA_TEST_ENVIRONMENT' ) || ! FLEXIA_TEST_ENVIRONMENT ) {
	WP_CLI::error( 'Set FLEXIA_TEST_ENVIRONMENT in a disposable installation, never on a real site.' );
}
global $failures, $checks;
$failures = array();
$checks = 0;
function flexia_test_assert( $condition, $message ) {
	global $failures, $checks;
	++$checks;
	if ( ! $condition ) { $failures[] = $message; }
}
function flexia_test_render( $file ) {
	$content = file_get_contents( get_template_directory() . '/' . $file );
	if ( substr( $file, -4 ) === '.php' ) {
		ob_start();
		include get_template_directory() . '/' . $file;
		$content = ob_get_clean();
	}
	$blocks = resolve_pattern_blocks( parse_blocks( $content ) );
	return do_blocks( serialize_blocks( $blocks ) );
}
flexia_test_assert( get_template() === 'flexia', 'Flexia must be the active parent.' );
flexia_test_assert( ! class_exists( 'Flexia_Core' ), 'Core must be absent during independence testing.' );
flexia_test_assert( ! has_filter( 'acf/shortcode/allow_in_block_themes_outside_content' ), 'Theme must preserve ACF defaults.' );
flexia_test_assert( ! function_exists( 'flexiapro_deactive_on_update_fse' ), 'Obsolete mutation must be removed.' );
foreach ( array( 'container', 'container-fluid', 'row', 'column' ) as $shortcode ) {
	flexia_test_assert( ! shortcode_exists( $shortcode ), 'Retired shortcode reintroduced: ' . $shortcode );
}
// Execute every automatic pattern with real WordPress functions; validate raw JSON
// before WP's forgiving parser can silently replace malformed attributes.
$patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
foreach ( $patterns as $pattern ) {
	if ( strpos( $pattern['name'], 'flexia/' ) !== 0 && strpos( $pattern['name'], 'flexia-pages/' ) !== 0 ) { continue; }
	preg_match_all( '/<!--\s+wp:[\w\/-]+\s+(\{.*?\})\s*\/?-->/s', $pattern['content'], $matches );
	foreach ( $matches[1] as $attrs ) {
		json_decode( $attrs, true );
		flexia_test_assert( json_last_error() === JSON_ERROR_NONE, 'Invalid rendered pattern JSON: ' . $pattern['name'] );
	}
}
// Hostile translation characters must remain a JSON string inside a block comment.
$translation = function( $text ) { return "Quote \" and slash \\ plus --> <tag>"; };
add_filter( 'gettext_with_context', $translation );
ob_start(); include get_template_directory() . '/patterns/main-sidebar.php'; $translated = ob_get_clean();
remove_filter( 'gettext_with_context', $translation );
preg_match_all( '/<!--\s+wp:[\w\/-]+\s+(\{.*?\})\s*\/?-->/s', $translated, $matches );
foreach ( $matches[1] as $attrs ) {
	json_decode( $attrs, true );
	flexia_test_assert( json_last_error() === JSON_ERROR_NONE, 'Translated block attribute must remain valid JSON.' );
}
flexia_test_assert( strpos( $translated, 'plus --> <tag>' ) === false, 'Translation must not break its block comment.' );
$created = array();
$category = wp_insert_term( 'Flexia fixture category', 'category' );
$term_id = is_wp_error( $category ) ? (int) $category->get_error_data() : $category['term_id'];
$old_per_page = get_option( 'posts_per_page' );
$original_query = $GLOBALS['wp_query'];
$original_post = isset( $GLOBALS['post'] ) ? $GLOBALS['post'] : null;
try {
	update_option( 'posts_per_page', 2 );
	for ( $i = 1; $i <= 3; ++$i ) {
		$created[] = wp_insert_post( array( 'post_title' => 'FLEXIA_INCLUDED_' . $i, 'post_content' => 'FLEXIA_BODY_' . $i, 'post_status' => 'publish', 'post_category' => array( $term_id ) ) );
	}
	$excluded = wp_insert_post( array( 'post_title' => 'FLEXIA_EXCLUDED', 'post_content' => 'Excluded fixture.', 'post_status' => 'publish' ) );
	$created[] = $excluded;
	$GLOBALS['wp_query'] = new WP_Query( array( 'cat' => $term_id, 'posts_per_page' => 2, 'paged' => 1 ) );
	$html = flexia_test_render( 'templates/archive.html' );
	flexia_test_assert( strpos( $html, 'FLEXIA_INCLUDED_' ) !== false, 'Archive must render matching posts.' );
	flexia_test_assert( ! preg_match( '/class="[^"]*wp-block-post-title[^"]*"[^>]*>.*?FLEXIA_EXCLUDED.*?<\/h[1-6]>/s', $html ), 'Archive must preserve category scope.' );
	$GLOBALS['wp_query'] = new WP_Query( array( 'cat' => $term_id, 'posts_per_page' => 2, 'paged' => 2 ) );
	$page_two = flexia_test_render( 'templates/archive.html' );
	flexia_test_assert( $html !== $page_two && strpos( $page_two, 'FLEXIA_INCLUDED_' ) !== false, 'Archive page 2 must render a different matching post.' );
	foreach ( array( 'templates/single.html', 'templates/single-right-sidebar.html' ) as $template ) {
		$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $created[0] ) );
		$GLOBALS['wp_query']->the_post();
		$html = flexia_test_render( $template );
		flexia_test_assert( strpos( $html, 'FLEXIA_BODY_1' ) !== false, $template . ' must render the selected post body.' );
		flexia_test_assert( substr_count( $html, '<main' ) === 1, $template . ' must have one main landmark.' );
		flexia_test_assert( substr_count( $html, '<h1' ) === 1, $template . ' must have one page title.' );
	}
	// Simulate an active child at the legacy trigger version; no actor may cause
	// an ordinary setup request to mutate the site's plugin activation list.
	$child = get_theme_root() . '/flexia-test-child';
	wp_mkdir_p( $child );
	file_put_contents( $child . '/style.css', "/*\nTheme Name: Flexia Test Child\nTemplate: flexia\nVersion: 3.0.0\n*/" );
	wp_clean_themes_cache();
	$old_stylesheet = get_option( 'stylesheet' );
	$plugins = get_option( 'active_plugins' );
	try {
		update_option( 'stylesheet', 'flexia-test-child' );
		update_option( 'active_plugins', array_merge( $plugins, array( 'flexia-pro/flexia-pro.php' ) ) );
		$expected = get_option( 'active_plugins' );
		foreach ( array( 0, 1 ) as $actor ) {
			wp_set_current_user( $actor );
			// Re-run only theme-owned setup callbacks; repeating the entire WP
			// lifecycle would register unrelated plugin templates twice.
			foreach ( $GLOBALS['wp_filter']['after_setup_theme']->callbacks as $callbacks ) {
				foreach ( $callbacks as $callback ) {
					if ( is_string( $callback['function'] ) && strpos( $callback['function'], 'flexia' ) === 0 ) {
						call_user_func( $callback['function'] );
					}
				}
			}
			flexia_test_assert( get_option( 'active_plugins' ) === $expected, 'Setup changed plugin state for actor ' . $actor );
		}
	} finally {
		update_option( 'stylesheet', $old_stylesheet );
		update_option( 'active_plugins', $plugins );
		unlink( $child . '/style.css' ); rmdir( $child ); wp_clean_themes_cache();
	}
} finally {
	foreach ( $created as $id ) { wp_delete_post( $id, true ); }
	wp_delete_term( $term_id, 'category' );
	update_option( 'posts_per_page', $old_per_page );
	$GLOBALS['wp_query'] = $original_query;
	$GLOBALS['post'] = $original_post;
	wp_reset_postdata();
}
if ( $failures ) { WP_CLI::error( implode( "\n", $failures ) ); }
WP_CLI::success( 'Flexia passed ' . $checks . ' WordPress checks; fixture content cleaned up.' );
