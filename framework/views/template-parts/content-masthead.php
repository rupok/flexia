<?php
/**
 * The template for displaying the header
 *
 * Contains the masthead part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

<header id="masthead" class="site-header">

	<?php get_template_part( 'framework/views/template-parts/content', 'header-widgets' ); ?>

	<?php get_template_part( 'framework/views/template-parts/content', 'topbar' ); ?>

	<?php get_template_part( 'framework/views/template-parts/content', 'navbar' ); ?>

</header><!-- #masthead -->