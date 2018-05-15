<ul>
<?php
if (is_single() && is_active_sidebar('sidebar-blog-post')) :
    dynamic_sidebar('sidebar-blog-post');
elseif (is_search() && is_active_sidebar('sidebar-search')) :
	dynamic_sidebar('sidebar-search');
elseif (is_page() && is_active_sidebar('sidebar-pages')) :
    dynamic_sidebar('sidebar-pages');
else :
	the_widget( 'WP_Widget_Recent_Posts', 'title=Популярные записи&number=10' );
	the_widget( 'WP_Widget_Tag_Cloud', 'title=Теги' );
endif; ?>
</ul>