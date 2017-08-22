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
				<main id="main" class="site-main flexia-woocommerce-wrapper flexia-container">
<?php
}?>

<?php function flexia_woo_wrapper_end() { ?>
				</main><!-- #main -->
			</div><!-- #primary -->

		</div><!-- #flexia-wrapper -->
	</div><!-- #content --> 
</div><!-- #page -->
<?php
get_template_part( 'framework/views/template-parts/content', 'footer' );
get_footer();

}

// Add cart menu  to Navbar
				
if( class_exists('WooCommerce') )  {			  

	function add_cart_menu_to_navbar ( $items, $args ) {
		if( 'primary' === $args -> theme_location ) {
			$items .= '<li class="menu-item flexia-header-cart">
	    <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
	    <span class="flexia-header-cart-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
		<span class="amount</span> <span class="count"></span>
		</a>
	</li>';
		}
	return $items;
	}
	add_filter('wp_nav_menu_items','add_cart_menu_to_navbar',99,2);

}

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function flexia_add_to_cart_fragment( $fragments ) {
 
    ob_start();
    $count = WC()->cart->get_cart_contents_count()
    ?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'flexia' ); ?>">
			<span class="flexia-header-cart-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
			<?php if ( $count > 0 ) { ?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'flexia' ), WC()->cart->get_cart_contents_count() ) );?></span>
				<?php } ?>
		</a>

        <?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'flexia_add_to_cart_fragment' );
