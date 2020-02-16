<?php


// Debugger
if ( class_exists('D') ) { $d = new D(); } else { class D { function __construct() {} function t($file,$line,$value,$show=false) {} } } if ( ! function_exists('t_functions') ) { function t_functions( $line, $value, $show ) {} } if ( ! class_exists('Debugger') ) { class Debugger { function __construct() {} function t($file,$line,$value,$show=false) {} } } if ( ! trait_exists('Debugging') ) { trait Debugging { function t($file,$line,$value,$show=false) {} } }


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


// Class - controller
class plugin_name_controller {
	
	use Debugging;

	/**
	 * instance
	 * 
	 * (default value: null)
	 * 
	 * @var mixed
	 * @access public
	 * @static
	 */
	static $instance = null;
	
	
	/**
	 * get_instance function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $extending_instance (default: null)
	 * @return void
	 */
	static function get_instance($settings_instance = null) {
		
		if (self::$instance == null) {
			
            self::$instance = new self($settings_instance);
            
        }
        
        return self::$instance;
        
	}
	
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param mixed $extending_instance
	 * @return void
	 */
	function __construct($settings_instance) {
		
		if ( $settings_instance !== null ) {
			
			$this->settings = $settings_instance;
			
			$settings_instance->controller = $this;
			
		}																				$this->t(__FILE__,__LINE__,true);

        $this->load_hooks();

    }


    /**
     * run function.
     *
     * @access public
     * @return void
     */
    function load_hooks() {

        // Load - admin page
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


        // Quit - if not hook is admin page
        if ( $hook != 'toplevel_page_' . $this->settings->slug . '_admin_page' ) {

            return;

        }


        // Load - assets
        wp_enqueue_style( $this->settings->slug . '_admin', $this->settings->asset_css_url . '/admin.css' );

        wp_enqueue_script($this->settings->slug . '_admin', $this->settings->asset_js_url . '/admin.js');

    }


    function get_database( $type ) {

        try {

            $database = new \Filebase\Database( [ 'dir' => $this->settings->storage_path . '/' . $type ] );     $this->t(__FILE__,__LINE__,$database);

        } catch ( \Filebase\Filesystem\FilesystemException $e ) {

            error_log($e->getMessage());

            return new stdClass();

        }

        return $database;

    }
	

}