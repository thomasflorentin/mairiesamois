


<div class="">

    <?php
    $featured_posts = get_field('featured_posts');
    $i = 1;
    if( $featured_posts ): ?>
        <ul>
        <?php foreach( $featured_posts as $post ): 

            setup_postdata($post); ?>
            
                <div class="<?php echo $i === 3 ? 'col2' : 'col1' ?>">
                    <?php get_template_part('components/blocs/bloc', 'post'); ?> 
                </div>

                <?php $i++; ?>
        <?php endforeach; ?>
        </ul>
        
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>



</div>