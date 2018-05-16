<?php get_header(); ?>
    <section class="section-main">
        <div class="container">
	        <?php if ( have_posts() ) :?>
                <main class="main">
			        <?php get_template_part( '/includes/front/short_article'); ?>
                </main>
	        <?php else: ?>
                <article class="article">
			        <?php get_template_part( '/includes/front/not-found'); ?>
                </article>
	        <?php endif; ?>
            <aside class="sidebar">
				<?php get_sidebar(); ?>
            </aside>
        </div>
    </section>
<?php get_footer(); ?>