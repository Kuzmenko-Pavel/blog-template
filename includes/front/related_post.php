<?php
$orig_post = $post;
global $post;
$posts = get_field( 'related_posts', false, false);
if ( $posts ) :
	$args       = array(
		'posts_per_page'      => 4,
		'ignore_sticky_posts' => true,
		'post__not_in' => array($orig_post->ID),
		'post__in' => $posts,
	);
else:
	$tags = wp_get_post_tags( $orig_post->ID, array( 'orderby' => 'count', 'fields' => 'ids' ) );
	$categories = wp_get_post_categories( $orig_post->ID, array( 'orderby' => 'count', 'fields' => 'ids' ) );
	$args       = array(
		'posts_per_page'      => 4,
		'ignore_sticky_posts' => true,
		'post__not_in' => array($orig_post->ID),
		'tax_query'           => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'post_tag',
				'terms'    => $tags
			),
			array(
				'taxonomy' => 'category',
				'terms'    => $categories,
			)
		)
	);
endif; ?>

<?php
$my_query   = new wp_query( $args );
$count = 0;
if ( $my_query->have_posts() ) { ?>
    <div class="related-posts">
        <h2>Ещё статьи по теме:</h2>
        <div class="related-items">
			<?php while ( $my_query->have_posts() ) {
				$my_query->the_post();
				$count++?>
                <div class="related-item">
                    <a class="related-item__img" rel="external" href="<?php the_permalink() ?>"
                       style="background-image:url(<?php
					   if ( has_post_thumbnail() ) {
						   echo the_post_thumbnail_url();
					   } else {
						   echo get_template_directory_uri() . '/assets/images/placeholder.jpg';
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
            <?php
            }
			if ($count < 5):
                while ( $count < 4  ) {
                    $count++; ?>
                <div class="related-item">
                    <a class="related-item__img" rel="external" href="<?php the_permalink() ?>"
                       style="background-image:url(<?php
					   if ( has_post_thumbnail() ) {
						   echo the_post_thumbnail_url();
					   } else {
						   echo get_template_directory_uri() . '/assets/images/placeholder.jpg';
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
            <?php }
			endif;?>
        </div>
    </div>
<?php }
$post = $orig_post;
wp_reset_query();
?>
