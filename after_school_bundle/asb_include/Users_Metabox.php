<?php

namespace asb_include;
require_once dirname(DIRECTORY).'/asb_include/meta-box/meta-box.php';

Class Users_Metabox {

	private static $user_obj;

    public static function get_user_obj() {
        if (!isset(self::$user_obj)) {
            self::$user_obj = new Users_Metabox();
        }
        return self::$user_obj;
    }

    function register() {
        self::$user_obj = self::get_user_obj();
        add_filter( 'rwmb_meta_boxes', array(self::$user_obj, 'asb_register_meta_boxes') );
    }

    function get_parents_list() {
        $users = get_users( [
            'role'    => 'parent',
            'orderby' => 'user_nicename',
            'order'   => 'ASC'
        ] );

        //$options = array();
        foreach ( $users as $user ) {
            $options[$user->display_name] = $user->display_name;
        }

        return $options;
    }

    function asb_register_meta_boxes( $meta_boxes ) {
        $prefix = 'asb_';
        
        $meta_boxes[] = [
            'title'      => 'Parent Users',
            'post_types' => 'parents, children, bookings',

            'fields' => [
                  [
                        'name' => 'Parent Users',
                        'id'   => $prefix . 'parent_users',
                        'type' => 'select',
                        // Array of 'value' => 'Label' pairs
                        'options'  => $this->get_parents_list(),
                        // Allow to select multiple value?
                        'multiple'        => false,
                        // Placeholder text
                        'placeholder'     => 'Select a parent',
                        // Display "Select All / None" button?
                        'select_all_none' => false,
                    ],  
                // More fields.
            ]
        ];

        // Add more field groups if you want
        // $meta_boxes[] = ...

        return $meta_boxes;
    }


}