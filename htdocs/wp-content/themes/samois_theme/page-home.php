<?php

/**
 * Template Name: Page Accueil 
 * 
 * Template Post Type: page
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package samois
 */

get_header();
?>

    <?php 
    $args = array( 
        'title' => 'Prenez un raccourci',
        'list'  => array(
            'un', 'deux'
        ),
    );
    
    set_query_var('maList', $args);
    get_template_part('components/shortcuts', '', $args); ?>

    <?php while (have_posts()) : the_post();

        get_template_part('components/content', 'flexible');

    endwhile; ?>



<?php
get_footer();
