<?php
$imgs = get_field('single_img');

// CALLING THE BREADCRUMB MODULE 
get_template_part('components/modules/module', 'breadcrumbs'); ?>


<article class="single_post">

    <?php if( get_post_type() == 'event' ) : ?>

        <section class="event_meta mb-big">
            <p class="FS24_B mb-small"><?php the_field('date'); ?></p>
            <p class="FS24_B"><?php the_field('location'); ?></p>
        </section>

    <?php endif; ?>

    <?php if ($imgs) : ?>

        <div class="grid mb-medium single_cover">
            <figure class="s_12col m_7col m_full">
                <div class="cover_slide">
                    <?php foreach ($imgs as $img) : ?>
                        <img src="<?= $img['url'] ?>" alt="" class="">
                    <?php endforeach; ?>
                </div>
            </figure>

            <div class="s_12col m_5col mt-big container-title-post p-small">
                <h1 class="FS42_B post-title"><?php the_title(); ?></h1>
                <div class="FS16_B post-excerpt"><?php the_excerpt(); ?></div>
            </div>
        </div>


    <?php elseif ( has_post_thumbnail() ) : ?>

        <div class="grid mb-medium single_cover thumbnail_single">
            <figure class="s_12col m_7col m_full">
                <div class="inner">
                    <?php the_post_thumbnail(); ?>
                </div>
            </figure>

            <div class="s_12col m_5col mt-big container-title-post p-small">
                <h1 class="FS42_B post-title"><?php the_title(); ?></h1>
                <div class="FS16_B post-excerpt"><?php the_excerpt(); ?></div>
            </div>
        </div>


    <?php else : // else imgs 

        if (is_page()) : ?>
            <div class="grid mb-medium">
                <div class="s_12col m_7col col_start_2">
                    <h1 class="FS42_B"><?php the_title(); ?></h1>
                    <div class="FS18"><?php the_excerpt(); ?></div>
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

    <?php endif; // if imgs ?>


    <div class="grid">
        <div class="s_12col m_9col copy FS16">
            <?= do_shortcode(the_content());  ?>
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