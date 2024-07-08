<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define Constants
 */
define( 'FLEXIA_DEV_MODE', false );
define( 'FLEXIA_VERSION', '3.0.1' );
define( 'FLEXIA_SLUG', 'flexia' );
define( 'FLEXIA_NAME', 'flexia' );
define( 'FLEXIA_DIR_PATH', get_template_directory() );

if ( ! function_exists( 'flexia_support' ) ):

    function flexia_support()
{
        // Custom editor styling
        add_editor_style( 'assets/css/editor-style.css' );
    }

endif;

add_action( 'after_setup_theme', 'flexia_support' );

if ( ! function_exists( 'flexia_styles' ) ):
    /**
     * Enqueue styles.
     */
    function flexia_styles()
{
        wp_enqueue_style( 'flexia-custom', get_template_directory_uri() . '/assets/css/custom.css', [  ], FLEXIA_VERSION );

        // Register theme stylesheet.
        wp_register_style(
            'flexia-style', get_template_directory_uri() . '/style.css', [  ], FLEXIA_VERSION
        );

        // Enqueue theme stylesheet.
        wp_enqueue_style( 'flexia-style' );
    }

endif;

add_action( 'wp_enqueue_scripts', 'flexia_styles' );

/**
 * Register block categories
 */
register_block_pattern_category(
    'flexia',
    [
        'label' => __( 'Flexia Patterns', 'flexia' )
     ]
);

register_block_pattern_category(
    'flexia-pages',
    [
        'label' => __( 'Flexia Pages', 'flexia' )
     ]
);

/**
 * Register block categories
 */
