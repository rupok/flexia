<?php

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
	
	$prefix = '_flexia_post_meta_key_';
 
    $html = '<div class="flexia_metaboxs">';

    //Page Additional Body Class
    $html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_body_class">'. esc_html__('Additional Body Class', 'flexia') .'</label>';
    $body_class = get_post_meta( $meta_id->ID, $prefix . 'body_class', true );
    $html .= '<input type="text" name="flexia_body_class" id="flexia_body_class" class="flexia_body_class" value="'. esc_attr($body_class) .'" />';
	$html .= '</div>';
	
	
    //Page Header Option    
	$post_layout = get_post_meta( $meta_id->ID, $prefix . 'page_title', true );
	
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
	

	
    //Show Header Meta
	$header_meta = get_post_meta( $meta_id->ID, $prefix . 'header_meta', true );
	$html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_header_meta">'. esc_html__('Show Header Meta', 'flexia') .'</label>';
    $html .= '<select name="flexia_header_meta" id="flexia_header_meta">';

    $selected = ($header_meta == "yes") ? "selected" : null;
    $html .= '<option value="yes" ' . $selected . '>'. esc_html__('Yes', 'flexia') .'</option>';

    $selected = ($header_meta == "no") ? "selected" : null;
    $html .= '<option value="no" ' . $selected . '>'. esc_html__('No', 'flexia') .'</option>';
    
    $html .= '</select>';
	$html .= '</div>';


	//Show Post Author
	$post_author = get_post_meta( $meta_id->ID, $prefix . 'header_author_meta', true );
	$html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_post_author">'. esc_html__('Show Post Author', 'flexia') .'</label>';
    $html .= '<select name="flexia_post_author" id="flexia_post_author">';

    $selected = ($post_author == "yes") ? "selected" : null;
    $html .= '<option value="yes" ' . $selected . '>'. esc_html__('Yes', 'flexia') .'</option>';

    $selected = ($post_author == "no") ? "selected" : null;
    $html .= '<option value="no" ' . $selected . '>'. esc_html__('No', 'flexia') .'</option>';
    
    $html .= '</select>';
	$html .= '</div>';


	//Show Post Date
	$post_date = get_post_meta( $meta_id->ID, $prefix . 'header_post_date', true );
	$html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_post_date">'. esc_html__('Show Post Date', 'flexia') .'</label>';
    $html .= '<select name="flexia_post_date" id="flexia_post_date">';

    $selected = ($post_date == "yes") ? "selected" : null;
    $html .= '<option value="yes" ' . $selected . '>'. esc_html__('Yes', 'flexia') .'</option>';

    $selected = ($post_date == "no") ? "selected" : null;
    $html .= '<option value="no" ' . $selected . '>'. esc_html__('No', 'flexia') .'</option>';
    
    $html .= '</select>';
	$html .= '</div>';


	//Show Post Category
	$post_category = get_post_meta( $meta_id->ID, $prefix . 'header_post_category', true );
	$html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_post_category">'. esc_html__('Show Post Category', 'flexia') .'</label>';
    $html .= '<select name="flexia_post_category" id="flexia_post_category">';

    $selected = ($post_category == "yes") ? "selected" : null;
    $html .= '<option value="yes" ' . $selected . '>'. esc_html__('Yes', 'flexia') .'</option>';

    $selected = ($post_category == "no") ? "selected" : null;
    $html .= '<option value="no" ' . $selected . '>'. esc_html__('No', 'flexia') .'</option>';
    
    $html .= '</select>';
	$html .= '</div>'; 


	//Show Post Comments Count
	$post_comment_count = get_post_meta( $meta_id->ID, $prefix . 'header_post_comments', true );
	$html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_post_comment_count">'. esc_html__('Show Post Comments Count', 'flexia') .'</label>';
    $html .= '<select name="flexia_post_comment_count" id="flexia_post_comment_count">';

    $selected = ($post_comment_count == "yes") ? "selected" : null;
    $html .= '<option value="yes" ' . $selected . '>'. esc_html__('Yes', 'flexia') .'</option>';

    $selected = ($post_comment_count == "no") ? "selected" : null;
    $html .= '<option value="no" ' . $selected . '>'. esc_html__('No', 'flexia') .'</option>';
    
    $html .= '</select>';
	$html .= '</div>';


	//Show Footer Meta
	$post_footer_meta = get_post_meta( $meta_id->ID, $prefix . 'footer_meta', true );
	$html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_post_footer_meta">'. esc_html__('Show Footer Meta', 'flexia') .'</label>';
    $html .= '<select name="flexia_post_footer_meta" id="flexia_post_footer_meta">';

    $selected = ($post_footer_meta == "yes") ? "selected" : null;
    $html .= '<option value="yes" ' . $selected . '>'. esc_html__('Yes', 'flexia') .'</option>';

    $selected = ($post_footer_meta == "no") ? "selected" : null;
    $html .= '<option value="no" ' . $selected . '>'. esc_html__('No', 'flexia') .'</option>';
    
    $html .= '</select>';
	$html .= '</div>';


	//Show Social Share
	$post_sharer = get_post_meta( $meta_id->ID, $prefix . 'post_sharer', true );
	$html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_post_sharer">'. esc_html__('Show Social Sharer', 'flexia') .'</label>';
    $html .= '<select name="flexia_post_sharer" id="flexia_post_sharer">';

    $selected = ($post_sharer == "yes") ? "selected" : null;
    $html .= '<option value="yes" ' . $selected . '>'. esc_html__('Yes', 'flexia') .'</option>';

    $selected = ($post_sharer == "no") ? "selected" : null;
    $html .= '<option value="no" ' . $selected . '>'. esc_html__('No', 'flexia') .'</option>';
    
    $html .= '</select>';
	$html .= '</div>';


	//Show Post Navigation
	$post_navigation = get_post_meta( $meta_id->ID, $prefix . 'post_navigation', true );
	$html .= '<div class="flexia_metabox_item">';
    $html .= '<label for="flexia_post_navigation">'. esc_html__('Show Post Navigation', 'flexia') .'</label>';
    $html .= '<select name="flexia_post_navigation" id="flexia_post_navigation">';

    $selected = ($post_navigation == "yes") ? "selected" : null;
    $html .= '<option value="yes" ' . $selected . '>'. esc_html__('Yes', 'flexia') .'</option>';

    $selected = ($post_navigation == "no") ? "selected" : null;
    $html .= '<option value="no" ' . $selected . '>'. esc_html__('No', 'flexia') .'</option>';
    
    $html .= '</select>';
	$html .= '</div>';


    $html .= '</div>';
 
    echo $html;
}

