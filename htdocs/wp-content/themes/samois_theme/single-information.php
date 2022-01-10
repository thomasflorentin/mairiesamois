<?php

/**
 *
 * @package samois
 */

get_header();
$imgs = get_field('single_img');
$flat_color = get_field('flat_color');

?>

<main id="primary" class="site-main">
    <?php while (have_posts()) : the_post(); ?>

        <article>

            <?php if ($imgs) : ?>

                <div class="grid">
                    <figure class="s_12col m_7col">
                        <?php foreach ($imgs as $img) : ?>
                            <img src="<?= $img['url'] ?>" alt="">
                        <?php endforeach; ?>
                    </figure>

                    <div class="s_12col m_5col">
                        <h1 class="h1"><?php the_title(); ?></h1>
                        <div class="h3"><?php the_excerpt(); ?></div>
                    </div>
                </div>


            <?php else : ?>

                <div class="grid">
                    <div class="s_12col m_7col col_start_2">
                        <h1 class="h1"><?php the_title(); ?></h1>
                        <div class="h3"><?php the_excerpt(); ?></div>
                    </div>
                </div>

            <?php endif; ?>


            <div class="grid">
                <div class="s_12col m_7col copy">
                    <?php the_content(); ?>
                </div>
            </div>

            

            <?php
                the_post_navigation(
                    array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'samois') . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'samois') . '</span> <span class="nav-title">%title</span>',
                    )
                );
            endwhile; // End of the loop.
            ?>

        </article>

</main><!-- #main -->

<?php
get_footer();
