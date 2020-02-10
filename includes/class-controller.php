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
			
			$settings_instance->plugin_name_controller = $this;
			
		}																				$this->t(__FILE__,__LINE__,true);
		
		$this->run_filters();
		
		$this->run_actions();
		
		$this->run_shortcodes();
		
	}
	
	
	/**
	 * run function.
	 * 
	 * @access public
	 * @return void
	 */
	 function run_filters() {
		
	
	 	//
		
		
	}
	
	
	/**
	 * run_actions function.
	 * 
	 * @access public
	 * @return void
	 */
	function run_actions() {
	
	
		//
		
		
	}
	
	
	/**
	 * run_shortcodes function.
	 * 
	 * @access public
	 * @return void
	 */
	function run_shortcodes() {				
		
	
		//
		
		
	}
	

}