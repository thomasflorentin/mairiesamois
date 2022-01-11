<aside id="shortcuts" class="shortcuts txt-centered">

    <h2 class="FS16_B"><?php echo $args['title']; ?></h2>
<?php //var_dump($args['list']) ?>
    <nav class="">
        <ul class="">
            <?php foreach( $args['list'] as $value ) : ?>
                <li><a class="FS14_B" href=""><?php echo $value->post_title; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>

</aside>