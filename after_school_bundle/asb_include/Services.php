<?php

namespace asb_include;
require_once dirname(DIRECTORY).'/asb_include/meta-box/meta-box.php';

Class Services {

	private static $service_obj;

    public static function get_service_obj() {
        if (!isset(self::$service_obj)) {
            self::$service_obj = new Services();
        }
        return self::$service_obj;
    }

    function register() {
        self::$service_obj = self::get_service_obj();
        add_action( 'init', array(self::$service_obj, 'create_services_cpt') );
        add_filter( 'rwmb_meta_boxes', array(self::$service_obj, 'asb_register_meta_boxes') );
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
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-screenoptions',
            'menu_position' => 5,
            'capability_type' => 'post',
            //'taxonomies' => array( 'category', 'post_tag' ),
            'exclude_from_search' => false,
            'supports' => array('title', 'editor', 'thumbnail'),
 
        )
    );
	}


    function asb_register_meta_boxes( $meta_boxes ) {
        $meta_boxes[] = [
            'title'      => 'Service Price',
            'post_types' => 'services',

            'fields' => [
                [
                    'name'  => 'Price (£)',
                    'desc'  => '',
                    'id'    => 'asb_price',
                    'type'  => 'number',
                    'min'   => 0
                ],
                // More fields.
            ]
        ];

        // Add more field groups if you want
        // $meta_boxes[] = ...

        return $meta_boxes;
    }


}