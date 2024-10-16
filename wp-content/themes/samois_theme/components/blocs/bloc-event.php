<li class="list-bbot bloc_event">
    <a class="grid" href="<?= the_permalink() ?>">
        <p class="s_12col m_3col txt-capitalize FS14 mb-none">
            <?php get_event_dates(get_the_ID()); ?>
        </p>
        <p class="s_12col m_4col mb-none FS16_B block_title" ><?= the_title() ?></p>
        <p class="s_6col m_4col mb-none FS14"><?= get_field('location') ?></p>
        <div class="arrow s_6col m_1col mb-none txt-right"></div>
    </a>
</li>