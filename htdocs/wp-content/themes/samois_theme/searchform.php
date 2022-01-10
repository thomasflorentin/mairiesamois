<form class="searchform fl-justify" method="get" action="<?= esc_url(home_url('/')); ?>">
    <input type="text" class="search-field" name="s" placeholder="Recherher" value="<?php echo get_search_query(); ?>">
    <button type="submit"><i class="fas fa-search"></i></button>
</form>