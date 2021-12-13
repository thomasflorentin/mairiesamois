<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package samois
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="wrapper">
        <?php samois_post_thumbnail(); ?>
    </div>



    <div class="entry-content wrapper">
        <?php get_template_part('components/content', 'flexible'); ?>

        <?php the_content(); ?>
    </div><!-- .entry-content -->


    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->