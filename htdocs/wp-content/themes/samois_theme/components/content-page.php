<?php
$imgs = get_field('single_img');

get_template_part('components/shortcuts');

$vertical_thumbnail = get_field('vertical_thumbnail');
if( $vertical_thumbnail === null) {
    $vertical_thumbnail = false;
}

// CALLING THE BREADCRUMB MODULE 
get_template_part('components/modules/module', 'breadcrumbs'); ?>


<div>

    <article class="single_post">

        <?php if ($imgs) : ?>

            <div class="grid mb-big single_cover">
                <figure class="s_12col m_7col m_full">
                    <div class="cover_slide">
                        <?php foreach ($imgs as $img) : ?>
                            <img src="<?= $img['url'] ?>" alt="<?= $img['alt'] ?>" class="">
                        <?php endforeach; ?>
                    </div>
                </figure>

                <div class="s_12col m_5col mt-big container-title-post p-small">
                    <h1 class="FS42_B post-title"><?php the_title(); ?></h1>
                    
                    <?php if( get_post_type() == 'event' ) : ?>

                        <div class="event_meta mb-big">
                            <p class="FS24_B mb-small">
                                <?php get_event_dates(get_the_ID()); ?>
                            </p>
                            <p class="FS24_B txt-capitalize"><?php the_field('location'); ?></p>
                        </div>

                    <?php endif; ?>

                    <div class="FS16_B post-excerpt"><?php the_excerpt(); ?></div>
                </div>
            </div>


        <?php elseif ( $vertical_thumbnail && has_post_thumbnail() ) : ?>

            <div class="grid mb-big single_cover thumbnail_single vertical_image">
                <figure class="s_12col m_5col m_full">
                    <div class="inner">
                        <?php the_post_thumbnail(); ?>
                    </div>
                </figure>

                <div class="s_12col m_7col mt-big container-title-post  p-small">
                    <h1 class="FS42_B post-title"><?php the_title(); ?></h1>

                    <?php if( get_post_type() == 'event' ) : ?>

                        <div class="event_meta mb-big">
                            <p class="FS24_B mb-small">
                                <?php get_event_dates(get_the_ID()); ?>
                            </p>
                            <p class="FS24_B txt-capitalize"><?php the_field('location'); ?></p>
                        </div>

                    <?php endif; ?>

                    <div class="FS16_B post-excerpt"><?php the_excerpt(); ?></div>
                </div>
            </div>

        <?php elseif ( !$vertical_thumbnail && has_post_thumbnail() ) : ?>

            <div class="grid mb-big single_cover thumbnail_single">
                <figure class="s_12col m_7col m_full">
                    <div class="inner">
                        <?php the_post_thumbnail('single-main'); ?>
                    </div>
                </figure>

                <div class="s_12col m_5col mt-big container-title-post p-small">
                    <h1 class="FS42_B post-title"><?php the_title(); ?></h1>
                    <?php if( get_post_type() == 'event' ) : ?>

                        <div class="event_meta mb-big">
                            <p class="FS24_B mb-small">
                                <?php get_event_dates(get_the_ID()); ?>
                            </p>
                            <p class="FS24_B txt-capitalize"><?php the_field('location'); ?></p>
                        </div>

                    <?php endif; ?>
                    <div class="FS16_B post-excerpt"><?php the_excerpt(); ?></div>
                </div>
            </div>

        <?php else : // else imgs 

            if (is_page()) : ?>
                <div class="grid mb-big">
                    <div class="s_12col m_7col col_start_2">
                        <h1 class="FS42_B"><?php the_title(); ?></h1>
                        <div class="FS18"><?php the_excerpt(); ?></div>
                    </div>
                </div>

            <?php else : ?>
                <div class="grid mb-big">
                    <div class="s_12col m_7col col_start_2">
                        <h1 class="FS42_B"><?php the_title(); ?></h1>
                        <?php if( get_post_type() == 'event' ) : ?>

                            <div class="event_meta mb-big">
                                <p class="FS24_B mb-small">            
                                    <?php get_event_dates(get_the_ID()); ?>
                                </p>
                                <p class="FS24_B txt-capitalize"><?php the_field('location'); ?></p>
                            </div>

                        <?php endif; ?>
                        <div class="FS18_B"><?php the_excerpt(); ?></div>
                    </div>
                </div>

            <?php endif; ?>

        <?php endif; // if imgs ?>


        <div class="grid">
            <div class="s_12col m_8col copy FS16">
                <?= do_shortcode(the_content());  ?>

                <?php get_template_part('components/content', 'flexible'); ?>

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


</div>