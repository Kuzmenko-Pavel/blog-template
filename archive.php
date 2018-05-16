<?php get_header(); ?>
    <div class="container">
        <div class="static-header">
            <div><?php single_term_title(); echo term_description('raw'); ?></div>
        </div>
    </div>
    <section class="section-main">
        <div class="container">
            <main class="main">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( '/includes/front/short_article'); ?>
				<?php endwhile; ?>
				<?php endif; ?>
				<?php get_template_part( '/includes/front/paging'); ?>
            </main>
            <aside class="sidebar">
				<?php get_sidebar(); ?>
            </aside>
        </div>
    </section>
<?php get_footer(); ?>