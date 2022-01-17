<?php 

$args = array(
    'post_type'   => 'information',
    'post_parent' => $parent_id, 
    'posts_per_page' => -1, 
    'sort_column' => 'title', 
    'sort_order' => 'ASC'
);

$the_query = new WP_Query($args); ?>

<div class="s_5col page_item mb-big">

    <figure class="ratio_1 item_cover">
        <div class="inner">
            <?php echo get_the_post_thumbnail( $parent_id, '' ); ?>
        </div>
    </figure>

    <div class="item_title txt-centered">
        <h2 class="FS18 mb-none"><?php echo get_the_title( $parent_id ); ?></h2>
    </div>

    <ul class="item_pages txt-centered">
        <?php

        if ($the_query->have_posts()) :

            while ($the_query->have_posts()) : $the_query->the_post(); ?>

                <li><a class="btn_inline FS14" href="<?php the_permalink() ?>"> <?php the_title() ?></a></li>

        <?php endwhile;
            wp_reset_postdata();
        endif;

        ?>
    </ul>

</div><!-- .page_item -->