

<div class="breadcrumb">

    <ul class="flex">
    
        <?php // Breadcrumb navigation

                
            $html = '<li><a title="Accueil - ' . get_bloginfo("name") . '" rel="nofollow" href="' . get_bloginfo("url") . '">Accueil</a>&nbsp;>&nbsp;</li>';


                // SI PAGE EVENEMENTS
                if( 'event' == get_post_type()  ) {
                    $html .= '<li><a href="/agenda">Agenda</a>&nbsp;>&nbsp;</li>';
                }

                // SI PAGE ACTUALITES
                else if ( 'post' == get_post_type() ) {
                    $html .= '<li><a href="/actualites">Actualités</a>&nbsp;>&nbsp;</li>';
                }

                // SI PAGE INFORMATIONS
                else if( 'information' == get_post_type() ) {
                    $ancestors = get_post_ancestors($post);

                    if ($ancestors) {
                        $ancestors = array_reverse($ancestors);

                        foreach ($ancestors as $crumb) {

                            if( get_top_level_page($crumb) > 0 ) {
                                $html .= '<li class="' . $crumb . '">' . get_the_title($crumb) . '&nbsp;>&nbsp;</li>';
                            }
                            else {
                                $html .= '<li class="' . $crumb . '"><a href="' . get_permalink($crumb) . '">' . get_the_title($crumb) . '</a>&nbsp;>&nbsp;</li>';
                            }

                        }
                    }
                }

                // AFFICHER LE TITRE DE LA PAGE
                $html .= '<li>' . get_the_title() . '</li>';
                
                // AFFICHE LE FIL
                echo $html; 
                        
        ?>
        
    </ul>
</div>