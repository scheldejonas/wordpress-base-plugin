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


// Load - all classes as services in global scope, load hooks from constructors of classes
require __DIR__ . '/vendor/autoload.php';

$plugin_name_settings = new plugin_name\plugin_name_settings(__FILE__);


// Plugin updater
require 'plugin-update-checker/plugin-update-checker.php';

$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/username/wordpress-plugin-plugin_name/',
    __FILE__,
    'ritzau'
);

$myUpdateChecker->setAuthentication('wordpresspluginplugin_nameaccess_token');

$myUpdateChecker->setBranch('master');