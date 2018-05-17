<?php
$popularpost = new WP_Query( array( 'posts_per_page' => 8,
                                    'meta_key' => 'post_views_count',
                                    'orderby' => 'meta_value_num',
                                    'order' => 'DESC'  ) );
if ( $popularpost->have_posts() ) : ?>
    <section class="article__misc">
    <div class="related-posts">
    <h2>Возможно вам понравяться:</h2>
    <div class="related-items">
	<?php while ( $popularpost->have_posts() ) : $popularpost->the_post(); ?>
				<div class="related-item">
					<a class="related-item__img" rel="external" href="<?php the_permalink() ?>"
					   style="background-image:url(<?php
					   if ( has_post_thumbnail() ) {
						   echo the_post_thumbnail_url();
					   } else {
						   echo get_template_directory_uri() . '/images/placeholder.jpg';
					   } ?> );">&nbsp;</a>
					<div class="article__controls">
                    <span class="date">
                        <i class="material-icons">&#xE916;</i>
                        <span><?php echo get_the_date(); ?></span>
                    </span>
						<?php if ( comments_open() || get_comments_number() ) : ?>
							<a href="<?php the_permalink(); ?>#comments" class="comments">
								<i class="material-icons">&#xE24C;</i>
								<span><?php comments_number( '0', '1', '%' ); ?></span>
							</a>
						<?php endif; ?>
					</div>
					<h2 class="related-item__title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
					</h2>
				</div>
	<?php endwhile; ?>
		</div>
	</div>
    </section>
<?php endif; ?>