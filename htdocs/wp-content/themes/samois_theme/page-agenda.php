<?php

/**
 * Template Name: Page Agenda
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
    while (have_posts()) :
        the_post();

        get_template_part('components/archives/archive', 'events');

    endwhile; 
    ?>


<?php
get_footer();