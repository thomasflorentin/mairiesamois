

<aside id="shortcuts" class="shortcuts txt-centered">

    <h2 class="FS16_B"><?= $args['title']; ?></h2>

    <nav class="">
        <ul class="">
            <?php foreach ($links as $value) : ?>
                <li>
                    <a class="FS14_B" href="<?= $value->guid; ?>"><?= $value->post_title; ?></a>
                    <hr>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

</aside>
