<?php
/**
 * This function will generate custom metaboxes into the pages
 */
function flexia_register_page_metaboxs() {
    $prefix = '_flexia_meta_key_';

    /**
     * Flexia Post Metaboxes
     */
    $cmb_post = new_cmb2_box(array(
        'id' 			=> $prefix . 'flexia-metaboxs',
        'title' 		=> esc_html__('Flexia Settings', 'flexia'),
        'object_types' 	=> array( 'page' ), // Post type
        'context'       => 'side',
        'priority' 		=> 'high',
    ));
    /**
     * Additional Body Class
     */
    $cmb_post->add_field(array(
        'name' 			=> esc_html__('Additional Body Class', 'flexia'),
        'desc' 			=> esc_html__('Add an extra class to body for this post.', 'flexia'),
        'id' 			=> $prefix . 'body_class',
        'type' 			=> 'text',
    ));
	/**
     * Show Page Title
     */
    $cmb_post->add_field( array(
		'name'             => esc_html__( 'Page Header', 'flexia' ),
		'desc'             => esc_html__( 'Choose page header.', 'flexia' ),
		'id'               => $prefix . 'page_header',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array(
			'flexia_core_page_header_default' 	  => esc_html__( 'Default Header ( From Customizer )', 'flexia' ),
            'flexia_core_page_header_large'       => esc_html__( 'Large Header', 'flexia' ),
            'flexia_core_page_header_mini'        => esc_html__( 'Mini Header', 'flexia' ),
			'flexia_core_page_header_none'        => esc_html__( 'No Header', 'flexia' ),
		),
	) );

}
add_action( 'cmb2_admin_init', 'flexia_register_page_metaboxs' );