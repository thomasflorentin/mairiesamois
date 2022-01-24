<?php
$title = $args['title'];
$posts = $args['list_posts'];
$loop = count($posts) + 1;
$link = $args['link'];

?>


<section class="mod_featured mb-big">

    <header class="mod_title mb-medium">
        <a href="<?php echo $link; ?>" class=" arrow FS24_B "><?php echo $title; ?></a>
    </header>

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
                        <div class="s_12col m_8col mb-medium">
                            <?php get_template_part('components/blocs/bloc', 'post', $args); ?>
                        </div>
                    <?php else : ?>
                        <div class="s_12col m_4col mb-medium">
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