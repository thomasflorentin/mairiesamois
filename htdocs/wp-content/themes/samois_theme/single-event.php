<?php

/**
 *
 * @package samois
 */

    get_header();
    $imgs = get_field('single_img');

    while (have_posts()) : the_post();

        get_template_part('components/content', 'page');

        // the_post_navigation(
        //     array(
        //         'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'samois') . '</span> <span class="nav-title">%title</span>',
        //         'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'samois') . '</span> <span class="nav-title">%title</span>',
        //     )
        // );

    endwhile; 

get_footer();
