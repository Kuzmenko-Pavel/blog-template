<?php get_header(); ?>
	<section class="section-main">
		<div class="container">
			<main class="main">
				<?php
				$popularpost = new WP_Query( array( 'posts_per_page' => 4,
                                                    'meta_key' => 'post_views_count',
                                                    'orderby' => 'meta_value_num',
                                                    'order' => 'DESC'  ) );
                if ( $popularpost->have_posts() ) : while ( $popularpost->have_posts() ) : $popularpost->the_post(); ?>
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