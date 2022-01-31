<?php
$title = $args['title'];
$posts = $args['list_posts'];
$link = $args['link'];

?>


<section class="mod_featured mb-big">

    <header class="mod_title mb-medium">
        <h2 class="FS42_BB ">
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
            <div class="grid">

                <?php foreach ($posts as $post) : setup_postdata($post); ?>

                    <div class="s_12col m_6col mb-medium">
                        <?php get_template_part('components/blocs/bloc', 'focus', $args); ?>
                    </div>


                <?php endforeach; ?>
            </div>
            <?php
            wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>


</section>