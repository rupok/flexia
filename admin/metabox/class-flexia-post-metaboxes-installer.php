<?php
/**
 * This function will create custom metaboxes into post page.
 */
function flexia_register_post_metaboxs() {
    $prefix = '_flexia_post_meta_key_';

    /**
     * Flexia Post Metaboxes
     */
    $cmb_post = new_cmb2_box(array(
        'id' => $prefix . 'metaboxs',
        'title' => esc_html__('Flexia Post Settings', 'flexia'),
        'object_types' => array('post'), // Post type
        'priority' => 'high',
    ));
    /**
     * Additional Body Class
     */
    $cmb_post->add_field(array(
        'name' => esc_html__('Additional Body Class', 'flexia'),
        'desc' => esc_html__('Add an extra class to body for this post.', 'flexia'),
        'id' => $prefix . 'body_class',
        'type' => 'text',
    ));
    /**
     * Post Page Title
     */
    $cmb_post->add_field( array(
		'name'             => esc_html__( 'Post Layout', 'flexia' ),
		'desc'             => esc_html__( 'Set individual layout for this post.', 'flexia' ),
		'id'               => $prefix . 'page_title',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array(
			'default' 	=> esc_html__( 'Default (from Customizer)', 'flexia' ),
			'large'   	=> esc_html__( 'Large Header (Featured Image Background)', 'flexia' ),
			'simple'    => esc_html__( 'Simple Header', 'flexia' ),
			'simple_no_container'    => esc_html__( 'Simple Header No Container', 'flexia' ),
			'none'      => esc_html__( 'No Header', 'flexia' ),
		),
	) );
	/**
     * Show Header Neta
     */
    $cmb_post->add_field( array(
		'name'             => esc_html__( 'Show Header Meta', 'flexia' ),
		'desc'             => esc_html__( 'Show or hide the header meta (post date, post category, post comments).', 'flexia' ),
		'id'               => $prefix . 'header_meta',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array(
			'yes' 	=> esc_html__( 'Yes', 'flexia' ),
			'no'   	=> esc_html__( 'No', 'flexia' ),
		),
	) );
	/**
     * Show Post Author
     */
    $cmb_post->add_field( array(
		'name'             => esc_html__( 'Show Post Author', 'flexia' ),
		'desc'             => esc_html__( 'Show or hide the post author.', 'flexia' ),
		'id'               => $prefix . 'header_author_meta',
		'classes'		   => 'js-flexia-core-alter',
		'type'             => 'select',
		'show_option_none' => false,
		// 'show_on_cb'	   => 'flexia_show_if_header_meta_active',
		'options'          => array(
			'yes' 	=> esc_html__( 'Yes', 'flexia' ),
			'no'   	=> esc_html__( 'No', 'flexia' ),
		),
	) );
	/**
     * Show Post Date
     */
    $cmb_post->add_field( array(
		'name'             => esc_html__( 'Show Post Date', 'flexia' ),
		'desc'             => esc_html__( 'Show or hide the post date.', 'flexia' ),
		'id'               => $prefix . 'header_post_date',
		'classes'		   => 'js-flexia-core-alter',
		'type'             => 'select',
		'show_option_none' => false,
		// 'show_on_cb'	   => 'flexia_show_if_header_meta_active',
		'options'          => array(
			'yes' 	=> esc_html__( 'Yes', 'flexia' ),
			'no'   	=> esc_html__( 'No', 'flexia' ),
		),
	) );
	/**
     * Show Post Category
     */
    $cmb_post->add_field( array(
		'name'             => esc_html__( 'Show Post Category', 'flexia' ),
		'desc'             => esc_html__( 'Show or hide the post category.', 'flexia' ),
		'id'               => $prefix . 'header_post_category',
		'classes'		   => 'js-flexia-core-alter',
		'type'             => 'select',
		'show_option_none' => false,
		// 'show_on_cb'	   => 'flexia_show_if_header_meta_active',
		'options'          => array(
			'yes' 	=> esc_html__( 'Yes', 'flexia' ),
			'no'   	=> esc_html__( 'No', 'flexia' ),
		),
	) );
	/**
     * Show Post Comments Count
     */
    $cmb_post->add_field( array(
		'name'             => esc_html__( 'Show Post Comments Count', 'flexia' ),
		'desc'             => esc_html__( 'Show or hide post comments count.', 'flexia' ),
		'id'               => $prefix . 'header_post_comments',
		'classes'		   => 'js-flexia-core-alter',
		'type'             => 'select',
		'show_option_none' => false,
		// 'show_on_cb'	   => 'flexia_show_if_header_meta_active',
		'options'          => array(
			'yes' 	=> esc_html__( 'Yes', 'flexia' ),
			'no'   	=> esc_html__( 'No', 'flexia' ),
		),
	) );
	/**
     * Show Footer Meta
     */
    $cmb_post->add_field( array(
		'name'             => esc_html__( 'Show Footer Meta', 'flexia' ),
		'desc'             => esc_html__( 'Show or hide the footer meta (author info).', 'flexia' ),
		'id'               => $prefix . 'footer_meta',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array(
			'yes' 	=> esc_html__( 'Yes', 'flexia' ),
			'no'   	=> esc_html__( 'No', 'flexia' ),
		),
	) );
	/**
     * Show Footer Meta
     */
    $cmb_post->add_field( array(
		'name'             => esc_html__( 'Show Social Sharer', 'flexia' ),
		'desc'             => esc_html__( 'Show or hide the the post social sharing options.', 'flexia' ),
		'id'               => $prefix . 'post_sharer',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array(
			'yes' 	=> esc_html__( 'Yes', 'flexia' ),
			'no'   	=> esc_html__( 'No', 'flexia' ),
		),
	) );
	/**
     * Show Post Navigation
     */
    $cmb_post->add_field( array(
		'name'             => esc_html__( 'Show Post Navigation', 'flexia' ),
		'desc'             => esc_html__( 'Show or hide the next/previous post navigation.', 'flexia' ),
		'id'               => $prefix . 'post_navigation',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array(
			'yes' 	=> esc_html__( 'Yes', 'flexia' ),
			'no'   	=> esc_html__( 'No', 'flexia' ),
		),
	) );

}
add_action( 'cmb2_admin_init', 'flexia_register_post_metaboxs' );

/**
 * Show specific fields if header_meta is set to "yes"
 */
function flexia_show_if_header_meta_active( $cmb_post ) {
	$status = get_post_meta( $cmb_post->object_id(), '_flexia_post_meta_key_header_meta', true );
	// Only show if status is 'external'
	return 'yes' === $status;
}