<?php

/**
 * Template Name: Page Actualités
 * 
 * Template Post Type: page
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package samois
 */
get_header();


$args = array(
    'post_type' => 'post',
    'order' => 'DESC'
);

// Custom query.
$query = new WP_Query($args);

// Check that we have query results.
if ($query->have_posts()) : ?>

    <h1 class="FS42_B"><?= the_title() ?></h1>
    <div class="grid mb-medium">
        <div class="s_12col m_9col">
            <p class="FS14"><?= get_the_excerpt() ?></p>
        </div>
    </div>

    <div class="list-news-container grid">

        <?php while ($query->have_posts()) : $query->the_post(); ?>

            <div class="s_12col m_4col mb-medium">

                <?php get_template_part('components/blocs/bloc', 'post'); ?>

            </div>



        <?php endwhile; ?>
    </div>
<?php endif;

wp_reset_postdata();

get_footer(); ?>