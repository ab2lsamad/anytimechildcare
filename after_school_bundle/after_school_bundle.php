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
	define('DIRECTORY', __FILE__);
}

if (!defined('ABSPATH')) {
	die();
}

if (file_exists(dirname(DIRECTORY).'/vendor/autoload.php')) {
	require_once dirname(DIRECTORY).'/vendor/autoload.php';
}

use asb_include\Services;
use asb_include\Parents;
use asb_include\Children;
use asb_include\Users_Metabox;
use asb_include\Bookings;

if (!class_exists('ASB_Main')) {
	class ASB_Main
    {
    	private static $main_obj;
    	private $service_obj;
    	private $parent_obj;
    	private $child_obj;
    	private $users_metabox_obj;
    	private $booking_obj;

	     function register_all() {
	     	$this->$service_obj = Services::get_service_obj();
	     	$this->$service_obj->register();
	     	
	     	$this->$parent_obj = Parents::get_parent_obj();
	     	$this->$parent_obj->register();
	     	
	     	$this->$child_obj = Children::get_child_obj();
	     	$this->$child_obj->register();

	     	$this->$user_metabox_obj = Users_Metabox::get_user_obj();
	     	$this->$users_metabox_obj->register();

	     	$this->$booking_obj = Bookings::get_booking_obj();
	     	$this->$booking_obj->register();
	     }

	     function activate_plugin()
	     {
			flush_rewrite_rules();

			add_role('parent', 'Parent',);
	     }

		function deactivate_plugin()
		{
			flush_rewrite_rules();

			remove_role('parent', 'Parent',);
		}

		public static function get_main_obj() {
			if (!isset(self::$main_obj)) {
				self::$main_obj = new ASB_Main();
			}
			return self::$main_obj;
		}

	}

	$mainclass = ASB_Main::get_main_obj();
	$mainclass->register_all();

	register_activation_hook( DIRECTORY, array('ASB_Main', 'activate_plugin') );
	register_deactivation_hook( DIRECTORY, array('ASB_Main', 'deactivate_plugin') );

}
