<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */



if (!function_exists('flexia_widgets_init')) :
	/**
	 * Register widgetized area and update sidebar with default widgets
	 */
	add_action('widgets_init', 'flexia_widgets_init');
	function flexia_widgets_init()
	{
		// Set up our array of widgets	
		$widgets = array(
			'sidebar-left' => __('Sidebar Left', 'flexia'),
			'sidebar-right' => __('Sidebar Right', 'flexia'),
			'header-1' => __('Header 1', 'flexia'),
			'header-2' => __('Header 2', 'flexia'),
			'header-3' => __('Header 3', 'flexia'),
			'header-4' => __('Header 4', 'flexia'),
			'footer-1' => __('Footer 1', 'flexia'),
			'footer-2' => __('Footer 2', 'flexia'),
			'footer-3' => __('Footer 3', 'flexia'),
			'footer-4' => __('Footer 4', 'flexia'),

		);

		if (class_exists('WooCommerce')) {
			$widgets['woo-sidebar'] = __('WooCommerce Sidebar', 'flexia');
		}

		// Loop through them to create our widget areas
		foreach ($widgets as $id => $name) {
			register_sidebar(array(
				'name'          => $name,
				'id'            => $id,
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => apply_filters('flexia_before_widget_title', '<h2 class="widget-title">'),
				'after_title'   => apply_filters('flexia_after_widget_title', '</h2>'),
			));
		}
	}
endif;


/**
 * Pre-configure and save a widget, designed for plugin and theme activation.
 * 
 * @link    http://wordpress.stackexchange.com/q/138242/1685
 *
 * @param   string  $sidebar    The database name of the sidebar to add the widget to.
 * @param   string  $name       The database name of the widget.
 * @param   mixed   $args       The widget arguments (optional).
 */
function flexia_pre_set_widget($sidebar, $name, $args = array())
{
	if (!$sidebars = get_option('sidebars_widgets'))
		$sidebars = array();

	// Create the sidebar if it doesn't exist.
	if (!isset($sidebars[$sidebar]))
		$sidebars[$sidebar] = array();

	// Check for existing saved widgets.
	if ($widget_opts = get_option("widget_$name")) {
		// Get next insert id.
		ksort($widget_opts);
		end($widget_opts);
		$insert_id = key($widget_opts);
	} else {
		// None existing, start fresh.
		$widget_opts = array('_multiwidget' => 1);
		$insert_id = 0;
	}

	// Add our settings to the stack.
	$widget_opts[++$insert_id] = $args;
	// Add our widget!
	$sidebars[$sidebar][] = "$name-$insert_id";

	update_option('sidebars_widgets', $sidebars);
	update_option("widget_$name", $widget_opts);
}



function flexia_setup_woo_sidebar()
{
	if ( is_dynamic_sidebar('woo-sidebar') && is_plugin_active('woocommerce/woocommerce.php') ) {
		$content = wp_get_sidebars_widgets();
		if (empty($content['woo-sidebar'])) {
			flexia_pre_set_widget(
				'woo-sidebar',
				'woocommerce_product_categories',
				array(
					'title' => 'Categories',
				)
			);
			flexia_pre_set_widget(
				'woo-sidebar',
				'woocommerce_price_filter',
				array(
					'title' => 'Price',
				)
			);
			flexia_pre_set_widget(
				'woo-sidebar',
				'woocommerce_products',
				array(
					'title' => 'Featured',
					'show' => 'featured'
				)
			);
		}
	}
}
add_action('init', 'flexia_setup_woo_sidebar');
