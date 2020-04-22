<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The template for displaying the Call to Action
 *
 * Contains the CTA part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */


$cta_layout = flexia_get_option('flexia_call_to_action_layout');

?>

<?php if(flexia_get_option('flexia_call_to_action_enable') == true) : ?>

	<section id="flexia-cta" class="flexia cta flexia-cta-<?php echo esc_attr($cta_layout); ?>">

		<?php

			if( $cta_layout == 1 ) : 
				get_template_part( 'framework/views/template-parts/cta/cta', '1' );
			endif;

			if (class_exists('Flexia_Pro')) :

				if( $cta_layout == 2 ) : 
					include( FLEXIA_PRO_DIR_PATH . 'public/template-parts/cta/cta-2.php' );
				endif;
				
			endif;
		?>

	</section><!-- #flexia-cta -->

<?php endif ?>