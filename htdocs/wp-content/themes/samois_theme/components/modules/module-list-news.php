<?php
$title = $args['title'];
$posts = $args['list_news'];
?>


<section class="mod_featured">

    <h2 class="mod_title"><?php echo $title; ?></h2>


    <div class="mod_list">
        <?php
        if ($posts) : ?>
            <ul>
                <?php foreach ($posts as $post) :

                    setup_postdata($post); ?>

                    <p>
                    <figure><?php the_post_thumbnail(); ?></figure>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <p><?php the_content(); ?></p>
                    </p>

                    <?php endforeach; ?>
            </ul>
            <?php
            wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>


</section>