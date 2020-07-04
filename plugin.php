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

require __DIR__ . '/vendor/autoload.php';

$plugin_name_settings = new plugin_name\plugin_name_settings();
