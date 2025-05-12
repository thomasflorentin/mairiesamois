<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package samois
 */
$useful_links = get_field('util_link', 'options')
?>


        </main>


        <footer id="colophon" class="site-footer wrapper ">

            <div class="section-search pb-medium">
                <h3 class="FS16_B">Vous n'avez pas trouvé l'information recherchée ?</h3>
                <div class="search-container fl-hcentered grid">
                    <div class="s_7col m_6col">
                        <?php get_search_form(); ?>
                    </div>
                    
                    <nav class="s_5col m_6col search-link FS14">
                        <ul class=" fl-col">
                            <li><a href="/contact-en-ligne" class="p1 btn_inline">Posez vos questions en ligne</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="news-infos grid">

                <div class="s_12col m_5col">
                    
                    <div class="mb-medium">
                        <h3 class="FS16_B">Restez toujours informé !</h3>
                        <?php get_template_part('components/modules/module', 'newsletter'); ?>

                    </div>

                    <div class="social-qrcode fl-justify pb-medium">
                        <div class="social p2">
                            <a href="<?= the_field('facebook_link', 'options') ?>" target="_blank" title="Aller sur la page Facebook de la Mairie de Samois sur Seine"><i class="fab fa-facebook-square"></i></a>
                            <a href="mailto:<?= get_field('mail', 'option');?>" title="Envoyer un mail à la Mairie de Samois sur Seine"><i class="fas fa-envelope"></i></a>
                            <a href="<?= get_field('whatsapp_url', 'option');?>" target="_blank"  title="Rejoindre la chaîne WhatsApp de la commune de Samois sur Seine">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/whatsapp.png" alt="">
                            </a>
                        </div>
                        <img src="<?= the_field('qrcode_notif', 'options') ?>" alt="Qr Code du site de la Mairie de Samois sur Seine">
                    </div>

                </div>


                <div class="s_12col m_7col">

                    <div class="mb-medium">
                        <h3 class="FS16_B">Numéros indispensables</h3>
                        <div class="number-phone flex FS14">
                            <div class="number-doc">
                                <?php echo wp_kses_post( get_field('number_indispensable', 'options') ) ?>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="notification-footer pb-medium">
                        <h3 class="FS16_B">Activer les notifications sur votre mobile </h3>
                        <ul class="FS14">
                            <li>1. Scanner ce QR code avec votre mobile</li>
                            <li>2. Une alerte vous demander d'activer les notifications.</li>
                            <li>3. Cliquez sur "J'accepte".</li>
                            <li>4. Recevez automatiquement actualités et événements !</li>
                        </ul>
                    </div>-->

                </div>
            </div>



            <div class="adresse-hourly-link grid">

                <div class="hourly-adress s_12col m_5col">
                    <h3 class="FS16_B"><?php the_field('structur_name', 'options') ?></h3>
                    <p class="FS14 mb-small"><?php echo wp_kses_post( get_field('hour_opening', 'options') ) ?></p>
                    <p class="FS14 mb-none"><?php the_field('structure_adress', 'options') ?></p>
                    <p class="FS14 mb-small"><?php the_field('mail', 'options') ?></p>

                    <p class="FS14 mb-none">Téléphone : <?php the_field('Phone', 'options') ?></p>
                    <p class="FS14">Télécopie : <?php the_field('telecopie', 'options') ?></p>
                </div>

                <div class="footer_links s_12col m_5col">
                    <div class="fl-col fl-justify">

                        <nav class="usefull-link fl-col FS14 mb-medium">
                            <h3 class="FS14">Liens utiles</h3>
                            <?php foreach ($useful_links as $val) : ?>
                                <a href="<?= $val->guid ?>" class="btn_inline">
                                    <?= $val->post_title ?>
                                </a>
                            <?php endforeach; ?>
                        </nav>

                        <nav class="">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location'    => 'footer',
                                    'items_wrap'     => '<ul class="end-link flex">%3$s</ul>'
                                )
                            );
                            ?>
                        </nav>

                    </div>
                </div>


                <div class="logo-footer s_2col m_2col">
                    <figure>
                        <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php the_field('logo_footer', 'options') ?>" alt="Blason de la Mairie de Samois sur Seine"></a>
                    </figure>
                </div>

            </div>

        </footer>


        <?php 
            $alert_post = get_field('alert', 'option');
        ?>

        <nav id="footer_menu" class="footer_menu l_hide">
            <ul class="fl-centered fl-hcentered">
                
                <?= (INSTAGRAM_LINK) ? "<li><a target=\"_blank\" href=\"". INSTAGRAM_LINK . "\"><i class=\"fab fa-instagram-square\"></i></a></li>" : "" ?>
                
                <?= (FACEBOOK_LINK) ? "<li><a target=\"_blank\" href=\"". FACEBOOK_LINK . "\"><i class=\"fab fa-facebook-square\"></i></a></li>" : "" ?>

                <?= ($alert_post) ? '<li><a href="' . $alert_post->guid . '" class="footer_alert">[ALERTE]</a></li>' : '' ?>

                <li>
                    <a href="#" id="js-shortcutsBtn">Prenez un raccourci</a>
                </li>
            </ul>
        </nav>

    </div><!-- #page -->

    
</body>
</html>