<?php

$fields = array(
    'mega-menu' => __('Mega Menu', 'flexia'),
);

if (!class_exists(Walker_Nav_Menu_Edit)) {
    require_once ABSPATH . 'wp-admin/includes/class-walker-nav-menu-edit.php';
}

class Flexia_Edit_Nav_Menu_Walker extends Walker_Nav_Menu_Edit
{
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $item_output = '';
        parent::start_el($item_output, $item, $depth, $args, $id);

        $output .= preg_replace(
            '/(?=<(fieldset|p)[^>]+class="[^"]*field-move)/',
            $this->get_fields($item, $depth, $args),
            $item_output
        );
    }

    protected function get_fields($item, $depth, $args = array(), $id = 0)
    {
        ob_start();
        do_action('flexia_nav_menu_item_extra_fields', $item->ID, $item, $depth, $args, $id);
        return ob_get_clean();
    }
}

add_filter('wp_edit_nav_menu_walker', function () {
    return 'Flexia_Edit_Nav_Menu_Walker';
});

function flexia_nav_item_inject_fields($id, $item, $depth, $args)
{
    if ($depth > 0) {
        return;
    }

    global $fields;

    foreach ($fields as $_key => $label) {
        $key = esc_attr(sprintf('menu-item-%s', $_key));
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

function flexia_nav_menu_item_update($menu_id, $menu_item_db_id, $menu_item_args)
{
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    check_admin_referer('update-nav_menu', 'update-nav-menu-nonce');

    global $fields;

    foreach ($fields as $_key => $label) {
        $key = sprintf('menu-item-%s', $_key);

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
