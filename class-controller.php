<?php
	
 // If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * NameExtensionController class.
 */
class plugin_name_controller {
	
	
	use tools_v1;
	
	
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
			
		}																									$this->t(__FILE__,__LINE__,true);
		
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