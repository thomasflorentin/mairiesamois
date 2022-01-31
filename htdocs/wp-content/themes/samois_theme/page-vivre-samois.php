<?php

/**
 * Template Name: Page Vivre à samois 
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
    'title' => 'Prenez un <br>raccourci !',
);
$shortcuts_links = get_field('shortcuts_links');
$shortcuts_infos = get_field('infos_pratiques__liens');
set_query_var('infos', $shortcuts_infos);
set_query_var('links', $shortcuts_links);
get_template_part('components/shortcuts', '', $args);  ?>


<?php while (have_posts()) : the_post(); ?>

    <header class="page_head">
        <h1 class="FS54_B "><?= the_title() ?></h1>
        <div class="grid mb-medium">
            <div class="s_12col m_9col">
                <p class="FS14"><?= get_the_excerpt() ?></p>
            </div>
        </div>
    </header>
    
    <div class="fl-justify">
        <div class="">
            <?php get_template_part('components/content', 'flexible'); ?>
        </div>
    </div>

<?php endwhile; ?>



<?php
get_footer();
