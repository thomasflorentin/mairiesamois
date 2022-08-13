<li class="list-bbot bloc_event">
    <a class="grid" href="<?= the_permalink() ?>">
        <p class="s_12col m_3col txt-capitalize FS14 mb-none">
            <?= get_field('date') ?>
            <?php 
                if( get_field('horaires') !== '' && get_field('horaires') !== NULL ) { 
                    echo ' - ' . get_field('horaires');
                } 
            ?></p>
        <p class="s_12col m_4col mb-none FS16_B" ><?= the_title() ?></p>
        <p class="s_6col m_4col mb-none FS14"><?= get_field('location') ?></p>
        <div class="arrow s_6col m_1col mb-none txt-right"></div>
    </a>
</li>