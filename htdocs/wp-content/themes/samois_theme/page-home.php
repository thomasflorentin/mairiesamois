<?php

/**
 * Template Name: Page Accueil 
 * 
 * Template Post Type: page
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package samois
 */

get_header();
$shortcuts_links = get_field('shortcuts_links');
?>

<?php
$args = array(
    'title' => 'Prenez un raccourci !',
    'list'  => $shortcuts_links
);

set_query_var('maList', $args);
get_template_part('components/shortcuts', '', $args); ?>

<aside id="structure-infos" class="structure-infos">

    <div class="grid">
        <div class="m_hide">
            <?php get_search_form(); ?>
        </div>
    </div>

    <div>

        <h3 class="h3">Mairie de Samois</h3>
        <p>Horaires d'ouverture au public <br>
            Lundi > Samedi de 8h30 à 16h30</p>
        <p><?php the_field('structure_adress', 'options') ?></p>
        <p> Courriel : <br> <?php the_field('mail', 'options') ?></p>

        <p>Std : <?php the_field('Phone', 'options') ?></p>
        <p>Télécopie : <?php the_field('telecopie', 'options') ?></p>

        <p class="btn_inline">tout les services et contacts de la mairie</p>

        <p class="mb-small">Newsletter</p>
        
        <form class="form-newsletter field_default" method="get" action="">
            <input type="text" class="search-field" name="s" placeholder="Votre email">
            <button type="submit"><i class="fas fa-arrow-right"></i></button>
        </form>
    
    </div>

</aside>

<?php while (have_posts()) : the_post();

    get_template_part('components/content', 'flexible');

endwhile; ?>



<?php
get_footer();
