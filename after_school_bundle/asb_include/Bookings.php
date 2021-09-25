<?php

namespace asb_include;
require_once dirname(DIRECTORY).'/asb_include/meta-box/meta-box.php';

Class Bookings {

	private static $booking_obj;

    public static function get_booking_obj() {
        if (!isset(self::$booking_obj)) {
            self::$booking_obj = new Bookings();
        }
        return self::$booking_obj;
    }

    function register() {
        self::$booking_obj = self::get_booking_obj();
        add_action( 'init', array(self::$booking_obj, 'create_bookings_cpt') );
        add_filter( 'rwmb_meta_boxes', array(self::$booking_obj, 'asb_register_meta_boxes') );
    }

	function create_bookings_cpt() {
		register_post_type( 'bookings',
        array(
            'labels' => array(
                'name' => __( 'Bookings', 'bookings' ),
                'singular_name' => __( 'Booking', 'bookings' ),
                'all_items' => __( 'All Bookings', 'bookings' ),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'bookings'),
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-calendar-alt',
            'menu_position' => 5,
            'capability_type' => 'post',
            //'taxonomies' => array( 'category', 'post_tag' ),
            'exclude_from_search' => false,
            'supports' => array('title'),
 
        )
    );
	}


    function asb_register_meta_boxes( $meta_boxes ) {
        $prefix = 'asb_';
        
        $meta_boxes[] = [
            'title'      => 'Booking Details',
            'post_types' => 'bookings',

            'fields' => [
                [
                    'name'        => 'Service',
                    'id'          => 'asb_booking_service',
                    'type'        => 'post',

                    // Post type.
                    'post_type'   => 'services',

                    // Field type.
                    'field_type'  => 'select_advanced',

                    // Placeholder, inherited from `select_advanced` field.
                    'placeholder' => 'Select a service',

                    // Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
                    'query_args'  => array(
                        'post_status'    => 'publish',
                        'posts_per_page' => - 1,
                    ),
                ],

                [
                    'name'        => 'For which Child?',
                    'id'          => 'asb_booking_child',
                    'type'        => 'post',

                    // Post type.
                    'post_type'   => 'children',

                    // Field type.
                    'field_type'  => 'select_advanced',

                    // Placeholder, inherited from `select_advanced` field.
                    'placeholder' => 'Select a child',

                    // Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
                    'query_args'  => array(
                        'post_status'    => 'publish',
                        'posts_per_page' => - 1,
                    ),
                ],

                [
                    'name'            => 'Date',
                    'id'              => 'asb_booking_date',
                    'type'            => 'date',
                    'placeholder'     => 'Select a date',

                    // Date picker options. See here http://api.jqueryui.com/datepicker
                    'js_options' => array(
                        'dateFormat'      => 'yy-mm-dd',
                        'showButtonPanel' => false,
                    ),

                    // Display inline?
                    'inline'    => false,

                    // Save value as timestamp?
                    'timestamp' => false,

                    'clone'     => true,
                    'add_button'=> 'Add another date',
                ],
                // More fields.
            ]
        ];

        // Add more field groups if you want
        // $meta_boxes[] = ...

        return $meta_boxes;
    }


}