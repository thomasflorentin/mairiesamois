

    <nav class="page_navigation" style="font-size: 2rem;">
        <div class="" style="display: flex; justify-content: space-between;">
             <?php 
                
                next_posts_link( '<- Pages précédentes ', $query->max_num_pages );
                previous_posts_link( ' Pages suivantes ->' ); 
                
                ?>
        </div>
    </nav>