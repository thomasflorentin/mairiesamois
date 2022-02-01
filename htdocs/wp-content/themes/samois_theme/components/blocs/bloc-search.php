<?php
$excerpt = get_the_excerpt();
 
$excerpt = substr($excerpt, 0, 260);
$excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . ' [...]';

?>

<div class="bloc">
    <a href="<?= get_the_permalink(); ?>">

        <?php if (has_post_thumbnail()) : ?>
            <figure class="ratio_1 m_full">
                <div class="inner">
                    <?php the_post_thumbnail('post-thumb'); ?>
                </div>
            </figure>
        <?php endif; ?>

        <div class="bloc-footer p-small">
            <?php 
                if ( get_post_type() == 'event' || get_post_type() == 'post' ) {
                    $type = get_field('type');
                }
                elseif ( get_post_type() == 'page' ) {
                    $type = 'Page';
                }
                else {
                    $type = 'Informations';
                }
            ?>
            <p class="FS10_U"><?= $type; ?></p>

            <h3 clasvs="FS_16B"><?= get_the_title(); ?></h3>
            <div class="FS14 mb-small"><?= $excerpt; ?></div>
            <p class="FS10_B"><?= get_field('date') ?></p>
        </div>

    </a>
</div>