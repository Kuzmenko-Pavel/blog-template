<ul>
<?php
if (is_page() && is_active_sidebar('sidebar-pages')) :
    dynamic_sidebar('sidebar-pages');
elseif (is_active_sidebar('sidebar-blog')) :
    dynamic_sidebar('sidebar-blog');
else :
    dynamic_sidebar('sidebar-other');
endif; ?>
</ul>