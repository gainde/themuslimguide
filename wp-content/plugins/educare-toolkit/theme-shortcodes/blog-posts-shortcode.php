<?php

if ( ! defined( 'ABSPATH' ) ) {	exit; }

function educare_blog_posts_shortcode($atts){
    extract( shortcode_atts( array(
        'count' => '3',
        'columns' => '3',
        'category' => '',
        'btn_text' => esc_html__('Details'),
    ), $atts) );

    if($category) {
        $q = new WP_Query( array('posts_per_page' => $count, 'post_type' => 'post', 'category' => $category) );
    } else {
        $q = new WP_Query( array('posts_per_page' => $count, 'post_type' => 'post') );
    }
    
    if($columns == 2) {
        $column_markup = ' col-sm-6';
    } elseif($columns == 4) {
        $column_markup = 'col-md-3 col-sm-6';
    } else {
        $column_markup = 'col-md-4 col-sm-6';
    }

    $list = '';


    
    $list .='
    <div class="row">';

        while($q->have_posts()) : $q->the_post();
            $idd = get_the_ID();
            $post_content = get_the_content();
    
    
            $list .= '
                <div class="'.esc_attr($column_markup).'">
                <div class="educare-boxed-post-wrap">
                    <div style="background-image:url('.esc_url(get_the_post_thumbnail_url($idd, 'medium')).')" class="educare-post-block-img">
                        <div class="educare-loading-bar">
                            <p><i class="fa fa-cog fa-spin"></i> '.esc_html__('Loading ...', 'educare-toolkit').'</p>
                        </div>
                        <div class="educare-pb-date">
                            <p>'.esc_html(get_the_date('d', $idd)).' <span>'.esc_html(get_the_date('F', $idd)).'</span></p>
                        </div>
                    </div>
                    
                    <p class="educare-pb-meta"><i class="fa fa-user"></i> <span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span> <span class="educare-pb-meta-right"><span class="post-comments-number"><i class="fa fa-comments"></i> '.esc_html(get_comments_number($idd)).'</span></span></p>
                    
                    <h3><a href="'.esc_url(get_permalink()).'">'.esc_html(get_the_title($idd)).'</a></h3>
                    
                    <a href="'.esc_url(get_permalink()).'" class="educare-btn bordered-btn">'.esc_html($btn_text).' <i class="fa fa-long-arrow-right"></i></a>
                </div>
                </div>
                ';
        endwhile;
    $list.= '</div>';
    wp_reset_query();
        
    return $list;
}
add_shortcode('educare_blog_posts', 'educare_blog_posts_shortcode');