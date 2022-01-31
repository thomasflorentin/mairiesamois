<?php if ($links || $infos) : ?>

    <aside id="shortcuts" class="shortcuts txt-centered">

        <h2 class="FS16_B"><?= $args['title']; ?></h2>

        <nav class="">
            <ul class="">
                <hr>
                <?php if ($infos) : ?>

                    <li><?= $infos; ?></li>

                    <?php else :

                    foreach ($links as $value) : ?>
                        <li>
                            <a class="FS14_B" href="<?= $value->guid; ?>"><?= $value->post_title; ?></a>
                            <hr>
                        </li>
                    <?php endforeach; ?>

                <?php endif; ?>
                <hr>
            </ul>
        </nav>

    </aside>

<?php endif; ?>