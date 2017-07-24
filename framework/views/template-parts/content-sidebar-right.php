<?php
/**
 * The sidebar containing the right sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

if ( ! is_active_sidebar( 'sidebar-right' ) ) {
	return;
}
?>

<aside id="flexia-sidebar-right" class="flexia-sidebar flexia-sidebar-right">
	<div class="flexia-sidebar-inner">
		<?php dynamic_sidebar( 'sidebar-right' ); ?>
	</div>
</aside><!-- #sidebar-right -->