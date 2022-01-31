<?php

/**
 *
 * @package samois
 */

get_header();

$imgs = get_field('single_img');

$args = array(
    'title' => 'Prenez un <br>raccourci !',
);
$shortcuts_links = get_field('shortcuts_links');
$shortcuts_infos = get_field('infos_pratiques__liens');
set_query_var('infos', $shortcuts_infos);
set_query_var('links', $shortcuts_links);
get_template_part('components/shortcuts', '', $args);

while (have_posts()) : the_post();

    set_query_var('imgs', $imgs);
    get_template_part('components/content', 'page');


endwhile;

get_footer();
