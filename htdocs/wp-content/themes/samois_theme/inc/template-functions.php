<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package samois
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function samois_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'samois_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function samois_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'samois_pingback_header');




function has_children($id = '')
{

    if ($id === '') {
        global $post;
        $id = $post->ID;
    }

    $pages = get_pages(
        array(
            'post_type'    => array('page', 'information', 'post', 'event'),
            'child_of'    => $id
        )
    );

    if (is_array($pages)) {
        return count($pages);
    } else {
        return 0;
    }
}

function is_top_level($id = '')
{
    global $wpdb;

    if ($id === '') {
        global $post;
        $id = $post->ID;
    }

    $current_page = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE ID = " . $id);

    return $current_page;
}



/*
 * Add ACCORDEON Shortcode
 */

function accordeon_shortcode($atts, $content = null)
{

    // Attributes
    $atts = shortcode_atts(
        array(
            'titre' => 'Le titre de l\'accordéon ici',
        ),
        $atts
    );
    $titre = $atts['titre'];
    $result = wpautop(trim($content));

    $return_string = '<div class="js_dropdown accordeon_item">';

    $return_string .= '<a href="#" class="js_dropd_link "><h3 class="btn-inline accordeon_title fl-justify">' . $titre . '<i class="fas fa-arrow-right"></i></h3></a>';

    $return_string .= '<div class="js_dropd_content accordeon_content">';
    $return_string .= $result;
    $return_string .= '</div>';

    $return_string .= '</div>';

    return $return_string;
}
add_shortcode('accordeon', 'accordeon_shortcode');
