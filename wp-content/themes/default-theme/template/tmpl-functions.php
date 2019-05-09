<?php

    //
    //  Google maps
    //
    function my_acf_init() {
        acf_update_setting('google_api_key', get_field('google_maps_api','option'));
    }
    add_action('acf/init', 'my_acf_init');

    wp_enqueue_script('google-maps-cluster', 'https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerclustererplus/src/markerclusterer.js', array(), '', true);
    wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?&key='.get_field('google_maps_api','option').'&libraries=places', array(), '', true);

    //
    //  Render image with custom size
    //
    function get_image_size($field_name,$size,$page_id=false){
        $field = get_field($field_name, $page_id);
        return $field['sizes'][$size];
    }
    function get_sub_image_size($field_name,$size,$page_id=false){
        $field = get_sub_field($field_name, $page_id);
        return $field['sizes'][$size];
    }

    //
    //  Render
    //
    function render_theme_component($component_name,$args = []){
        include get_template_directory() . '/template/components/' . $component_name . '.php';
    }
    function render_theme_block($block_name,$args = []){

        if( is_string($args['id_block']) ){
            $fields = get_field($args['id_block']);
        } else {
            $fields = $args['id_block'];
        }

        include get_template_directory() . '/template/blocks/' . $block_name . '.php';

    }