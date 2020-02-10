<?php


// IMPORTANT !! - Install this file in wordpress root folder,
// rename it without the stub,
// and require it from the wordpress wp-load.php file,
// right after "Define ABSPATH" lines,
// like so:
/*

require_once __DIR__ . '/class-and-trait-debugging.php';

*/

// IMPORTANT !! - see bottom of this file to find class's able for debugging anywere and other things
// Use this one liner in top of file: (It makes the code run even though you delete the debugging in future)
/*

if ( class_exists('D') ) { $d = new D(); } else { class D { function __construct() {} function t($file,$line,$value,$show=false) {} } } if ( ! function_exists('t_functions') ) { function t_functions( $line, $value, $show ) {} } if ( ! class_exists('Debugger') ) { class Debugger { function __construct() {} function t($file,$line,$value,$show=false) {} } } if ( ! trait_exists('Debugging') ) { trait Debugging { function t($file,$line,$value,$show=false) {} } }

*/
// Folded out it looks like this
/*

if ( class_exists('D') ) {

    $d = new D();

} else {

    class D {

        function __construct() {}

        function t($file,$line,$value,$show=false) {}

    }

}

if ( ! function_exists('t_functions') ) {

    function t_functions( $line, $value, $show ) {}

}

if ( ! class_exists('Debugger') ) {

    class Debugger {

        function __construct() {}

        function t($file,$line,$value,$show=false) {}

    }

}

if ( ! trait_exists('Debugging') ) {

    trait Debugging {

        function t($file,$line,$value,$show=false) {}

    }

}

*/


// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {

    die;

}


// Turn - on debugging based on request or other vars
$debugging_ip = 'YOUR IP ADDRESS';

if ( array_key_exists('debugging', $_GET) ) {

    define( 'APP_TEST_LOG', true );

    define( 'APP_TEST_LOG_SAME_LOG_FILE', true );

}
else if (
    array_key_exists('REMOTE_ADDR', $_SERVER )
    && $_SERVER['REMOTE_ADDR'] == $debugging_ip
) {

    define( 'APP_TEST_LOG', true );

}


// Define - default turned on logging behaviour
if ( ! defined('APP_TEST_LOG') ) {

    define( 'APP_TEST_LOG', false );

}


// Define - default setting of same log file or request based log files
if ( ! defined( 'APP_TEST_LOG_SAME_LOG_FILE') ) {

    define( 'APP_TEST_LOG_SAME_LOG_FILE', false );

}


// Prepare - folder and file path for debugging
if ( APP_TEST_LOG ) {

    $root_path = getcwd();

    if ( ! file_exists( $root_path . '/debugging' ) ) {

        mkdir( $root_path . '/debugging' );

    }


    // Define - file path for this request
    if ( APP_TEST_LOG_SAME_LOG_FILE ) {

        define( 'APP_TEST_LOG_FILEPATH', $root_path . '/debugging/debugging.txt' );

    }
    else {


        // Prepare - time
        $time = microtime(true);

        $micro = sprintf("%06d",($time - floor($time)) * 1000000);

        try {

            $date = new DateTime( date( 'Y-m-d H:i:s.' . $micro, $time ) );

        } catch ( \Exception $e ) {

            $value = 'Error on getting date in Debugging: ' . $e->getMessage();

        }

        $time = $date->format("Y-m-d-H-i-s-u");


        // Define - test log file path
        define( 'APP_TEST_LOG_FILEPATH', $root_path . '/debugging/' . $time . '.txt' );

    }

}

// Clean - debugging based on query or the whole directory
if (
    APP_TEST_LOG
    && APP_TEST_LOG_SAME_LOG_FILE
) {

    $f = @fopen( APP_TEST_LOG_FILEPATH , 'r+' );

    if ( $f !== false ) {

        ftruncate($f, 0);

        fclose($f);

    }

}

if ( array_key_exists('empty_debugging', $_GET ) ) {


    // Prepare - recursive function for deleting af folder and its content
    function rrmdir($src) {

        $dir = opendir($src);

        while(false !== ( $file = readdir($dir)) ) {

            if (( $file != '.' ) && ( $file != '..' )) {

                $full = $src . '/' . $file;

                if ( is_dir($full) ) {

                    rrmdir($full);

                }

                else {

                    unlink($full);

                }

            }

        }

        closedir($dir);

        rmdir($src);

    }


    // Fire - deleting the folder and it's content
    $debugging_folder = getcwd() . '/debugging';

    if ( is_dir($debugging_folder) ) {

        rrmdir($debugging_folder);

    }

}


