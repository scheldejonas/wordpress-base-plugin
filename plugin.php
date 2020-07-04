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


class plugin_name_settings {

	
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
	

	function __construct() {


        $this->root_path = substr( plugin_dir_path( __FILE__ ), 0, -1);

        $this->templates_path = $this->root_path . '/templates';

        $this->includes_path = $this->root_path . '/includes';

        $this->storage_path = $this->root_path . '/storage';


        $this->root_url = substr( plugin_dir_url( __FILE__ ), 0, -1);

        $this->asset_js_url = $this->root_url . '/js';

        $this->asset_css_url = $this->root_url . '/css';


        $this->settings = $this;
		
	}
	

	function activate() {
		
	}
	

	function deactivate() {
		
	}


	static function uninstall() {

	}
	

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


register_activation_hook( __FILE__, [$plugin_name_settings, 'activate'] );


register_deactivation_hook( __FILE__, [$plugin_name_settings, 'deactivate'] );


register_uninstall_hook( __FILE__, [$plugin_name_settings, 'uninstall'] );


add_action( 'init', [$plugin_name_settings, 'register_crons'] );


require_once $plugin_name_controller->includes_path . '/functions.php';

require_once $plugin_name_controller->includes_path . '/class-controller.php';


$plugin_name_controller = plugin_name_controller::get_instance( $plugin_name_settings );

