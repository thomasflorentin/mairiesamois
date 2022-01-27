<?php 
$excerpt = get_the_excerpt();
 
$excerpt = substr($excerpt, 0, 260);
$excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . ' [...]';
?>

<li class="s_12col m_4col item_related">
    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?= get_the_title(); ?>">
        <p class="FS14_U item_related_type mb-vsmall"><?= get_field('type'); ?></p>
        <p class="FS16_B mb-small item_related_title"><?= get_the_title(); ?></p>
        <p class="FS14 item_related_excerpt"><?= $excerpt; ?></p>
        <p class="FS10_B mb-none item_related_date"><?= get_field('date'); ?></p>
    </a>

</li>