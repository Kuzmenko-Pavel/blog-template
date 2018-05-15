<ul>
<?php
if (is_page() && is_active_sidebar('sidebar-pages')) :
    dynamic_sidebar('sidebar-pages');
elseif (is_active_sidebar('sidebar-blog')) :
    dynamic_sidebar('sidebar-blog');
else :
	the_widget('WP_Widget_Pages', 'title=Contents&sortby=post_modified', 'before_title=<h3>&after_title=</h3>');
endif; ?>
</ul>