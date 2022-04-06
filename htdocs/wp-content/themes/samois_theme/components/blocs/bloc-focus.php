<?php
    $categories = get_the_category();
    $type = '';
 
 if ( ! empty( $categories ) ) {
     $type .= esc_html( $categories[0]->name );   
 }
?>
<div class="bloc">
    <a href="<?= get_the_permalink(); ?>">
    
        <?php if (has_post_thumbnail()) : ?>
            <figure class="ratio_1 m_full mb-small">
                <div class="inner">
                    <?php the_post_thumbnail('focus-thumb'); ?>
                </div>
            </figure>
        <?php endif; ?>

        <div class="bloc-footer">
            <p class="FS10_U"><?= $type; ?></p>

            <h3 clasvs="FS_16B"><?= get_the_title(); ?></h3>
            <div class="FS14 mb-small"><?= get_the_excerpt(); ?></div>
        </div>

    </a>
</div>