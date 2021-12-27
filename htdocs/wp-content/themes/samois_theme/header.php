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
$website_logo = get_field('website_logo', 'option');
$header_banner = get_field('banner', 'option');
$alert_post = get_field('alert', 'option');
$facebook_link = get_field('facebook_link', 'option');
$mail = get_field('mail', 'option');
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_directory"); ?>/assets/main.css" />
    <?php wp_head(); ?>
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
            <div class="header-branding">
                <figure>
                    <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?= $website_logo ?>" alt=""></a>
                </figure>
            </div><!-- #site-logo -->


            <div class="header-alert">
                <?= ($alert_post) ? "<div class=\"alert-container\"><a href=\"$alert_post->guid\">[ALERTE] $alert_post->post_title</a><i class=\"fas fa-arrow-right\"></i></div>" : "" ?>

            </div><!-- #site-alert -->

            <?php if (is_front_page() && $header_banner) : ?>

                <style>
                    .site-main {
                        margin-top: 300px;
                    }
                </style>

                <div class="header-banner">
                    <figure>
                        <img src="<?= $header_banner ?>" alt="">
                    </figure>
                </div>

            <?php endif; ?>

            <div class="nav-links">
                <i class="fas fa-search"></i>
                <i class="fas fa-bars"></i>
                <nav id="header-navigation" class="navigation-links">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'samois'); ?></button>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary-menu'
                        )
                    );
                    ?>
                </nav><!-- #site-navigation -->
                <div class="header-link">
                    <?= ($mail) ? "<a target=\"_blank\" href=\"mailto: $mail\"><i class=\"fas fa-envelope\"></i></a>" : "" ?>
                    <?= ($facebook_link) ? "<a target=\"_blank\" href=\"$facebook_link\"><i class=\"fab fa-facebook-square\"></i></a>" : "" ?>
                </div><!-- #site-link-contact -->
            </div>


        </header><!-- #masthead -->