<?php
	
// plugin_name - Plugin Global functions file
if ( class_exists('D') ) { $d = new D(); } else { class D { function __construct(){} function t($file,$line,$value,$show=false) {} } }

$d->t(__FILE__,__LINE__,'Tryout',true);
