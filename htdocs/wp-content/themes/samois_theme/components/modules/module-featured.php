

<?php
    $title = $args['title']; 
    $content = $args['content']; 
    $link = $args['link']; 
?>


<section class="mod_featured">

    <h2 class="mod_title"><?php echo $title; ?></h2>
    
    <div class="mod_content"><?php echo $content; ?></div>

    <a href="<?php echo $link['url']; ?>">En savoir plus</a>

</section>