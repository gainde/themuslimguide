<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


add_action('wp_ajax_nopriv_load_more_courses', 'load_more_courses_callback');
add_action('wp_ajax_load_more_courses', 'load_more_courses_callback');

function load_more_courses_callback() {
    $permission = check_ajax_referer( 'load_more_courses_nonce', 'nonce', false );
    if( $permission == false ) {
        echo 'error';
        $educare_courses_markup = '
            <div class="educare-ajax-error-content">
                <i class="fa fa-warning"></i>
                <h3>I don\'t know what happened, but there is an error!</h3>
            </div>
        ';        
    }
    else {
        $post_count  = (isset($_POST['count'])) ? $_POST['count'] : 0;
        $columns  = (isset($_POST['columns'])) ? $_POST['columns'] : 0;
        $static_count  = (isset($_POST['static_count'])) ? $_POST['static_count'] : 0;
        $total_loaded  = (isset($_POST['total_loaded'])) ? $_POST['total_loaded'] : 0;
        $category  = (isset($_POST['category'])) ? $_POST['category'] : 0;
        $btn_text  = (isset($_POST['btn_text'])) ? $_POST['btn_text'] : 0;
        $base_no = 0;
        
        $currency = cs_get_option('currency_code');
        
        if($columns == 3) {
            $course_column_markup = 'col-md-4';
        } elseif($columns == 4) {
            $course_column_markup = 'col-md-3';
        } else {
            $course_column_markup = 'col-md-6';
        }
        

        $ignore_posts = $post_count - $static_count;
        
        if($category) {
            $settings = array(
                'showposts' => $post_count, 
                'post_type' => 'course',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'course_cat',
                        'field'    => 'term_id',
                        'terms'    => $category,
                    ),
                ),
            ); 
        } else {
            $settings = array(
                'showposts' => $post_count, 
                'post_type' => 'course'
            ); 
        }

        $courses_courses_query = new WP_Query($settings);      

        $educare_courses_markup = '';
        while($courses_courses_query->have_posts()) : $courses_courses_query->the_post();
            $base_no++;
            $idd = get_the_ID();
            $course_meta = get_post_meta($idd, 'educare_course_meta', true);
            $post_content = get_the_excerpt();

            $educare_allowed_html_in_course = array(
                'a' => array(
                    'href' => array(),
                    'class' => array(),
                    'target' => array(),
                ),
                'img' => array(
                    'href' => array(),
                    'class' => array(),
                    'alt' => array(),
                ),
                'p' => array(),
                'br' => array(),
                'strong' => array(),
                'i' => array(),
            );
            
        
            if(($base_no) > $total_loaded) {

                $educare_courses_markup .= '<div class="'.esc_attr($course_column_markup).'">';
                
                $educare_courses_markup .= '
                    <div class="single-educare-course">
                        <div style="background-image:url('.esc_url(get_the_post_thumbnail_url($idd, 'medium')).')" class="educare-course-img">
                            <div class="educare-loading-bar">
                                <p><i class="fa fa-cog fa-spin"></i> '.esc_html__('Loading ...', 'educare-toolkit').'</p>
                            </div>
                            <div class="educare-course-img-border"></div>
                        </div>

                        <h2>'.esc_html(get_the_title($idd)).' <span>'.esc_html($currency).' <span  class="count">'.esc_attr($course_meta['price']).'</span></span></h2>
                        '.wp_kses(wpautop($post_content), $educare_allowed_html_in_course).'
                        <a href="'.esc_url(get_permalink()).'" class="educare-btn bordered-btn">'.esc_html($btn_text).'</a>
                    </div>
                ';
        
                $educare_courses_markup .= '</div>';
            }
        
            if($base_no % $columns == 0) {
                $educare_courses_markup .='</div><div class="row">';
            }
        
        
        
        endwhile;
        wp_reset_query(); 
    }
 
    wp_die($educare_courses_markup);
    
    
}



