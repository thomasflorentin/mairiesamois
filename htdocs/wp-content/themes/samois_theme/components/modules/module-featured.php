<?php
$title = $args['title'];
$content = $args['content'];
$link = $args['link'];
?>

<section class="mod_featured mb-big">
    <h2 class="mod_title FS42_B"><?php echo $title; ?></h2>

    <div class="grid">
        <div class="mod_content FS14 m_9col">
            <?= $content; ?>
        </div>

    </div>
    <?php if (!empty($link)) : ?>
        <a href="<?= $link['url'] ?>">En savoir plus</a>
    <?php endif; ?>
</section>