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

<footer id="colophon" class="site-footer">
    <div class="section-search">
        <p>Vous n'avez pas trouvé l'information recherchée ?</p>
        <div class="search-container">
            <?php get_search_form(); ?>
            <div class="search-link">
                <p><a href="">> Posez vos questions en ligne</a></p>
                <p><a href="">> Questions fréquement posées</a></p>
            </div>
        </div>
    </div>
    <div class="news-infos">

        <div class="newsletter-form-container">
            <p>Restez toujours informé.e !</p>
            <label for="s">Recevez notre Newsletter</label>
            <form class="form-newsletter" method="get" action="">
                <input type="text" class="search-field" name="s" placeholder="Recherher">
                <button type="submit"><i class="fas fa-arrow-right"></i></button>
            </form>
            <div class="social-qrcode">
                <div class="social">
                    <a href="<?= the_field('facebook_link', 'options') ?>"><i class="fab fa-facebook-square"></i></a>
                    <a href="<?= the_field('instagram_url', 'options') ?>"><i class="fab fa-instagram"></i></a>
                </div>
                <img src="<?= the_field('qrcode_notif', 'options') ?>" alt="">
            </div>
        </div>

        <div class="number-section">
            <p>Numéros indispensables</p>
            <div class="number-phone">
                <div class="number-rescue">
                    <p>Police > 17</p>
                    <p>Pompier > 18</p>
                    <p>Samu > 15</p>
                </div>
                <div class="number-doc">
                    <?php the_field('number_indispensable', 'options') ?>
                </div>
            </div>
            <p>Activer les notifications sur votre mobile </p>
            <ul>
                <li>1. Scanner ce QR code avec votre mobile</li>
                <li>2. Une alerte vous demander d'activer les notifications.</li>
                <li>3. Cliquez sur "J'accepte".</li>
                <li>4. Recevez automatiquement actualités et événements !</li>
            </ul>
        </div>
    </div>
    <div class="adresse-hourly-link">
        <div class="hourly-adress">
            <h3><?php the_field('structur_name', 'options') ?></h3>
            <p><?php the_field('hour_opening', 'options') ?></p>
            <p><?php the_field('structure_adress', 'options') ?></p>
            <p><?php the_field('mail', 'options') ?></p>

            <p>Std : <?php the_field('Phone', 'options') ?></p>
            <p>Télécopie : <?php the_field('telecopie', 'options') ?></p>
        </div>
        <div class="link">
            <h3>Liens utiles</h3>
            <?php foreach ($useful_links as $val) :?>
                <a href="<?= $val->guid ?>"><p>> <?= $val->post_title ?></p></a>
            <?php endforeach; ?>
        </div>
        <div class="logo-footer">
            <figure>
                <img src="<?php the_field('logo_footer', 'options') ?>" alt="">
            </figure>
        </div>
    </div>
</footer>
</div>

</body>

</html>