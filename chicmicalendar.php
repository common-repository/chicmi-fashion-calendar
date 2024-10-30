<?php
/*
Plugin Name: Chicmi Fashion Calendar
Plugin URI: https://www.chicmi.com/for-bloggers/
Description: Show a calendar of fashion events for your city, sourced from Chicmi.com
Author: Chicmi Ltd
Author URI: https://www.chicmi.com/
Version: 1.0.4
Licence: GPL2 or later
Licence URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function chicmicalendar_shortcode( $atts ) {

    global $chicmicalendar_instance_id;

    if ( !$chicmicalendar_instance_id ) {
        $chicmicalendar_instance_id = 1;
    } else {
        $chicmicalendar_instance_id += 1;
    }

    $output = "";

    if ($chicmicalendar_instance_id == 1) {
        wp_enqueue_script( 'chicmicalendar_embed', 'https://d3a5iz4rjesio2.cloudfront.net/js/embed-v1.0.4.js', array(), '1.0.4', false );
    }

    $chicmicalendar_atts = shortcode_atts( array(
        'target' => 'chicmicalendar-'.esc_attr($chicmicalendar_instance_id),
        'city' => 'london',
        'types' => '',
        'sectors' => '',
        'days' => '7',
        'date_from' => '',
        'date_to' => '',
        'max_results' => '',
        'locale' => 'en',
        'columns' => '1',
        'image_position' => 'top',
        'image_size' => '200',
        'show_image' => 'yes',
        'show_image_link' => 'yes',
        'show_summary' => 'yes',
        'show_address' => 'yes',
        'show_date' => 'yes',
        'show_entry_status' => 'yes',
        'show_price' => 'yes',
        'show_action_link' => 'yes',
        'show_read_more_link' => 'yes',
        'element_spacing' => '20',
        'row_spacing' => '25',
        'title_style' => 'font-weight:bold;font-size:100%;',
        'summary_style' => 'font-size:80%;margin-bottom:5px;',
        'details_style' => 'font-size:70%;margin-bottom:5px;',
        'group_style' => 'font-weight:bold;font-size:80%;margin-bottom:5px;margin-top:15px;border-bottom:1px solid black;',
        'link_style' => 'font-size:80%;',
        'designers' => '',
        'stores' => '',
        'users' => '',
        'featured_only' => 'yes',
        'group_by' => '',
        'empty_text' => 'There are no events to show at the moment. Please check back later!',
        'loading_text' => 'Loading calendar...'
    ), $atts );

    $chicmicalendar_args = json_encode( $chicmicalendar_atts );

    $output .= "<div id='" . esc_attr($chicmicalendar_atts['target']) . "' style='position:relative;'></div>";
    $output .= "<script type='text/javascript'>document.addEventListener('DOMContentLoaded', function(event) {";
        $output .= 'chicmicalendar_show(' . $chicmicalendar_args . ');';
    $output .= "});</script>";

    return $output;

}

function chicmicalendar_register_shortcode() {
    add_shortcode( 'chicmi-calendar', 'chicmicalendar_shortcode' );
}

add_action( 'init', 'chicmicalendar_register_shortcode' );