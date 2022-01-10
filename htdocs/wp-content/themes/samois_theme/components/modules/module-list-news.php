<?php
$title = $args['title'];
$posts = $args['list_news'];
?>


<section class="mod_featured">

    <h2 class="mod_title"><?php echo $title; ?></h2>


    <div class="mod_list">
        <?php
        if ($posts) : ?>
            <div class="grid">
                <?php foreach ($posts as $post) :

                    setup_postdata($post); ?>

                    <div class="m_4col mb-medium">
                        <?php get_template_part('components/blocs/bloc', 'post'); ?>
                    </div>

                <?php endforeach; ?>
            </div>
            <?php
            wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>


</section>