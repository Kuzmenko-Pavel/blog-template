<?php get_header(); ?>
    <section class="section-main">
        <div class="container">
            <main class="main">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( '/includes/front/short_article'); ?>
				<?php endwhile; ?>
					<?php get_template_part( '/includes/front/paging'); ?>
				<?php else: ?>
					<?php get_template_part( '/includes/front/not-found'); ?>
				<?php endif; ?>
            </main>
            <aside class="sidebar">
				<?php get_sidebar(); ?>
            </aside>
        </div>
    </section>
<?php get_footer(); ?>