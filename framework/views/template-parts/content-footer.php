<?php

// No direct access, please
if (!defined('ABSPATH')) {
    exit;
}

/**
 * The bottom footer area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

if (flexia_get_option('flexia_footer_widget_area') == true) {
    get_template_part('framework/views/template-parts/content', 'footer-widgets');
}

if (flexia_get_option('footer_bottom') == true) {
    get_template_part('framework/views/template-parts/content', 'footer-bottom');
}
