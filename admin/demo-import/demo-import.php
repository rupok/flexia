<?php

function flexia_import_files()
{
  return array(
    array(
      'import_index'               => '1',
      'import_file_name'           => 'Flexia Demo 1',
      'categories'                 => array('elementor', 'templately'),
      'import_file_url'            => 'http://fencermonir.com/flexia-demo/flexiapro.xml',
      'import_widget_file_url'     => 'http://fencermonir.com/flexia-demo/flexia-widgets.wie',
      'import_customizer_file_url' => 'http://fencermonir.com/flexia-demo/flexia-export.dat',
      // 'import_redux'               => array(
      //   array(
      //     'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
      //     'option_name' => 'flexia',
      //   ),
      // ),
      'import_preview_image_url'   => 'https://items.templately.com/item-2cc2f48160faa9673d017c7dbdc01bc2/banner_about.jpg',
      'import_notice'              => __('After you import this demo, you can customize contents.', 'flexia'),
      'preview_url'                => 'https://live.templately.com/creative-hub/',
    ),
    array(
      'import_file_name'           => 'Flexia Demo 2 (Test)',
      'categories'                 => array('test'),
      'import_file_url'            => 'http://www.your_domain.com/ocdi/demo-content2.xml',
      'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets2.json',
      'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer2.dat',
      // 'import_redux'               => array(
      //   array(
      //     'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
      //     'option_name' => 'flexia',
      //   ),
      //   array(
      //     'file_url'    => 'http://www.your_domain.com/ocdi/redux2.json',
      //     'option_name' => 'flexia_2',
      //   ),
      // ),
      'import_preview_image_url'   => 'https://items.templately.com/pack-3253aff32f3a8f7c41f06861c1e3eeb5/banner_.jpg',
      'import_notice'              => __('A special note for this import.', 'flexia'),
      'preview_url'                => 'https://live.templately.com/crunchdealz',
    ),
  );
}
add_filter('pt-ocdi/import_files', 'flexia_import_files');

/*
* After Import  - Update Options
*/
function flexia_import_set_reading_options($settings)
{
  $reading_settings = $settings['reading_settings'];
  if (!empty($reading_settings)) {
    $homepage = get_page_by_title(html_entity_decode($reading_settings['homepage']));
    $blog     = get_page_by_title(html_entity_decode($reading_settings['blog']));
    if ((isset($homepage) && $homepage->ID) && (isset($blog) && $blog->ID)) {
      update_option('show_on_front',   'page');
      update_option('page_on_front',   $homepage->ID);
      update_option('page_for_posts',  $blog->ID);

      return true;
    }
  }

  return false;
}

/*
* After Import  - Set WooCommerce Pages
*/
function flexia_import_set_woocommerce_pages($settings)
{
  if (class_exists('Woocommerce') && !empty($settings['woocommerce_pages'])) {
    foreach ($settings['woocommerce_pages'] as $woo_name => $woo_title) {
      $woopage = get_page_by_title($woo_title);
      if (isset($woopage) && property_exists($woopage, 'ID')) {
        update_option($woo_name, $woopage->ID);
      }
    }

    return true;
  }

  return false;
}

/*
* After Import - Set Menus
*/
function flexia_import_set_nav_menus($settings)
{

  if (is_array($settings['navigation'])) {
    $locations = get_theme_mod('nav_menu_locations');
    $menus = wp_get_nav_menus();

    foreach ((array) $menus as $theme_menu) {
      foreach ((array) $settings['navigation'] as $import_menu) {
        if ($theme_menu->name == $import_menu['name']) {
          $locations[$import_menu['location']] = $theme_menu->term_id;
        }
      }
    }

    set_theme_mod('nav_menu_locations', $locations);

    return true;
  }

  return false;
}

/*
* After Import Setup
*/
function flexia_ocdi_after_import_setup($selected_index)
{
  require_once(ABSPATH . 'wp-admin/includes/file.php');

  WP_Filesystem();

  global $wp_filesystem;

  $json = null;
  $settings = array();

  if (is_file(get_template_directory() . '/demo/demo-config.json')) {
    $rsp = $wp_filesystem->get_contents(get_template_directory() . '/demo/demo-config.json');
    $json = json_decode($rsp, true);
  }

  if ($json !== null) {
    foreach ($json as $demo) {
      if ('Flexia Demo' === $demo['demo_name']) {
        $settings = $demo['settings'];
      }
    }

    flexia_import_set_reading_options($settings);
    flexia_import_set_woocommerce_pages($settings);
    flexia_import_set_nav_menus($settings);

    // update the selected import index
    $import_index = isset($selected_index['import_index']) ? $selected_index['import_index'] : 0;
    update_option('flexia_demo_import', $import_index);
    $wp_filesystem->put_contents(get_template_directory() . '/framework/assets/site/css/demo-import.css', '');

    if (0 !== (int) $import_index) {
      $file_css = $wp_filesystem->get_contents('http://fencermonir.com/flexia-demo/demo-import-' . $import_index . '.css');
      if (!empty($file_css)) {
        $wp_filesystem->put_contents(get_template_directory() . '/framework/assets/site/css/demo-import.css', $file_css);
      }
    }

    flush_rewrite_rules();
  }
}
add_action('pt-ocdi/after_import', 'flexia_ocdi_after_import_setup');

/*
* Before Import Setup
*/
function flexia_ocdi_before_content_import_setup()
{
  update_option('sidebars_widgets', array());
}
add_action('pt-ocdi/before_content_import', 'flexia_ocdi_before_content_import_setup');

add_filter('pt-ocdi/disable_pt_branding', '__return_true');
