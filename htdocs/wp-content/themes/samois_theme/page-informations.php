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

    <?php while (have_posts()) : the_post(); ?>


        <header class="mb-medium grid">  
            <div class="s_12col m_9col">
                <h1 class="h1"><?= the_title() ?></h1>
                <div class="h3"><?= the_excerpt() ?></div>
            </div>
        </header>


        <div class="grid">

            <?php

            $categories = get_the_category();
            $category_id = $categories[0]->cat_ID;


            $categoriesChild = get_categories(
                array(
                    'hide_empty' => false,
                    'parent' => $category_id
                )
            );

            foreach ($categoriesChild as $c) :

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

                <div class="<?= $c->slug ?> s_5col page_item mb-big">

                    <?php if ($img) : ?>
                        <figure class="ratio_1 item_cover">
                            <div class="inner">
                                <img src="<?= $img ?>" alt="">
                            </div>
                        </figure>
                    <?php endif; ?>

                    <div class="item_title txt-centered">
                        <h2 class="h31"><?= $c->cat_name ?></h2>
                    </div>

                    <ul class="item_pages txt-centered">
                        <?php

                        if ($the_query->have_posts()) :

                            while ($the_query->have_posts()) : $the_query->the_post(); ?>

                                <a href="<?php the_permalink() ?>"> <?php the_title() ?></a>

                        <?php endwhile;
                            wp_reset_postdata();
                        endif;

                        ?>
                    </ul>

                </div><!-- .page_item -->

            <?php endforeach; ?>

        </div><!-- .grid -->

    <?php endwhile; ?>


</main><!-- #main -->

<?php
get_footer();
