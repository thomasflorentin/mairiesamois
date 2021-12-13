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

    $categories = get_the_category();
    $category_id = $categories[0]->cat_ID;


    $categoriesChild = get_categories(
        array(
            'hide_empty' => false,
            'parent' => $category_id
        )
    );

    /**echo '<pre>';
    var_dump($categoriesChild);
    echo '</pre>';
    die(); */
    echo '<ul>';
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

        $the_query = new WP_Query($args);



        echo "<img src=" . $img . ">";
        echo '<li>' . $c->cat_name . '</li>';

        if ($the_query->have_posts()) :

            while ($the_query->have_posts()) :
                $the_query->the_post(); ?>

                <?php the_title(); ?>

    <?php endwhile;
        endif;
    }
    echo '</ul>';

    ?>

</main><!-- #main -->

<?php
get_footer();