function educare_courses_shortcode($atts){
    extract( shortcode_atts( array(
        'count' => '10',
        'type' => '1',
        'category' => '',
        'columns' => '3',
        'btn_text' => esc_html__('Learn More', 'educare-toolkit'),
        'loadmore_text' => esc_html__('Load More', 'educare-toolkit'),
        'autoplay' => 'true',
        'autoplay_time' => '5000',
    ), $atts) );
    if($category) {
        $q = new WP_Query(array(
            'posts_per_page' => $count, 
            'post_type' => 'course', 
            'tax_query' => array(
                array(
                    'taxonomy' => 'course_cat',
                    'field'    => 'term_id',
                    'terms'    => $category,
                ),
            ),
        ));
    } else {
        $q = new WP_Query(array('posts_per_page' => $count, 'post_type' => 'course'));
    }
    
    $currency = cs_get_option('currency_code');
    
    $course_no = 0;
    $course_random_id = rand(32987, 54972);
    
    if($type == 1) {
    $educare_courses_markup = '
    <div class="educare-course-list-wrap">
    <script>
        jQuery(document).ready(function($){
            $("#educare-course-list-'.esc_attr($course_random_id).'").owlCarousel({
                items: '.esc_attr($columns).',
                nav: true,
                navText: ["<i class=\'fa hvr-ripple-out fa-long-arrow-left\'></i>", "<i class=\'fa hvr-ripple-out fa-long-arrow-right\'></i>"],
                loop: true,
                dots: false,
                margin: 30,
                autoplay: '.esc_attr($autoplay).',
                autoplayTimeout: '.esc_attr($autoplay_time).',
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2,
                    },
                    992: {
                        items: '.esc_attr($columns).',
                    }
                }
            });
        });
    </script>
    <div id="educare-course-list-'.esc_attr($course_random_id).'" class="educare-course-list">';
    } else {
        $educare_courses_markup = '<div class="educare-course-list-wrap educare-course-list-'.esc_attr($columns).'"><div class="row">';
    }
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $course_meta = get_post_meta($idd, 'educare_course_meta', true);
        $post_content = get_the_excerpt();
        $course_no++;
        $a_little_sum = $count + $count;
        $total_found_posts = $q->found_posts;
        $total_loaded = $a_little_sum - $count;
    
        if($type == 2) {
            if($columns == 3) {
                $course_column_markup = 'col-md-4';
            } elseif($columns == 4) {
                $course_column_markup = 'col-md-3';
            } else {
                $course_column_markup = 'col-md-6';
            }
            $educare_courses_markup .= '<div class="'.esc_attr($course_column_markup).'">';
        }
    
        $educare_courses_markup .= '
            <div class="single-educare-course">
                <div style="background-image:url('.esc_url(get_the_post_thumbnail_url($idd, 'medium')).')" class="educare-course-img">
                    <div class="educare-loading-bar">
                        <p><i class="fa fa-cog fa-spin"></i> '.esc_html__('Loading ...', 'educare-toolkit').'</p>
                    </div>
                    <div class="educare-course-img-border"></div>
                </div>
                <h2>'.esc_html(get_the_title($idd)).' <span>'.esc_html($currency).' <span  class="count">'.esc_html($course_meta['price']).'</span></span></h2>
                '.wpautop($post_content).'
                <a href="'.esc_url(get_permalink()).'" class="educare-btn bordered-btn ">'.esc_html($btn_text).'</a>
            </div>
        ';
    
        if($type == 2) {
            $educare_courses_markup .= '</div>';
        }
    
        if($type == 2 && $course_no % $columns == 0) {
            $educare_courses_markup .='</div><div class="row">';
        }
    
    endwhile;
    wp_reset_query();
    
    $educare_courses_markup .= '</div>';
    
    
    if($type == 2) {
    $educare_courses_markup .= '
    <script>
    jQuery(document).ready(function($){
        $(".loadmore-course-btn").click(function(){
            $.ajax({
                type: \'POST\',
                url: "'.esc_url(site_url()).'/wp-admin/admin-ajax.php",
                dataType: \'html\',
                data: {
                    count: $(this).attr("data-count"),
                    columns: $(this).attr("data-columns"),
                    static_count: $(this).attr("data-static-count"),
                    total_loaded: $(this).attr("data-total-loaded"),
                    btn_text: $(this).attr("data-btn-text"),
                    category: $(this).attr("data-category"),
                    action: \'load_more_courses\',
                    nonce: $(this).data(\'nonce\')
                },
                beforeSend: function(data) {
                    $("#load-next-courses-message").append("<span class=\'coursemore-loading-text\'><i class=\'fa fa-cog fa-spin\'></i> courses loading ...</span>");
                    $(".loadmore-course-btn").hide();
                },
                success: function(data, result){
                    if( result != \'error\' ) {
                        $(".educare-course-list-wrap .row").append(data);




                        var posts_per_page = '.esc_attr($count).';
                        var final_count = parseInt($(".loadmore-course-btn").attr("data-count")) + parseInt(posts_per_page);

                        var total_found_posts = parseInt('.esc_attr($total_found_posts).');
                        $(".loadmore-course-btn").removeAttr("data-count");
                        $(".loadmore-course-btn").attr("data-count", final_count);



                        var total_loaded_count = parseInt($(".loadmore-course-btn").attr("data-count")) - parseInt(posts_per_page);

                        $(".loadmore-course-btn").removeAttr("data-total-loaded");
                        $(".loadmore-course-btn").attr("data-total-loaded", total_loaded_count);
                        $("#load-next-courses-message").empty();
                        $(".loadmore-course-btn").show();

                        if ( parseInt($(".loadmore-course-btn").attr("data-total-loaded")) > total_found_posts) {
                            $("#load-next-courses-message").append("No more courses available");
                            $(".load-more-courses-wrap, #load-next-courses-message").fadeOut();
                            $(".loadmore-course-btn").hide();
                        }
                    }
                }
            }); 
        });
    });
    </script>     

    
    <div class="load-more-courses-wrap">
    <p id="load-next-courses-message"></p>
    <span data-nonce="'.esc_attr(wp_create_nonce('load_more_courses_nonce')).'" data-count="'.esc_attr($a_little_sum).'" data-static-count="'.esc_attr($count).'" data-category="'.esc_attr($category).'" data-columns="'.esc_attr($columns).'" data-btn-text="'.esc_attr($btn_text).'" data-total-loaded="'.esc_attr($total_loaded).'" class="loadmore-course-btn">'.esc_html($loadmore_text).' <i class="fa fa-long-arrow-right"></i></span></div>    
    ';
    }
    
    
    
    
    
    $educare_courses_markup .= '</div>';
    
    return $educare_courses_markup;
}
add_shortcode('educare_courses', 'educare_courses_shortcode');