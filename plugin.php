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

require_once 'vendor/autoload.php';

$plugin_name_settings = new plugin_name_settings();


register_activation_hook( __FILE__, [$plugin_name_settings, 'activate'] );


register_deactivation_hook( __FILE__, [$plugin_name_settings, 'deactivate'] );


register_uninstall_hook( __FILE__, [$plugin_name_settings, 'uninstall'] );


add_action( 'init', [$plugin_name_settings, 'register_crons'] );
