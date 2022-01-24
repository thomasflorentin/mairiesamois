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





        elseif (get_row_layout() == 'mod_grid_new') :
            $title = get_sub_field('mod_title');
            $list_news = get_sub_field('mod_list_news');

            $args = array(
                'title'   => $title,
                'list_news'   => $list_news,
            );

            get_template_part('components/modules/module', 'list-news', $args);




        // 
        elseif (get_row_layout() == 'mod_list_event') :
            $title = get_sub_field('mod_title');
            $list_events = get_sub_field('mod_list_events');

            $args = array(
                'title'   => $title,
                'list_events'   => $list_events,
            );

            get_template_part('components/modules/module', 'list-events', $args);


        // 
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
