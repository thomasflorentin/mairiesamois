<?php 
$excerpt = get_the_excerpt();
 
$excerpt = substr($excerpt, 0, 180);
$excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . ' [...]';
?>

<li class="s_12col m_4col item_related">
    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?= get_the_title(); ?>">

        <?php if (has_post_thumbnail()) : ?>
            <figure class="ratio_1 m_full">
                <div class="inner">
                    <?php the_post_thumbnail('post-thumb'); ?>
                </div>
            </figure>
        <?php endif; ?>
        
        <div class="item_inner">

            <p class="FS14_U item_related_type">
                <?= get_field('type'); ?> 
                <?php if(get_field('date') !== '' ) { ?>
                    <span class="item_related_date"> - <?= get_field('date'); ?></span>
                <?php } ?>
            </p>

            <p class="FS16_B mb-small item_related_title"><?= get_the_title(); ?></p>
            <p class="FS14 item_related_excerpt"><?= $excerpt; ?></p>
        </div>

    </a>

</li>