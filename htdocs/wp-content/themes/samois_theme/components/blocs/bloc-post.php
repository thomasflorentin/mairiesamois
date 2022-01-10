<div class="bloc">

    <a href="<?php the_permalink(); ?>">

        <?php if (has_post_thumbnail()) : ?>
            <figure class="">
                <?php the_post_thumbnail(); ?>
            </figure>
        <?php endif; ?>

        <?php //the_category(); ?>

        <h3 class="h3"><?php the_title(); ?></h3>
        <div><?php the_excerpt(); ?></div>


    </a>

</div>