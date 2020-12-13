<?php

function flexia_import_files() {
    return array(
      array(
        'import_file_name'           => 'Demo Import 1',
        'categories'                 => array( 'Category 1', 'Category 2' ),
        'import_file_url'            => 'http://www.your_domain.com/ocdi/demo-content.xml',
        'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets.json',
        'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer.dat',
        'import_redux'               => array(
          array(
            'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
            'option_name' => 'flexia',
          ),
        ),
        'import_preview_image_url'   => 'http://www.your_domain.com/ocdi/preview_import_image1.jpg',
        'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
        'preview_url'                => 'http://www.your_domain.com/my-demo-1',
      ),
      array(
        'import_file_name'           => 'Demo Import 2',
        'categories'                 => array( 'New category', 'Old category' ),
        'import_file_url'            => 'http://www.your_domain.com/ocdi/demo-content2.xml',
        'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets2.json',
        'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer2.dat',
        'import_redux'               => array(
          array(
            'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
            'option_name' => 'flexia',
          ),
          array(
            'file_url'    => 'http://www.your_domain.com/ocdi/redux2.json',
            'option_name' => 'flexia_2',
          ),
        ),
        'import_preview_image_url'   => 'http://www.your_domain.com/ocdi/preview_import_image2.jpg',
        'import_notice'              => __( 'A special note for this import.', 'your-textdomain' ),
        'preview_url'                => 'http://www.your_domain.com/my-demo-2',
      ),
    );
  }
  add_filter( 'pt-ocdi/import_files', 'flexia_import_files' );

?>