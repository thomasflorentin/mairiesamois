<?php 

function information_register_post_types() {
	
    // CPT Portfolio
    $labels = array(
        'name' => 'Informations',
        'all_items' => 'Tous les informations',  // affiché dans le sous menu
        'singular_name' => 'Information',
        'add_new_item' => 'Ajouter une informations',
        'edit_item' => 'Modifier l\'information',
        'menu_name' => 'Informations'
    );

	$args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor','thumbnail','custom-fields' ),
        'rewrite' => array('slug' => 'information','with_front' => true),
        'menu_position' => 5, 
        'menu_icon' => 'dashicons-info',
	);

	register_post_type( 'information', $args );
}
add_action( 'init', 'information_register_post_types' ); // Le hook init lance la fonction