<aside id="structure-infos" class="structure-infos">

    <div>

        <h3 class="h3"><?php the_field('structur_name', 'options') ?></h3>
        
        <p class="FS14"><?php the_field('structure_adress', 'options') ?></p>

        <?php the_field('hour_opening', 'options') ?></p>

        <p class="mb-none FS14"> Courriel : <br> <?php the_field('mail', 'options') ?></p>
        <p class="mb-none FS14">Téléphone : <?php the_field('Phone', 'options') ?></p>
        <p class="FS14">Télécopie : <?php the_field('telecopie', 'options') ?></p>

        <p class="FS14">
            <a href="/contact" class="btn_inline mb-medium">Tous les services et contacts de la mairie</a>
        </p>
    
        <?php get_template_part('components/modules/module', 'newsletter'); ?>
    
    </div>

</aside>