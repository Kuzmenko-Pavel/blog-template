<?php get_header(); ?>
	<section class="section-main">
		<div class="container">
            <article class="article">
                <div class="term">
                    <div class="term-not-found">К сожалению, запрашиваемая Вами страница не найдена...</div>
                </div>
				<?php get_template_part( '/includes/front/not-found'); ?>
            </article>
			<aside class="sidebar">
				<?php get_sidebar(); ?>
			</aside>
		</div>
	</section>
<?php get_footer(); ?>