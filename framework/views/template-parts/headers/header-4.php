<?php

// No direct access, please
if (!defined('ABSPATH')) exit;


/**
 * The template for displaying the Navbar
 *
 * Contains the navbar part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

$navbar_class = get_theme_mod('flexia_navbar_position', 'flexia-navbar-static-top');
$dropdown_animation = 'flexia-menu-dropdown-animate-' . get_theme_mod('flexia_main_nav_menu_dropdown_animation', 'to-top');

?>

<div class="flexia-navbar <?php echo esc_attr($navbar_class); ?>">
    <div class="flexia-navbar-container">
        <div class="flexia-container flexia-navbar-inner <?php echo (get_theme_mod('flexia_header_layout_type') == "full-width") ? "full-width" : "width max" ?>">
            
                <!-- Header Main Social Start -->
                <div class="flexia-header-4-mobile">
                    <?php
                    if (flexia_get_option('flexia_enable_header_social') == true && flexia_get_option('flexia_header_social_position') == "header_main") {
                        get_template_part('framework/views/template-parts/content', 'social-links');
                    }
                    ?>
                </div>
                <!-- Header Main Social End -->
            <div class="flexia-header-top">
                <div class="flexia-logobar-inline">
                    <div class="site-branding">

                        <?php echo flexia_main_logo(); ?>

                    </div><!-- .site-branding -->
                </div><!-- flexia-logobar-inline -->
            </div>
            <div class="flexia-header-navigation">

                <!-- Header Main Social Start -->
                <div class="flexia-header-4-social">
                    <?php
                    if (flexia_get_option('flexia_enable_header_social') == true && flexia_get_option('flexia_header_social_position') == "header_main") {
                        get_template_part('framework/views/template-parts/content', 'social-links');
                    }
                    ?>
                </div>
                <!-- Header Main Social End -->
                <nav id="site-navigation" class="flexia-menu main-navigation">
                    <?php

                    if (has_nav_menu('primary')) :
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'flexia-primary-menu',
                            'menu_class'     => 'nav-menu flexia-primary-menu ' . $dropdown_animation,
                            'container'      => false,
                        ));
                    else :

                        echo '<ul class="flexia-primary-menu"><li><a href="' . home_url('/') . 'wp-admin/nav-menus.php">Assign a Menu</a></li></ul>';
                    endif;
                    ?>

                </nav><!-- #site-navigation -->
                <div class="flexia-menu header-icons icon-menu">
                    <ul class="nav-menu <?php echo esc_attr($dropdown_animation); ?>">
                        <?php
                        $items = '';
                        $items = apply_filters('flexia_header_icon_items', $items);
                        echo wp_kses_post($items);
                        ?>
                    </ul>
                </div><!-- #header-icons -->

            </div><!-- #flexia-header-navigation -->
        </div><!-- #flexia-container -->
    </div><!-- #flexia-navbar-container -->
</div>