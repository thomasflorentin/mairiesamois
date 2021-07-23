<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'samois' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'root' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '}Ha;&de-4)08Jg/^ZbbmjikOHYFt.4O{q]FM0vLAMo`|x&=H>}>s_hKs.Ao|<Mxc' );
define( 'SECURE_AUTH_KEY',  'ti]FR`OxpZ+,m7YMcyx4j5u,HHBBIb>k$vb-k`vO?>D/86Y$jC<r18qa7E7~<r0 ' );
define( 'LOGGED_IN_KEY',    'G[2wNCCFCQ$kN6WMlqe4=128fY-62f>P`b`_:zm8vidmMH2N1ktU^$GfXsy-rR<%' );
define( 'NONCE_KEY',        'g/y`(u0HC/A0KmD[o3g1 =M&kTFTO@cLFRsDc/f7>p`BxLd&.7)*/2mdJt`KQ&R:' );
define( 'AUTH_SALT',        'swKo$W%9`$N1%R@MNl@}g/mt2Ud6KsOW_Cbq~`o&,+tX7/v+z1t!yhz9sh)a+(6}' );
define( 'SECURE_AUTH_SALT', 'uMT+WZRs0Sq]x.sHNU5@FAVAGPi`wL6k.We=|>nRY 2X4y#PzGTG4nMUIvKj*`py' );
define( 'LOGGED_IN_SALT',   ',CKS;BcErb]!ykh2d2i!KX!oT_!xcl:eC]#gc-45H.-o|Tt1]|<#hEG,.fPTOU<Y' );
define( 'NONCE_SALT',       'Z=XA`uGfv3n7tbJgG[bbV/2ZK%(0&Bc+p-444t99O)M+~Yw/+1a8VlqOM[m7-&G|' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
