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

$shortcuts_links = get_field('shortcuts_links');
$shortcuts_args = array(
    'title' => 'Pour aller plus vite !',
);
set_query_var('links', $shortcuts_links);
get_template_part('components/shortcuts', '', $shortcuts_args); ?>


<h1 class="FS42_B"><?= the_title() ?></h1>
<div class="grid mb-medium">
    <div class="m_9col">
        <p class="FS14"><?= get_the_excerpt() ?></p>
    </div>
</div>
<ul class="agenda-list">
    <?php
    $current_header = '';

    foreach ($query as $post) : setup_postdata($post);

        $date = get_field('date', false, false);
        $temp_header = date_i18n('F Y', strtotime($date));

        if ($temp_header != $current_header) {
            $current_header = $temp_header;
            echo "<h3 class='agenda-month FS24_B txt-capitalize mb-vsmall'>" . $current_header . '</h3>';
        } ?>

        <li class="list-bbot">
            <a class="grid p-small" href="<?= the_permalink() ?>">
                <p class="m_3col txt-capitalize FS14 mb-none"><?= get_field('date') ?></p>
                <p class="m_4col mb-none FS16_B"><?= the_title() ?></p>
                <p class="m_4col mb-none FS14"><?= get_field('location') ?></p>
                <div class="arrow m_1col mb-none txt-right"></div>
            </a>
        </li>




    <?php endforeach;
    wp_reset_postdata();

    ?>
</ul>


<?php
get_footer();
