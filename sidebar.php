<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="flexia-sidebar-left" class="flexia-sidebar flexia-sidebar-left">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->

<aside id="flexia-sidebar-right" class="flexia-sidebar flexia-sidebar-right">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->


