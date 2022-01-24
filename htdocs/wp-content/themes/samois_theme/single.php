<?php
/**
 *
 * @package samois
 */

get_header();

    $imgs = get_field('single_img');

    while (have_posts()) : the_post();

        set_query_var('imgs', $imgs);
        get_template_part('components/content', 'page');


    endwhile; 

get_footer();
