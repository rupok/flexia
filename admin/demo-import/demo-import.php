<?php

/*
* Import Files
*/
function flexia_ocdi_import_files() {
    return array(
        array(
            'import_file_name'             => 'Flexia Demo',
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo/flexia-demo.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo/flexia-widgets.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo/flexia-customizer.dat'
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'flexia_ocdi_import_files' );

/*
* After Import  - Update Options
*/
function flexia_import_set_reading_options( $settings ) {
    $reading_settings = $settings['reading_settings'];
    if ( ! empty( $reading_settings ) ) {
        $homepage = get_page_by_title( html_entity_decode( $reading_settings['homepage'] ) );
        $blog     = get_page_by_title( html_entity_decode( $reading_settings['blog'] ) );
        if ( ( isset( $homepage ) && $homepage->ID ) && ( isset( $blog ) && $blog->ID) ) {
            update_option( 'show_on_front',   'page' );
            update_option( 'page_on_front',   $homepage->ID );
            update_option( 'page_for_posts',  $blog->ID );

            return true;
        }
    }

    return false;
}

/*
* After Import  - Set WooCommerce Pages
*/
function flexia_import_set_woocommerce_pages( $settings ) {
    if ( class_exists( 'Woocommerce' ) && ! empty( $settings['woocommerce_pages'] ) ) {
        foreach ( $settings['woocommerce_pages'] as $woo_name => $woo_title ) {
            $woopage = get_page_by_title( $woo_title );
            if ( isset( $woopage ) && property_exists( $woopage, 'ID' ) ) {
                update_option( $woo_name, $woopage->ID );
            }
        }

        return true;
    }

    return false;
}

/*
* After Import - Set Menus
*/
function flexia_import_set_nav_menus( $settings ) {

    if ( is_array( $settings['navigation'] ) ) {
        $locations = get_theme_mod( 'nav_menu_locations' );
        $menus = wp_get_nav_menus();

        foreach ( (array) $menus as $theme_menu ) {
            foreach ( (array) $settings['navigation'] as $import_menu ) {
                if ( $theme_menu->name == $import_menu['name'] ) {
                    $locations[ $import_menu['location'] ] = $theme_menu->term_id;
                }
            }
        }

        set_theme_mod( 'nav_menu_locations', $locations );

        return true;
    }

    return false;
}

/*
* After Import Setup
*/
function flexia_ocdi_after_import_setup() {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );

    WP_Filesystem();

    global $wp_filesystem;

    $json = null;
    $settings = array();

    if ( is_file( get_template_directory() . '/demo/demo-config.json' ) ) {
        $rsp = $wp_filesystem->get_contents( get_template_directory() . '/demo/demo-config.json' );
        $json = json_decode( $rsp, true );
    }

    if ($json !== null) {
        foreach ( $json as $demo ) {
            if ( 'Flexia Demo' === $demo['demo_name'] ) {
                $settings = $demo['settings'];
            }
        }

        flexia_import_set_reading_options( $settings );
        flexia_import_set_woocommerce_pages( $settings );
        flexia_import_set_nav_menus( $settings );

        flush_rewrite_rules();
    }
}
add_action( 'pt-ocdi/after_import', 'flexia_ocdi_after_import_setup' );

/*
* Before Import Setup
*/
function flexia_ocdi_before_content_import_setup() {
    update_option('sidebars_widgets',array());
}
add_action( 'pt-ocdi/before_content_import', 'flexia_ocdi_before_content_import_setup' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
