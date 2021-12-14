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
                        <?= the_field('date') ?> - <a href="<?= the_permalink() ?>"><?= the_title() ?></a> - <?php the_field('location') ?> - <a href="<?= the_permalink() ?>">-></a>
                    </li>

                <?php endforeach; ?>
            </ul>
            <?php
            wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>


</section>