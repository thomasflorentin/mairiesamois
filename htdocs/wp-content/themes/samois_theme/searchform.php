<form class="searchform field_default" method="get" action="<?= esc_url(home_url('/')); ?>">
    <input type="text" class="search-field" name="s" placeholder="Rechercher" value="<?php echo get_search_query(); ?>">
    <button type="submit" value="rechercher sur le site"><i class="fas fa-search"></i></button>
</form>