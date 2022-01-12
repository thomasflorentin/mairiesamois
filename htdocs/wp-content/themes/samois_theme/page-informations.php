<?php

/**
 * Template Name: Page Informations 
 * 
 * Template Post Type: page
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package samois
 */

get_header();
$shortcuts_links = get_field('shortcuts_links');
?>


<?php
$args = array(
    'title' => 'Pour aller plus vite !',
    'list'  => $shortcuts_links
);

set_query_var('maList', $args);
get_template_part('components/shortcuts', '', $args); ?>


<?php while (have_posts()) : the_post(); ?>


    <header class="mb-medium grid">
        <div class="s_12col m_9col">
            <h1 class="FS42_B"><?= the_title() ?></h1>
            <div class="FS14"><?= the_excerpt() ?></div>
        </div>
    </header>


    <div class="grid">

        <?php

        $categories = get_the_category();
        $category_id = $categories[0]->cat_ID;


        $categoriesChild = get_categories(
            array(
                'hide_empty' => false,
                'parent' => $category_id
            )
        );

        foreach ($categoriesChild as $c) :

            set_query_var('c', $c);
            get_template_part('components/modules/module', 'informations');

        endforeach; ?>

    </div><!-- .grid -->

<?php endwhile; ?>


<?php
get_footer();
