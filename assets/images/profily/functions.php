<?php
/**
 * profily functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @since profily 1.0
 */

 /**
 * Global constants for companion plugin
 */
define( 'PROFILY_THEME', true );
define( 'PROFILY_THEME_VERSION', '1.4' );

const PROFILY_PFX  = 'profily';


/**
 * Theme setup related functions
 */

require get_template_directory() . '/inc/setup.php';

require get_template_directory() . '/inc/companion.php';

require get_template_directory() . '/inc/tgm/plugin-required.php';

