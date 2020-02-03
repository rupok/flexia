<?php

if (!class_exists('Walker_Nav_Menu_Edit')) {
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
