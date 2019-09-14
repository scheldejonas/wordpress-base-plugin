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
 
 
 // If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


// Load - tooling and testing
require_once plugin_dir_path( __FILE__ ) . 'trait-tools.php';


/**
 * Load all the constants for the plugin
 *
 * Note: Start at version 1.0.0 and use SemVer - https://semver.org
 * 
 */
class plugin_name_settings {
	
	use tools_v1;
	
	public $version = '1.0.0';
	
	public $slug = 'plugin_name';
	
	public $test_stop = false;
	
	public $test_force = false;
	
	public $test_ip = '188.180.97.126';
	
	public $plugin_dir_path = '';
	
	public $plugin_dir_url = '';
	
	public $asset_version = 1;
	
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	function __construct() {					
		
		$this->plugin_dir_path = plugin_dir_path( __FILE__ );
		
		$this->plugin_dir_url = substr( plugin_dir_url( __FILE__ ), 0, -1);
		
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
require_once $plugin_name_settings->plugin_dir_path . 'class-controller.php';


// Run - plugin with controller and others
$plugin_name_controller = plugin_name_controller::get_instance( $plugin_name_settings );

if ( 
	false 
) {
	
	require_once $this->settings->plugin_dir_path . 'class-child_name.php';
		
	plugin_name_child_name::get_instance( $plugin_name_controller );
	
}
