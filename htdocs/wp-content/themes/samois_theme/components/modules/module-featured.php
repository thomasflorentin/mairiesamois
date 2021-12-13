<?php
$title = $args['title'];
$imgs = $args['imgs'];
$content = $args['content'];
$flat_color = $args['flat_color'];
$link = $args['link'];



?>


<section class="mod_featured">


    <?php if ($imgs) : ?>
        <figure>
            <?php foreach ($imgs as $img) : ?>
                <img src="<?= $img['url'] ?>" alt="">
            <?php endforeach; ?>
        </figure>
    <?php endif; ?>

    <?php if ($flat_color) : ?>

        <div style="height: 150px;width: 200px;background-color:<?= $flat_color ?>;">

        </div>
    <?php endif; ?>




    <h2 class="mod_title"><?php echo $title; ?></h2>

    <div class="mod_content"><?php echo $content; ?></div>

    <?php if (!empty($link)) : ?>
        <a href="<?= $link['url'] ?>">En savoir plus</a>
    <?php endif; ?>
</section>