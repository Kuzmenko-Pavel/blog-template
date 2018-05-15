<ul>
<?php
if (is_page() && is_active_sidebar('sidebar-pages')) :
    dynamic_sidebar('sidebar-pages');
elseif (is_active_sidebar('sidebar-blog')) :
    dynamic_sidebar('sidebar-blog');
else :
	the_widget( 'WP_Widget_Recent_Posts', 'title=_( \'Recent Comments\' )&number=10' );
endif; ?>
</ul>