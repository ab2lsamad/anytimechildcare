<?php
/**
 * Plugin Name:       After School Bundle
 * Plugin URI:        https://cawoy.com/
 * Description:       Any Time Child Care System to book child care services.
 * Version:           1.0
 * Author:            Cawoy LTD | Abdul Samad
 * Text Domain:       any-time-child-care
 */

if (!defined('DIRECTORY')) {
	define('DIRECTORY', '__FILE__');
}

if (!defined('ABSPATH')) {
	die();
}

if (file_exists(dirname(DIRECTORY).'/vendor/autoload.php')) {
	require_once dirname(DIRECTORY).'/vendor/autoload.php';
}

use asb_include\Services;

if (!class_exists('AfterSchoolBundle_Main')) {
	class AfterSchoolBundle_Main
    {
    	private static $main_obj;
    	private $service_obj;
	
	     function __construct() {
	     	$this->$service_obj = Services::get_service_obj();
	     	add_action( 'init', array($this->$service_obj, 'create_services_cpt') );
	     }

	     function activate_plugin()
	     {
	     	$this->$service_obj = Services::get_service_obj();
	     	add_action( 'init', array($this->$service_obj, 'create_services_cpt') );
			flush_rewrite_rules();
	     }

		function deactivate_plugin()
		{
			flush_rewrite_rules();
		}

		function register_activation() {
			register_activation_hook( DIRECTORY, array(self::$main_obj, 'activate_plugin') );
		}

		function register_deactivation() {
			register_deactivation_hook( DIRECTORY, array(self::$main_obj, 'deactivate_plugin') );
		}

		public static function get_main_obj() {
			if (!isset(self::$main_obj)) {
				self::$main_obj = new AfterSchoolBundle_Main();
			}
			return self::$main_obj;
		}

	}

	$mainclass = AfterSchoolBundle_Main::get_main_obj();
	$mainclass->register_activation();
	$mainclass->register_deactivation();	

}
