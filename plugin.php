<?php

/**
 * @wordpress-plugin
 * Plugin Name:       plugin_name
 * Plugin URI:        https://github.com/scheldejonas/wordpress-base-plugin
 * Description:       A description for a truly clean and genuine plugin
 * Version:           1.0.0
 * Author:            Jonas Schelde
 * Author URI:        https://www.jonasschelde.dk/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */


// Debugger
if ( class_exists('D') ) { $d = new D(); } else { class D { function __construct() {} function t($file,$line,$value,$show=false) {} } } if ( ! function_exists('t_functions') ) { function t_functions( $line, $value, $show ) {} } if ( ! class_exists('Debugger') ) { class Debugger { function __construct() {} function t($file,$line,$value,$show=false) {} } } if ( ! trait_exists('Debugging') ) { trait Debugging { function t($file,$line,$value,$show=false) {} } }


 // If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Load all the constants for the plugin
 *
 * Note: Start at version 1.0.0 and use SemVer - https://semver.org
 * 
 */
class plugin_name_settings {
	
	use Debugging;
	
	public $version = '1.0.0';
	
	public $slug = 'plugin_name';
	
	public $root_path = '';

	public $templates_path = '';

	public $includes_path = '';

    public $storage_path = '';

    public $root_url = '';

	public $asset_js_url = '';

	public $asset_css_url = '';
	
	public $asset_version = 1;
	
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	function __construct() {


        // Create - needed paths
        $this->root_path = substr( plugin_dir_path( __FILE__ ), 0, -1);

        $this->templates_path = $this->root_path . '/templates';

        $this->includes_path = $this->root_path . '/includes';

        $this->storage_path = $this->root_path . '/storage';


        // Create - needed urls
        $this->root_url = substr( plugin_dir_url( __FILE__ ), 0, -1);

        $this->asset_js_url = $this->root_url . '/js';

        $this->asset_css_url = $this->root_url . '/css';


        // Relate - settings instance
        $this->settings = $this;				$this->t(__FILE__,__LINE__,true);
		
	}
	
	
	/**
	 * activate function.
	 * 
	 * @access public
	 * @return void
	 */
	function activate() {						$this->t(__FILE__,__LINE__,true);
		
		//
		
	}
	
	
	/**
	 * deactivate function.
	 * 
	 * @access public
	 * @return void
	 */
	function deactivate() {						$this->t(__FILE__,__LINE__,true);
		
		//
		
	}
	
	
	/**
	 * uninstall function.
	 * 
	 * @access public
	 * @return void
	 */
	function uninstall() {						$this->t(__FILE__,__LINE__,true);
		
		//
		
	}
	
	
	/**
	 * register_crons function.
	 * 
	 * @access public
	 * @return void
	 */
	function register_crons() {
		
		$events = [
// 			'plugin_name_hourly_event' => 'hourly'
		];
		
		
		foreach ( $events as $event_name => $duration ) {
			
		    if (
		    	! wp_next_scheduled ( $event_name )
		    ) {
			    
				wp_schedule_event( strtotime('today Europe/Copenhagen +1 day'), $duration, $event_name );
			
		    }	
			
		}
		
	}
	
	
}

$plugin_name_settings = new plugin_name_settings();


// Change - things on activation
register_activation_hook( __FILE__, [$plugin_name_settings, 'activate'] );


// Change - things on deactivation
register_deactivation_hook( __FILE__, [$plugin_name_settings, 'deactivate'] );


// Change - things on uninstallation
register_uninstall_hook( __FILE__, [$plugin_name_settings, 'uninstall'] );


// Register - cron schedules
add_action( 'init', [$plugin_name_settings, 'register_crons'] );


// Load - plugin main class
require_once $plugin_name_controller->includes_path . '/functions.php';

require_once $plugin_name_controller->includes_path . '/class-controller.php';


// Run - plugin with controller and others
$plugin_name_controller = plugin_name_controller::get_instance( $plugin_name_settings );

