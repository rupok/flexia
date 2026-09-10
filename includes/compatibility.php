<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (!function_exists('flexia_get_option')) {
    function flexia_get_option($handler) {
        return '';
    }
}