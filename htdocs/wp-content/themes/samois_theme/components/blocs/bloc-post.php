<?php 
    if( !isset( $args['loop'] ) ) {
        $args['loop'] = 1;
    }

    $categories = get_the_category();
    $type = '';
 
 if ( ! empty( $categories ) ) {
     $type .= esc_html( $categories[0]->name );   
 }

?>

<div class="bloc">
    <a href="<?= get_the_permalink(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <?php if (is_front_page() || is_page()) : ?>
                <figure class="<?= ($args['loop'] == 2) ? 'ratio_2' : '' ?> m_full  mb-small">
                <?php else : ?>
                    <figure class="m_full  mb-small">
                    <?php endif; ?>
                    <div class="inner">
                        <?php the_post_thumbnail('post-thumb'); ?>
                    </div>
                    </figure>
                <?php endif; ?>

                <div class="bloc-footer">
                    <p class="FS10_U"><?= $type; ?></p>

                    <h3 clasvs="FS_16B"><?= get_the_title(); ?></h3>
                    <div class="FS14 mb-small"><?= get_the_excerpt(); ?></div>
                    <p class="FS10_B"><?= get_field('date') ?></p>
                </div>
    </a>
</div>