<?php

namespace asb_include;
require_once dirname(DIRECTORY).'/asb_include/meta-box/meta-box.php';

Class Children {

	private static $child_obj;

    public static function get_child_obj() {
        if (!isset(self::$child_obj)) {
            self::$child_obj = new Children();
        }
        return self::$child_obj;
    }

    function register() {
        self::$child_obj = self::get_child_obj();
        add_action( 'init', array(self::$child_obj, 'create_children_cpt') );
        add_filter( 'rwmb_meta_boxes', array(self::$child_obj, 'asb_register_meta_boxes') );
    }

	function create_children_cpt() {
		register_post_type( 'children',
        array(
            'labels' => array(
                'name' => __( 'Children', 'children' ),
                'singular_name' => __( 'Child', 'children' ),
                'all_items' => __( 'All Children', 'children' ),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'children'),
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-universal-access',
            'menu_position' => 6,
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
        $meta_boxes[] = [
            'title'      => 'Child Details',
            'post_types' => 'children',

            'fields' => [
                [
                    'name'            => 'Name',
                    'desc'            => '',
                    'id'              => 'asb_child_name',
                    'type'            => 'text',
                    'placeholder'     => 'Enter your child\'s name',
                ],

                [
                    'name'    => 'Sex',
                    'desc'    => '',
                    'id'      => 'asb_child_sex',
                    'type'    => 'radio',
                    'options' => array(
                        'male'   => 'Male',
                        'female' => 'Female',
                    ),
                    // Show choices in the same line?
                    'inline' => true,
                ],

                [
                    'name'            => 'Date of Birth',
                    'id'              => 'asb_child_dob',
                    'type'            => 'date',
                    'placeholder'     => 'Selec a date',

                    // Date picker options. See here http://api.jqueryui.com/datepicker
                    'js_options' => array(
                        'dateFormat'      => 'yy-mm-dd',
                        'showButtonPanel' => false,
                    ),

                    // Display inline?
                    'inline'    => false,

                    // Save value as timestamp?
                    'timestamp' => false,
                ],

                [
                    'name'  => 'Age',
                    'desc'  => '',
                    'id'    => 'asb_child_age',
                    'type'  => 'number',
                    'min'   => 1,
                ],

                [
                    'name'            => 'School Name',
                    'desc'            => '',
                    'id'              => 'asb_child_schoolname',
                    'type'            => 'text',
                    'placeholder'     => 'Enter your child\'s school name',
                ],

                [
                    'name'            => 'School Address',
                    'desc'            => '',
                    'id'              => 'asb_child_schooladdress',
                    'type'            => 'text',
                    'placeholder'     => 'Enter your child\'s school address',
                ],

                [
                    'name'            => 'School Telephone Number',
                    'desc'            => '',
                    'id'              => 'asb_child_schooltelephone',
                    'type'            => 'text',
                    'placeholder'     => 'Enter your child\'s school\'s telephone number',
                ],

                [
                    'name'        => 'School Postcode',
                    'desc'        => '',
                    'id'          => 'asb_child_schoolpostcode',
                    'type'        => 'text',
                    'minlength'   => 5,
                    'maxlength'   => 7,
                    'placeholder' => 'Enter your child\'s school postcode'
                ],

                // More fields.
            ]
        ];

        // Add more field groups if you want
        // $meta_boxes[] = ...

        $meta_boxes[] = [
            'title'      => 'About your Child',
            'post_types' => 'children',

            'fields' => [
                [
                    'name'        => 'Please detail any additional/special needs your child has:',
                    'desc'        => '(please provide full details)',
                    'id'          => 'asb_child_question1',
                    'type'        => 'textarea',
                    'placeholder' => 'Start writing here',
                    'rows'        => '6',
                ],

                [
                    'name'        => 'Please detail any dietary requirements/food allergies for your child:',
                    'desc'        => '(please provide full details)',
                    'id'          => 'asb_child_question2',
                    'type'        => 'textarea',
                    'placeholder' => 'Start writing here',
                    'rows'        => '6',
                ],

                [
                    'name'        => 'Is there anything your child doesn\'t like (food, games etc) or is scared of?',
                    'desc'        => '',
                    'id'          => 'asb_child_question3',
                    'type'        => 'textarea',
                    'placeholder' => 'Start writing here',
                    'rows'        => '6',
                ],

                [
                    'name'        => 'What are your child\'s favourite activities?',
                    'desc'        => '',
                    'id'          => 'asb_child_question4',
                    'type'        => 'textarea',
                    'placeholder' => 'Start writing here',
                    'rows'        => '6',
                ],
                // More fields.
            ]
        ];


        return $meta_boxes;
    }


}