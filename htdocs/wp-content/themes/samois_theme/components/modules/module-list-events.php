<?php
$title = $args['title'];
$posts = $args['list_posts'];
$link = $args['link'];
?>


<section class="mod_featured mb-big">

    <header class="mod_title mb-medium">
        <h2 class="FS24_B">
            <?php if( $link != '' ) : ?>
                <a href="<?php echo $link; ?>" class="arrow">
            <?php endif; ?>
                    <?php echo $title; ?>
            <?php if( $link != '' ) : ?>
                </a>
            <?php endif; ?>  
        </h2>
    </header>

    <div class="mod_list">
        <?php
        if ($posts) : ?>
            <ul class="">
                <?php foreach ($posts as $post) :

                    setup_postdata($post); ?>

                    <li class="list-btop">
                        <a class="grid p-small" href="<?= the_permalink() ?>">
                            <p class="s_3col txt-capitalize FS14 mb-none"><?= get_field('date') ?></p>
                            <p class="s_4col mb-none FS16_B" ><?= the_title() ?></p>
                            <p class="s_4col mb-none FS14"><?= get_field('location') ?></p>
                            <div class="arrow s_1col mb-none txt-right"></div>
                        </a>
                    </li>

                <?php endforeach; ?>
            </ul>
            <?php
            wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>


</section>