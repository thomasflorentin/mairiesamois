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

        <header class="page-header mb-big">
            <h1 class="page-title">
                <?php
                /* translators: %s: search query. */
                printf(esc_html__('Résultats pour votre recherche : %s', 'samois'), '<span><em>' . get_search_query() . '</em></span>');
                ?>
            </h1>
        </header><!-- .page-header -->

        <div class="grid">
            <?php while (have_posts()) : the_post(); ?>
                <div class="s_12col m_4col mb-medium">
                    <?php get_template_part('components/blocs/bloc', 'search'); ?>
                </div>
            <?php endwhile; 

                the_posts_navigation();

            else : ?>
                
                <div class="mb-big">
                    <h1>Nous n'avons trouvé aucun résultat...</h1>
                    <p>Ne perdons pas espoir :) ! Réessayez avec un autre terme.</p>

                    <?php get_search_form(); ?>
                </div>

                <a href="/actualites" class="mod_title arrow FS24_B">
                    <?php print('L\'actualité'); ?>
                </a>

                <?php get_template_part('components/archives/archive', 'news');

            endif; ?>

        </div><!-- .grid -->



<?php
get_footer();
