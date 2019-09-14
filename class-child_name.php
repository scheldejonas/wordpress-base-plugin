<?php
	
 // If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
* Visual Composer Date Form Button element
*/
class plugin_name_child_name {


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
	static function get_instance( $controller_instance = null) {
		
		if (self::$instance == null) {
			
            self::$instance = new self( $controller_instance );
            
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
	function __construct( $controller_instance ) {
		
		
		// Set - parent classes
		if ( $controller_instance !== null ) {
			
			$this->controller = $controller_instance;
			
			$this->settings = $controller_instance->settings;
			
			$controller_instance->plugin_name_child_name = $this;
			
		}																													$this->t(__FILE__,__LINE__,$this);
		
		
		// Run - class
		$this->run_filters();
		
		$this->run_actions();
		
		$this->run_shortcodes();
		
		
	}
	
	
	/**
	 * run_filters function.
	 * 
	 * @access public
	 * @return void
	 */
	function run_filters() {
		
	}
	
	
	/**
	 * run_actions function.
	 * 
	 * @access public
	 * @return void
	 */
	function run_actions() {
		
	}
	
	
	/**
	 * run_shortcode function.
	 * 
	 * @access public
	 * @return void
	 */
	function run_shortcodes() {
		
		
	}
	

}
