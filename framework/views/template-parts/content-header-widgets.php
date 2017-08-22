<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The template for displaying the header widgets
 *
 * Contains the header widgets part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

<div class="flexia-header-widget-area">
	<div class="flexia-header-widget-inner flexia-container">
		<?php dynamic_sidebar( 'header-1' ); ?>
		<?php dynamic_sidebar( 'header-2' ); ?>
		<?php dynamic_sidebar( 'header-3' ); ?>
		<?php dynamic_sidebar( 'header-4' ); ?>
	</div>
<div class="header-widget-toggle toggle-collapsed"></div>
</div>