//Save Metabox Values
function save_flexia_post_metabox( $post_id ) {

	$prefix = '_flexia_post_meta_key_';
 
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
            update_post_meta($post_id, $prefix . 'body_class', sanitize_html_class($_POST['flexia_body_class']) );
        }

        if (isset($_POST['flexia_post_layout']) ) { 
            update_post_meta($post_id, $prefix . 'page_title', sanitize_text_field($_POST['flexia_post_layout']) );
        }

        if (isset($_POST['flexia_header_meta']) ) { 
            update_post_meta($post_id, $prefix . 'header_meta', sanitize_text_field($_POST['flexia_header_meta']) );
		}

		if (isset($_POST['flexia_post_author']) ) { 
			update_post_meta($post_id, $prefix . 'header_author_meta', sanitize_text_field($_POST['flexia_post_author']) );
		}

        if (isset($_POST['flexia_post_date']) ) { 
            update_post_meta($post_id, $prefix . 'header_post_date', sanitize_text_field($_POST['flexia_post_date']) );
        }

        if (isset($_POST['flexia_post_category']) ) { 
            update_post_meta($post_id, $prefix . 'header_post_category', sanitize_text_field($_POST['flexia_post_category']) );
        }

        if (isset($_POST['flexia_post_comment_count']) ) { 
            update_post_meta($post_id, $prefix . 'header_post_comments', sanitize_text_field($_POST['flexia_post_comment_count']) );
        }

        if (isset($_POST['flexia_post_footer_meta']) ) { 
            update_post_meta($post_id, $prefix . 'footer_meta', sanitize_text_field($_POST['flexia_post_footer_meta']) );
        }

        if (isset($_POST['flexia_post_sharer']) ) { 
            update_post_meta($post_id, $prefix . 'post_sharer', sanitize_text_field($_POST['flexia_post_sharer']) );
        }

        if (isset($_POST['flexia_post_navigation']) ) { 
            update_post_meta($post_id, $prefix . 'post_navigation', sanitize_text_field($_POST['flexia_post_navigation']) );
        }
 
    }
     
}
add_action( 'save_post', 'save_flexia_post_metabox' );