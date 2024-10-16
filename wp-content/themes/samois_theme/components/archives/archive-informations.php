<?php
/* 
    Archives des pages pages informations
    Càd NIveau 1 type "Services et Démarches" ou "Mairie"
    */
?>


<div>

    <header class="mb-medium grid">
        <div class="s_12col m_9col">
            <h1 class="FS42_B"><?= the_title() ?></h1>
            <div class="FS14"><?= the_excerpt() ?></div>
        </div>
    </header>



    <section class="module mb-big">
        <?php 
            set_query_var('before', true);
            get_template_part('components/content', 'flexible'); ?>
    </section>



    <section class="module mb-big">

        <?php if( get_field("module_title") !== "" ) { 
            echo '<header class="mb-small"><h2 class="FS42_BC ">'. get_field("module_title") . '</h2></header>';
        } ?>

        <div class="grid">

            <?php
            foreach ($page_children as $child) {
                set_query_var('parent_id', $child->ID);
                get_template_part('components/modules/module', 'informations');
            }
            ?>

        </div>
    </section>



    <section class="module mb-big">
        <?php 
                set_query_var('before', false);
                get_template_part('components/content', 'flexible'); ?>
    </section>

</div>