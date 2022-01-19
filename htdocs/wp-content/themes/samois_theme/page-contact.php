<?php

/**
 * Template Name: Page Contact
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
        <div class="grid mb-medium">
            <div class="s_12col m_9col">
                <p class="FS14"><?= get_the_excerpt() ?></p>
            </div>
        </div>
    </header>


    <div class="games">
        <?= apply_shortcodes('[contact-form-7 id="239" title="Contact form 1"]'); ?>
    </div>

<?php endwhile;
?>


<?php
get_footer();
