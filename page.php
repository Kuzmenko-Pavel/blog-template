<?php get_header(); ?>
    <section class="section-main">
        <div class="container">
            <article class="article">
				<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>
					<?php setPostViews( get_the_ID() ); ?>

                    <main class="article__content">
						<?php the_content(); ?>
                    </main>
                    <footer class="article__footer">
	                    <?php get_template_part( '/includes/front/social_share_down'); ?>
                    </footer>
                    <section class="article__misc">
						<?php get_template_part( '/includes/front/related_page'); ?>
						<?php get_template_part('/includes/front/comments'); ?>
                    </section>
				<?php endwhile; endif; ?>
            </article>
            <aside class="sidebar">
				<?php get_sidebar(); ?>
            </aside>
        </div>
    </section>
<?php get_footer(); ?>