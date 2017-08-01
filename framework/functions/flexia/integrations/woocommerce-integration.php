<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'after_setup_theme','flexia_setup_woocommerce' );
/** 
 * Set up WooCommerce
 *
 * @since 1.3.47
 */
function flexia_setup_woocommerce() {
	
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	
	// Add support for WC features
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	//Remove default WooCommerce wrappers
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	// Add Flexia wrappers
	add_action('woocommerce_before_main_content', 'flexia_woo_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'flexia_woo_wrapper_end', 10);

}


function flexia_woo_wrapper_start() {
get_header(); ?>

<div id="page" class="site">

	<?php get_template_part( 'framework/views/template-parts/content', 'masthead' ); ?>

	<div id="content" class="site-content">
		<div class="flexia-wrapper flexia-container max width">
			<div id="primary" class="content-area">
				<main id="main" class="site-main flexia-container">
<?php
}?>

<?php function flexia_woo_wrapper_end() { ?>
				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div><!-- #flexia-wrapper -->
	</div><!-- #content --> 
</div><!-- #page -->
<?php
get_template_part( 'framework/views/template-parts/content', 'footer' );
get_footer();

}