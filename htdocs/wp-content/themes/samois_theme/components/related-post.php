<?php

$related = get_posts(array(/*'category__in' => wp_get_post_categories($post->ID),*/'numberposts' => 3, 'post__not_in' => array($post->ID), 'orderby' => 'rand',));

if ($related) : ?>
    <div class="related-posts mt-big">
        <h2 class="FS24_B arrow">Médias relatifs</h2>
        <ul class="grid txt-centered">
            <?php foreach ($related as $post) :
                setup_postdata($post); ?>

                <?php get_template_part('components/blocs/bloc', 'post-related') ?>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif;
wp_reset_postdata();

// related Post by tags
/*
$tags = wp_get_post_terms(get_queried_object_id(), 'post_tag', ['fields' => 'ids']);
$args = [
    'post__not_in'        => array(get_queried_object_id()),
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => 1,
    'orderby'             => 'rand',
    'tax_query' => [
        [
            'taxonomy' => 'post_tag',
            'terms'    => $tags
        ]
    ]
];
$my_query = new wp_query($args);
if ($my_query->have_posts()) {
    echo '<div id="related"><h4>Related Posts</h4>';
    while ($my_query->have_posts()) {
        $my_query->the_post(); ?>
        <div class="ncc">

            <h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" rel="nofollow"><?php the_title(); ?></a></h5>
            <?php the_excerpt(); ?>

        </div>
        <!--ncc-->
<?php }
    wp_reset_postdata();
    echo '</div><!--related-->';
}*/