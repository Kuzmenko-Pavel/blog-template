<?php while ( have_posts() ) : the_post(); ?>
    <article class="article-item">

		<?php if ( has_post_thumbnail() ) { ?>
            <div class="article__thumb">
                <a href="<?php the_permalink(); ?>" title="<?php echo wp_strip_all_tags(get_the_excerpt());?>">
                    <img src="<?php the_post_thumbnail_url(); ?>">
                </a>
            </div>
		<?php } ?>
        <h2 class="article__title">
            <a href="<?php the_permalink(); ?>"
               title="<?php echo wp_strip_all_tags(get_the_excerpt());?>"
            ><?php the_title(); ?></a>
        </h2>
        <div class="article__excerpt">
            <p>
                <?php echo wp_strip_all_tags(apply_filters( 'the_content', get_the_content( '')));?>
            </p>
        </div>
	    <?php get_template_part( '/includes/front/counters' ); ?>
	    <?php get_template_part( '/includes/front/tags' ); ?>
        <p style="text-align:right; margin: 0; padding: 25px 0 0;"><a
                    href="<?php the_permalink(); ?>"
                    class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary">Перейти к
                полной статье...</a></p>
    </article>
<?php endwhile; ?>
<?php get_template_part( '/includes/front/paging' ); ?>