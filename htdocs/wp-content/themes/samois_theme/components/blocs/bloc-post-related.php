<?php
$excerpt = get_the_excerpt();

$excerpt = substr($excerpt, 0, 180);
$excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . ' [...]';

    $categories = get_the_category();
    $type = '';
 
 if ( ! empty( $categories ) ) {
     $type .= esc_html( $categories[0]->name );   
 }

?>

<li class="s_12col m_4col item_related">

    <p class="FS14_U mb-none ">
        <span class="item_related_type mb_none"> <?= $type; ?></span>
        <?php if (get_field('date')) : ?>
            <span class="item_related_date mb_none"><?= get_field('date'); ?></span>
        <?php endif; ?>
    </p>

    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?= get_the_title(); ?>">

        <div class="item_inner">
            <p class="FS16_B mb-small item_related_title"><?= get_the_title(); ?></p>
            <p class="FS14 item_related_excerpt"><?= $excerpt; ?></p>
        </div>

    </a>

</li>