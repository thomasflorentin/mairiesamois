<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package samois
 */

get_header();
?>


    <?php if (have_posts()) : ?>
        <header class="page-header category-header mb-big">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </header><!-- .page-header -->

        <div class="grid">

            <?php while (have_posts()) : the_post(); ?>
                <div class="m_4col mb-medium">
                    <?php get_template_part('components/blocs/bloc', 'search'); ?>
                </div>
            <?php endwhile; ?>

        </div>

        <?php the_posts_navigation(); ?>

    <?php endif; ?>



<?php
get_sidebar();
get_footer();
