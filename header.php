<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
if( class_exists('Flexia_Pro') ) {
	$flexia_under_construction = get_option( 'flexia-under-construction' );
	if( $flexia_under_construction['flexia-under-construction'] == true ) { 
		do_action('flexia_under_construction'); 
	}
}

?>

<div id="page" class="site">

<?php

	$no_footer_template = array(
		'template-blank-container-3.php',
		'template-no-container-2.php',
		'template-no-container-4.php'
	);
	$current_template = basename( get_page_template() ) ;

	if ( !in_array($current_template, $no_footer_template) ) {

		get_template_part( 'framework/views/template-parts/content', 'masthead' );

	}

?>