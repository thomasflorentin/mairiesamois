<?php

/**
 *
 * @package samois
 */

get_header();
$imgs = get_field('single_img');
$flat_color = get_field('flat_color');

?>


<?php
$args = array(
    'title' => 'Prenez un raccourci !',
);
$shortcuts_links = get_field('shortcuts_links');
set_query_var('links', $shortcuts_links);
get_template_part('components/shortcuts', '', $args);  ?>


<?php while (have_posts()) : the_post(); ?>

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
                    <div class="FS16 post-excerpt"><?php the_excerpt(); ?></div>
                </div>
            </div>


        <?php else : ?>

            <div class="grid mb-medium">
                <div class="s_12col m_7col col_start_2">
                    <h1 class="FS42_B"><?php the_title(); ?></h1>
                    <div class="FS16"><?php the_excerpt(); ?></div>
                </div>
            </div>

        <?php endif; ?>


        <div class="grid">
            <div class="s_12col m_7col copy FS18_B">
                <?= get_the_content(); ?>
            </div>
        </div>



    <?php
    the_post_navigation(
        array(
            'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'samois') . '</span> <span class="nav-title">%title</span>',
            'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'samois') . '</span> <span class="nav-title">%title</span>',
        )
    );


    $tags = wp_get_post_tags( $post->ID,
        array(
            'fields' => 'ids',
        )
    );


endwhile; // End of the loop. ?>

    </article>


    <?php get_template_part('components/related-post'); ?>

    <?php
    get_footer();
