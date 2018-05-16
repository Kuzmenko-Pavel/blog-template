<?php get_header(); ?>
    <div class="container">
        <div class="static-header">
            <div><?php single_term_title(); echo term_description(); ?></div>
        </div>
    </div>
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