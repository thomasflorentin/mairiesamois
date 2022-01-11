<?php
$title = $args['title'];
$posts = $args['list_news'];
$loop = count($posts) + 1;

?>


<section class="mod_featured">

    <h2 class="mod_title arrow FS24_B"><?php echo $title; ?></h2>


    <div class="mod_list">
        <?php
        if ($posts) : ?>
            <div class="grid">

                <?php foreach ($posts as $post) : setup_postdata($post); ?>
                 
                    <?php $loop--;
                    $args = [
                        'loop' => $loop
                    ] ?>

                    <?php if ($loop === 2) : ?>
                        <div class="m_8col mb-medium">
                            <?php get_template_part('components/blocs/bloc', 'post', $args); ?>
                        </div>
                    <?php else : ?>
                        <div class="m_4col mb-medium">
                            <?php get_template_part('components/blocs/bloc', 'post', $args); ?>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>
            </div>
            <?php
            wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>


</section>