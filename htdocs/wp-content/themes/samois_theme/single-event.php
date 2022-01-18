<?php

/**
 *
 * @package samois
 */

get_header();
$imgs = get_field('single_img');
$flat_color = get_field('flat_color');

?>


<?php
$shortcuts_links = get_field('shortcuts_links');
if ($shortcuts_links) {
    $args = array(
        'title' => 'Prenez un raccourci !',
    );
    set_query_var('links', $shortcuts_links);
    get_template_part('components/shortcuts', '', $args);
}
?>


<?php while (have_posts()) : the_post();

    set_query_var('root', $root);
    get_template_part('components/content', 'page');


    the_post_navigation(
        array(
            'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'samois') . '</span> <span class="nav-title">%title</span>',
            'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'samois') . '</span> <span class="nav-title">%title</span>',
        )
    );

endwhile; // End of the loop.

get_footer();
