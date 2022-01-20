<?php
/**
 *
 * @package samois
 */

get_header(); 


while (have_posts()) : the_post(); 


    $args = array(
        'post_type'   => 'information',
        'post_parent' => $post->ID, 
        'posts_per_page' => -1, 
        'sort_column' => 'title', 
        'sort_order' => 'ASC'
    );
    $page_children = get_posts( $args );

    

    // CALLING THE BREADCRUMB MODULE
    $level = 0;

    $ancestors = get_post_ancestors($post);
    if( !empty( $ancestors ) ) {
        $level = count($ancestors);
    }
    $ariane = '';

    if( $level == 0 ) {
        $root = get_the_ID();
        $children = get_page_children($root, $page_children);
        $root_title = get_the_title($root);
        $root_title_url = get_permalink($root);	
    } 
    else {
        $root = end($ancestors);
        $root_title = get_the_title($root);
        $root_title_url = get_permalink($root);	
    } 
    




    // TESTING IF ROOT OR CHILDREN
    if ( count( $page_children) > 0 ) : 
        // C'est une page parente (donc archives des pages enfants) 

        set_query_var( 'root', $root );
        set_query_var( 'root_title', $root_title );
        set_query_var( 'root_title_url', $root_title_url ); 
        
        get_template_part('components/modules/module', 'breadcrumbs');
    

        $shortcuts_links = get_field('shortcuts_links');
        $shortcuts_args = array(
            'title' => 'Pour aller plus vite !',
        );
        set_query_var('links', $shortcuts_links);
        get_template_part('components/shortcuts', '', $shortcuts_args); 


        set_query_var('page_children', $page_children);
        get_template_part('components/archives/archive', 'informations');
        

    else : 
        // C'est une page enfant (donc contenu normal) 

        set_query_var( 'root', $root );
        get_template_part('components/content', 'page'); 
    

    endif;


endwhile; 


get_footer();
