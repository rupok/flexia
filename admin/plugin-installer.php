<?php

if (!class_exists('Flexia_Plugin_Installer')) {

    /**
     * Flexia Plugin Installer Class
     *
     * @since     1.0.4
     */
    class Flexia_Plugin_Installer
    {
        public $free_plugins;
        public $pro_plugins;

        public function __construct()
        {
            add_action('admin_footer', array($this, 'free_plugins_activation_script'));
            add_action('wp_ajax_flexia_free_plugin_installer', array($this, 'free_plugins_installer'));
        }

        /**
         * Fail if plugin install/activation fails
         *
         * @since   1.0.4
         */
        public function fail_on_error($thing)
        {
            if (is_wp_error($thing)) {
                wp_send_json_error($thing->get_error_message());
            }
        }

        /**
         * Generates all free plugins
         *
         * @since   1.0.4
         */
        public function free_plugins()
        {
            include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
            include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

            $this->free_plugins = array(
                array(
                    'slug' => 'flexia-core',
                    'file' => 'flexia-core.php',
                ),
                array(
                    'slug' => 'elementor',
                    'file' => 'elementor.php',
                ),
                array(
                    'slug' => 'essential-addons-for-elementor-lite',
                    'file' => 'essential-addons-for-elementor.php',
                ),
                array(
                    'slug' => 'woocommerce',
                    'file' => 'woocommerce.php',
                ),
                array(
                    'slug' => 'wordpress-seo',
                    'file' => 'wp-seo-main.php',
                ),
            );

            foreach ($this->free_plugins as $plugin) {
                $slug_name = $plugin['slug'];
                $file_name = $plugin['file'];
                $plugin_basename = $plugin['slug'] . '/' . $plugin['file'];
                $api = plugins_api('plugin_information',
                    array(
                        'slug' => $plugin['slug'],
                        'fields' => array(
                            'short_description' => true,
                            'sections' => false,
                            'requires' => false,
                            'downloaded' => true,
                            'last_updated' => false,
                            'added' => false,
                            'tags' => false,
                            'compatibility' => false,
                            'homepage' => false,
                            'donate_link' => false,
                            'icons' => false,
                            'banners' => true,
                        ),
                    )
                );
                $main_plugin_file = $this->get_plugin_file($plugin['slug']);

                if (!empty($main_plugin_file) && !is_plugin_active($main_plugin_file)) {
                    $btn_class = 'button button-primary';
                    $btn_text = __('Activate', 'flexia');
                } else if (is_plugin_active($main_plugin_file)) {
                    $btn_class = 'button button-secondary disabled';
                    $btn_text = __('Activated', 'flexia');
                } else {
                    $btn_class = 'activate button button-secondary';
                    $btn_text = __('Install Now', 'flexia');
                }

                $this->render_free_template($plugin, $api, $slug_name, $file_name, $btn_class, $btn_text);
            }
        }

        /**
         * A method to get the main plugin file
         *
         * @since   1.0.4
         */
        public function get_plugin_file($plugin_slug)
        {
            require_once ABSPATH . '/wp-admin/includes/plugin.php';

            $plugins = get_plugins();

            foreach ($plugins as $plugin_file => $plugin_info) {
                if ($slug = dirname(plugin_basename($plugin_file))) {
                    if ($slug == $plugin_slug) {
                        return $plugin_file;
                    }
                }
            }

            return null;
        }

        /**
         * Plugin Activation Script
         *
         * @since   1.0.4
         */
        public function free_plugins_activation_script()
        {
            echo '<script type="text/javascript">
				jQuery(document).ready( function($) {
					$(".install-btn").on("click", function(e) {
						var self = $(this);
						e.preventDefault();
						var fileName = self.attr("data-file-name");
						var slugName = self.attr("data-slug");
						self.addClass("install-now updating-message");
						self.text("' . esc_js("Installing...") . '");

						$.ajax({
							url: "' . admin_url("admin-ajax.php") . '",
							type: "post",
							data: {
								action: "flexia_free_plugin_installer",
								slug: slugName,
								file: fileName,
								_wpnonce: "' . wp_create_nonce("flexia_free_plugin_installer") . '"
							},
							success: function(response) {
								self.text("' . esc_js("Activated") . '");
								self.removeClass("button-primary");
								self.addClass("button-secondary");
								self.attr("disabled", "disabled");
							},
							error: function(error) {
								self.text("' . esc_js("Try Again!") . '");
								self.removeClass("install-now updating-message");
							},
							complete: function() {
								self.removeClass("install-now updating-message");
							}
						});
					});
				} );
			</script>';
        }

        /**
         * Install \ Activate a plugin
         *
         * @since   1.0.4
         */
        public function free_plugins_installer()
        {
            check_ajax_referer('flexia_free_plugin_installer');

            if (!current_user_can('manage_options')) {
                wp_send_json_error(__('You don\'t have permission to install the plugins', 'flexia'));
            }

            $slug_name = $_POST['slug'];
            $file_name = $_POST['file'];

            $install_status = $this->install_a_free_plugin($slug_name, $file_name);
            $this->fail_on_error($install_status);

            wp_send_json_success();
        }

        /**
         * Install a free plugin
         *
         * @since   1.0.4
         */
        public function install_a_free_plugin($slug, $file)
        {
            include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
            include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

            $plugin_basename = $slug . '/' . $file;

            // if exists and not activated
            if (file_exists(WP_PLUGIN_DIR . '/' . $plugin_basename)) {
                return activate_plugin($plugin_basename);
            }

            // seems like the plugin doesn't exists. Download and activate it
            $upgrader = new Plugin_Upgrader(new WP_Ajax_Upgrader_Skin());

            $api = plugins_api('plugin_information', array('slug' => $slug, 'fields' => array('sections' => false)));
            $result = $upgrader->install($api->download_link);

            if (is_wp_error($result)) {
                return $result;
            }

            return activate_plugin($plugin_basename);
        }

        /**
         * Generates all premium plugins
         *
         * @since   1.0.4
         */
        public function premium_plugins()
        {
            $this->pro_plugins = array(
                array(
                    'name' => 'Flexia - Pro',
                    'url' => 'https://wpdeveloper.net/themes/flexia/',
                    'desc' => 'Adds premium features for the theme Flexia.',
                    'author' => 'Codetic',
                    'author_url' => 'https://flexia.pro/',
                    'banner' => get_template_directory_uri() . '/admin/img/flexia-banner.jpg',
                    'doc_url' => 'https://flexia.pro/docs/',
                ),
                array(
                    'name' => 'Essential Addons for Elementor - Pro',
                    'url' => 'https://wpdeveloper.net/flexia-essential-addons-elementor',
                    'desc' => 'Ultimate elements  library for Elementor WordPress Page Builder. 30+ stunning elements for Elementor.',
                    'author' => 'Codetic',
                    'author_url' => 'https://essential-addons.com',
                    'banner' => get_template_directory_uri() . '/admin/img/eael-pro-banner.jpg',
                    'doc_url' => 'https://essential-addons.com/elementor',
                ),
            );

            foreach ($this->pro_plugins as $plugin) {
                $this->render_premium_template(
                    $plugin['name'],
                    $plugin['url'],
                    $plugin['desc'],
                    $plugin['author'],
                    $plugin['author_url'],
                    $plugin['banner'],
                    $plugin['doc_url']
                );
            }
        }

        /**
         * This method will render recomended plugin block
         *
         * @since   1.0.4
         */
        public function render_free_template($plugin, $api, $slug_name, $file_name, $btn_class, $btn_text)
        {
            echo '<div class="flexia-plugins">
				<div class="header">
					<img src="' . $api->banners['high'] . '" alt="' . esc_attr($slug_name) . '">
				</div>
				<div class="content">
					<h4 class="title">' . $api->name . '</h4>
					<p>' . $api->short_description . '</p>
					<span class="by-author">' . __('By:', 'flexia') . $api->author . '</span>
				</div>
				<div class="footer">
					<div class="footer-left">
						<ul>
							<li>
								<button type="submit" class="' . esc_attr($btn_class) . ' install-btn" data-slug = "' . esc_attr($slug_name) . '" data-file-name="' . esc_attr($file_name) . '">' . $btn_text . '</button>
							</li>
							<li><a href="https://wordpress.org/plugins/' . $api->slug . '/" target="_blank">' . __('More Details', 'flexia') . '</a></li>
						</ul>
					</div>
					<div class="footer-right">
						<span class="tag-free">' . __('Free', 'flexia') . '</span>
					</div>
				</div>
			</div>';
        }

        /**
         * This method will render premium plugin block
         *
         * @since   1.0.4
         */
        public function render_premium_template($name, $url, $desc, $author, $author_url, $banner, $doc_url)
        {
            echo '<div class="flexia-plugins">
				<div class="header">
					<img src="' . esc_url($banner) . '" alt="' . esc_attr($name) . '">
				</div>
				<div class="content">
					<h4 class="title">' . $name . '</h4>
					<p>' . esc_html($desc, 'flexia') . '</p>
					<span class="by-author">' . __('By:', 'flexia') . ' <a href="' . esc_url($author_url) . '">' . esc_html($author, 'flexia') . '</a></span>
				</div>
				<div class="footer">
					<div class="footer-left">
						<ul>
							<li>
								<a href="' . esc_url($url) . '" class="button button-secondary">' . __('Get Now', 'flexia') . '</a>
							</li>
							<li><a href="' . esc_url($doc_url) . '" target="_blank">' . __('More Details', 'flexia') . '</a></li>
						</ul>
					</div>
					<div class="footer-right">
						<span class="tag-pro">' . __('Premium', 'flexia') . '</span>
					</div>
				</div>
			</div>';
        }

    }
}
