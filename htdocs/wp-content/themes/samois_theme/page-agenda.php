<?php

/**
 * Template Name: Page Agenda
 * 
 * Template Post Type: page
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package samois
 */

get_header();

$args = array(
    'post_type' => 'event',
    'meta_key' => 'date',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
);
$query = get_posts($args);

?>


    <?php
    ?>

    <h1><?= the_title() ?></h1>
    <p><?= the_excerpt() ?></p>
    <ul>
        <?php
        $current_header = '';

        foreach ($query as $post) : setup_postdata($post);

            $date = get_field('date', false, false);
            $temp_header = date_i18n('F Y', strtotime($date));

            if ($temp_header != $current_header) {
                $current_header = $temp_header;
                echo "<h3>" . $current_header . '</h3>';
            } ?>

            <li>
                <?= the_field('date') ?> - <a href="<?= the_permalink() ?>"><?= the_title() ?></a> - <?php the_field('location') ?> - <a href="<?= the_permalink() ?>">-></a>
            </li>




        <?php endforeach;
        wp_reset_postdata();

        ?>
    </ul>

    

<?php
get_footer();
