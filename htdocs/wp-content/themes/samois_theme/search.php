<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package samois
 */

get_header();
?>


    <?php if (have_posts()) : ?>

        <header class="page-header">
            <h1 class="page-title">
                <?php
                /* translators: %s: search query. */
                printf(esc_html__('Search Results for: %s', 'samois'), '<span>' . get_search_query() . '</span>');
                ?>
            </h1>
        </header><!-- .page-header -->

        <div class="grid">
            <?php while (have_posts()) : the_post(); ?>
                <div class="m_4col mb-medium">
                    <?php get_template_part('components/blocs/bloc', 'post'); ?>
                </div>
            <?php endwhile; 

                the_posts_navigation();

            else :

                printf('Rien trouvé...');

            endif; ?>

        </div><!-- .grid -->



<?php
get_footer();
