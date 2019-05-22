<?php

/**
 * Schelde Common Trait
 * version: 4.0.0
*/


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


if ( ! trait_exists('ScheldeCommon4') ) :
/**
 * ScheldeCommon trait.
 */
trait ScheldeCommon4
{


	/**
	 * exists function.
	 * 
	 * @access public
	 * @param mixed $value
	 * @return void
	 */
	function exists($value) {

		// Check for set
		if ( ! isset($value) ) {
			return false;
		}

		// Check for empty
		if ( empty($value) ) {
			return false;
		}

		// Check for empty string
		if ( $value === '' ) {
			return false;
		}

		// Check for false
		if ( $value === false ) {
			return false;
		}

		// Check for null
		if ( $value === null ) {
			return false;
		}

		// Check for no date time
		if ( $value === '0000-00-00 00:00:00') {
			return false;
		}

		// Check for no date
		if ( $value === '0000-00-00') {
			return false;
		}

        // Check for empty array
        if ( $value === (new \stdClass())) {
            return false;
        }

		return true;
	}
	
	
	/**
	 * is_array_value function.
	 * 
	 * @access public
	 * @param mixed $key
	 * @param mixed $array
	 * @return void
	 */
	function is_array_value($key, $array) {
		
		if ( array_key_exists($key, $array) ) {
			
			if ( $array[$key] ) {
				
				return true;
				
			}
			
		}
		
		return false;
	}



	/**
	 * exists_static function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $value
	 * @return void
	 */
	static function exists_static($value) {

		// Check for set
		if ( ! isset($value) ) {
			return false;
		}

		// Check for empty
		if ( empty($value) ) {
			return false;
		}

		// Check for empty string
		if ( $value === '' ) {
			return false;
		}

		// Check for false
		if ( $value === false ) {
			return false;
		}

		// Check for null
		if ( $value === null ) {
			return false;
		}

		return true;
	}



	/**
	 * t function.
	 * 
	 * @access public
	 * @param mixed $file
	 * @param mixed $line
	 * @param mixed $value
	 * @param mixed $force (default: null)
	 * @return void
	 */
	function t($file, $line, $value, $force = null) {

		if (
			$force === true
			|| ( 
				$force !== false
				&& ! $this->settings->test_stop
				&& ( 
					$_SERVER['REMOTE_ADDR'] === $this->settings->test_ip 
					|| $this->settings->test_force 
				) 
			) 
		) {

            $debug_file_path = dirname($file) . '/' . basename($file, '.php') . '.txt';

            $time = microtime(true);

            $micro = sprintf("%06d",($time - floor($time)) * 1000000);

            try {
	            
                $date = new DateTime(date('Y-m-d H:i:s.' . $micro, $time));
                
            } catch (\Exception $e) {
	            
                $date = now();
                
            }

            $start_line = $date->format("[Y-m-d H:i:s.u]") . ' test ' . $line . ' ';

            $value = $start_line . ' ' . $this->te( $value );
            
            file_put_contents(
                $debug_file_path,
                $value . PHP_EOL,
                LOCK_EX | FILE_APPEND
            );
		
		}

	}
	
	
	/**
	 * show_DOM_node function.
	 * 
	 * @access public
	 * @param DOMNode $domNode
	 * @param mixed $print
	 * @return void
	 */
	function show_DOM_node(DOMNode $domNode, $print) {
		
		$print .= $domNode->nodeName.':'.$domNode->nodeValue;
		
	    foreach ($domNode->childNodes as $node) {																				
		    
	        if ( $node->hasChildNodes() ) {
		        
	            $this->show_DOM_node($node, $print);
	            
	        }
	        
	    }   
	    
	    return $print;
	     
	}
	

	/**
	 * te function.
	 * 
	 * @access public
	 * @param mixed $value
	 * @return void
	 */
	function te( $value ) {

		$type = gettype( $value );
		
		$type .= ' ';

        if (
        	$type === 'object'
        	&& $value instanceof DOMNode
        ) {
            
			$value = $type . $this->show_DOM_node( $value );

        } 
        else if ( 
            $type === 'object'
        	&& method_exists( $value,'attributesToArray') 
        ) {

            $value = $type . print_r( $value->attributesToArray(), true);

        }
        else if (
        	$type === 'object'
        	&& method_exists( $value,'getMessage') 
        ) {

            $value = $type . print_r( $value->getMessage(), true);

        } 
        else if (
        	$type === 'array'
        ) {

            $value = $type . print_r($value, true);

        } 
        else if (
        	$value === null
        ) {

            $value = $type . 'null';

        } 
        else if (
        	$value === true
        ) {

            $value = $type . 'true';

        } 
        else if (
        	$value === false
        ) {

            $value = $type . 'false';

        }
        else {

            $value = $type . print_r($value, true);

        }
        
        return $value;

	}


    /**
     * get_secure_string function.
     * 
     * @access public
     * @return void
     */
    public function get_secure_string() {

		return $this->random_string_generator(50);

	}


	/**
	 * random_string_generator function.
	 * 
	 * @access public
	 * @param mixed $count
	 * @return void
	 */
	public function random_string_generator($count) {

		// If count is less then 10 throw exception
		if ( $count < 10 ) {
			report( new \Exception('Random string generator was below 10 characters') );

			return false;
		}

		// Make new random string
		$new_random_string = '';

		// Get random character from alphabet foreach count
		for ( $i = 0; $i < $count; $i++ ) {

			// Get random number inside scope
			$random_number = rand(0, 57);

			// Get random alphabet number
			$new_character = $this->random_alphabet($random_number);

			// Add new character to string
			$new_random_string .= $new_character;
		}

		return $new_random_string;


	}


    /**
     * base64url_encode function.
     * 
     * @access public
     * @param mixed $input
     * @param int $nopad (default: 1)
     * @param int $wrap (default: 0)
     * @return void
     */
    public function base64url_encode( $input , $nopad = 1 , $wrap = 0 ) {

        $data  = base64_encode($input);

        if ( $nopad ) {

            $data = str_replace("=","",$data);

        }

        $data = strtr($data, '+/=', '-_,');

        if ($wrap) {

            $datalb = "";

            while (strlen($data) > 64) {

                $datalb .= substr($data, 0, 64) . "\n";

                $data = substr($data,64);

            }

            $datalb .= $data;

            return $datalb;

        } else {

            return $data;

        }

    }


    /**
     * base64url_decode function.
     * 
     * @access public
     * @param mixed $input
     * @return void
     */
    public function base64url_decode($input) {

        return base64_decode(strtr($input, '-_,', '+/='));

    }



	/**
	 * random_alphabet function.
	 * 
	 * @access private
	 * @param mixed $position
	 * @return void
	 */
	private function random_alphabet($position) {

		// Get character on position
		$character = substr('0123456789ABCDEFGHIJKLMNOPQRSTUXYZabcdefghijklmnopqrstuxyz', $position, 1);

		return $character;
	}


    /**
     * get_unique_id function.
     * 
     * @access public
     * @param bool $test (default: false)
     * @return void
     */
    public function get_unique_id($test = false) {

        $id = date_format('YmdHisu');

        if ( $test ) {

            $time = date_format('ymdHisu');

            $id = 'TE' . $time;

        }

        return $id;

    }
    
    
    /**
     * wp_is_doing_ajax function.
     * 
     * @access public
     * @return void
     */
    public function wp_is_doing_ajax() {
	    
	    if ( array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) ) {
		    
		    if ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) {
			
				return true;    
			    
		    }
		    
	    }
	    
	    return defined( 'DOING_AJAX' ) && DOING_AJAX;
	    		
    }

}
endif;