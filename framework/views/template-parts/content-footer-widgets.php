<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

<footer id="flexia-colophon-top" class="flexia-footer-widget-area">
	<div class="flexia-colophon-inner flexia-container max width">
		<?php dynamic_sidebar( 'footer-1' ); ?>
		<?php dynamic_sidebar( 'footer-2' ); ?>
		<?php dynamic_sidebar( 'footer-3' ); ?>
		<?php dynamic_sidebar( 'footer-4' ); ?>
	</div>
</footer><!-- #footer-widget-area -->