<?php
    $imgs = get_field('single_img');

    // CALLING THE BREADCRUMB MODULE 
    get_template_part('components/modules/module', 'breadcrumbs'); ?>


<article>

    <?php if ($imgs) : ?>

        <div class="grid mb-medium single_post">
            <figure class="s_12col m_7col ratio_1">
                <?php foreach ($imgs as $img) : ?>
                    <div class="inner">
                        <img src="<?= $img['url'] ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </figure>

            <div class="s_12col m_5col mt-big container-title-post p-small">
                <h1 class="FS42_B post-title"><?php the_title(); ?></h1>
                <div class="FS16_B post-excerpt"><?php the_excerpt(); ?></div>
            </div>
        </div>


    <?php else : ?>

        <div class="grid mb-medium">
            <div class="s_12col m_7col col_start_2">
                <h1 class="FS42_B"><?php the_title(); ?></h1>
                <div class="FS18_B"><?php the_excerpt(); ?></div>
            </div>
        </div>

    <?php endif; ?>


    <div class="grid">
        <div class="s_12col m_7col copy FS16">
            <?= get_the_content(); ?>
        </div>
    </div>

</article>


<?php

$tags = wp_get_post_tags(
    $post->ID,
    array(
        'fields' => 'ids',
    )
);
set_query_var('tags', $tags);
get_template_part('components/related-post'); ?>