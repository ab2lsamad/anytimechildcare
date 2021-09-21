<?php

namespace asb_include;

Class Services {

	private static $service_obj;
	
	function __construct() {
		add_action( 'init', array($this->$service_obj, 'create_services_cpt') );
	}

	function create_services_cpt() {
		register_post_type( 'services',
        array(
            'labels' => array(
                'name' => __( 'Services', 'services' ),
                'singular_name' => __( 'Service', 'services' ),
                'all_items' => __( 'All Services', 'services' ),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'services'),
            'show_in_rest' => true,
            'show_in_menu' => true,
            'menu_position' => 3,
            'capability_type' => 'post',
 
        )
    );
	}

	public static function get_service_obj() {
		if (!isset(self::$service_obj)) {
			self::$service_obj = new Services();
		}
        return self::$service_obj;
	}
}