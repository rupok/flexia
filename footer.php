<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

<?php wp_footer(); ?>

<?php if( get_theme_mod('flexia_scroll_to_top') == true ) : ?>

<a title="Scroll back to top" rel="nofollow" href="#" class="flexia-back-to-top" style="opacity: 0; visibility: hidden;" data-scroll-speed="400" data-start-scroll="300">
	<i class="fa fa-angle-up" aria-hidden="true"></i>
	<span class="screen-reader-text">Scroll back to top</span>
</a>

<?php endif; ?>

</body>
</html>
