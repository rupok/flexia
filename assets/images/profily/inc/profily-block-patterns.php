<?php
/**
 * profily: Block Patterns
 *
 * @since profily 1.0
 */

/**
 * Registers block patterns and categories.
 *
 * @since profily 1.0
 *
 * @return void
 */
function profily_register_block_patterns() {
	$profily_block_pattern_categories = array(
		'profily-header-default'    => array( 'label' => __( 'Header Default', 'profily' ) ),
		'profily-footer-default'    => array( 'label' => __( 'Footer Default', 'profily' ) ),
	);

	/**
	 * Filters the theme block pattern categories.
	 *
	 * @since profily 1.0
	 *
	 * @param array[] $profily_block_pattern_categories {
	 *     An associative array of block pattern categories, keyed by category name.
	 *
	 *     @type array[] $properties {
	 *         An array of block category properties.
	 *
	 *         @type string $label A human-readable label for the pattern category.
	 *     }
	 * }
	 */
	$profily_block_pattern_categories = apply_filters( 'profily_block_pattern_categories', $profily_block_pattern_categories );

	foreach ( $profily_block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}

	$profily_block_patterns = array(
		'profily-header-default',
		'profily-footer-default',
	);

	/**
	 * Filters the theme block patterns.
	 *
	 * @since profily 1.0
	 *
	 * @param array $profily_block_patterns List of block patterns by name.
	 */
	$profily_block_patterns = apply_filters( 'profily_block_patterns', $profily_block_patterns );

	foreach ( $profily_block_patterns as $profily_block_pattern ) {
		$profily_pattern_file = get_theme_file_path( '/inc/patterns/' . $profily_block_pattern . '.php' );

		register_block_pattern(
			'profily/' . $profily_block_pattern,
			require $profily_pattern_file
		);
	}
}
add_action( 'init', 'profily_register_block_patterns', 9 );
