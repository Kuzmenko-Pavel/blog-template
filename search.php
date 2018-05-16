<?php get_header(); ?>
    <section class="section-main">
        <div class="container">
				<?php if ( have_posts() ) :?>
                    <main class="main">
                        <div class="term">
                            <div class="term-search">Результаты поиска по запросу: " <?php the_search_query() ?> "</div>
                        </div>
						<?php get_template_part( '/includes/front/short_article'); ?>
                    </main>
				<?php else: ?>
                    <article class="article">
                        <div class="term">
                            <div class="term-search">Результаты поиска по запросу: " <?php the_search_query() ?> "</div>
                        </div>
					    <?php get_template_part( '/includes/front/not-found'); ?>
                    </article>
				<?php endif; ?>
            <aside class="sidebar">
				<?php get_sidebar(); ?>
            </aside>
        </div>
    </section>
<?php get_footer(); ?>