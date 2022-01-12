<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package samois
 */

get_header();
$imgs = get_field('single_img');
$flat_color = get_field('flat_color');
?>



<?php while (have_posts()) : the_post();

    if ($imgs) : ?>
        <figure>
            <?php foreach ($imgs as $img) : ?>
                <img src="<?= $img['url'] ?>" alt="">
            <?php endforeach; ?>
        </figure>
    <?php endif;

    if ($flat_color) : ?>
        <div class="" style="height: 100px;width: 300px;background-color: <?= $flat_color ?>;">

        </div>
<?php endif;

    the_title();

    the_excerpt();

    the_content();

    the_post_navigation(
        array(
            'prev_text' => '<span class="nav-subtitle">' . esc_html__('<-', 'samois') . '</span> <span class="nav-title">%date</span>',
            'next_text' => '<span class="nav-subtitle">' . esc_html__('->', 'samois') . '</span> <span class="nav-title">%date</span>',
        )
    );

endwhile; // End of the loop.
?>

<?php get_template_part('components/related-post'); ?>
<?php
get_footer();
