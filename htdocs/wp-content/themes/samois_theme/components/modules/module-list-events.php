<?php
$title = $args['title'];
$posts = $args['list_posts'];
$link = $args['link'];
?>


<section class="mod_featured mb-big">

    <header class="mod_title mb-medium">
        <h2 class="FS54_B ">
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

                    setup_postdata($post);
                    get_template_part('components/blocs/bloc', 'event');

                endforeach; ?>
            </ul>
            <?php
            wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>


</section>