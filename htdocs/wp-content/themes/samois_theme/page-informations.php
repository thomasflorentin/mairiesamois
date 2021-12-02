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
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();

        get_template_part('components/content', 'page');

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
