<?php
	
/**
 * @wordpress-plugin
 * Plugin Name:       Name - Extension
 * Plugin URI:        https://github.com/scheldejonas/wordpress-base-plugin
 * Description:       Modifying the initial plugin, for this site
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
class Plugin_Name_Extension_Settings {
	
	use ToolsV1;
	
	public $version = '1.0.0';
	
	public $slug = 'name-extension';
	
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
		
		$this->plugin_dir_url = plugin_dir_url( __FILE__ );
		
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

$plugin_name_settings = new Plugin_Name_Extension_Settings();


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
$plugin_name_controller = Plugin_Name_Controller::get_instance( $plugin_name_settings );

if ( 
	false 
) {
	
	require_once $this->settings->plugin_dir_path . 'class-child-name.php';
		
	Plugin_Name_Child_Name::get_instance( $plugin_name_controller );
	
}
