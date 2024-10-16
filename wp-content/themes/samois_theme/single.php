<?php

/**
 *
 * @package samois
 */

get_header();

get_template_part('components/shortcuts');

while (have_posts()) : the_post();

    $imgs = get_field('single_img');
    set_query_var('imgs', $imgs);
    get_template_part('components/content', 'page');


endwhile;

get_footer();
