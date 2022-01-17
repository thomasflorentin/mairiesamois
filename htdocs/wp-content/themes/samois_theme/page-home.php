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
    'title' => 'Prenez un raccourci !',
);
$shortcuts_links = get_field('shortcuts_links');
set_query_var('links', $shortcuts_links);
get_template_part('components/shortcuts', '', $args);  ?>


<?php while (have_posts()) : the_post(); ?>

    <div class="fl-justify">
        <div class="hp_left">
            <?php get_template_part('components/content', 'flexible'); ?>
        </div>
        <div class="hp_right">
            <?php get_template_part('components/modules/module', 'horaires'); ?>
        </div>
    </div>

<?php endwhile; ?>



<?php
get_footer();
