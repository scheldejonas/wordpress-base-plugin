<?php
	
// plugin_name - Plugin Global functions file
if ( class_exists('D') ) { $d = new D(); } else { class D { function __construct() {} function t($file,$line,$value,$show=false) {} } } if ( ! function_exists('t_functions') ) { function t_functions( $line, $value, $show ) {} } if ( ! class_exists('Debugger') ) { class Debugger { function __construct() {} function t($file,$line,$value,$show=false) {} } } if ( ! trait_exists('Debugging') ) { trait Debugging { function t($file,$line,$value,$show=false) {} } }

$d = new D();