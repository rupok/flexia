<?php
// No direct access, please
if (!defined('ABSPATH')) {
    exit;
}

// Add cart menu  to Navbar
function add_edd_cart_menu_to_navbar($items, $args)
{
    $flexia_woo_cart_menu = get_theme_mod('flexia_woo_cart_menu', false);

    if ($flexia_woo_cart_menu == true && 'primary' === $args->theme_location) {
        $items .= '<li class="menu-item flexia-header-cart">';

        $items .= '<a class="cart-contents edd-cart-contents" href="' . edd_get_checkout_uri() . '">';
        $items .= '<span class="flexia-header-cart-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="510px" height="510px" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve"> <g> <g id="shopping-cart"> <path d="M153,408c-28.05,0-51,22.95-51,51s22.95,51,51,51s51-22.95,51-51S181.05,408,153,408z M0,0v51h51l91.8,193.8L107.1,306 c-2.55,7.65-5.1,17.85-5.1,25.5c0,28.05,22.95,51,51,51h306v-51H163.2c-2.55,0-5.1-2.55-5.1-5.1v-2.551l22.95-43.35h188.7 c20.4,0,35.7-10.2,43.35-25.5L504.9,89.25c5.1-5.1,5.1-7.65,5.1-12.75c0-15.3-10.2-25.5-25.5-25.5H107.1L84.15,0H0z M408,408 c-28.05,0-51,22.95-51,51s22.95,51,51,51s51-22.95,51-51S436.05,408,408,408z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg></span>';
        $items .= '<span class="amount">' . wp_kses_data(edd_cart_total(false)) . '</span>';
        $items .= '<span class="count">' . wp_kses_data(sprintf(_n('%d item', '%d items', edd_get_cart_quantity(), 'flexia'), edd_get_cart_quantity())) . '</span>';
        $items .= '</a>';
        $items .= '</li>';
    }

    return $items;
}
$header_layouts = get_theme_mod('flexia_header_layouts', '1');
if($header_layouts == '1') {
add_filter('wp_nav_menu_items', 'add_edd_cart_menu_to_navbar', 99, 2);
}
