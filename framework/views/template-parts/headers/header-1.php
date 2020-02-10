<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * The template for displaying the Navbar
 *
 * Contains the navbar part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

$navbar_class = get_theme_mod('flexia_navbar_position', 'flexia-navbar-static-top');
$dropdown_animation = 'flexia-menu-dropdown-animate-' . get_theme_mod('flexia_main_nav_menu_dropdown_animation', 'to-top');
$flexia_logobar_position = get_theme_mod('flexia_logobar_position', 'flexia-logobar-inline');
$flexia_custom_logo_id = get_theme_mod( 'custom_logo' );
$flexia_header_logo = wp_get_attachment_image_src( $flexia_custom_logo_id , 'full' );

?>

<div class="flexia-navbar <?php echo $navbar_class;?>">
	<div class="flexia-navbar-container">
		<div class="flexia-container flexia-navbar-inner <?php echo (get_theme_mod( 'header_layout_type' ) == "full-width") ? "full-width" : "width max" ?>">
			
			<?php if( $flexia_logobar_position == 'flexia-logobar-inline' ) : ?>

			<div class="flexia-logobar-inline">
				<div class="site-branding">

					<?php if( $flexia_header_logo[0] !== NULL ) :  ?>

				       	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="flexia-header-logo"><img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo $flexia_header_logo[0]; ?>"></a>

				    <?php else : ?>

						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php
						endif; ?>
					<?php endif; ?>

				</div><!-- .site-branding -->
			</div>
			<?php endif; ?>

			<!-- Header Main Social Start -->
			<?php
				if (flexia_get_option('flexia_enable_header_social') == true && flexia_get_option('flexia_header_social_position') == "header_main") {
					get_template_part('framework/views/template-parts/content', 'social-links');
				}
			?>
			<!-- Header Main Social End -->

			<nav id="site-navigation" class="flexia-menu main-navigation">
				<?php

					if ( has_nav_menu( 'primary' ) ) :
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id'        => 'flexia-primary-menu',
							'menu_class'     => 'nav-menu flexia-primary-menu ' . $dropdown_animation,
							'container'      => false,
						) );
					else :

					  echo '<ul class="flexia-primary-menu"><li><a href="' . home_url( '/' ) . 'wp-admin/nav-menus.php">Assign a Menu</a></li></ul>';
					endif;

				?>

			</nav><!-- #site-navigation -->
			<div class="nav-icons">
				<ul>
					<?php
					// haeder search
					$flexia_nav_menu_search = get_theme_mod('flexia_nav_menu_search', true);
					if ($flexia_nav_menu_search == true && 'primary' === $args->theme_location) {
						$items .= '<li class="menu-item navbar-search-menu"> <a id="btn-search" href="javascript:void(0);">';
						$items .= '<i class="fa fa-search" aria-hidden="true"></i></a></li>';
						echo $items;
					}

					// header WooCommerce cart
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
						echo $items;
					}
					?>
				</ul>
			</div>
		</div><!-- #flexia-container -->
	</div><!-- #flexia-navbar-container -->
</div>