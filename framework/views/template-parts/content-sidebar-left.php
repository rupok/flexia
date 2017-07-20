<?php
/**
 * The sidebar containing the left sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) {
	return;
}
?>

<aside id="flexia-sidebar-left" class="flexia-sidebar flexia-sidebar-left">
	<?php dynamic_sidebar( 'sidebar-left' ); ?>
</aside><!-- #sidebar-left -->