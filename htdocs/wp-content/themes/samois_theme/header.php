<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package samois
 */
define("FACEBOOK_LINK", get_field('facebook_link', 'option'));
define("INSTAGRAM_LINK", get_field('instagram_link', 'option'));
$website_logo = get_field('website_logo', 'option');
$header_banner = get_field('banner', 'option');
$alert_post = get_field('alert', 'option');
$mail = get_field('mail', 'option');
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css" rel="stylesheet">
    <?php wp_head(); ?>

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/libs/tarteaucitron/tarteaucitron.js"></script>

<script type="text/javascript">
tarteaucitron.init({
  "privacyUrl": "", /* Privacy policy url */
  "bodyPosition": "bottom", /* or top to bring it as first element for accessibility */

  "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
  "cookieName": "tarteaucitron", /* Cookie name */

  "orientation": "bottom", /* Banner position (top - bottom) */

  "groupServices": false, /* Group services by category */
                   
  "showAlertSmall": false, /* Show the small banner on bottom right */
  "cookieslist": false, /* Show the cookie list */
                   
  "closePopup": false, /* Show a close X on the banner */

  "showIcon": true, /* Show cookie icon to manage cookies */
  //"iconSrc": "", /* Optionnal: URL or base64 encoded image */
  "iconPosition": "BottomRight", /* BottomRight, BottomLeft, TopRight and TopLeft */

  "adblocker": false, /* Show a Warning if an adblocker is detected */
                   
  "DenyAllCta" : true, /* Show the deny all button */
  "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
  "highPrivacy": true, /* HIGHLY RECOMMANDED Disable auto consent */
                   
  "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */

  "removeCredit": false, /* Remove credit link */
  "moreInfoLink": true, /* Show more info link */

  "useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */
  "useExternalJs": false, /* If false, the tarteaucitron.js file will be loaded */

  //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */
                  
  "readmoreLink": "", /* Change the default readmore link */

  "mandatory": true, /* Show a message about mandatory cookies */
  "mandatoryCta": true /* Show the disabled accept button when mandatory on */
});
tarteaucitron.user.googletagmanagerId = 'GTM-XXXX';
(tarteaucitron.job = tarteaucitron.job || []).push('googletagmanager');
(tarteaucitron.job = tarteaucitron.job || []).push('youtube');
</script>


</head>
<?php
if (is_admin_bar_showing()) : ?>

    <style>
        .header-container {
            top: 32px;
        }
    </style>

<?php endif; ?>


?>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'samois'); ?></a>


        <header id="masthead" class="header-container">

            <div class="header_inner">

                <div class="header-branding">
                    <figure class="fl-vcentered">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="fl-vcentered">
                            <img src="<?= $website_logo ?>" alt="" class="site_logo">
                        </a>
                    </figure>
                </div><!-- #site-logo -->


                <div class="s_hide m_show">
                    <div class="header-alert fl-end fl-hcentered">
                        <?= ($alert_post) ? "<div class='alert-container field_alert'><a href='$alert_post->guid'>[ALERTE] $alert_post->post_title</a><i class='fas fa-arrow-right'></i></div>" : "" ?>
                    </div><!-- #site-alert -->
                </div>


                <?php if (is_front_page() && $header_banner) : ?>

                    <div class="header-banner">
                        <figure>
                            <img src="<?= $header_banner ?>" alt="">
                        </figure>
                    </div>

                <?php endif; ?>



                <div class="nav-container">

                    <div class="nav-upper">
                        <ul class="flex">
                            <li>
                                <a href="#" id="js-toggleSearchbar" role="button">
                                    <i class="fas fa-search"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" id="js-toggleDropdown" role="button" class="fl-centered js-toggleDropdown">
                                    <i class="fas fa-bars js-toggleDropdown"></i>
                                    <span class="s_hide m_show js-toggleDropdown"><?php print('Thématiques'); ?></span>
                                </a>
                            </li>
                        </ul>
                        
                    </div>


                    <nav id="header-navigation" class="navigation-links">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'    => 'primary-menu',
                                'menu_class'        => 'flex'
                            )
                        );
                        ?>
                    </nav><!-- #site-navigation -->



                    <div class="header-link s_hide l_show">
                        <?= ($mail) ? "<a href=\"mailto: $mail\"><i class=\"fas fa-envelope\"></i></a>" : "" ?>
                        <?= (FACEBOOK_LINK) ? "<a target=\"_blank\" href=\"". FACEBOOK_LINK . "\"><i class=\"fab fa-facebook-square\"></i></a>" : "" ?>
                    </div><!-- #site-link-contact -->

                </div><!-- .nav-container -->

            </div>


            <nav id="nav_thematiques" class="nav_thematiques">
                <div class="">
                    <?php 
                        wp_nav_menu(
                            array(
                                'theme_location'    => 'primany-dropdown-men',
                                'menu_class'        => 'fl-justify'
                            )
                        );
                    ?>
                </div>
            </nav>

            <nav id="searchbar_wrapper" class="searchbar_wrapper">
                <?php get_search_form(); ?>

                <div class="m_hide">
                    <?php get_template_part('components/modules/module', 'horaires'); ?>
                </div>
            </nav>
           

        </header><!-- #masthead -->

        

        <main id="primary" class="site-main wrapper">