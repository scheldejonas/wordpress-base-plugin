<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class plugin_name_controller {

	static $instance = null;

	static function get_instance($settings_instance = null) {
		
		if (self::$instance == null) {
			
            self::$instance = new self($settings_instance);
            
        }
        
        return self::$instance;
        
	}


	function __construct($settings_instance) {
		
		if ( $settings_instance !== null ) {
			
			$this->settings = $settings_instance;
			
			$settings_instance->controller = $this;
			
		}

        $this->load_hooks();

    }


    function load_hooks() {

        add_action( 'admin_menu', [$this, 'register_admin_page'] );

        add_action( 'admin_enqueue_scripts', [$this, 'load_admin_page_assets'] );

    }


    function register_admin_page() {

        add_menu_page(
            __('plugin_name', $this->settings->slug),
            __('plugin_name', $this->settings->slug),
            'manage_options',
            $this->settings->slug . '_admin_page',
            [$this, 'view_admin_page'],
            'dashicons-editor-ul',
            100
        );

    }


    function view_admin_page() {

        $controller = $this;

        include_once $this->settings->templates_path . '/admin-page.php';

    }


    function load_admin_page_assets( $hook ) {


        if ( $hook != 'toplevel_page_' . $this->settings->slug . '_admin_page' ) {

            return;

        }


        wp_enqueue_style( $this->settings->slug . '_admin', $this->settings->asset_css_url . '/admin.css' );

        wp_enqueue_script($this->settings->slug . '_admin', $this->settings->asset_js_url . '/admin.js');

    }


    function get_database( $type ) {

        try {

            $database = new \Filebase\Database( [ 'dir' => $this->settings->storage_path . '/' . $type ] );

        } catch ( \Filebase\Filesystem\FilesystemException $e ) {

            error_log($e->getMessage());

            return new stdClass();

        }

        return $database;

    }
	

}