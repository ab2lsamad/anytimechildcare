<?php

namespace asb_include;
require_once dirname(DIRECTORY).'/asb_include/meta-box/meta-box.php';

Class Parents {

	private static $parent_obj;

    public static function get_parent_obj() {
        if (!isset(self::$parent_obj)) {
            self::$parent_obj = new Parents();
        }
        return self::$parent_obj;
    }

    function register() {
        self::$parent_obj = self::get_parent_obj();
        add_action( 'init', array(self::$parent_obj, 'create_parents_cpt') );
        add_filter( 'rwmb_meta_boxes', array(self::$parent_obj, 'asb_register_meta_boxes') );
    }

	function create_parents_cpt() {
		register_post_type( 'parents',
        array(
            'labels' => array(
                'name' => __( 'Parents', 'parents' ),
                'singular_name' => __( 'Parent', 'parents' ),
                'all_items' => __( 'All Parents', 'parents' ),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'parents'),
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-groups',
            'menu_position' => 4,
            'capability_type' => 'post',
            //'taxonomies' => array( 'category', 'post_tag' ),
            'exclude_from_search' => false,
            'supports' => array('title'),
 
        )
    );
	}

    function get_parents_list() {
        $users = get_users( [
            'role'    => 'subscriber',
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
            'title'      => 'Personal Details',
            'post_types' => 'parents',

            'fields' => [
                    [
                        'name' => 'Title',
                        'id'   => $prefix . 'personal_title',
                        'type' => 'select',
                        // Array of 'value' => 'Label' pairs
                        'options'  => [
                            'mr.'    => 'Mr.',
                            'mrs.'   => 'Mrs.',
                            'ms.'    => 'Ms.',
                            'dr.'    => 'Dr.',
                        ],
                        // Allow to select multiple value?
                        'multiple'        => false,
                        // Placeholder text
                        'placeholder'     => 'Select a title',
                        // Display "Select All / None" button?
                        'select_all_none' => false,
                    ],

                    [
                        'name'        => 'Full Address',
                        'desc'        => '',
                        'id'          => 'asb_personal_address',
                        'type'        => 'textarea',
                        'placeholder' => 'Enter your full address'
                    ],

                    [
                        'name'        => 'Number',
                        'desc'        => '',
                        'id'          => 'asb_personal_number',
                        'type'        => 'text',
                        'pattern'     => '[0-9]{11}',
                        'maxlength'   => 11,
                        'placeholder' => 'Enter your mobile number'
                    ],

                    [
                        'name'        => 'Postcode',
                        'desc'        => '',
                        'id'          => 'asb_personal_postcode',
                        'type'        => 'text',
                        'minlength'   => 5,
                        'maxlength'   => 7,
                        'placeholder' => 'Enter your postcode'
                    ],

                    [
                        'name'        => 'Telephone Number',
                        'desc'        => '',
                        'id'          => 'asb_personal_telephone',
                        'type'        => 'text',
                        'pattern'     => '[0-9]{11}',
                        'maxlength'   => 11,
                        'placeholder' => 'Enter your telephone number'
                    ],

                    [
                        'name'        => 'Email Address',
                        'desc'        => '',
                        'id'          => 'asb_personal_email',
                        'type'        => 'text',
                        'placeholder' => 'Enter your email address'
                    ],

                // More fields.
            ]
        ];

        $meta_boxes[] = [
            'title'      => 'Emergency Contact',
            'post_types' => 'parents',

            'fields' => [
                    [
                        'name'        => 'Name',
                        'desc'        => '',
                        'id'          => 'asb_emergency_name',
                        'type'        => 'text',
                        'placeholder' => 'Enter emergency contact name'
                    ],

                    [
                        'name' => 'Title',
                        'id'   => $prefix . 'emergency_title',
                        'type' => 'select',
                        // Array of 'value' => 'Label' pairs
                        'options'  => [
                            'mr.'    => 'Mr.',
                            'mrs.'   => 'Mrs.',
                            'ms.'    => 'Ms.',
                            'dr.'    => 'Dr.',
                        ],
                        // Allow to select multiple value?
                        'multiple'        => false,
                        // Placeholder text
                        'placeholder'     => 'Select a title',
                        // Display "Select All / None" button?
                        'select_all_none' => false,
                    ],

                    [
                        'name'        => 'Full Address',
                        'desc'        => '',
                        'id'          => 'asb_emergency_address',
                        'type'        => 'textarea',
                        'placeholder' => 'Enter emergency contact\'s full address'
                    ],

                    [
                        'name'        => 'Number',
                        'desc'        => '',
                        'id'          => 'asb_emergency_number',
                        'type'        => 'text',
                        'pattern'     => '[0-9]{11}',
                        'maxlength'   => 11,
                        'placeholder' => 'Enter emergency mobile number'

                    ],

                    [
                        'name'        => 'Postcode',
                        'desc'        => '',
                        'id'          => 'asb_emergency_postcode',
                        'type'        => 'text',
                        'minlength'   => 5,
                        'maxlength'   => 7,
                        'placeholder' => 'Enter emergency contact\'s postcode'
                    ],

                    [
                        'name'        => 'Telephone Number',
                        'desc'        => '',
                        'id'          => 'asb_emergency_telephone',
                        'type'        => 'text',
                        'pattern'     => '[0-9]{11}',
                        'maxlength'   => 11,
                        'placeholder' => 'Enter emergency telephone number'
                    ],

                    [
                        'name'        => 'Email Address',
                        'desc'        => '',
                        'id'          => 'asb_emergency_email',
                        'type'        => 'text',
                        'placeholder' => 'Enter emergency email address'
                    ],

                    [
                        'name'        => 'Relationship',
                        'desc'        => '',
                        'id'          => 'asb_emergency_relationship',
                        'type'        => 'text',
                        'placeholder' => 'Enter emergency contact\'s relationship with child'
                    ],

                // More fields.
            ]
        ];

        $meta_boxes[] = [
            'title'      => 'Doctor Details',
            'post_types' => 'parents',

            'fields' => [
                    [
                        'name'        => 'Name',
                        'desc'        => '',
                        'id'          => 'asb_doctor_name',
                        'type'        => 'text',
                        'placeholder' => 'Enter doctor\'s name'
                    ],

                    [
                        'name'        => 'Address',
                        'desc'        => '',
                        'id'          => 'asb_doctor_address',
                        'type'        => 'textarea',
                        'placeholder' => 'Enter doctor\'s full address'
                    ],

                    [
                        'name'        => 'Telephone Number',
                        'desc'        => '',
                        'id'          => 'asb_doctors_telephone',
                        'type'        => 'text',
                        'pattern'     => '[0-9]{11}',
                        'maxlength'   => 11,
                        'placeholder' => 'Enter doctor\'s telephone number'
                    ],

                // More fields.
            ]
        ];

        // Add more field groups if you want
        // $meta_boxes[] = ...

        return $meta_boxes;
    }


}