if ( ! function_exists( 'flexia_register' ) ):
    function flexia_register()
{
        /**
         * Register block styles
         */

        if ( function_exists( 'register_block_style' ) ) {
            register_block_style(
                'core/group',
                [
                    'name'       => 'flexia-hover-border',
                    'label'      => __( 'Hover Border', 'flexia' ),
                    'is_default' => false
                 ]

            );

            register_block_style(
                'core/group',
                [
                    'name'       => 'flexia-hover-shadow',
                    'label'      => __( 'Hover Shadow', 'flexia' ),
                    'is_default' => false
                 ]

            );

            register_block_style(
                'core/group',
                [
                    'name'       => 'flexia-sm-bg-shadow',
                    'label'      => __( 'Small BG Shadow', 'flexia' ),
                    'is_default' => false
                 ]

            );
            register_block_style(
                'core/cover',
                [
                    'name'       => 'flexia-team',
                    'label'      => __( 'Image Hover', 'flexia' ),
                    'is_default' => false
                 ]

            );

            register_block_style(
                'core/search',
                [
                    'name'         => 'flexia-minimal-search',
                    'label'        => __( 'Minimal', 'flexia' ),
                    'is_default'   => false,
                    'inline_style' => '
																																																															                    .is-style-flexia-minimal-search .wp-block-search__inside-wrapper{
																																																															                           height:auto;
																																																															                           padding:0px;
																																																															                        }

																																																															                        .is-style-flexia-minimal-search  .wp-block-search__inside-wrapper:hover{
																																																															                            box-shadow: 0px 9px 18px 0px rgba(0, 0, 0, 0.08);
																																																															                        }
																																																															                        .is-style-flexia-minimal-search .wp-block-search__button{
																																																															                            position:static;
																																																															                        }
																																																															                    '

                 ]

            );

            register_block_style(
                'core/button',
                [
                    'name'         => 'flexia-btn-inverse',
                    'label'        => __( 'Inverse', 'flexia' ),
                    'is_default'   => false,
                    'inline_style' => '
																																																															                    .is-style-flexia-btn-inverse .wp-block-button__link{
																																																															                           background:var(--wp--preset--color--white);
																																																															                           color:var(--wp--preset--color--black);
																																																															                           border-radius:inherit;
																																																															                        }

																																																															                        .is-style-flexia-btn-inverse  .wp-block-button__link:hover{
																																																															                            background:var(--wp--preset--color--primary);
																																																															                            color:var(--wp--preset--color--white);
																																																															                            border-radius:inherit;
																																																															                         }
																																																															                    '

                 ]
            );

            register_block_style(
                'core/button',
                [
                    'name'         => 'flexia-btn-theme',
                    'label'        => __( 'Primary', 'flexia' ),
                    'is_default'   => false,
                    'inline_style' => '
																																																															                        .is-style-flexia-btn-theme  .wp-block-button__link{
																																																															                            background:var(--wp--preset--color--primary);
																																																															                            color:var(--wp--preset--color--white);
																																																															                            border-radius:inherit;
																																																															                         }
																																																															                         .is-style-flexia-btn-theme .wp-block-button__link:hover{
																																																															                            background:var(--wp--preset--color--tertiary);
																																																															                            color:var(--wp--preset--color--black);
																																																															                            border-radius:inherit;
																																																															                         }

																																																															                    '

                 ]
            );

            register_block_style(
                'core/list',
                [
                    'name'         => 'flexia-checkmark-list',
                    'label'        => __( 'Checkmark', 'flexia' ),
                    'is_default'   => false,
                    'inline_style' => '
				                                                                                                                                                                                                                             ul.is-style-flexia-checkmark-list {
				                                                                                                                                                                                                                                    list-style-type: "\f15e";
				                                                                                                                                                                                                                                    padding-left:10px;
				                                                                                                                                                                                                                                }
				                                                                                                                                                                                                                                ul.is-style-flexia-checkmark-list li::marker{
				                                                                                                                                                                                                                                    font-family: "dashicons";
				                                                                                                                                                                                                                                }

				                                                                                                                                                                                                                                ul.is-style-flexia-checkmark-list li {
				                                                                                                                                                                                                                                    padding-inline-start: 1ch;
				                                                                                                                                                                                                                                }'
                 ]
            );

            register_block_style(
                'core/post-author',
                [
                    'name'       => 'flexia-author-rounded',
                    'label'      => __( 'Image Rounded', 'flexia' ),
                    'is_default' => false
                 ]
            );

            register_block_style(
                'core/separator',
                [
                    'name'         => 'flexia-separator-wide-thin-line',
                    'label'        => __( 'Wide Thin Line', 'flexia' ),
                    'inline_style' => '
																																																															                    .is-style-flexia-separator-wide-thin-line.wp-block-separator:not(.is-style-wide):not(.is-style-dots){
																																																															                            max-width: var(--wp--style--global--content-size);
																																																															                            width: 100%;
																																																															                            border-width: 1px;
																																																															                        }
																																																															                    '
                 ]
            );
            register_block_style(
                'core/social-links',
                [
                    'name'         => 'flexia-social-rounded',
                    'label'        => __( 'Rounded Icon', 'flexia' ),
                    'inline_style' => '
																																																															                    .is-style-flexia-social-rounded .wp-social-link{
																																																															                        border-radius: 8px;
																																																															                    }
																																																															                        .is-style-flexia-social-rounded .wp-social-link a:hover{
																																																															                            background:var(--wp--preset--color--primary)!important;
																																																															                            color:var(--wp--preset--color--white)!important;
																																																															                            border-radius: 8px;
																																																															                        }
																																																															                    '
                 ]
            );
        }
    }

    add_action( 'init', 'flexia_register' );
endif;

add_action( 'enqueue_block_assets', function (): void {
    wp_enqueue_style( 'dashicons' );
} );

//ACF Support
add_filter( 'acf/shortcode/allow_in_block_themes_outside_content', '__return_true' );

//Deactive flexia pro on switch theme
function flexiapro_deactive_on_update_fse()
{
    $current_version = wp_get_theme()->get( 'Version' );
    if ( version_compare( $current_version, '3.0.0', '==' ) ) {
        if ( ! function_exists( 'deactivate_plugins' ) ) {
            include ABSPATH . '/wp-admin/includes/plugin.php';
        }
        deactivate_plugins( 'flexia-pro/flexia-pro.php' );
    }
}

add_action( 'admin_init', 'flexiapro_deactive_on_update_fse' );
add_action( 'after_setup_theme', 'flexiapro_deactive_on_update_fse' );

require_once FLEXIA_DIR_PATH . '/includes/compatibility.php'; //Load compatibility file
