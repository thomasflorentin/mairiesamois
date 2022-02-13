<aside id="structure-infos" class="structure-infos">

    <div>

        <h3 class="h3">Mairie de Samois</h3>
        
        <p class="FS14"><?php the_field('structure_adress', 'options') ?></p>

        <p class="FS14">Horaires d'ouverture au public <br>
            Lundi > Samedi de 8h30 à 16h30</p>

        <p class="mb-none FS14"> Courriel : <br> <?php the_field('mail', 'options') ?></p>
        <p class="mb-none FS14">Téléphone : <?php the_field('Phone', 'options') ?></p>
        <p class="FS14">Télécopie : <?php the_field('telecopie', 'options') ?></p>

        <p class="FS14">
            <a href="/contact" class="btn_inline mb-medium">Tous les services et contacts de la mairie</a>
        </p>
    
        <p class="mb-vsmall FS14">Newsletter :</p>
        
        <form class="form-newsletter field_default" method="get" action="">
            <input type="text" class="search-field FS14" name="s" placeholder="Votre email">
            <button type="submit"><i class="fas fa-arrow-right"></i></button>
        </form>
    
    </div>

</aside>