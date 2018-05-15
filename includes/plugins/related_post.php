<?php
$orig_post = $post;
global $post;
$tags = wp_get_post_tags($post->ID);

if ($tags) {
	$tag_ids = array();
	foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	$args = array(
		'tag__in' => $tag_ids,
		'post__not_in' => array($post->ID),
		'posts_per_page' => 4, // Number of related posts to display.
		'caller_get_posts' => 1
	);

	$my_query = new wp_query($args);

	if ($my_query->have_posts()) { ?>

        <div class="related-posts">
        <h2>Ещё статьи по теме:</h2>
        <div class="related-items">

		<?php while ($my_query->have_posts()) {
			$my_query->the_post(); ?>


            <div class="related-item">

                <a class="related-item__img" rel="external" href="<?php the_permalink() ?>"
                   style="background-image:url(<?php
				   if (has_post_thumbnail()) {
					   echo the_post_thumbnail_url();
				   } else {
					   echo get_template_directory_uri() . '/assets/images/placeholder.jpg';
				   } ?> );">&nbsp;</a>

                <div class="article__controls">
                                            <span class="date"><i
                                                        class="material-icons">&#xE916;</i><span><?php echo get_the_date(); ?></span></span>
                    <span class="views"><i
                                class="material-icons">&#xE417;</i><span><?php echo getPostViews(get_the_ID()); ?></span></span>
					<?php if (comments_open() || get_comments_number()) : ?><a
                        href="<?php the_permalink(); ?>#comments" class="comments"><i
                                class="material-icons">&#xE24C;</i><span><?php comments_number('0', '1', '%'); ?></span>
                        </a> <?php endif; ?>
                </div>
                <h2 class="related-item__title"><a
                            href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
            </div>
			<?php
		}
	}
	$post = $orig_post;
	wp_reset_query(); ?>
    </div>
    </div>
<?php } ?>