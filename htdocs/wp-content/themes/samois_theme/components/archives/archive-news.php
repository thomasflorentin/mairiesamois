


    <header class="page_head">
        <h1 class="FS42_B"><?= the_title() ?></h1>
        <div class="grid mb-medium">
            <div class="s_12col m_9col">
                <p class="FS14"><?= get_the_excerpt() ?></p>
            </div>
        </div>
    </header>



    <?php

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        $args = array(
            'post_type'         => 'post',
            'status'            => 'published',
            'order'             => 'DESC',
            'orderby'           => 'date',
            'paged'             => $paged,
            'posts_per_page'    => 3
        );

        // Custom query.
        $allnews = new WP_Query($args);

        // Check that we have query results.
        if ($allnews->have_posts()) : ?>


        <div class="list-news-container grid">

            <?php while ($allnews->have_posts()) : $allnews->the_post(); ?>

                <div class="s_12col m_4col mb-medium">

                    <?php get_template_part('components/blocs/bloc', 'post'); ?>

                </div>

            <?php endwhile; ?>
        </div>

        <?php 
            set_query_var('posts', $allnews);
            get_template_part('components/modules/module', 'pagination'); ?>


    <?php endif; wp_reset_postdata();
