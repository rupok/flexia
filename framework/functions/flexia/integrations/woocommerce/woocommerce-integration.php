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

//Add Flexia Wrapper Classes
function flexia_woo_wrapper_start() {
	get_header(); ?>

		<div id="content" class="site-content">
			<div class="flexia-wrapper flexia-container max width">
				<div id="primary" class="content-area">
					<main id="main" class="site-main flexia-woocommerce-wrapper flexia-container">
<?php } ?>

<?php function flexia_woo_wrapper_end() { ?>
					</main><!-- #main -->
				</div><!-- #primary -->

				<?php echo flexia_woocommerce_sidebar(); ?>

			</div><!-- #flexia-wrapper -->
		</div><!-- #content --> 
	</div><!-- #page -->
	<?php
	get_footer();
}

//Sidebar for Cart, Checkout
function page_sidebar_control($content_layout) {

	if ( is_page( 'cart' ) || is_cart() ) {
		$content_layout = "";
		if ( flexia_get_option('flexia_woo_sidebar_cart_page') ) {
			echo flexia_sidebar_content('woo-sidebar', 'flexia-sidebar-right', 'flexia-woo-sidebar');
		}
		
	}

	if ( is_page( 'checkout' ) || is_checkout() ) {
		$content_layout = "";
		if ( flexia_get_option('flexia_woo_sidebar_checkout_page') ) {
			echo flexia_sidebar_content('woo-sidebar', 'flexia-sidebar-right', 'flexia-woo-sidebar');
		}
		
	}

	return $content_layout;
}
add_filter('flexia_sidebar_content_layout', 'page_sidebar_control');

//3 Column Per row in Shop Page
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

//Add Discount text in HTML
function show_discount_with_product_price_display( $price ) {
	global $product;
	if (is_shop()) {
		if ( $product->get_regular_price() > 0 && $product->get_price() > 0 && $product->get_regular_price()!=$product->get_price() ) {
			$save_amount = $product->get_regular_price() - $product->get_price();
			$price .= '<span class="discunt_amount">Save '.get_woocommerce_currency_symbol().'' . $save_amount . '</span>';
		}
	}
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'show_discount_with_product_price_display' );

//Add Plus Minus Button to WooCommerce Quantity in single page
add_action( 'woocommerce_before_add_to_cart_quantity', 'bbloomer_display_quantity_plus' );  
function bbloomer_display_quantity_plus() {
   echo '<div class="product-single-quantity"><button type="button" class="plus" >+</button>';
}
  
add_action( 'woocommerce_after_add_to_cart_quantity', 'bbloomer_display_quantity_minus' );  
function bbloomer_display_quantity_minus() {
   echo '<button type="button" class="minus" >-</button></div>';
}

//Menu Cart Item display
function menu_cart_items_html() {
	global $woocommerce;
	$cartitems = $woocommerce->cart->get_cart();
	$items = "";
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
			// $items .= '<div class="flexia-cart-product-action"> <i data-id="'.$product_id.'" class="fa fa-trash"></i> </div>';
		$items .= '</li>';
	}
	$items .= '<li class="flexia-cart-total">Cart Total: <span><strong>'.$woocommerce->cart->get_cart_total().'</strong></span></li>';
	$items .= '<li class="flexia-cart-links">';
		$items .= '<a class="button" href=" '.esc_url( wc_get_cart_url()).' ">View Cart</a>';
		$items .= '<a class="button" href=" '.esc_url( wc_get_checkout_url()).' ">View Checkout</a>';
	$items .= '</li>';

	return $items;
}

// Add cart menu  to Navbar
function add_cart_menu_to_navbar($items)
{
	$flexia_woo_cart_menu = flexia_get_option('flexia_woo_cart_menu');
	
	global $woocommerce;
	$cartitems = $woocommerce->cart->get_cart();

    if ($flexia_woo_cart_menu == true ) {
        $items .= '<li class="menu-item flexia-header-cart">';
        $items .= '<a class="cart-contents wc-cart-contents" href="' . esc_url(wc_get_cart_url()) . '">';
        $items .= '<span class="flexia-header-cart-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="510px" height="510px" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve"> <g> <g id="shopping-cart"> <path d="M153,408c-28.05,0-51,22.95-51,51s22.95,51,51,51s51-22.95,51-51S181.05,408,153,408z M0,0v51h51l91.8,193.8L107.1,306 c-2.55,7.65-5.1,17.85-5.1,25.5c0,28.05,22.95,51,51,51h306v-51H163.2c-2.55,0-5.1-2.55-5.1-5.1v-2.551l22.95-43.35h188.7 c20.4,0,35.7-10.2,43.35-25.5L504.9,89.25c5.1-5.1,5.1-7.65,5.1-12.75c0-15.3-10.2-25.5-25.5-25.5H107.1L84.15,0H0z M408,408 c-28.05,0-51,22.95-51,51s22.95,51,51,51s51-22.95,51-51S436.05,408,408,408z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg></span>';
        $items .= '<span class="amount"></span> <span class="count">'. WC()->cart->get_cart_contents_count().'</span>';
		$items .= '</a>';
		if (WC()->cart->get_cart_contents_count() > 0 ) {
			$items .= '<ul id="menu-cart-items" class="flexia-cart-submenu flexia-menu-cart-items">';
			$items .= menu_cart_items_html();
			$items .= '</ul>';
		}
		
        $items .= '</li>';
    }
    return $items;
}
add_filter('flexia_header_icon_items', 'add_cart_menu_to_navbar', 99, 2);

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function flexia_add_to_cart_fragment( $fragments ) {
 
    ob_start();
    $count = WC()->cart->get_cart_contents_count();
    ?>
		<a class="cart-contents wc-cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'flexia' ); ?>">
			<span class="flexia-header-cart-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="510px" height="510px" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve"> <g> <g id="shopping-cart"> <path d="M153,408c-28.05,0-51,22.95-51,51s22.95,51,51,51s51-22.95,51-51S181.05,408,153,408z M0,0v51h51l91.8,193.8L107.1,306 c-2.55,7.65-5.1,17.85-5.1,25.5c0,28.05,22.95,51,51,51h306v-51H163.2c-2.55,0-5.1-2.55-5.1-5.1v-2.551l22.95-43.35h188.7 c20.4,0,35.7-10.2,43.35-25.5L504.9,89.25c5.1-5.1,5.1-7.65,5.1-12.75c0-15.3-10.2-25.5-25.5-25.5H107.1L84.15,0H0z M408,408 c-28.05,0-51,22.95-51,51s22.95,51,51,51s51-22.95,51-51S436.05,408,408,408z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg></span>
			<?php if ( $count > 0 ) { ?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'flexia' ), WC()->cart->get_cart_contents_count() ) );?></span>
				<?php } ?>
		</a>

        <?php
 
    $fragments['a.wc-cart-contents'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'flexia_add_to_cart_fragment' );


