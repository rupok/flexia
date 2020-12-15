<?php

function flexia_import_files() {
    return array(
      array(
        'import_file_name'           => 'Flexia Demo 1',
        'categories'                 => array( 'elementor', 'templately' ),
        'import_file_url'            => site_url() . '/wp-content/themes/flexia/demo/freshwp.xml',
        'import_widget_file_url'     => site_url() . '/wp-content/themes/flexia/demo/flexia-widgets.wie',
        'import_customizer_file_url' => site_url() . '/wp-content/themes/flexia/demo/flexia-customizer.dat',
        // 'import_redux'               => array(
        //   array(
        //     'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
        //     'option_name' => 'flexia',
        //   ),
        // ),
        'import_preview_image_url'   => 'https://items.templately.com/item-2cc2f48160faa9673d017c7dbdc01bc2/banner_about.jpg',
        'import_notice'              => __( 'After you import this demo, you can customize contents.', 'flexia' ),
        'preview_url'                => 'https://live.templately.com/creative-hub/',
      ),
      array(
        'import_file_name'           => 'Flexia Demo 2 (Test)',
        'categories'                 => array( 'test' ),
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
        'import_notice'              => __( 'A special note for this import.', 'flexia' ),
        'preview_url'                => 'https://live.templately.com/crunchdealz',
      ),
    );
  }
  add_filter( 'pt-ocdi/import_files', 'flexia_import_files' );

?>