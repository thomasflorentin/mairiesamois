

    <nav class="page_navigation" style="font-size: 3rem;>
        <div class="">
             <?php 
                
                next_posts_link( '<<- ', $query->max_num_pages );
                previous_posts_link( '->>' ); 
                
                ?>
        </div>
    </nav>