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
        'id' 			=> $prefix . 'flexia-metabox',
        'title' 		=> esc_html__('Flexia Settings', 'flexia'),
        'object_types' 	=> array( 'page' ), // Post type
        'context'       => 'side',
        // 'priority' 		=> 'high',
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
			'flexia_core_page_header_default' 	  => esc_html__( 'Default Header ( Customizer )', 'flexia' ),
            'flexia_core_page_header_large'       => esc_html__( 'Large Header', 'flexia' ),
            'flexia_core_page_header_mini'        => esc_html__( 'Mini Header', 'flexia' ),
			'flexia_core_page_header_none'        => esc_html__( 'No Header', 'flexia' ),
		),
	) );

}
// add_action( 'cmb2_admin_init', 'flexia_register_page_metaboxs' );


//Register Meta Box
function flexia_register_page_meta_box() {
    $prefix = '_flexia_meta_key_';
    add_meta_box( 
        'flexia-page-meta-box',
        esc_html__('Flexia Settings', 'flexia'), 
        'flexia_page_meta_box_callback', 
        'page', 
        'side', 
        'high' 
    );
}
add_action( 'add_meta_boxes', 'flexia_register_page_meta_box');
 
//Display Fileds
function flexia_page_meta_box_callback( $meta_id ) {

    wp_nonce_field( 'flexia_metabox_nonce', 'flexia_meta_value_nonce' );
 
    $html = '<div class="flexia_metaboxs">';

    //Page Additional Body Class
    $html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_body_class">'. esc_html__('Additional Body Class', 'flexia') .'</label>';
    $body_class = get_post_meta( $meta_id->ID, '_flexia_meta_key_body_class', true );
    $html .= '<input type="text" name="flexia_body_class" id="flexia_body_class" class="flexia_body_class" value="'. esc_attr($body_class) .'" />';
    $html .= '</div>';

    //Page Header Option    
    $page_header = get_post_meta( $meta_id->ID, '_flexia_meta_key_page_header', true );
    $html .= 'Header: ' . ($page_header == "flexia_core_page_header_large") ? "selected" : "null";
    $html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_page_header">'. esc_html__('Page Header', 'flexia') .'</label>';
    $html .= '<select name="flexia_page_header" id="flexia_page_header">';

    $selected = ($page_header == "flexia_core_page_header_default") ? "selected" : null;
    $html .= '<option value="flexia_core_page_header_default" ' . $selected . '>'. esc_html__('Default Header ( Customizer )', 'flexia') .'</option>';

    $selected = ($page_header == "flexia_core_page_header_large") ? "selected" : null;
    $html .= '<option value="flexia_core_page_header_large" ' . $selected . '>'. esc_html__('Large Header', 'flexia') .'</option>';

    $selected = ($page_header == "flexia_core_page_header_mini") ? "selected" : null;
    $html .= '<option value="flexia_core_page_header_mini" ' . $selected . '>'. esc_html__('Mini Header', 'flexia') .'</option>';

    $selected = ($page_header == "flexia_core_page_header_none") ? "selected" : null;
    $html .= '<option value="flexia_core_page_header_none" ' . $selected . '>'. esc_html__('No Header', 'flexia') .'</option>';
    
    $html .= '</select>';
    $html .= '</div>';


    $html .= '</div>';
 
    echo $html;
}

//Save Metabox Values
function save_flexia_metabox( $post_id ) {
 
    if( !isset( $_POST['flexia_meta_value_nonce'] ) || !wp_verify_nonce( $_POST['flexia_meta_value_nonce'],'flexia_metabox_nonce') ) {
        return;
    }
 
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
 
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
 
    if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
 
        if (isset($_POST['flexia_body_class']) ) { 
            update_post_meta($post_id, '_flexia_meta_key_body_class', sanitize_html_class($_POST['flexia_body_class']) );
        }

        if (isset($_POST['flexia_page_header']) ) { 
            update_post_meta($post_id, '_flexia_meta_key_page_header', sanitize_text_field($_POST['flexia_page_header']) );
        }
 
    }
     
}
add_action( 'save_post', 'save_flexia_metabox' );