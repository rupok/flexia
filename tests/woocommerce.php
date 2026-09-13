<?php
/** Commerce regressions; use wp eval-file in a disposable test installation. */
if ( ! defined( 'FLEXIA_TEST_ENVIRONMENT' ) || ! FLEXIA_TEST_ENVIRONMENT || ! class_exists( 'WooCommerce' ) ) {
	WP_CLI::error( 'A disposable test installation with WooCommerce is required.' );
}
$created = array();
$term = wp_insert_term( 'Flexia test products', 'product_cat' );
$category = is_wp_error( $term ) ? (int) $term->get_error_data() : $term['term_id'];
$failures = array();
$original_query = $GLOBALS['wp_query'];
$original_product = isset( $GLOBALS['product'] ) ? $GLOBALS['product'] : null;
try {
	foreach ( array( 'FLEXIA_CURRENT_PRODUCT', 'FLEXIA_RELATED_PRODUCT', 'FLEXIA_UNRELATED_PRODUCT' ) as $i => $title ) {
		$product = new WC_Product_Simple();
		$product->set_name( $title ); $product->set_status( 'publish' ); $product->set_regular_price( '12.00' );
		if ( $i < 2 ) { $product->set_category_ids( array( $category ) ); }
		$created[] = $product->save();
	}
	$catalog = get_block_template( get_stylesheet() . '//archive-product', 'wp_template' );
	if ( ! $catalog || $catalog->source !== 'theme' || strpos( $catalog->content, 'flexia/product-catalog' ) === false ) { $failures[] = 'Product catalog did not resolve to the theme override.'; }
	$GLOBALS['wp_query'] = new WP_Query( array( 'post_type' => 'product', 'p' => $created[0] ) );
	$GLOBALS['wp_query']->the_post();
	$GLOBALS['product'] = wc_get_product( $created[0] );
	ob_start(); include get_template_directory() . '/patterns/single-product.php'; $source = ob_get_clean();
	$blocks = resolve_pattern_blocks( parse_blocks( $source ) );
	$html = do_blocks( serialize_blocks( $blocks ) );
	if ( strpos( $html, 'FLEXIA_CURRENT_PRODUCT' ) === false ) { $failures[] = 'Single product title missing.'; }
	if ( strpos( $html, 'FLEXIA_RELATED_PRODUCT' ) === false ) { $failures[] = 'Related collection lost current product context.'; }
	if ( strpos( $html, 'FLEXIA_UNRELATED_PRODUCT' ) !== false ) { $failures[] = 'Unrelated product leaked into related collection.'; }
	if ( substr_count( $html, '<main' ) !== 1 ) { $failures[] = 'Single product has incorrect main landmarks.'; }
	if ( strpos( $html, '<form class="cart"' ) === false ) { $failures[] = 'Add-to-cart form missing.'; }
	// The legacy add-to-cart block must preserve each WooCommerce product type.
	$variable = new WC_Product_Variable();
	$variable->set_name( 'FLEXIA_VARIABLE_PRODUCT' ); $variable->set_status( 'publish' );
	$attribute = new WC_Product_Attribute(); $attribute->set_name( 'Size' ); $attribute->set_options( array( 'Small' ) ); $attribute->set_variation( true );
	$variable->set_attributes( array( $attribute ) ); $variable->set_default_attributes( array( 'size' => 'Small' ) );
	$created[] = $variable->save();
	$variation = new WC_Product_Variation(); $variation->set_parent_id( $variable->get_id() ); $variation->set_attributes( array( 'size' => 'Small' ) ); $variation->set_regular_price( '15' ); $variation->set_status( 'publish' );
	$created[] = $variation->save(); WC_Product_Variable::sync( $variable->get_id() );
	$grouped = new WC_Product_Grouped(); $grouped->set_name( 'FLEXIA_GROUPED_PRODUCT' ); $grouped->set_status( 'publish' ); $grouped->set_children( array( $created[1] ) ); $created[] = $grouped->save();
	$external = new WC_Product_External(); $external->set_name( 'FLEXIA_EXTERNAL_PRODUCT' ); $external->set_status( 'publish' ); $external->set_product_url( 'https://example.invalid/flexia-fixture' ); $external->set_button_text( 'External fixture link' ); $external->set_regular_price( '20' ); $created[] = $external->save();
	foreach ( array( array( $variable->get_id(), 'variations_form' ), array( $grouped->get_id(), 'grouped_form' ), array( $external->get_id(), 'https://example.invalid/flexia-fixture' ) ) as $case ) {
		$GLOBALS['wp_query'] = new WP_Query( array( 'post_type' => 'product', 'p' => $case[0] ) ); $GLOBALS['wp_query']->the_post(); $GLOBALS['product'] = wc_get_product( $case[0] );
		$variant_html = do_blocks( serialize_blocks( resolve_pattern_blocks( parse_blocks( $source ) ) ) );
		if ( strpos( $variant_html, $case[1] ) === false || substr_count( $variant_html, '<main' ) !== 1 ) { $failures[] = 'Product-type rendering failed: ' . $case[1]; }
	}
	// Preserve a rendered fixture for browser QA only when explicitly requested.
	if ( getenv( 'FLEXIA_TEST_HTML' ) ) { file_put_contents( getenv( 'FLEXIA_TEST_HTML' ), $html ); }
} finally {
	foreach ( array_reverse( $created ) as $id ) { wp_delete_post( $id, true ); }
	wp_delete_term( $category, 'product_cat' );
	$GLOBALS['wp_query'] = $original_query; $GLOBALS['product'] = $original_product; wp_reset_postdata();
}
if ( $failures ) { WP_CLI::error( implode( "\n", $failures ) ); }
WP_CLI::success( 'WooCommerce catalog routing, product context, related collection, landmarks and simple/variable/grouped/external forms passed; products removed.' );
