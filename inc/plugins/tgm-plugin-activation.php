<?php
/**
 * Recommends plugins for use with the theme via the TGMA Script
 *
 * @package Flexia WordPress theme
 */

function flexia_tgmpa_register() {

	// Get array of recommended plugins
	$plugins = array(
		
		array(
			'name'				=> 'Flexia Core',
			'slug'				=> 'flexia-core', 
			'required'			=> false,
			'force_activation'	=> false,
		),
		
	);

	// Register notice
	tgmpa( $plugins, array(
		'id'           => 'flexia_theme',
		'domain'       => 'flexia',
		'menu'         => 'flexia-required-plugins',
		'has_notices'  => true,
		'is_automatic' => true,
		'dismissable'  => true,
	) );

}
add_action( 'tgmpa_register', 'flexia_tgmpa_register' );