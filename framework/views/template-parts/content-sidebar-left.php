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
	<div class="flexia-sidebar-inner">
		<?php dynamic_sidebar( 'sidebar-left' ); ?>
	</div>
</aside><!-- #sidebar-left -->