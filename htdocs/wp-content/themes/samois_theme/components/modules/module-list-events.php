<?php
$title = $args['title'];
$posts = $args['list_events'];
?>


<section class="mod_featured">

    <h2 class="mod_title"><?php echo $title; ?></h2>


    <div class="mod_list">
        <?php
        if ($posts) : ?>
            <ul>
                <?php foreach ($posts as $post) :

                    setup_postdata($post); ?>

                    <li>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <span>A custom field from this post: <?php the_field('field_name'); ?></span>
                    </li>

                <?php endforeach; ?>
            </ul>
            <?php
            wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>


</section>