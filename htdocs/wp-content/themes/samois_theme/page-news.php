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
?>

<?php
while (have_posts()) : the_post(); ?>

<header class="page_head">
        <h1 class="FS42_B"><?= the_title() ?></h1>
        <div class="grid mb-big">
            <div class="s_12col m_9col">
                <p class="FS14"><?= get_the_excerpt() ?></p>
            </div>
        </div>
    </header>



<?php get_template_part('components/archives/archive', 'news');

endwhile;
?>


<?php
get_footer();
