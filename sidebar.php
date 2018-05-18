<ul>
	<?php
	if ( is_single() && is_active_sidebar( 'sidebar-blog-post' ) ) :
		dynamic_sidebar( 'sidebar-blog-post' );
    elseif ( is_home() && is_active_sidebar( 'sidebar-home' ) ) :
		dynamic_sidebar( 'sidebar-home' );
    elseif ( is_search() && is_active_sidebar( 'sidebar-search' ) ) :
		dynamic_sidebar( 'sidebar-search' );
    elseif ( is_page() && is_active_sidebar( 'sidebar-pages' ) ) :
		dynamic_sidebar( 'sidebar-pages' );
    elseif ( is_404() && is_active_sidebar( 'sidebar-not-found' ) ) :
		dynamic_sidebar( 'sidebar-not-found' );
	else :
		$args = array(
			'before_widget' => '<li class="widget %s">',
			'after_widget'  => "</li>",
        );
		the_widget( 'WP_Widget_Recent_Posts', 'title=Популярные записи&number=10', $args);
		the_widget( 'WP_Widget_Tag_Cloud', 'title=Теги', $args);
	endif; ?>
</ul>