<?php



if( isset($before) && $before ) {
    $flex_content = 'flex-content-before';
}
else {
    $flex_content = 'flex-content';
}



if (have_rows( $flex_content )) :


    while (have_rows( $flex_content )) : the_row();

        /*
         * BLOCS de CONTENUS MIS EN AVANT 
         * (cf. Accueil)
         */
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
         * LISTE DE POSTS 
         * (actualités, événements, etc.)
         */
        elseif (get_row_layout() == 'mod_grid_new') :

            $title = get_sub_field('mod_title');
            $design = get_sub_field('mod_design');
            $link = get_sub_field('mod_link');
            $auto = get_sub_field('mod_auto');
            $postsperpage = get_sub_field('mod_postsperpage');
            $posttype = get_sub_field('mod_posttype');

            if( $auto ) {
                
                $q_args = array(
                    'posts_per_page'    => $postsperpage,
                    'post_type'         => $posttype,
                    'status'            => 'published',

                );

                if( $posttype === 'event' ) {
                    setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
                    $today = date('Ymd');

                    $q_args['meta_key'] = 'date';
                    $q_args['orderby'] = 'meta_value_num';
                    $q_args['order'] = 'ASC';
                    $q_args['meta_query'] = array(
                        'key'           => 'date',
                        'value'         => $today,
                        'compare'       => '>=',
                    );

                }
                else {
                    $q_args['orderby'] = 'date';
                    $q_args['order'] = 'DESC';
                }

                $list_posts = get_posts( $q_args );
            }
            else {
                $list_posts = get_sub_field('mod_list_news');
            }

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




        /*
         * BLOCS d'INFORMATIONS 
         * (cf. SERVICES ET DEMARCHES)
         */
        elseif (get_row_layout() == 'mod_blocs_informations') :
            $parentId = get_sub_field('pages_information');
            $title = get_sub_field('mod_title');

            echo '<section class="module mb-big">';

                if( $title !== '' ) {
                    echo '<header class="mb-small"><h2 class="FS52_B">'. $title . '</h2></header>';
                }

                echo '<div class="grid">';

                foreach ($parentId as $p) :
                        set_query_var( 'parent_id', $p->ID);
                        get_template_part('components/modules/module', 'informations');
                endforeach; 

                echo '</div>';
            echo '</section>';


        endif;


    endwhile;

endif;
