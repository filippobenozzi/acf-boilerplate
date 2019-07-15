<?php
// Register Custom Post Type
function custom_post_type() {

    $labels = array(
        'name'                  => 'Portfolio',
        'singular_name'         => 'Portfolio',
        'menu_name'             => 'Portfolio',
        'name_admin_bar'        => '',
        'archives'              => '',
        'parent_item_colon'     => '',
        'all_items'             => 'Tutti gli elementi',
        'add_new_item'          => 'Aggiungi nuovo',
        'add_new'               => 'Aggiungi nuovo',
        'new_item'              => 'Nuovo',
        'edit_item'             => 'Modifica',
        'update_item'           => 'Aggiorna',
        'view_item'             => 'Visualizza',
        'search_items'          => 'Cerca',
        'not_found'             => 'Nessun risultato',
        'not_found_in_trash'    => 'Nessun risultato',
        'featured_image'        => 'Immagine in evidenza',
        'set_featured_image'    => 'Imposta immagine in evidenza',
        'remove_featured_image' => 'Rimuovi immagine in evidenza',
        'use_featured_image'    => 'Usa come immagine in evidenza',
        'insert_into_item'      => 'Inserisci',
        'uploaded_to_this_item' => 'Carica',
        'items_list'            => 'Lista',
        'items_list_navigation' => 'Naviga',
        'filter_items_list'     => 'Filtra',
    );
    $args = array(
        'label'                 => 'Portfolio',
        'labels'                => $labels,
        'supports'              => array('title','revisions','thumbnail'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'portfolio', $args );

}
add_action( 'init', 'custom_post_type', 0 );