//Remove Product from Cart WP Ajax function
add_action( 'wp_ajax_product_remove', 'product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'product_remove');
function product_remove() {
    $cart = WC()->instance()->cart;
	$id = $_POST['product_id'];
	$cart_id = $cart->generate_cart_id($id);
	$cart_item_id = $cart->find_product_in_cart($cart_id);

	if($cart_item_id){
		$cart->set_quantity($cart_item_id,0);
		echo menu_cart_items_html();
	}
	wp_die();
}


//Return Cart HTML WP Ajax function
add_action( 'wp_ajax_cart_items_html', 'cart_items_html' );
add_action( 'wp_ajax_nopriv_cart_items_html', 'cart_items_html');
function cart_items_html() {
	echo menu_cart_items_html();
	wp_die();
}

function flexia_woocommerce_sidebar() {
	$flexia_sidebar_id = flexia_get_option('flexia_woo_sidebar_default');

	if ( is_shop() && flexia_get_option('flexia_woo_sidebar_shop_page') ) {
		return flexia_sidebar_content($flexia_sidebar_id, 'flexia-sidebar-left', 'flexia-woo-sidebar');
	}

	if ( is_product() && flexia_get_option('flexia_woo_sidebar_product_single') ) {
		return flexia_sidebar_content($flexia_sidebar_id, 'flexia-sidebar-right', 'flexia-woo-sidebar');
	}
	
	if ( is_product_category() && flexia_get_option('flexia_woo_sidebar_archive_page') ) {
		return flexia_sidebar_content($flexia_sidebar_id, 'flexia-sidebar-right', 'flexia-woo-sidebar');
	}
}

function flexia_woocommerce_sidebar_content($sidebar_id, $sidebar_position) {
	ob_start();
	dynamic_sidebar( $sidebar_id );
	$sidebar =  ob_get_clean();
	return '
	<aside id="flexia-woo-sidebar" class="flexia-sidebar '.$sidebar_position.'">
		<div class="flexia-sidebar-inner">
			' . $sidebar . '
		</div>
	</aside>';
}


add_action( 'wp_footer', 'bbloomer_add_cart_quantity_plus_minus' );  
function bbloomer_add_cart_quantity_plus_minus() {
	//Delete Cart item ajax
	?>
		<script type="text/javascript">

			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			jQuery('.flexia-cart-product-action i').click(function(){
				console.log('Remove Click');
				var product_id = jQuery(this).attr("data-id");
				
				var data = {
					'action' : 'product_remove',
					'product_id': product_id
				};

				jQuery.post( ajaxurl, data, function( response ) {
					jQuery('#menu-cart-items').html(response);
				} );
				return false;
			});

			jQuery('body').bind('added_to_cart', function(event, fragments, cart_hash) {

				var data = {
					'action' : 'cart_items_html',
				};

				jQuery.post( ajaxurl, data, function( response ) {
					jQuery('#menu-cart-items').html(response);
				} );
				return false;
			});
		</script>
	<?php

   	// Only run this on the single product page
   	if ( is_product() ) {
		?>
			<script type="text/javascript">				
				jQuery(document).ready(function($){           
					$('form.cart').on( 'click', 'button.plus, button.minus', function() {  
					// Get current quantity values
					var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
					var val   = parseFloat(qty.val());
					var max = parseFloat(qty.attr( 'max' ));
					var min = parseFloat(qty.attr( 'min' ));
					var step = parseFloat(qty.attr( 'step' ));  
					// Change the value if plus or minus
					if ( $( this ).is( '.plus' ) ) {
						if ( max && ( max <= val ) ) {
							qty.val( max );
						} else {
							qty.val( val + step );
						}
					} else {
						if ( min && ( min >= val ) ) {
							qty.val( min );
						} else if ( val > 1 ) {
							qty.val( val - step );
						}
					}              
					});
				});
				
			</script>
		<?php
   	}
}
