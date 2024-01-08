<?php /*
// Register Custom Taxonomy
function custom_taxonomy() {

    $labels = array(
        'name'                       => 'Categorie',
        'singular_name'              => 'Categoria',
        'menu_name'                  => 'Categorie',
        'all_items'                  => 'Tutte le categorie',
        'parent_item'                => 'Categoria parente',
        'parent_item_colon'          => 'Categoria parente:',
        'new_item_name'              => 'Nuova categoria',
        'add_new_item'               => 'Aggiungi categoria',
        'edit_item'                  => 'Modifica categoria',
        'update_item'                => 'Aggiorna categoria',
        'view_item'                  => 'Visualizza categoria',
        'separate_items_with_commas' => 'Separa gli elementi con virgole',
        'add_or_remove_items'        => 'Aggiungi o rimuovi elementi',
        'choose_from_most_used'      => 'Scegli fra le più usate',
        'popular_items'              => 'Categorie più usate',
        'search_items'               => 'Cerca',
        'not_found'                  => 'Nessun risultato',
        'no_terms'                   => 'Nessun risultato',
        'items_list'                 => '',
        'items_list_navigation'      => '',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'categorie', array( 'portfolio' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );