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

<?php get_template_part('components/shortcuts');  ?>


<?php while (have_posts()) : the_post(); ?>

    <header class="page_head">
        <h1 class="FS42_B"><?= the_title() ?></h1>
        <div class="grid mb-big">
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
