<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'after_setup_theme','flexia_setup_woocommerce' );
/** 
 * Set up WooCommerce
 *
 * @since 1.0
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
<?php } ?>
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
function add_cart_menu_to_navbar($items, $args)
{
	$flexia_woo_cart_menu = get_theme_mod('flexia_woo_cart_menu', false);
	
	global $woocommerce;
	$cartitems = $woocommerce->cart->get_cart();

    if ($flexia_woo_cart_menu == true && 'primary' === $args->theme_location) {
        $items .= '<li class="menu-item flexia-header-cart">';
        $items .= '<a class="cart-contents wc-cart-contents" href="' . esc_url(wc_get_cart_url()) . '">';
        $items .= '<span class="flexia-header-cart-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>';
        $items .= '<span class="amount"></span> <span class="count">'. WC()->cart->get_cart_contents_count().'</span>';
		$items .= '</a>';
		if (WC()->cart->get_cart_contents_count() > 0 ) {
			$items .= '<ul class="flexia-menu-cart-items">';
			foreach($cartitems as $cartitem => $values) {
				$product_id = $values['data']->get_id();
				$product =  wc_get_product( $product_id );
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $values['data']->get_id() ), 'thumbnail' );
				$price = get_post_meta($values['product_id'] , '_price', true);

				$items .= '<li class="flexia-cart-item">';
					$items .= '<div class="flexia-cart-product-img">';
						$items .= '<img src="'.$image[0].'" data-id="'. $product_id.'">';
					$items .= '</div>';
					$items .= '<div class="flexia-cart-product-meta">';
						$items .= '<span class="flexia-cart-product-title">';
						$items .= '<a href="'.get_permalink($product_id).'">' .$product->get_title() . '</a>';
						$items .= '</span>';
						$items .= '<span class="flexia-cart-product-qty">'.$values['quantity'].' x '.get_woocommerce_currency_symbol().''.$price.'</span>';
						$items .= '<span class="flexia-cart-product-price"></span>';
					$items .= '</div>';
					$items .= '<div class="flexia-cart-product-action"> <i data-id="'.$product_id.'" class="fa fa-trash"></i> </div>';
				$items .= '</li>';
			}
			$items .= '<li class="flexia-cart-total">Cart Total: <span>'.$woocommerce->cart->get_cart_total().'</span></li>';
			$items .= '<li class="flexia-cart-links">';
				$items .= '<a class="button" href=" '.esc_url( wc_get_cart_url()).' ">View Cart</a>';
				$items .= '<a class="button" href=" '.esc_url( wc_get_checkout_url()).' ">View Checkout</a>';
			$items .= '</li>';
			$items .= '</ul>';
		}
		
        $items .= '</li>';
    }
    return $items;
}
// add_filter('wp_nav_menu_items', 'add_cart_menu_to_navbar', 99, 2);


/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function flexia_add_to_cart_fragment( $fragments ) {
 
    ob_start();
    $count = WC()->cart->get_cart_contents_count();
    ?>
		<a class="cart-contents wc-cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'flexia' ); ?>">
			<span class="flexia-header-cart-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
			<?php if ( $count > 0 ) { ?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'flexia' ), WC()->cart->get_cart_contents_count() ) );?></span>
				<?php } ?>
		</a>

        <?php
 
    $fragments['a.wc-cart-contents'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'flexia_add_to_cart_fragment' );


add_action( 'wp_footer', 'add_js_to_wp_wcommerce');
function add_js_to_wp_wcommerce(){ ?>
    <script type="text/javascript">
    jQuery('.flexia-cart-product-action i').click(function(){
        var product_id = jQuery(this).attr("data-id");
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: { action: "product_remove", 
                    product_id: product_id
            },success: function(data){
                console.log(data);
            }
        });
        return false;
    });
    </script>
<?php }

add_action( 'wp_ajax_product_remove', 'product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'product_remove');
function product_remove() {
    $cart = WC()->instance()->cart;
	$id = $_POST['product_id'];
	$cart_id = $cart->generate_cart_id($id);
	$cart_item_id = $cart->find_product_in_cart($cart_id);

	if($cart_item_id){
		$cart->set_quantity($cart_item_id,0);
	}
	wp_die();
}
