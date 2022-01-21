<div class="bloc">
    <a href="<?= get_the_permalink(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <?php if (is_front_page() || is_page()) : ?>
                <figure class="<?= ($args['loop'] == 2) ? 'ratio_2' : 'ratio_1' ?> m_full">
                <?php else : ?>
                    <figure class="ratio_1 m_full">
                    <?php endif; ?>
                    <div class="inner">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    </figure>
                <?php endif; ?>

                <div class="bloc-footer p-small">
                    <p class="FS10_U"><?= get_field('type'); ?></p>

                    <h3 clasvs="FS_16B"><?= get_the_title(); ?></h3>
                    <div class="FS14 mb-small"><?= get_the_excerpt(); ?></div>
                    <p class="FS_10B"><?= get_field('date') ?></p>
                </div>
    </a>
</div>