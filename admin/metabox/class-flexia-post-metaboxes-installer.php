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
        'context'       => 'side',
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
// add_action( 'cmb2_admin_init', 'flexia_register_post_metaboxs' );

/**
 * Show specific fields if header_meta is set to "yes"
 */
function flexia_show_if_header_meta_active( $cmb_post ) {
	$status = get_post_meta( $cmb_post->object_id(), '_flexia_post_meta_key_header_meta', true );
	// Only show if status is 'external'
	return 'yes' === $status;
}

//---------------------------------------------------------------
//Register Meta Box
function flexia_register_post_meta_box() {
    $prefix = '_flexia_meta_key_';
    add_meta_box( 
        'flexia-post-meta-box',
        esc_html__('Flexia Settings', 'flexia'), 
        'flexia_post_meta_box_callback', 
        'post', 
        'side', 
        'high' 
    );
}
add_action( 'add_meta_boxes', 'flexia_register_post_meta_box');
 
//Display Fileds
function flexia_post_meta_box_callback( $meta_id ) {

    wp_nonce_field( 'flexia_metabox_nonce', 'flexia_meta_value_nonce' );
 
    $html = '<div class="flexia_metaboxs">';

    //Page Additional Body Class
    $html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_body_class">'. esc_html__('Additional Body Class', 'flexia') .'</label>';
    $body_class = get_post_meta( $meta_id->ID, '_flexia_post_meta_key_body_class', true );
    $html .= '<input type="text" name="flexia_body_class" id="flexia_body_class" class="flexia_body_class" value="'. esc_attr($body_class) .'" />';
	$html .= '</div>';
	
	
    //Page Header Option    
	$post_layout = get_post_meta( $meta_id->ID, '_flexia_post_meta_key_page_title', true );
	
    $html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_post_layout">'. esc_html__('Post Layout', 'flexia') .'</label>';
    $html .= '<select name="flexia_post_layout" id="flexia_post_layout">';

    $selected = ($post_layout == "default") ? "selected" : null;
    $html .= '<option value="default" ' . $selected . '>'. esc_html__('Default (from Customizer)', 'flexia') .'</option>';

    $selected = ($post_layout == "large") ? "selected" : null;
    $html .= '<option value="large" ' . $selected . '>'. esc_html__('Large Header (Featured Image Background)', 'flexia') .'</option>';

    $selected = ($post_layout == "simple") ? "selected" : null;
    $html .= '<option value="simple" ' . $selected . '>'. esc_html__('Simple Header', 'flexia') .'</option>';

    $selected = ($post_layout == "simple_no_container") ? "selected" : null;
	$html .= '<option value="simple_no_container" ' . $selected . '>'. esc_html__('Simple Header No Container', 'flexia') .'</option>';
	
    $selected = ($post_layout == "none") ? "selected" : null;
    $html .= '<option value="none" ' . $selected . '>'. esc_html__('No Header', 'flexia') .'</option>';
    
    $html .= '</select>';
    $html .= '</div>';


    $html .= '</div>';
 
    echo $html;
}

//Save Metabox Values
function save_flexia_post_metabox( $post_id ) {
 
    if( !isset( $_POST['flexia_meta_value_nonce'] ) || !wp_verify_nonce( $_POST['flexia_meta_value_nonce'],'flexia_metabox_nonce') ) {
        return;
    }
 
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
 
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
 
    if ( isset( $_POST['post_type'] ) && 'post' === $_POST['post_type'] ) {
 
        if (isset($_POST['flexia_body_class']) ) { 
            update_post_meta($post_id, '_flexia_post_meta_key_body_class', sanitize_html_class($_POST['flexia_body_class']) );
        }

        if (isset($_POST['flexia_post_layout']) ) { 
            update_post_meta($post_id, '_flexia_post_meta_key_page_title', sanitize_text_field($_POST['flexia_post_layout']) );
        }
 
    }
     
}
add_action( 'save_post', 'save_flexia_post_metabox' );