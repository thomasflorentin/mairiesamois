<?php

/**
 * samois functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package samois
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

if (!function_exists('samois_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function samois_setup()
    {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on samois, use a find and replace
		 * to change 'samois' to the name of your theme in all the template files.
		 */
        load_theme_textdomain('samois', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'primary-menu' => esc_html__('Menu primaire', 'samois'),
                'primany-dropdown-men' => esc_html__('Menu Thématiques', 'samois'),
                'footer' => esc_html__('Menu Footer', 'samois')
            )
        );
        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'samois_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action('after_setup_theme', 'samois_setup');



/**
 * Never worry about cache again!
 */
function my_load_scripts($hook)
{

    // create my own version codes
    // $my_js_ver  = date("ymd-Gis", filemtime( get_template_directory_uri() . '/assets/main.min.js' ) );
    // $my_css_ver = date("ymd-Gis", filemtime( get_template_directory_uri() . '/assets/styles.css' ) );
    $my_js_ver  = '220118';
    $my_css_ver = '220118';
    // 
    wp_enqueue_script('my_js', get_template_directory_uri() . '/assets/main.min.js', array('masonry'), $my_js_ver);
    wp_enqueue_script('tinyslide', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js', array(), '');
    wp_enqueue_script('masonry', get_template_directory_uri() . '/assets/lib/masonry.js', array('jquery'), $my_js_ver, true);

    wp_register_style('my_css', get_template_directory_uri() . '/assets/styles.css', false,   $my_css_ver);
    wp_enqueue_style('my_css');
}
add_action('wp_enqueue_scripts', 'my_load_scripts');


/* 
 * CSS ADMIN
 *************************/

function admin_style() {
	wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

function add_taxonomies_to_pages()
{
    register_taxonomy_for_object_type('post_tag', 'page');
    register_taxonomy_for_object_type('category', 'page');
}
add_action('init', 'add_taxonomies_to_pages');

add_post_type_support('page', 'excerpt');

function my_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'my_mime_types');


remove_filter('get_the_excerpt', 'wp_trim_excerpt');



/*
 * Pre get post sur résultats de recherche
 */

function loops_filters($query) {
    if (!is_admin() && $query->is_main_query()) {

        
        if ( $query->is_search()) {
            $taxquery = array(
                'taxonomy' => 'post_tag',
                'field'    => 'slug',
                'terms'    => 'noindex',
                'operator' => 'NOT IN',
            );
    
            $query->set('tax_query', array($taxquery));
        }

        
        if ( is_category() ) {
			$query->set( 'posts_per_page', 24 );
            $query->set( 'post_type', array('post', 'page', 'event', 'information') );
            $query->set( 'orderby', 'date' );
            $query->set( 'order', 'DESC');
		}

    }
}
add_action('pre_get_posts', 'loops_filters');


