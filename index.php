<?php get_header(); ?>
    <section class="section-main">
        <div class="container">
	        <?php if ( have_posts() ) :?>
		        <?php get_template_part( '/includes/front/short_article'); ?>
	        <?php else: ?>
		        <?php get_template_part( '/includes/front/not-found'); ?>
	        <?php endif; ?>
            <aside class="sidebar">
				<?php get_sidebar(); ?>
            </aside>
        </div>
    </section>
<?php get_footer(); ?>