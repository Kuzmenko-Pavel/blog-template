<?php get_header(); ?>
    <section class="section-main">
        <div class="container">
	        <?php if ( have_posts() ) :?>
            <main class="main">
                <div class="term">
                    <div class="term-archive"><?php single_term_title(); echo term_description(); ?></div>
                </div>
		        <?php get_template_part( '/includes/front/short_article'); ?>
            </main>
	        <?php else: ?>
            <main class="main">
                    <div class="term">
                        <div><?php single_term_title(); echo term_description(); ?></div>
                    </div>
                <article class="article">
			        <?php get_template_part( '/includes/front/not-found'); ?>
                </article>
            </main>
	        <?php endif; ?>
            <aside class="sidebar">
				<?php get_sidebar(); ?>
            </aside>
        </div>
    </section>
<?php get_footer(); ?>