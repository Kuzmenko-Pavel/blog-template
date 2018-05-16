<?php get_header(); ?>
	<section class="section-main">
		<div class="container">
            <main class="main">
                <div class="term">
                    <div class="term-not-found">К сожалению, запрашиваемая Вами страница не найдена...</div>
                </div>
                <article class="article">
				    <?php get_template_part( '/includes/front/not-found'); ?>
                </article>
            </main>
			<aside class="sidebar">
				<?php get_sidebar(); ?>
			</aside>
		</div>
	</section>
<?php get_footer(); ?>