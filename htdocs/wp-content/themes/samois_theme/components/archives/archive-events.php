
    <?php get_template_part('components/shortcuts' ); ?>


    <header>
        <h1 class="FS42_B"><?= the_title() ?></h1>
        <div class="grid mb-big">
            <div class="s_12col m_9col">
                <p class="FS14"><?= get_the_excerpt() ?></p>
            </div>
        </div>
    </header>

        
    <ul class="agenda-list">
        
        <?php
        $current_header = '';
        setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
        $today = date('Ymd');

        $args = array(
            'post_type'         => 'event',
            'posts_per_page' 	=> '-1',
            'meta_key'          => 'date',
            'orderby'           => 'meta_value_num',
            'order'             => 'ASC',
            'meta_query'        => array(
                array(
                    'key'           => 'date',
                    'value'         => $today,
                    'compare'       => '>=',
                )
            )
        );
        $allevents = new WP_Query($args);
        $i = 0;

        if ( $allevents->have_posts() ) : 

            echo '<div class="agenda-groupe mb-big">';

            while ( $allevents->have_posts() ) : $allevents->the_post(); 

                $date = get_field('date', false, false);
                $temp_header = date_i18n('F Y', strtotime($date));

                if ($temp_header != $current_header) {
                    $current_header = $temp_header;
                    if( $i !== 0 ) {
                        echo '</div>';
                        echo '<div class="agenda-groupe mb-big">';
                    }
                    echo "<h3 class='agenda-month FS24_B txt-capitalize mb-vsmall'>" . $current_header . '</h3>';
                } ?>

                <?php get_template_part('components/blocs/bloc', 'event'); ?>

            <?php
                $i++; 
                endwhile; 
                echo '</div>'; 
                ?>
            


            <?php 
                set_query_var('posts', $allevents);
                get_template_part('components/modules/module', 'pagination'); ?>
                

        <?php endif;  wp_reset_postdata();  ?>
        
    </ul>