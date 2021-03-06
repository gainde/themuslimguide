<?php

if ( ! defined( 'ABSPATH' ) ) {	exit; }

vc_map(
    array(
        "name" => esc_html__( "Service box", "educare-toolkit" ),
        "base" => "educare_service_box",
        "icon"  => EDUC_ACC_URL.'/assets/img/services-icon.png',
        "category" => esc_html__( "educare", "educare-toolkit"),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__( "Title", "educare-toolkit" ),
                "param_name" => "title",
                "description" => esc_html__( "Type your service title", "educare-toolkit" )
            ),
            array(
                "type" => "attach_image",
                "heading" => esc_html__( "Background", "educare-toolkit" ),
                "param_name" => "bg",
                "description" => esc_html__( "Upload your service box background here", "educare-toolkit" )
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__( "Icon type", "educare-toolkit" ),
                "param_name" => "icon_type",
                "std" => esc_html__( "1", "educare-toolkit" ),
                "value" => array(
                    'Upload' => '1',
                    'Font awesome icon' => '2',
                ),
                "description" => esc_html__( "Select service box icon type", "educare-toolkit" )
            ),
            array(
                "type" => "attach_image",
                "heading" => esc_html__( "Icon", "educare-toolkit" ),
                "param_name" => "icon",
                "dependency" => array(
                    "element" => "icon_type",
                    "value" => array("1"),
                ),
                "description" => esc_html__( "Upload your service box icon here", "educare-toolkit" )
            ),
            array(
                "type" => "iconpicker",
                "heading" => esc_html__( "Select icon", "educare-toolkit" ),
                "param_name" => "fa_icon",
                "dependency" => array(
                    "element" => "icon_type",
                    "value" => array("2"),
                ),
                "description" => esc_html__( "Upload your service box icon here", "educare-toolkit" )
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__( "Description", "educare-toolkit" ),
                "param_name" => "desc",
                "description" => esc_html__( "Type your service description here", "educare-toolkit" )
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__( "Link to", "educare-toolkit" ),
                "param_name" => "link_to",
                "std" => esc_html__( "1", "educare-toolkit" ),
                "value" => array(
                    'Page' => '1',
                    'External link' => '2',
                ),
                "description" => esc_html__( "Select your button link type", "educare-toolkit" )
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__( "Select page", "educare-toolkit" ),
                "param_name" => "link_to_page",
                "value" => educare_toolkit_get_page_as_list(),
                "description" => esc_html__( "Select your page", "educare-toolkit" ),
                "dependency" => array(
                    "element" => "link_to",
                    "value" => array("1"),
                )
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__( "Link", "educare-toolkit" ),
                "param_name" => "link_external",
                "description" => esc_html__( "Type your external link here", "educare-toolkit" ),
                "dependency" => array(
                    "element" => "link_to",
                    "value" => array("2"),
                )
            ),
        )
    )
);