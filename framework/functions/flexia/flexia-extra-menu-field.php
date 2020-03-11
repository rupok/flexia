<?php

$fields = array(
    'mega-menu' => __('Flexia Mega Menu', 'flexia'),
);

$widget_fields = array(
    'mega-menu-widget' => __('Select Widget for Mega Menu', 'flexia'),
);

function flexia_nav_item_inject_fields($id, $item, $depth, $args)
{
    if ($depth > 0) {
        return;
    }

    global $fields;

    foreach ($fields as $_key => $label) {
        $key = esc_attr(sprintf('flexia-menu-item-%s', $_key));
        $id = esc_attr(sprintf('edit-%s-%s', $key, $item->ID));
        $name = esc_attr(sprintf('%s[%s]', $key, $item->ID));
        $value = esc_attr(get_post_meta($item->ID, $key, true));
        $class = esc_attr(sprintf('field-%s', $_key));        

        echo '<p class="description description-wide ' . $class . '">
			<label for="' . $id . '">' . esc_html($label) . '<br />
				<select id="' . $id . '" class="widefat ' . $id . '" name="' . $name . '" value="' . $value . '">
					<option value="" ' . ($value == '' ? 'selected' : '') . '>Disable</option>
					<option value="3-col" ' . ($value == '3-col' ? 'selected' : '') . '>3 Column</option>
					<option value="4-col" ' . ($value == '4-col' ? 'selected' : '') . '>4 Column</option>
					<option value="5-col" ' . ($value == '5-col' ? 'selected' : '') . '>5 Column</option>
					<option value="6-col" ' . ($value == '6-col' ? 'selected' : '') . '>6 Column</option>
				</select>
			</label>
		</p>';
    }
}
add_action('flexia_nav_menu_item_extra_fields', 'flexia_nav_item_inject_fields', 10, 4);

/**
 * Add Option to Select Widget in Mega Menu
 */
function flexia_megamenu_inject_widget_select_option($id, $item, $depth, $args)
{
    if ($depth == 1) {
        if ( !empty(get_post_meta($item->menu_item_parent, 'flexia-menu-item-mega-menu', true) ) ) {
            
        }
        global $widget_fields;
        foreach ($widget_fields as $_key => $label) {
            $key = esc_attr(sprintf('flexia-menu-item-%s', $_key));
            $id = esc_attr(sprintf('edit-%s-%s', $key, $item->ID));
            $name = esc_attr(sprintf('%s[%s]', $key, $item->ID));
            $value = esc_attr(get_post_meta($item->ID, $key, true));
            $class = esc_attr(sprintf('field-%s', $_key));

            $output = '<p class="description description-wide ' . $class . '">';
            $output .= '<label for="' . $id . '">' . esc_html($label) . '<br />';
            $output .= '<select id="' . $id . '" class="widefat ' . $id . '" name="' . $name . '" value="' . $value . '">';
            $output .= '<option value="" ' . ($value == '' ? 'selected' : '') . '>Disable</option>';
            foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
                $output .= '<option value="'. $sidebar['id'] .'" '. ($value ==  $sidebar['id'] ? 'selected' : '') . '>'.ucwords( $sidebar['name'] ).'</option>';
            }            
            $output .= '</select>';
            $output .= '</label>';
            $output .= ' </p>';

            echo wp_kses_post($output);
        }  
    }   
}
add_action('flexia_nav_menu_item_extra_fields', 'flexia_megamenu_inject_widget_select_option', 10, 4);

function flexia_nav_menu_item_update($menu_id, $menu_item_db_id, $menu_item_args)
{
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    check_admin_referer('update-nav_menu', 'update-nav-menu-nonce');

    global $fields;

    foreach ($fields as $_key => $label) {
        $key = sprintf('flexia-menu-item-%s', $_key);

        // Sanitize
        if (!empty($_POST[$key][$menu_item_db_id])) {
            // Do some checks here...
            $value = $_POST[$key][$menu_item_db_id];
        } else {
            $value = null;
        }

        // Update
        if (!is_null($value)) {
            update_post_meta($menu_item_db_id, $key, $value);
        } else {
            delete_post_meta($menu_item_db_id, $key);
        }
    }

    global $widget_fields;
    foreach ($widget_fields as $_key => $label) {
        $key = sprintf('flexia-menu-item-%s', $_key);

        // Sanitize
        if (!empty($_POST[$key][$menu_item_db_id])) {
            // Do some checks here...
            $value = $_POST[$key][$menu_item_db_id];
        } else {
            $value = null;
        }

        // Update
        if (!is_null($value)) {
            update_post_meta($menu_item_db_id, $key, $value);
        } else {
            delete_post_meta($menu_item_db_id, $key);
        }
    }
}
add_action('wp_update_nav_menu_item', 'flexia_nav_menu_item_update', 10, 3);

function flexia_nav_menu_columns($columns)
{
    global $fields;

    $columns = array_merge($columns, $fields);
    return $columns;
}
add_filter('manage_nav-menus_columns', 'flexia_nav_menu_columns', 99);
