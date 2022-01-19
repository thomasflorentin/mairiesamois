<?php 

$taxonomy = $c->taxonomy;
$term_id = $c->term_id;
$slug =  $taxonomy . '_' . $term_id;
$img = get_field('image', $slug);

$args = array(
    'post_type' => 'information',
    'post_status' => 'publish',
    'category_name' => $c->cat_name,
    'posts_per_page' => -1,
    'order'   => 'ASC'
);

$the_query = new WP_Query($args); ?>

<div class="<?= $c->slug ?> s_5col page_item mb-big">

    <?php if ($img) : ?>
        <figure class="ratio_1 m_full item_cover">
            <div class="inner">
                <img src="<?= $img ?>" alt="">
            </div>
        </figure>
    <?php endif; ?>

    <div class="item_title txt-centered">
        <h2 class="FS18 mb-none"><?= $c->cat_name ?></h2>
    </div>

    <ul class="item_pages txt-centered">
        <?php

        if ($the_query->have_posts()) :

            while ($the_query->have_posts()) : $the_query->the_post(); ?>

                <li><a  class="btn_inline FS14" href="<?php the_permalink() ?>"> <?php the_title() ?></a></li>

        <?php endwhile;
            wp_reset_postdata();
        endif;

        ?>
    </ul>

</div><!-- .page_item -->