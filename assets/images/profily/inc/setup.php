<?php
/*
 * Disallow direct access
 */
if( !defined( 'ABSPATH' ) ) {
    die( 'Forbidden.' );
}


if ( ! function_exists( 'profily_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since profily 1.0
	 *
	 * @return void
	 */
	function profily_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

        // Custom styling
		add_editor_style( 'assets/css/styles.css' );

	}

endif;

add_action( 'after_setup_theme', 'profily_support' );

// Dashicon Support

add_action('enqueue_block_assets', function (): void {
    wp_enqueue_style('dashicons');
});


if ( ! function_exists( 'profily_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since profily 1.0
	 *
	 * @return void
	 */
	function profily_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;

		wp_register_style(
			'profily-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'profily-style' );


		wp_enqueue_style( 'profily-custom-styles', get_template_directory_uri() . '/assets/css/styles.css', __FILE__ );
        
		wp_enqueue_style( 'profily-default-block-styles', get_template_directory_uri() . '/assets/css/blocks.css', __FILE__ );

		wp_enqueue_script( 'profily-custom', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), 1.1, true);

	}

endif;

add_action( 'wp_enqueue_scripts', 'profily_styles' );



/**
 * Register block categories
 */

register_block_pattern_category(
    'profily-patterns',
    [ 
        'label' => __( 'Profily Patterns', 'profily' )
    ]
);
register_block_pattern_category(
    'profily-pages',
    [ 
        'label' => __( 'Profily Pages', 'profily' )
    ]
);



// Add block patterns
require get_template_directory() . '/inc/profily-block-patterns.php';


/**
 * Register block categories
 */
if( !function_exists( 'profily_register' ) ) :
    function profily_register() {

        /**
         * Register block styles
         */
        if( function_exists( 'register_block_style' ) ) {
            
            register_block_style(
                'core/post-terms',
                [
                    'name'         => 'dots',
                    'label'        => __( 'Dot Seperators', 'profily' ),
                    'is_default'   => false,
                ]
            );

            register_block_style(
                'core/post-terms',
                [
                    'name'         => 'boxes',
                    'label'        => __( 'Boxes', 'profily' ),
                    'is_default'   => false,
                ]
            );



            register_block_style(
                'core/button',
                array(
                    'name'         => PROFILY_PFX . '-button-inverse',
                    'label'        => __( 'Inverse', 'profily' ),
                    'inline_style' => '
                        div.is-style-' . PROFILY_PFX . '-button-inverse .wp-element-button {
                            color: #1F2937;
                            background: #fff;
                        }

                        div.is-style-' . PROFILY_PFX . '-button-inverse .wp-element-button:hover {
                            color: #1F2937;
                            background: #fff;
                        }
                    ',
                )
            );


            register_block_style(
                'core/list',
                [
                    'name'         => PROFILY_PFX . '-checkmark-list',
                    'label'        => __( 'Checkmark', 'profily' ),
                    'is_default'   => false,
                    'inline_style' => '
                        ul.is-style-'.PROFILY_PFX.'-checkmark-list {
                            list-style-type: "\f15e";
                            padding-left:10px!important;
                        }
                        ul.is-style-'.PROFILY_PFX.'-checkmark-list li::marker{
                            font-family: "dashicons";
                        }

                        ul.is-style-'.PROFILY_PFX.'-checkmark-list li {
                            padding-inline-start: 1ch;
                        }
                        ',
                ]
            );

            register_block_style(
                'core/group',
                [
                    'name'         => PROFILY_PFX . '-hover-box',
                    'label'        => __( 'Hover Box', 'profily' ),
                    'is_default'   => false,
                    'inline_style' => '
                        .is-style-'.PROFILY_PFX.'-hover-box{
                            transition: all .4s ease ;
                            border: 1px solid transparent;
                            border-radius: 8px;
                        }

                        .is-style-'.PROFILY_PFX.'-hover-box .wp-block-group{
                            display:inline-block;

                        }
                        
                        .is-style-'.PROFILY_PFX.'-hover-box:hover{
                            background: var(--wp--preset--color--base);
                            box-shadow: 0px 20px 40px 0px rgba(0,0,0,0.04);
                            border: 1px solid var(--wp--preset--color--contrast-5);
                        }

                        ',
                ]
            );

            register_block_style(
                'core/post-author',
                [
                    'name'         => 'large',
                    'label'        => __( 'Large', 'profily' ),
                    'is_default'   => false,
                ]
            );

            register_block_style(
                'core/post-navigation-link',
                [
                    'name'         => 'button',
                    'label'        => __( 'Button', 'profily' ),
                    'is_default'   => false,
                ]
            );
            register_block_style(
                'core/cover',
                [
                    'name'         => 'hover',
                    'label'        => __( 'Hover', 'profily' ),
                    'is_default'   => false,
                ]
            );
            register_block_style(
                'core/button',
                [
                    'name'         => 'hover',
                    'label'        => __( 'Hover', 'profily' ),
                    'is_default'   => false,
                ]
            );

            register_block_style(
                'core/navigation',
                [
                    'name'         => 'standard',
                    'label'        => __( 'Standard', 'profily' ),
                    'is_default'   => false,
                ]
            );

            register_block_style(
                'core/query-pagination-previous',
                [
                    'name'         => 'button',
                    'label'        => __( 'Button', 'profily' ),
                    'is_default'   => false,
                ]
            );

            register_block_style(
                'core/query-pagination-next',
                [
                    'name'         => 'button',
                    'label'        => __( 'Button', 'profily' ),
                    'is_default'   => false,
                ]
            );

            register_block_style(
                'core/search',
                [
                    'name'         => 'border-with-radius',
                    'label'        => __( 'Border & Radius', 'profily' ),
                    'is_default'   => false,
                ]
            );

            register_block_style(
                'core/image',
                [
                    'name'         => 'hover-zoom',
                    'label'        => __( 'Hover Zoom', 'profily' ),
                ]
            );

            register_block_style(
                'core/comment-template',
                [
                    'name'         => 'replies-bg',
                    'label'        => __( 'Replies with BG', 'profily' ),
                ]
            );
            

            register_block_style(
                'core/social-links',
                [
                    'name'         => 'logos-border',
                    'label'        => __( 'With Border', 'profily' ),
                ]
            );

            register_block_style(
                'core/social-links',
                [
                    'name'         => 'logos-only-small',
                    'label'        => __( 'Logos Only Small', 'profily' ),
                ]
            );
        }
    }
    add_action( 'init', 'profily_register' );
endif;

