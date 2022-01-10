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


        <footer id="colophon" class="site-footer wrapper">

            <div class="section-search">
                <h3 class="h3">Vous n'avez pas trouvé l'information recherchée ?</h3>
                <div class="search-container fl-hcentered grid">
                    <div class="m_6col">
                        <?php get_search_form(); ?>
                    </div>
                    
                    <nav class="m_6col search-link">
                        <ul class=" fl-col">
                            <li><a href="" class="p1 btn_inline">Posez vos questions en ligne</a></li>
                            <li><a href="" class="p1 btn_inline">Questions fréquement posées</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="news-infos grid">

                <div class="m_5col">
                    
                    <div class="mb-medium">
                        <h3 class="h3">Restez toujours informé.e !</h3>
                        <p class="mb-small">Recevez notre Newsletter</p>
                        <form class="form-newsletter field_default" method="get" action="">
                            <input type="text" class="search-field" name="s" placeholder="Recherher">
                            <button type="submit"><i class="fas fa-arrow-right"></i></button>
                        </form>
                    </div>

                    <div class="social-qrcode fl-justify">
                        <div class="social p2">
                            <a href="<?= the_field('facebook_link', 'options') ?>"><i class="fab fa-facebook-square"></i></a>
                            <a href="<?= the_field('instagram_url', 'options') ?>"><i class="fab fa-instagram"></i></a>
                        </div>
                        <img src="<?= the_field('qrcode_notif', 'options') ?>" alt="">
                    </div>

                </div>


                <div class="m_7col">

                    <div class="mb-small">
                        <h3 class="h3">Numéros indispensables</h3>
                        <div class="number-phone flex p1">
                            <div class="number-rescue">
                                <p>Police > 17</p>
                                <p>Pompier > 18</p>
                                <p>Samu > 15</p>
                            </div>
                            <div class="number-doc">
                                <?php the_field('number_indispensable', 'options') ?>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="h3">Activer les notifications sur votre mobile </h3>
                        <ul class="">
                            <li>1. Scanner ce QR code avec votre mobile</li>
                            <li>2. Une alerte vous demander d'activer les notifications.</li>
                            <li>3. Cliquez sur "J'accepte".</li>
                            <li>4. Recevez automatiquement actualités et événements !</li>
                        </ul>
                    </div>

                </div>
            </div>



            <div class="adresse-hourly-link grid">

                <div class="hourly-adress m_5col">
                    <h3 class="h3"><?php the_field('structur_name', 'options') ?></h3>
                    <p><?php the_field('hour_opening', 'options') ?></p>
                    <p><?php the_field('structure_adress', 'options') ?></p>
                    <p><?php the_field('mail', 'options') ?></p>

                    <p>Std : <?php the_field('Phone', 'options') ?></p>
                    <p>Télécopie : <?php the_field('telecopie', 'options') ?></p>
                </div>

                <div class="footer_links m_5col">
                    <div class="fl-col fl-justify">

                        <nav class="usefull-link fl-col">
                            <h3 class="h3">Liens utiles</h3>
                            <?php foreach ($useful_links as $val) : ?>
                                <a href="<?= $val->guid ?>" class="btn_inline">
                                    <?= $val->post_title ?>
                                </a>
                            <?php endforeach; ?>
                        </nav>

                        <nav class="end-link flex">
                            <a href="" class="btn_inline">Mentions légales</a>
                            <a href="" class="btn_inline">Cookie</a>
                            <a href="" class="btn_inline">Plan du site</a>
                        </nav>

                    </div>
                </div>


                <div class="logo-footer m_2col">
                    <figure>
                        <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php the_field('logo_footer', 'options') ?>" alt=""></a>
                    </figure>
                </div>

            </div>

        </footer>

    </div><!-- #page -->

</body>
</html>