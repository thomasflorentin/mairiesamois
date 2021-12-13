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
global $post;
$post_slug = $post->post_name;
?>

<main id="primary" class="site-main <?= $post_slug ?>">
    <h1><?= the_title() ?></h1>
    <p><?= the_excerpt() ?></p>
    <?php

    $categories = get_the_category();
    $category_id = $categories[0]->cat_ID;


    $categoriesChild = get_categories(
        array(
            'hide_empty' => false,
            'parent' => $category_id
        )
    );

    foreach ($categoriesChild as $c) {

        $taxonomy = $c->taxonomy;
        $term_id = $c->term_id;
        $slug =  $taxonomy . '_' . $term_id;
        $img = get_field('image', $slug);

        $args = array(
            'post_type' => 'information',
            'post_status' => 'publish',
            'category_name' => $c->cat_name,
            'posts_per_page' => -1,
        );

        $the_query = new WP_Query($args); ?>

        <div class="<?= $c->slug ?>">

            <?php if ($img) : ?>
                <figure>
                    <img src="<?= $img ?>" alt="">
                </figure>
            <?php endif; ?>

            <p><?= $c->cat_name ?></p>

            <ul>
                <?php

                if ($the_query->have_posts()) :

                    while ($the_query->have_posts()) : $the_query->the_post(); ?>

                        <a href="<?php the_permalink() ?>"> <?php the_title() ?></a>

                <?php endwhile;
                    wp_reset_postdata();
                endif;

                ?>
            </ul>

        </div>

    <?php }
    ?>

</main><!-- #main -->

<?php
get_footer();
