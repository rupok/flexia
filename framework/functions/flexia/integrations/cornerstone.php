    <?php

    class Cornerstone_Integration_Flexia {

      /**
       * This integration will load if get_stylesheet() matches the value returned here.
       */
      public static function stylesheet() {
        return 'flexia';
      }

      /**
       * Loads on the after_theme_setup hook
       */
      public function __construct() {

        // Set Default Post Types
        cornerstone_set_default_post_types( array( 'post', 'page') );

        // Declare theme integration flags
        cornerstone_theme_integration( array(
          'remove_global_validation_notice' => true,
          'remove_themeco_offers'           => true,
          'remove_purchase_link'            => true,
          'remove_support_box'              => true
        ) );

        add_filter( 'cornerstone_enqueue_styles', '__return_false' );

      }

    }