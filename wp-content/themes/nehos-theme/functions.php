<?php

/*
 *  Theme setup
 * */
include_once(get_template_directory() .'/config/theme-config.php');

/*
 *  Theme navbar generator
 * */
require_once(get_template_directory().'/config/class-wp-bootstrap-navwalker.php');

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
 *  Disable comment
 * */
require get_template_directory() . '/config/disableComment.php';

/*
 *  Add feature image
 * */
add_theme_support( 'post-thumbnails' );

/*
 *  Include tmpl-functions.php
 * */
require get_template_directory() . '/template/tmpl-functions.php';
