<?php 

$shortcuts_links = get_field('shortcuts_links');
$shortcuts_infos = get_field('infos_pratiques__liens');

if(  $shortcuts_infos !== '' ) {
    $title = 'A savoir';
}
elseif( $shortcuts_infos !== "" && $shortcuts_infos !== null ) {
    $title = 'Prenez un <br>raccourci !';
}
else {
    $shortcuts_links = get_field('shortcuts_links', get_option('page_on_front') );
    $title = 'Prenez un <br>raccourci !';
}


if ( $shortcuts_infos !== "" || $shortcuts_infos !== null ) : ?>
    <aside id="shortcuts" class="shortcuts txt-centered">

        <header class="shortcuts_title">
            <h2 class="FS16_B"><?= $title; ?></h2>
        </header>

        <?php if (  $shortcuts_infos !== null && $shortcuts_infos !== '' ) : ?>
            <div>
                <?= $shortcuts_infos; ?>
            </div>


        <?php else : ?>

            <nav class="">
                <ul class="">

                    <?php foreach ($shortcuts_links as $value) : ?>
                        <li>
                            <a class="FS14" href="<?= $value->guid; ?>"><?= $value->post_title; ?></a>
                            <hr>
                        </li>
                    <?php endforeach; ?>
                    <hr class="last">

                </ul>
            </nav>
        <?php endif; ?>

    </aside>

<?php endif; ?>