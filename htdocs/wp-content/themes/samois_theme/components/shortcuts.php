<?php 

$shortcuts_links = get_field('shortcuts_links');
$shortcuts_infos = get_field('infos_pratiques__liens');

if(  $shortcuts_infos !== '' && $shortcuts_infos !== null ) {
    $title = 'A savoir';
}
elseif( $shortcuts_links !== "" && $shortcuts_links !== null ) {
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

        <?php if ( $shortcuts_infos !== null && $shortcuts_infos !== '' ) : ?>
            <div>
                <?= $shortcuts_infos; ?>
            </div>



        <?php else : ?>

            <nav class="">
                <ul class="">

                <?php

                    if( $shortcuts_links ) : 
                        
                        foreach( $shortcuts_links as $link ) : 
                        $item = $link["shortcut_item"];
                        ?>
                            <li>
                                <a class="FS14" href="<?= $item['url']; ?>" target="<?= $item['target']; ?>"><?= $item['title']; ?></a>
                                <hr>
                            </li>

                        <?php endforeach;

                        
                    else : 

                        if( have_rows('shortcuts_links', get_option('page_on_front') ) ):

                            while( have_rows('shortcuts_links', get_option('page_on_front') ) ) : the_row(); 
                            $item = get_sub_field('shortcut_item'); ?>

                                <li>
                                    <a class="FS14" href="<?= $item['url']; ?>" target="<?= $item['target']; ?>"><?= $item['title']; ?></a>
                                    <hr>
                                </li>

                            <?php endwhile; ?>
                            <hr class="last">

                        <?php endif; ?>
                    <?php endif; ?>

                </ul>
            </nav>
        <?php endif; ?>

    </aside>

<?php endif; ?>