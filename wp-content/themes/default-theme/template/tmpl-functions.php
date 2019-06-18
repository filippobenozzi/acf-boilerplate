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
    //  Print pretty array
    //
    function print_pretty_array($variable){
        return print("<pre>".print_r($variable,true)."</pre>");
    }

    //
    //  Render image with custom size
    //
    function get_image_size($field,$size){
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

    //
    //  Theme Javascript
    //
    function my_script_enq(){
        $my_script_url = get_template_directory_uri() . '/assets/dist/js/bundle.js';
        $my_script_mod = filemtime(get_template_directory() . '/assets/dist/js/bundle.js');
        wp_enqueue_script('my-theme-script', $my_script_url, array(), $my_script_mod, true);
    }
    add_action('wp_enqueue_scripts','my_script_enq');

    //
    //  Theme Style
    //
    function my_style_enq(){
        $my_style_url = get_template_directory_uri() . '/assets/dist/css/style.css';
        $my_style_mod = filemtime(get_template_directory() . '/assets/dist/css/style.css');
        wp_enqueue_style('my-theme-script', $my_style_url, array(), $my_style_mod);
    }
    add_action('wp_enqueue_scripts','my_style_enq');

    //
    //  Get SVG image
    //
    function get_svg($name, $path_folder = ''){

        if($path_folder == ''){
            $path_folder = get_template_directory() . '/images/svg/';
        }

        return file_get_contents($path_folder . $name . '.svg');

    }