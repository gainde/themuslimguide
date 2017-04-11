<?php

/*
Plugin Name: Educare Toolkit
Plugin URI: http://www.crazycafe.net/wp/educare/
Author: CrazyCafe
Author URI: http://www.crazycafe.net/wp/educare
Version: 1.0.1
Description: This plugin required for Educare WP theme
textdomain: hostlab-crazycafe
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Define
define( 'EDUC_ACC_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( 'EDUC_ACC_PATH', plugin_dir_path( __FILE__ ) );

//type of presentation section
function get_type_section($typeID){
	$defaultID = 1;
	$type_list = array('coran', 'islam', 'profession');
	if(is_numeric($typeID) && $typeID>0 && $typeID<=count($type_list)){
		return $type_list[$typeID-1];
	}
	return $type_list[$defaultID];
}
// Dynamic page list on VC addons
function educare_toolkit_get_page_as_list( ) {

    $args = wp_parse_args( array(
        'post_type'   => 'page',
        'numberposts' => -1,
    ) );

    $posts = get_posts( $args );

    $post_options = array(esc_html__('-- Select page --', 'educare-toolkit')=>'');
    if ( $posts ) {
        foreach ( $posts as $post ) {
            $post_options[ $post->post_title ] = $post->ID;
        }
    }

    return $post_options;
}

// Dynamic course category list on VC addons
function educare_toolkit_gcc_as_list( ) {


    $course_categories = get_terms( 'course_cat' );

    $course_category_options = array(esc_html__('All category', 'educare-toolkit')=>'');
    if ( $course_categories ) {
        foreach ( $course_categories as $course_category ) {
            $course_category_options[ $course_category->name ] = $course_category->term_id;
        }
    }

    return $course_category_options;
}

// Dynamic post list on VC addons
function educare_toolkit_get_post_as_list( ) {

    $args = wp_parse_args( array(
        'post_type'   => 'educare-slide',
        'numberposts' => -1,
    ) );

    $posts = get_posts( $args );

    $post_options = array(esc_html__('-- Select slide --', 'educare-toolkit')=>'');
    if ( $posts ) {
        foreach ( $posts as $post ) {
            $post_options[ $post->post_title ] = $post->ID;
        }
    }

    return $post_options;
}

// Register custom post
add_action( 'init', 'educare_toolkit_custom_post' );
function educare_toolkit_custom_post() {
    register_post_type( 'educare-slide',
        array(
            'labels' => array(
                'name' => esc_html__( 'Slides' ),
                'singular_name' => esc_html__( 'Slide', 'educare-toolkit' )
            ),
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'public' => false,
            'show_ui' => true,
            'menu_icon'  => 'dashicons-laptop'
        )
    );
    register_post_type( 'course',
        array(
            'labels' => array(
                'name' => esc_html__( 'Courses', 'educare-toolkit' ),
                'singular_name' => esc_html__( 'Course', 'educare-toolkit' )
            ),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
            'public' => true,
            'menu_icon' => 'dashicons-book-alt'
        )
    );
    register_post_type( 'event',
        array(
            'labels' => array(
                'name' => esc_html__( 'Events', 'educare-toolkit' ),
                'singular_name' => esc_html__( 'event', 'educare-toolkit' )
            ),
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'public' => true,
            'menu_icon' => 'dashicons-calendar-alt'
        )
    );
    register_post_type( 'notice',
        array(
            'labels' => array(
                'name' => esc_html__( 'Notices', 'educare-toolkit' ),
                'singular_name' => esc_html__( 'Notice', 'educare-toolkit' )
            ),
            'supports' => array('title', 'editor'),
            'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-megaphone'
        )
    );
    
    register_post_type( 'testimonial',
        array(
            'labels' => array(
                'name' => esc_html__( 'Testimonials', 'educare-toolkit' ),
                'singular_name' => esc_html__( 'Testimonial', 'educare-toolkit' )
            ),
            'supports' => array('title', 'editor', 'thumbnail'),
            'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-star-half'
        )
    );
	
    register_taxonomy(
        'course_cat',  
        'course',                  
        array(
            'hierarchical'          => true,
            'label'                 => esc_html__('Course Category', 'educare-toolkit'),  
            'query_var'             => true,
            'show_admin_column'     => true,
            'rewrite'               => array(
                'slug'              => 'course-category', 
                'with_front'    => true 
            )
        )
    );
	
    
    register_taxonomy(
        'event_cat',  
        'event',                  
        array(
            'hierarchical'          => true,
            'label'                 => esc_html__('Event Category', 'educare-toolkit'),  
            'query_var'             => true,
            'show_admin_column'     => true,
            'rewrite'               => array(
                'slug'              => 'event-category', 
                'with_front'    => true 
            )
        )
    );    
}

// Print shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Thumbnail posts widget
require_once( EDUC_ACC_PATH . 'inc/educare-thumbnail-posts-widget.php' );


// Loading VC addons
require_once( EDUC_ACC_PATH . 'vc-addons/vc-blocks-load.php' );


// Theme shortcodes
require_once( EDUC_ACC_PATH . 'theme-shortcodes/slides-shortcode.php' );
require_once( EDUC_ACC_PATH . 'theme-shortcodes/service-box-shortcode.php' );
require_once( EDUC_ACC_PATH . 'theme-shortcodes/presentation-box-shortcode.php' );
require_once( EDUC_ACC_PATH . 'theme-shortcodes/section-title-shortcode.php' );
require_once( EDUC_ACC_PATH . 'theme-shortcodes/courses-shortcode.php' );
require_once( EDUC_ACC_PATH . 'theme-shortcodes/notices-shortcode.php' );
require_once( EDUC_ACC_PATH . 'theme-shortcodes/testimonials-shortcode.php' );
require_once( EDUC_ACC_PATH . 'theme-shortcodes/statistics-counter-box-shortcode.php' );
require_once( EDUC_ACC_PATH . 'theme-shortcodes/blog-posts-shortcode.php' );
require_once( EDUC_ACC_PATH . 'theme-shortcodes/logo-carousel-shortcode.php' );
require_once( EDUC_ACC_PATH . 'theme-shortcodes/events-shortcode.php' );
require_once( EDUC_ACC_PATH . 'theme-shortcodes/gallery-shortcode.php' );
require_once( EDUC_ACC_PATH . 'theme-shortcodes/extra-shortcodes.php' );

// Shortcodes depended on Visual Composer
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('js_composer/js_composer.php')){
    require_once( EDUC_ACC_PATH . 'theme-shortcodes/staff-shortcode.php' );
}

// Registering educare toolkit files
function educare_toolkit_files(){
    
    wp_enqueue_style('owl-carousel', plugin_dir_url( __FILE__ ) .'assets/css/owl.carousel.css');
    wp_enqueue_style('jquery-marnific', plugin_dir_url( __FILE__ ) .'assets/css/magnific-popup.css');
    wp_enqueue_style('educare-toolkit-main', plugin_dir_url( __FILE__ ) .'assets/css/educare-toolkit.css');
    
    wp_enqueue_script( 'jquery-perfect-scrollbar', plugin_dir_url( __FILE__ ) . 'assets/js/perfect-scrollbar.jquery.min.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'jquery-isotope', plugin_dir_url( __FILE__ ) . 'assets/js/isotope-2.1.min.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'jquery-gmap3', plugin_dir_url( __FILE__ ) . 'assets/js/gmap3.min.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'assets/js/owl.carousel.min.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'jquery-magnific', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.magnific-popup.min.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'educare-toolkit-main', plugin_dir_url( __FILE__ ) . 'assets/js/industry-toolkit.js', array('jquery'), '20120206', true );
    
}
add_action('wp_enqueue_scripts', 'educare_toolkit_files'); 