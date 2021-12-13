<?php
$title = $args['title'];
$content = $args['content'];
$link = $args['link'];
?>

<section class="mod_featured">

    <h2 class="mod_title"><?php echo $title; ?></h2>

    <div class="mod_content"><?php echo $content; ?></div>

    <?php if (!empty($link)) : ?>
        <a href="<?= $link['url'] ?>">En savoir plus</a>
    <?php endif; ?>
</section>