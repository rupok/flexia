<?php


function flexia_theme_register_required_plugins() {

    $plugins = array(
        'flexia-core' => array(
            'name'               => 'Flexia Core',
            'slug'               => 'flexia-core',
            'required'           => true,
            'description'        => 'Core plugin for Flexia theme. Controls all the plugin territory functionality for Flexia.',
        ),
        'one-click-demo-import'=> array(
            'name'               => 'One Click Demo Import',
            'slug'               => 'one-click-demo-import',
            'required'           => false,
            'description'        => 'Adds easy-to-use demo import functionality.',
        ),
        'elementor'=> array(
            'name'               => 'Elementor',
            'slug'               => 'elementor',
            'required'           => false,
            'description'        => 'A website builder that delivers high-end page designs and advanced capabilities, never before seen on WordPress.',
        ),
        'essential-addons-for-elementor-lite'=> array(
            'name'               => 'Essential Addons for Elementor',
            'slug'               => 'essential-addons-for-elementor-lite',
            'required'           => false,
            'description'        => 'Enhance your Elementor page building experience with 70+ creative elements and extensions.',
        ),
    );

    $config = array(
        'id'               => 'flexia',
        'default_path'      => '',
        'parent_slug'       => 'themes.php',
        'menu'              => 'tgmpa-install-plugins',
        'has_notices'       => true,
        'is_automatic'      => false,
    );

    tgmpa( $plugins, $config );

}

add_action( 'tgmpa_register', 'flexia_theme_register_required_plugins' );
