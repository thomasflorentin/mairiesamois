<?php
$title = $args['title'];
$posts = $args['list_events'];
?>


<section class="mod_featured">

    <a href="<?php echo esc_url(home_url('/agenda')); ?>" class="mod_title arrow FS24_B"><?php echo $title; ?></a>


    <div class="mod_list">
        <?php
        if ($posts) : ?>
            <ul class="">
                <?php foreach ($posts as $post) :

                    setup_postdata($post); ?>

                    <li class="list-btop">
                        <a class="grid p-small" href="<?= the_permalink() ?>">
                            <p class="m_4col txt-capitalize mb-none"><?= get_field('date') ?></p>
                            <p class="m_4col mb-none" ><?= the_title() ?></p>
                            <p class="m_3col mb-none"><?= get_field('location') ?></p>
                            <p class="arrow m_1col mb-none txt-right"></p>
                        </a>
                    </li>

                <?php endforeach; ?>
            </ul>
            <?php
            wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>


</section>