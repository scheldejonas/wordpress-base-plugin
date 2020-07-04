<?php

namespace plugin_name;

class plugin_name_settings {


    public $version = '1.0.0';

    public $slug = 'plugin_name';

    public $root_path = '';

    public $templates_path = '';

    public $includes_path = '';

    public $storage_path = '';

    public $root_url = '';

    public $asset_js_url = '';

    public $asset_css_url = '';

    public $asset_version = 1;


    function __construct() {


        $this->root_path = substr( plugin_dir_path( __FILE__ ), 0, -1);

        $this->templates_path = $this->root_path . '/templates';

        $this->includes_path = $this->root_path . '/includes';

        $this->storage_path = $this->root_path . '/storage';


        $this->root_url = substr( plugin_dir_url( __FILE__ ), 0, -1);

        $this->asset_js_url = $this->root_url . '/js';

        $this->asset_css_url = $this->root_url . '/css';


        register_activation_hook( __FILE__, [$this, 'activate'] );

        register_deactivation_hook( __FILE__, [$this, 'deactivate'] );

        register_uninstall_hook( __FILE__, [$this, 'uninstall'] );

        add_action( 'init', [$this, 'register_crons'] );


    }


    function activate() {

    }


    function deactivate() {

    }


    static function uninstall() {

    }


    function register_crons() {

        $events = [
            // 			'plugin_name_hourly_event' => 'hourly'
        ];

        foreach ( $events as $event_name => $duration ) {

            if (
            ! wp_next_scheduled ( $event_name )
            ) {

                wp_schedule_event( strtotime('today Europe/Copenhagen +1 day'), $duration, $event_name );

            }

        }

    }


}
