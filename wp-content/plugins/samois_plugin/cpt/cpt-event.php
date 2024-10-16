<?php 

function event_register_post_types() {
	
    // CPT Portfolio
    $labels = array(
        'name' => 'Événements',
        'all_items' => 'Tous les événements',  // affiché dans le sous menu
        'singular_name' => 'Événement',
        'add_new_item' => 'Ajouter un événement',
        'edit_item' => 'Modifier l\'événement',
        'menu_name' => 'Événements'
    );

	$args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor','thumbnail','custom-fields','excerpt'),
        'taxonomies' => array('category', 'post_tag'),
        'rewrite' => array('slug' => 'evenement','with_front' => true),
        'menu_position' => 5, 
        'menu_icon' => 'dashicons-calendar',
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
	);

	register_post_type( 'event', $args );
}
add_action( 'init', 'event_register_post_types' ); // Le hook init lance la fonction