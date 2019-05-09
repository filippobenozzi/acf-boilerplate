<?php

/*
 *  Theme setup
 * */
include_once(get_template_directory() .'/config/theme-config.php');

/*
 *  Theme navbar generator
 * */
require_once(get_template_directory().'/config/wp_bootstrap_navwalker.php');

/*
 *  Custom images size
 * */
include_once(get_template_directory().'/config/thumbnail-config.php');

/*
 *  Custom post type
 * */
require get_template_directory() . '/config/postType-config.php';

/*
 *  Custom taxonomy
 * */
require get_template_directory() . '/config/taxonomy-config.php';

/*
 *  Add feature image
 * */
add_theme_support( 'post-thumbnails' );

/*
 *  Get images with size
 * */
function get_image_size($field_name,$size,$page_id=false){
    $field = get_field($field_name, $page_id);
    return $field['sizes'][$size];
}

/*
 *  Render components
 * */
function render_component($component_name,$args = []){
    include get_template_directory() . '/template-parts/components/' . $component_name . '.php';
}

/*
 *  Render block
 * */
function render_block($block_name,$args = []){
    include get_template_directory() . '/template-parts/blocks/' . $block_name . '.php';
}

/*
 * Google Maps API
 * */
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyC09KXHjzoRQYA3776gtG1avzjpFjZVonA');
}
//This init the google api key
add_action('acf/init', 'my_acf_init');