// Trait - for debugging with in any class or just with the T class from the bottom
trait Debugging {


    // Define - core debugging method
    function t( $file, $line, $value, $show = false ) {


        // Quit - if test log is turned off
        if ( ! APP_TEST_LOG ) {

            return false;

        }


        // Prepare - file name
        $file = basename( $file );


        // Prepare - time
        $time = microtime(true);

        $micro = sprintf("%06d",($time - floor($time)) * 1000000);

        try {

            $date = new DateTime( date( 'Y-m-d H:i:s.' . $micro, $time ) );

        } catch ( \Exception $e ) {

            $value = 'Error on getting date in Debugging: ' . $e->getMessage();

        }

        $time = $date->format("[Y-m-d H:i:s.u]");


        // Print - full debugging line to file
        $line = PHP_EOL . $file . ' ' . $time . ' test ' . $line . ' ' . $this->te( $value );

        file_put_contents(
            APP_TEST_LOG_FILEPATH,
            $line,
            LOCK_EX | FILE_APPEND
        );

        return true;

    }


    /**
     * Debugger used for sending response to exception message
     *
     * Author: Jonas Schelde
     * Version: 16
     */
    function te( $value ) {

        $type = gettype( $value );

        if (
            $type === 'object'
            && $value instanceof DOMNode
        ) {

            $class = get_class( $value );

            $value = $type . ' ' . $class . ' ' . $this->show_DOM_node( $value );

        }
        else if (
            $type === 'object'
            && method_exists( $value,'attributesToArray')
        ) {

            $class = get_class( $value );

            $value = $type . ' ' . $class . ' ' . print_r( $value->attributesToArray(), true);

        }
        else if (
            $type === 'object'
            && method_exists( $value,'getMessage')
        ) {

            $class = get_class( $value );

            $value = $type . ' ' . $class . ' ' . print_r( $value->getMessage(), true);

        }
        else if ( $type === 'array' ) {

            $value = print_r($value, true);

        }
        else if ( $value === null ) {

            $value = $type . ' null';

        }
        else if ( $value === true ) {

            $value = $type . ' true';

        }
        else if ( $value === false ) {

            $value = $type . ' false';

        }
        else {

            $value = $type . ' ' . print_r($value, true);

        }

        return $value;

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
     * base64url encoding.
     * @param  String $input    Data to be encoded.
     * @param  Int    $nopad    Whether "=" pad the output or not.
     * @param  Int    $wrap     Whether to wrap the result.
     * @return base64url encoded $input.
     */
    function base64url_encode( $input , $nopad = 1 , $wrap = 0 ) {

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

    function base64url_decode($input) {

        return base64_decode(strtr($input, '-_,', '+/='));

    }

    /**
     * @param $format
     * @param $arr
     *
     * @return mixed
     */
    function printf_array($format, $arr) {

        return call_user_func_array('printf', array_merge((array)$format, $arr));

    }


    /**
     * @return bool|string
     */
    function get_secure_string() {

        return $this->random_string_generator(50);

    }

    /**
     * Random string generator
     *
     * @param $count
     *
     * @return bool|string
     */
    function random_string_generator($count) {

        // If count is less then 10 throw exception
        if ( $count < 10 ) {

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
     * Random Alphabet
     *
     * @param $position
     *
     * @return bool|string
     */
    function random_alphabet($position) {

        // Get character on position
        $character = substr('0123456789ABCDEFGHIJKLMNOPQRSTUXYZabcdefghijklmnopqrstuxyz', $position, 1);

        return $character;

    }

}

if ( ! class_exists('D') ) {

    class D {

        use Debugging;

    }

}

if ( ! class_exists('Debugger') ) {

    class Debugger {

        use Debugging;

    }

}

if ( ! function_exists('t_functions') ) {

    function t_functions( $line, $value, $show ) {

        $d = new D();

        $d->t( 't_functions', $line, $value, $show );

    }

}
