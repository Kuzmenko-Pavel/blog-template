<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text" for="s">
    <button type="submit" class="search-submit"><i class="material-icons">&#xE8B6;</i></button>
    <input type="search" id="s" class="search-field" placeholder="Найти материалы"
           value="<?php echo get_search_query(); ?>" name="s"/>
    </label>

</form>
