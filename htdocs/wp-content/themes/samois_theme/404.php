<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package samois
 */

get_header();

get_template_part('components/shortcuts');

?>


    <section class="error-404 not-found">

        <header class="page-header">
            <div class="grid">
                <div class="s-12col m_7col col_start_2">
                    <h1 class="h1"><?php esc_html_e('Désolé, nous ne trouvons pas le contenu recherché...', 'samois'); ?></h1>
                </div>
            </div>
        </header><!-- .page-header -->

    </section><!-- .error-404 -->



<?php
get_footer();
