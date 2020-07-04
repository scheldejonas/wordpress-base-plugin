<?php

namespace plugin_name;

use stdClass;

class plugin_name_admin_page {


	function __construct() {

        add_action( 'admin_menu', [$this, 'register_admin_page'] );

        add_action( 'admin_enqueue_scripts', [$this, 'load_admin_page_assets'] );

    }


    function register_admin_page() {

        global $plugin_name_settings;

        add_menu_page(
            __('plugin_name', $plugin_name_settings->slug),
            __('plugin_name', $plugin_name_settings->slug),
            'manage_options',
            $plugin_name_settings->slug . '_admin_page',
            [$this, 'view_admin_page'],
            'dashicons-editor-ul',
            100
        );

    }


    function view_admin_page() {

        global $plugin_name_settings;

        include_once $plugin_name_settings->templates_path . '/admin_view.php';

    }


    function load_admin_page_assets( $hook ) {

        global $plugin_name_settings;

        if ( $hook != 'toplevel_page_' . $plugin_name_settings->slug . '_admin_page' ) {

            return;

        }


        wp_enqueue_style( $plugin_name_settings->slug . '_admin', $plugin_name_settings->asset_css_url . '/admin.css' );

        wp_enqueue_script( $plugin_name_settings->slug . '_admin', $plugin_name_settings->asset_js_url . '/admin.js');

    }


    function get_database( $type ) {

        global $plugin_name_settings;

        try {

            $database = new \Filebase\Database([
                'dir' => $plugin_name_settings->storage_path . '/' . $type
            ]);

        } catch ( \Filebase\Filesystem\FilesystemException $e ) {

            error_log($e->getMessage());

            return new stdClass();

        }

        return $database;

    }


}