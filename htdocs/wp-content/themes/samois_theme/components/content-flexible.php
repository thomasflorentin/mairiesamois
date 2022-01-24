<?php


if (have_rows('flex-content')) :


    while (have_rows('flex-content')) : the_row();


        if (get_row_layout() == 'mod_featured') :
            $title = get_sub_field('mod_title');
            $content = get_sub_field('mod_content');
            $link = get_sub_field('mod_link');

            $args = array(
                'title'   => $title,
                'content'   => $content,
                'link'   => $link
            );

            get_template_part('components/modules/module', 'featured', $args);




        /*
         * BLOCS d'INFORMATIONS 
         * (cf. SERVICES ET DEMARCHES)
         */
        elseif (get_row_layout() == 'mod_grid_new') :

            $title = get_sub_field('mod_title');
            $list_posts = get_sub_field('mod_list_news');
            $design = get_sub_field('mod_design');
            $link = get_sub_field('mod_link');

            $args = array(
                'title'   => $title,
                'list_posts'   => $list_posts,
                'link'   => $link,
            );

            if( $design == 'focus' ) {
                get_template_part('components/modules/module', 'blocs-focus', $args);

            } else if( $design == 'events'  ) {
                get_template_part('components/modules/module', 'list-events', $args);
            }
            else if ( $design == 'news' ) {
                get_template_part('components/modules/module', 'list-news', $args);
            }
            else {

            }



        // 
        elseif (get_row_layout() == 'mod_list_event') :
            $title = get_sub_field('mod_title');
            $list_posts = get_sub_field('mod_list_events');

            $args = array(
                'title'   => $title,
                'list_posts'   => $list_posts,
            );

            get_template_part('components/modules/module', 'list-events', $args);


        /*
         * BLOCS d'INFORMATIONS 
         * (cf. SERVICES ET DEMARCHES)
         */
        elseif (get_row_layout() == 'mod_blocs_informations') :
            $parentId = get_sub_field('pages_information');
            echo '<div class="grid">';

            foreach ($parentId as $p) :
                    set_query_var( 'parent_id', $p->ID);
                    get_template_part('components/modules/module', 'informations');
            endforeach; 

            echo '</div>';


        endif;


    endwhile;

endif;
