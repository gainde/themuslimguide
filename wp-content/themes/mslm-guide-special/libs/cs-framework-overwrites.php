<?php

function educare_extra_cs_shortcode_options( $options ) {
    $options = array();
    return $options;
}
add_filter( 'cs_shortcode_options', 'educare_extra_cs_shortcode_options' );

function educare_extra_cs_customize_options( $options ) {
    $options = array(); 
    return $options;
}
add_filter( 'cs_customize_options', 'educare_extra_cs_customize_options' );

function educare_extra_cs_framework_settings( $settings ) {
  
    $settings = array();    

    $settings           = array(
      'menu_title'      => esc_html__('Theme Options', 'mslm-guide-special'),
      'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
      'menu_slug'       => 'educare-theme-options',
      'ajax_save'       => true,
      'show_reset_all'  => true,
      'framework_title' => esc_html__('Educare theme options - by champtheme', 'mslm-guide-special'),
    );    


    return $settings;

}
add_filter( 'cs_framework_settings', 'educare_extra_cs_framework_settings' );

function educare_extra_cs_framework_options( $options ) {

    $options      = array(); // remove old options

    $options[]    = array(
        'name'      => 'educare_header',
        'title'     => esc_html__('Header area', 'mslm-guide-special'),
        'icon'      => 'fa fa-header',
        'fields'    => array(
            array(
                'id'    => 'enable_header_top',
                'type'  => 'switcher',
                'title' => esc_html__('Enable header top', 'mslm-guide-special'),
                'default' => true,
                'desc' => esc_html__('If you want to enable header top, select on.', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'header_content_type',
                'type'  => 'select',
                'title' => esc_html__('Header top left content type', 'mslm-guide-special'),
                'default' => 'predefinied',
                'desc' => esc_html__('Select header top left content type.', 'mslm-guide-special'),
                'options' => array(
                    'predefinied' => esc_html__('Phone number & email', 'mslm-guide-special'),
                    'others' => esc_html__('Custom', 'mslm-guide-special')
                ),
                'dependency'   => array( 'enable_header_top', '==', 'true' ),
            ),
            array(
                'id'    => 'header_phone_no',
                'type'  => 'text',
                'title' => esc_html__('Header phone number', 'mslm-guide-special'),
                'desc' => esc_html__('Type header phone number. Leave blank if you do not want to show phone number.', 'mslm-guide-special'),
                'default' => esc_html__('(000) 111-222-333', 'mslm-guide-special'),
                'dependency'   => array( 'header_content_type|enable_header_top', '==|==', 'predefinied|true' ),
            ),
            array(
                'id'    => 'header_email',
                'type'  => 'text',
                'title' => esc_html__('Header email address', 'mslm-guide-special'),
                'desc' => esc_html__('Type header email address. Leave blank if you do not want to show email address.', 'mslm-guide-special'),
                'default' => 'champtheme@gmail.com',
                'dependency'   => array( 'header_content_type|enable_header_top', '==|==', 'predefinied|true' ),
            ),
            array(
                'id'    => 'header_others',
                'type'  => 'wysiwyg',
                'title' => esc_html__('Header top left content', 'mslm-guide-special'),
                'desc' => esc_html__('Add your own header top left content.', 'mslm-guide-special'),
                'dependency'   => array( 'header_content_type|enable_header_top', '==|==', 'others|true' ),
            ),
            array(
                'id'    => 'header_right_content_type',
                'type'  => 'select',
                'title' => esc_html__('Header top right content type', 'mslm-guide-special'),
                'default' => 'social',
                'desc' => esc_html__('Select header top right content type.', 'mslm-guide-special'),
                'options' => array(
                    'social' => esc_html__('Social links', 'mslm-guide-special'),
                    'others' => esc_html__('Custom', 'mslm-guide-special')
                ),
                'dependency'   => array( 'enable_header_top', '==', 'true' ),
            ),
            array(
                'id'    => 'social_icons',
                'type'  => 'group',
                'title' => esc_html__('Social links', 'mslm-guide-special'),
                'desc' => esc_html__('Add social links, it will show on header top right & footer, by using shortcode.', 'mslm-guide-special'),
                'button_title'    => esc_html__('Add new social link', 'mslm-guide-special'),
                'accordion_title' => esc_html__('Add New link', 'mslm-guide-special'),
                'fields'          => array(
                    array(
                        'id'    => 'code',
                        'type'  => 'text',
                        'title' => esc_html__('Icon code', 'mslm-guide-special'),
                    ),
                    array(
                        'id'    => 'link',
                        'type'  => 'text',
                        'title' => esc_html__('Link', 'mslm-guide-special'),
                    ),
                ),                
                'dependency'   => array( 'header_right_content_type|enable_header_top', '==|==', 'social|true' ),
            ),
            array(
                'id'    => 'header_right_others',
                'type'  => 'wysiwyg',
                'title' => esc_html__('Header top right content', 'mslm-guide-special'),
                'desc' => esc_html__('Type your own header top right content.', 'mslm-guide-special'),
                'dependency'   => array( 'header_right_content_type|enable_header_top', '==|==', 'others|true' ),
            ),
            array(
                'id'    => 'enable_header_right_btn',
                'type'  => 'switcher',
                'title' => esc_html__('Enable header right button?', 'mslm-guide-special'),
                'default' => true,
                'desc' => esc_html__('If you want to enable header right button, select on.', 'mslm-guide-special'),
                'dependency'   => array( 'enable_header_top', '==', 'true' ),
            ),
            array(
                'id'    => 'header_right_btn_text',
                'type'  => 'text',
                'title' => esc_html__('Header right button text', 'mslm-guide-special'),
                'default' => esc_html__('Apply Now', 'mslm-guide-special'),
                'desc' => esc_html__('Type header right button text', 'mslm-guide-special'),
                'dependency'   => array( 'enable_header_top|enable_header_right_btn', '==|==', 'true|true' ),
            ),
            array(
                'id'    => 'header_right_btn_link_to',
                'type'  => 'select',
                'title' => esc_html__('Header right button link to', 'mslm-guide-special'),
                'options' => array(
                    '1' => esc_html__('A specific page', 'mslm-guide-special'),
                    '2' => esc_html__('External link', 'mslm-guide-special')
                ),
                'default' => '1',
                'desc' => esc_html__('Header right button link type', 'mslm-guide-special'),
                'dependency'   => array( 'enable_header_top|enable_header_right_btn', '==|==', 'true|true' ),
            ),
            array(
                'id'    => 'header_right_btn_link_page',
                'type'  => 'select',
                'title' => esc_html__('Header right button link', 'mslm-guide-special'),
                'options' => 'page',
                'desc' => esc_html__('Select header right button link to page.', 'mslm-guide-special'),
                'dependency'   => array( 'enable_header_right_btn|header_right_btn_link_to|enable_header_top', '==|==|==', 'true|1|true' ),
            ),
            array(
                'id'    => 'header_right_btn_link_external',
                'type'  => 'text',
                'title' => esc_html__('Header right button link', 'mslm-guide-special'),
                'desc' => esc_html__('Type header right button external', 'mslm-guide-special'),
                'dependency'   => array( 'enable_header_right_btn|header_right_btn_link_to|enable_header_top', '==|==|==', 'true|2|true' ),
            ),
        )
    );
    
    $options[]    = array(
        'name'      => 'educare_logo_favicon',
        'title'     => esc_html__('Logo and favicon', 'mslm-guide-special'),
        'icon'      => 'fa fa-camera',
        'fields'    => array(
            array(
                'id'    => 'educare_favicon',
                'type'  => 'image',
                'title' => esc_html__('Favicon', 'mslm-guide-special'),
                'desc' => esc_html__('Upload favicon image. Favicon image should be square sized image.', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'text_logo',
                'type'  => 'switcher',
                'title' => esc_html__('Enable text logo?', 'mslm-guide-special'),
                'desc' => esc_html__('If you want to enable text logo, select on.', 'mslm-guide-special'),
                'default' => false,
            ),
            array(
                'id'    => 'educare_logo_regular',
                'type'  => 'image',
                'title' => esc_html__('Logo', 'mslm-guide-special'),
                'desc' => esc_html__('Upload site logo.', 'mslm-guide-special'),
                'dependency'   => array( 'text_logo', '!=', 'true' ),
            ),
            array(
                'id'    => 'educare_logo_light',
                'type'  => 'image',
                'title' => esc_html__('White color logo', 'mslm-guide-special'),
                'desc' => esc_html__('White color logo will show on footer widgets by using shortcode.', 'mslm-guide-special'),
                'dependency'   => array( 'text_logo', '!=', 'true' ),
            ),
            array(
                'id'    => 'educare_logo_text',
                'type'  => 'text',
                'default'  => esc_html__('Educare', 'mslm-guide-special'),
                'title' => esc_html__('Logo text', 'mslm-guide-special'),
                'desc' => esc_html__('Type logo text here.', 'mslm-guide-special'),
                'dependency'   => array( 'text_logo', '==', 'true' ),
            ),
        )
    );
    
    $options[]    = array(
        'name'      => 'educare_typography',
        'title'     => esc_html__('Typography', 'mslm-guide-special'),
        'icon'      => 'fa fa-font',
        'fields'    => array(
            array(
                'id'    => 'educare_body_font',
                'type'  => 'typography',
                'title' => esc_html__('Body font', 'mslm-guide-special'),
                'desc' => esc_html__('Select body google font & font weight.', 'mslm-guide-special'),
                'default'   => array(
                    'family'  => 'Roboto',
                    'variant' => '300',
                    'font'    => 'google', // this is helper for output
                ),
            ),
            array(
                'id'    => 'educare_body_font_size',
                'type'  => 'text',
                'title' => esc_html__('Body font size', 'mslm-guide-special'),
                'desc' => esc_html__('Select body font size.', 'mslm-guide-special'),
                'default'   => '16px',
            ),
            array(
                'id'    => 'educare_body_line_height',
                'type'  => 'text',
                'title' => esc_html__('Body font line height', 'mslm-guide-special'),
                'desc' => esc_html__('Select body font line height.', 'mslm-guide-special'),
                'default'   => '27px',
            ),
            array(
                'id'    => 'educare_headding_font',
                'type'  => 'typography',
                'title' => esc_html__('Headding font', 'mslm-guide-special'),
                'default'   => array(
                    'family'  => 'Roboto',
                    'variant' => '700',
                    'font'    => 'google', // this is helper for output
                ),
                'desc' => esc_html__('Select headding google font & font weight.', 'mslm-guide-special'),
            ),
        )
    );
    
    $options[]    = array(
        'name'      => 'educare_styling',
        'title'     => esc_html__('Styling', 'mslm-guide-special'),
        'icon'      => 'fa fa-paint-brush',
        'fields'    => array(
            array(
                'id'    => 'enable_preloader',
                'type'  => 'switcher',
                'default'  => true,
                'title' => esc_html__('Proloader', 'mslm-guide-special'),
                'desc' => esc_html__('If you want to enable preloader, select on.', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'enable_boxed',
                'type'  => 'switcher',
                'default'  => false,
                'title' => esc_html__('Enable boxedd layout', 'mslm-guide-special'),
                'desc' => esc_html__('If you want to enable boxed layout, select on.', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'body_background_img',
                'type'  => 'image',
                'title' => esc_html__('Body background image', 'mslm-guide-special'),
                'desc' => esc_html__('Upload body background image, If you upload a bigger image, do not forget to select background repeat as cover.', 'mslm-guide-special'),
                'dependency'   => array( 'enable_boxed', '==', 'true' ),
            ),
            array(
                'id'    => 'body_background_repeat',
                'type'  => 'select',
                'title' => esc_html__('Body background repeat', 'mslm-guide-special'),
                'desc' => esc_html__('Select background behabour', 'mslm-guide-special'),
                'options' => array(
                    'repeat' => esc_html__('Repeat', 'mslm-guide-special'),
                    'no-repeat' => esc_html__('No Repeat', 'mslm-guide-special'),
                    'cover' => esc_html__('Cover', 'mslm-guide-special')
                ),
                'dependency'   => array( 'enable_boxed', '==', 'true' ),
            ),
            array(
                'id'    => 'body_background_attachment',
                'type'  => 'select',
                'title' => esc_html__('Body background attachment', 'mslm-guide-special'),
                'desc' => esc_html__('Select background attachment.', 'mslm-guide-special'),
                'options' => array(
                    'scroll' => esc_html__('Scroll', 'mslm-guide-special'),
                    'fixed' => esc_html__('Fixed', 'mslm-guide-special')
                ),
                'dependency'   => array( 'enable_boxed', '==', 'true' ),
            ),
            array(
                'id'    => 'educare_theme_color',
                'type'  => 'color_picker',
                'desc'  => esc_html__('Choose theme primary color.', 'mslm-guide-special'),
                'title' => esc_html__('Theme color', 'mslm-guide-special'),
                'default' => '#5aa938',
            ),
        )
    );
    
    $options[]    = array(
        'name'      => 'educare_currency',
        'title'     => esc_html__('Currency settings', 'mslm-guide-special'),
        'icon'      => 'fa fa-dollar',
        'fields'    => array(
            array(
                'id'    => 'currency_code',
                'type'  => 'text',
                'default' => esc_html__('$', 'mslm-guide-special'),
                'title' => esc_html__('Currency code', 'mslm-guide-special'),
                'desc' => esc_html__('If you want to change currency code on courses, type here.', 'mslm-guide-special'),
            ),
        )
    );
    
    $options[]    = array(
        'name'      => 'educare_blog_settings',
        'title'     => esc_html__('Blog Settings', 'mslm-guide-special'),
        'icon'      => 'fa fa-pencil',
        'fields'    => array(
            array(
                'id'    => 'blog_breadcroumb_image',
                'type'  => 'image',
                'title' => esc_html__('Blog breadcroump image', 'mslm-guide-special'),
                'desc' => esc_html__('Upload blog index pages breadcroump image', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'blog_post_by',
                'type'  => 'switcher',
                'default'  => true,
                'title' => esc_html__('Display post by?', 'mslm-guide-special'),
                'desc' => esc_html__('If you want to show posted by name on blog index page and single blog, select on', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'blog_post_date',
                'type'  => 'switcher',
                'default'  => true,
                'title' => esc_html__('Display post date?', 'mslm-guide-special'),
                'desc' => esc_html__('If you want to show blog post date on blog index page and single blog, select on', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'blog_post_comment',
                'type'  => 'switcher',
                'default'  => true,
                'title' => esc_html__('Display comment count?', 'mslm-guide-special'),
                'desc' => esc_html__('If you want to show comment count on blog index page, select on', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'blog_post_category',
                'type'  => 'switcher',
                'default'  => true,
                'title' => esc_html__('Display posted in categories?', 'mslm-guide-special'),
                'desc' => esc_html__('If you want to show blog category on blog index page and single blog, select on', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'blog_post_tags',
                'type'  => 'switcher',
                'default'  => true,
                'title' => esc_html__('Display posted in tags?', 'mslm-guide-special'),
                'desc' => esc_html__('If you want to show blog tags on blog index page and single blog, select on', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'blog_post_nav',
                'type'  => 'switcher',
                'default'  => true,
                'title' => esc_html__('Enable next previous link on single post?', 'mslm-guide-special'),
                'desc' => esc_html__('If you want to show next previous links on single blog, select on', 'mslm-guide-special'),
            ),
        )
    );
    
    $options[]    = array(
        'name'      => 'educare_footer_settings',
        'title'     => esc_html__('Footer Settings', 'mslm-guide-special'),
        'icon'      => 'fa fa-wordpress',
        'fields'    => array(
            array(
                'id'    => 'footer_bg_color',
                'type'  => 'color_picker',
                'title' => esc_html__('Footer background color', 'mslm-guide-special'),
                'default' => '#000000',
                'desc' => esc_html__('Select footer area background color', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'footer_color',
                'type'  => 'color_picker',
                'title' => esc_html__('Footer text color', 'mslm-guide-special'),
                'default' => '#d6d6d6',
                'desc' => esc_html__('Select footer area text color', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'footer_left_text',
                'type'  => 'wysiwyg',
                'title' => esc_html__('Copyright area left text', 'mslm-guide-special'),
                'desc' => esc_html__('Type footer copyright area left text', 'mslm-guide-special'),
            ),
            array(
                'id'    => 'footer_right_text',
                'type'  => 'wysiwyg',
                'title' => esc_html__('Copyright area right text', 'mslm-guide-special'),
                'desc' => esc_html__('Type footer copyright area right text', 'mslm-guide-special'),
            ),
        )
    );
    
    $options[]    = array(
        'name'      => 'educare_gmap_settings',
        'title'     => esc_html__('Google map', 'mslm-guide-special'),
        'icon'      => 'fa fa-map-marker',
        'fields'    => array(
            array(
                'id'    => 'gmap_api_key',
                'type'  => 'text',
                'title' => esc_html__('Google map API key', 'mslm-guide-special'),
                'desc' => esc_html__('Paste your google map API key here. You can get it on google developer console.', 'mslm-guide-special'),
            ),
        )
    );
    
    $options[]    = array(
        'name'      => 'educare_settings_backup',
        'title'     => esc_html__('Backups', 'mslm-guide-special'),
        'icon'      => 'fa fa-heart',
        'fields'    => array(
            array(
                'type'  => 'backup',
                'title' => esc_html__('Backup', 'mslm-guide-special'),
            ),
        )
    );

  return $options;

}
add_filter( 'cs_framework_options', 'educare_extra_cs_framework_options' );

function educare_extra_cs_metabox_options( $options ) {

    $options      = array();

    $options[]    = array(
        'id'        => 'educare_page_meta',
        'title'     => esc_html__('Page Options', 'mslm-guide-special'),
        'post_type' => 'page',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'  => 'educare_page_meta_1',
                'fields' => array(
                    array(
                        'id'    => 'titlebar',
                        'type'  => 'switcher',
                        'title' => esc_html__('Enable page title bar?', 'mslm-guide-special'),
                        'default' => true,
                    )
                )
            )
        )
    );

    $options[]    = array(
        'id'        => 'educare_event_meta',
        'title'     => esc_html__('Event Options', 'mslm-guide-special'),
        'post_type' => 'event',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'  => 'educare_event_meta_1',
                'fields' => array(
                    array(
                        'id'    => 'day',
                        'type'  => 'select',
                        'title' => 'Date',
                        'options'  => array(
                            '1'  => '1',
                            '2'   => '2',
                            '3'   => '3',
                            '4'   => '4',
                            '5'   => '5',
                            '6'   => '6',
                            '7'   => '7',
                            '8'   => '8',
                            '9'   => '9',
                            '10'   => '10',
                            '11'   => '11',
                            '12'   => '12',
                            '13'   => '13',
                            '14'   => '14',
                            '15'   => '15',
                            '16'   => '16',
                            '17'   => '17',
                            '18'   => '18',
                            '19'   => '19',
                            '20'   => '20',
                            '21'   => '21',
                            '22'   => '22',
                            '23'   => '23',
                            '24'   => '24',
                            '25'   => '25',
                            '26'   => '26',
                            '27'   => '27',
                            '28'   => '28',
                            '29'   => '29',
                            '30'   => '30',
                            '31'   => '31',
                        ),
                    ),
                    array(
                        'id'    => 'month',
                        'type'  => 'select',
                        'title' => esc_html__('Month', 'mslm-guide-special'),
                        'options'  => array(
                            esc_html__('January', 'mslm-guide-special')  => esc_html__('January', 'mslm-guide-special'),
                            esc_html__('February', 'mslm-guide-special')   => esc_html__('February', 'mslm-guide-special'),
                            esc_html__('March', 'mslm-guide-special')   => esc_html__('March', 'mslm-guide-special'),
                            esc_html__('April', 'mslm-guide-special')   => esc_html__('April', 'mslm-guide-special'),
                            esc_html__('May', 'mslm-guide-special')   => esc_html__('May', 'mslm-guide-special'),
                            esc_html__('June', 'mslm-guide-special')   => esc_html__('June', 'mslm-guide-special'),
                            esc_html__('July', 'mslm-guide-special')   => esc_html__('July', 'mslm-guide-special'),
                            esc_html__('August', 'mslm-guide-special')   => esc_html__('August', 'mslm-guide-special'),
                            esc_html__('September', 'mslm-guide-special')   => esc_html__('September', 'mslm-guide-special'),
                            esc_html__('October', 'mslm-guide-special')   => esc_html__('October', 'mslm-guide-special'),
                            esc_html__('November', 'mslm-guide-special')   => esc_html__('November', 'mslm-guide-special'),
                            esc_html__('December', 'mslm-guide-special')   => esc_html__('December', 'mslm-guide-special'),
                        ),
                    ),
                    array(
                        'id'    => 'year',
                        'type'  => 'text',
                        'title' => esc_html__('Year', 'mslm-guide-special'),
                    ),
                    array(
                        'id'    => 'host',
                        'type'  => 'text',
                        'title' => esc_html__('Event Host', 'mslm-guide-special'),
                    ),
                    array(
                        'id'    => 'location',
                        'type'  => 'text',
                        'title' => esc_html__('Location', 'mslm-guide-special'),
                    ),
                    array(
                        'id'    => 'meta',
                        'type'  => 'group',
                        'title'           => esc_html__('Event others info', 'mslm-guide-special'),
                        'button_title'    => esc_html__('Add New Info', 'mslm-guide-special'),
                        'accordion_title' => esc_html__('Add New Info', 'mslm-guide-special'),
                        'fields'          => array(
                            array(
                                'id'    => 'title',
                                'type'  => 'text',
                                'title' => esc_html__('Info title', 'mslm-guide-special'),
                            ),
                            array(
                                'id'    => 'info',
                                'type'  => 'text',
                                'title' => esc_html__('Info Info', 'mslm-guide-special'),
                            ),
                        )
                    ),
                    array(
                        'id'    => 'tickets_btn',
                        'type'  => 'switcher',
                        'default'  => false,
                        'title' => esc_html__('Enable buy tickets button?', 'mslm-guide-special'),
                    ),
                    array(
                        'id'    => 'btn_text',
                        'type'  => 'text',
                        'default'  => 'Book ticket',
                        'title' => esc_html__('Button text', 'mslm-guide-special'),
                        'dependency'   => array( 'tickets_btn', '==', 'true' ),
                    ),
                    array(
                        'id'    => 'btn_link_to_page',
                        'type'  => 'switcher',
                        'default'  => true,
                        'title' => esc_html__('Link to page?', 'mslm-guide-special'),
                        'dependency'   => array( 'tickets_btn', '==', 'true' ),
                    ),
                    array(
                        'id'    => 'btn_link_to_page_link',
                        'type'  => 'select',
                        'options'  => 'page',
                        'title' => esc_html__('Button link to page', 'mslm-guide-special'),
                        'dependency'   => array( 'tickets_btn|btn_link_to_page', '==|==', 'true|true' ),
                    ),
                    array(
                        'id'    => 'btn_link_to_external_link',
                        'type'  => 'text',
                        'title' => esc_html__('Button link to external', 'mslm-guide-special'),
                        'dependency'   => array( 'tickets_btn|btn_link_to_page', '==|==', 'true|false' ),
                    ),
                    array(
                        'id'    => 'link_tab',
                        'type'  => 'select',
                        'title' => esc_html__('Lins open in', 'mslm-guide-special'),
                        'default' => '_self',
                        'options'  => array(
                            '_self'  => esc_html__('Same tab', 'mslm-guide-special'),
                            '_blank'   => esc_html__('New tab', 'mslm-guide-special'),
                        ),
                        'dependency'   => array( 'tickets_btn', '==', 'true' ),
                    ),
                    array(
                        'id'    => 'show_map',
                        'type'  => 'switcher',
                        'default'  => true,
                        'title' => esc_html__('Show google map on event details page?', 'mslm-guide-special'),
                    ),
                )
            )
        )
    );

    $options[]    = array(
        'id'        => 'educare_testimonial_meta',
        'title'     => esc_html__('Testimonial Options', 'mslm-guide-special'),
        'post_type' => 'testimonial',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'  => 'educare_testimonial_meta_1',
                'fields' => array(
                    array(
                        'id'    => 'info',
                        'type'  => 'text',
                        'title' => esc_html__('Designation', 'mslm-guide-special'),
                    ),
                )
            )
        )
    );

    $options[]    = array(
        'id'        => 'educare_course_meta',
        'title'     => esc_html__('Course Options', 'mslm-guide-special'),
        'post_type' => 'course',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'  => 'educare_course_meta_1',
                'fields' => array(
                    array(
                        'id'    => 'price',
                        'type'  => 'text',
                        'title' => esc_html__('Price', 'mslm-guide-special'),
                    ),
                    array(
                        'id'    => 'teacher',
                        'type'  => 'text',
                        'title' => esc_html__('Teacher name', 'mslm-guide-special'),
                    ),
                    array(
                        'id'    => 'info',
                        'type'  => 'group',
                        'title'           => esc_html__('Course info', 'mslm-guide-special'),
                        'button_title'    => esc_html__('Add New info', 'mslm-guide-special'),
                        'accordion_title' => esc_html__('Add New info', 'mslm-guide-special'),
                        'fields'          => array(
                            array(
                                'id'    => 'title',
                                'type'  => 'text',
                                'title' => esc_html__('Info title', 'mslm-guide-special'),
                            ),
                            array(
                                'id'    => 'text',
                                'type'  => 'text',
                                'title' => esc_html__('Info text', 'mslm-guide-special'),
                            ),
                        )
                    ),
                    array(
                        'id'    => 'enable_reg_button',
                        'type'  => 'switcher',
                        'default'  => true,
                        'title' => esc_html__('Enable register button?', 'mslm-guide-special'),
                    ),
                    array(
                        'id'    => 'btn_text',
                        'type'  => 'text',
                        'default'  => esc_html__('Register now', 'mslm-guide-special'),
                        'title' => esc_html__('Button text', 'mslm-guide-special'),
                        'dependency'   => array( 'enable_reg_button', '==', 'true' ),
                    ),
                    array(
                        'id'    => 'cta_linkto',
                        'type'  => 'select',
                        'title' => esc_html__('Button link to', 'mslm-guide-special'),
                        'default' => '1',
                        'options'  => array(
                            '1'  => esc_html__('Page', 'mslm-guide-special'),
                            '2'   => esc_html__('External link', 'mslm-guide-special'),
                        ),
                        'dependency'   => array( 'enable_reg_button', '==', 'true' ),
                    ),
                    array(
                        'id'    => 'cta_to_page',
                        'type'  => 'select',
                        'options'  => 'page',
                        'title' => esc_html__('Select page', 'mslm-guide-special'),
                        'dependency'   => array( 'cta_linkto|enable_reg_button', '==|==', '1|true' ),
                    ),
                    array(
                        'id'    => 'cta_to_external',
                        'type'  => 'text',
                        'title' => esc_html__('Link', 'mslm-guide-special'),
                        'dependency'   => array( 'cta_linkto|enable_reg_button', '==|==', '2|true' ),
                    ),
                    array(
                        'id'    => 'cta_tab',
                        'type'  => 'select',
                        'title' => esc_html__('Lins open in', 'mslm-guide-special'),
                        'default' => '_self',
                        'options'  => array(
                            '_self'  => esc_html__('Same tab', 'mslm-guide-special'),
                            '_blank'   => esc_html__('New tab', 'mslm-guide-special'),
                        ),
                        'dependency'   => array( 'enable_reg_button', '==', 'true' ),
                    ),
                )
            )
        )
    );

    $options[]    = array(
        'id'        => 'educare_slide_meta',
        'title'     => esc_html__('Slide Options', 'mslm-guide-special'),
        'post_type' => 'educare-slide',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'  => 'educare_slide_meta_1',
                'fields' => array(
                    array(
                        'id'    => 'buttons',
                        'type'  => 'group',
                        'title'           => 'Buttons',
                        'button_title'    => esc_html__('Add New button', 'mslm-guide-special'),
                        'accordion_title' => esc_html__('Add New button', 'mslm-guide-special'),
                        'fields'          => array(
                            array(
                                'id'    => 'type',
                                'type'  => 'select',
                                'title' => esc_html__('Button type', 'mslm-guide-special'),
                                'default' => '1',
                                'options'  => array(
                                    'filled'  => esc_html__('Filled button', 'mslm-guide-special'),
                                    'bordered'   => esc_html__('Bordered button', 'mslm-guide-special'),
                                ),
                            ),
                            array(
                                'id'    => 'btn_text',
                                'type'  => 'text',
                                'title' => esc_html__('Button text', 'mslm-guide-special'),
                            ),
                            array(
                                'id'    => 'linkto',
                                'type'  => 'select',
                                'title' => esc_html__('Button link to', 'mslm-guide-special'),
                                'default' => '1',
                                'options'  => array(
                                    '1'  => esc_html__('Page', 'mslm-guide-special'),
                                    '2'   => esc_html__('External link', 'mslm-guide-special'),
                                ),
                            ),
                            array(
                                'id'    => 'to_page',
                                'type'  => 'select',
                                'options'  => 'page',
                                'title' => esc_html__('Select page', 'mslm-guide-special'),
                                'dependency'   => array( 'linkto', '==', '1' ),
                            ),
                            array(
                                'id'    => 'to_external',
                                'type'  => 'text',
                                'title' => esc_html__('Link', 'mslm-guide-special'),
                                'dependency'   => array( 'linkto', '==', '2' ),
                            ),
                            array(
                                'id'    => 'tab',
                                'type'  => 'select',
                                'title' => esc_html__('Lins open in', 'mslm-guide-special'),
                                'default' => '_self',
                                'options'  => array(
                                    '_self'  => esc_html__('Same tab', 'mslm-guide-special'),
                                    '_blank'   => esc_html__('New tab', 'mslm-guide-special'),
                                ),
                            ),
                        )
                    ),
                    array(
                        'id'    => 'img',
                        'type'  => 'image',
                        'title' => esc_html__('Right side image', 'mslm-guide-special'),
                        'desc' => esc_html__('Upload slider right side image.', 'mslm-guide-special'),
                    )
                )
            )
        )
    );

    return $options;

}
add_filter( 'cs_metabox_options', 'educare_extra_cs_metabox_options' );