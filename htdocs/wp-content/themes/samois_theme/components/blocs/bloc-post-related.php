<li class="m_4col">
    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?= get_the_title(); ?>">
        <p><?= get_field('type'); ?></p>
        <p><?= get_the_title(); ?></p>
        <p><?= get_the_excerpt(); ?></p>
        <p><?= get_field('date'); ?></p>

    </a>

</li>