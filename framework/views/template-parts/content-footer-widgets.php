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
		<?php if(is_active_sidebar('footer-1')) { ?>
			<div class="fleixa-footer-widget-area-wrap"><?php dynamic_sidebar( 'footer-1' ) ?></div>
		<?php } ?>
		<?php if(is_active_sidebar('footer-2')) { ?>
			<div class="fleixa-footer-widget-area-wrap"><?php dynamic_sidebar( 'footer-2' ) ?></div>
		<?php } ?>
		<?php if(is_active_sidebar('footer-3')) { ?>
			<div class="fleixa-footer-widget-area-wrap"><?php dynamic_sidebar( 'footer-3' ) ?></div>
		<?php } ?>
		<?php if(is_active_sidebar('footer-4')) { ?>
			<div class="fleixa-footer-widget-area-wrap"><?php dynamic_sidebar( 'footer-4' ) ?></div>
		<?php } ?>
	</div>
</footer><!-- #footer-widget-area -->