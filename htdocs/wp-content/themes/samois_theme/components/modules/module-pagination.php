

    <nav class="page_navigation">
        <div class="">
             <?php 
                
                if( isset($GLOBALS['wp_query']) ) {
                    $GLOBALS['wp_query']->max_num_pages = $posts->max_num_pages;
                }

                the_posts_pagination( array(
                   'mid_size' => 1,
                   'prev_text' => __( 'Articles plus récents', 'samois' ),
                   'next_text' => __( 'Articles plus anciens', 'samois' ),
                   'screen_reader_text' => __( 'Posts navigation' )
                ) ); ?>
        </div>
    </nav>