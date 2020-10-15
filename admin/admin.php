<?php

/**
 * Defining admin page of flexia
 */

class Flexia_Admin
{
    protected $theme;
    protected $installer;

    public function __construct()
    {
        // load files
		$this->load_files();
		
        // init vars
		$this->theme = wp_get_theme();
		$this->installer = new Flexia_Plugin_Installer();

        // actions
        add_action('admin_menu', array($this, 'flexia_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'flexia_admin_enqueue_scripts'));
    }

    /**
     * Load required files.
     *
     * @since     1.0.4
     */
    protected function load_files()
    {
        require_once get_template_directory() . '/admin/plugin-installer.php';
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.4
     */
    public function flexia_admin_enqueue_scripts()
    {
        wp_enqueue_style('flexia', get_template_directory_uri() . '/admin/css/flexia-admin.css', array(), $this->theme->version);
    }

    /**
     * Create Dashboard Pages
     *
     * @since     1.0.4
     */
    public function flexia_admin_menu()
    {
		if( !class_exists('Flexia_Pro') ) {
			add_theme_page( 'Flexia', 'Flexia Settings', 'edit_theme_options', 'flexia-options', 'flexia_dashboard_page' );
		} 
		else {
			do_action('flexia_theme_admin_menu', $this);
		}
		
	}
}
