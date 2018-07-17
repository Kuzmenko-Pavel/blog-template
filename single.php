<?php get_header(); ?>
<section class="section-main">
    <div class="container">
        <main class="main">
            <article class="article">
				<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>
                    <header class="article__header">
                        <h1 class="article__title"><?php the_title(); ?></h1>


						<?php if ( has_post_thumbnail() ) { ?>
                            <div class="article__thumb"><img src="<?php the_post_thumbnail_url(); ?>"></div>
						<?php } ?>

	                    <?php get_template_part( '/includes/front/counters' ); ?>

                        <div class="article__postpone">
                            <span class="time-to-read"><i
                                        class="material-icons">&#xE192;</i><span>Время на чтение:</span><span
                                        class="time"><?php echo estimated_reading_time(); ?></span></span>
	                        <?php get_template_part( '/includes/front/read_later' ); ?>
							<?php get_template_part( '/includes/front/social_share_up' ); ?>
                        </div>

                    </header>
                    <main class="article__content">
						<?php the_content(); ?>
                    </main>
                    <footer class="article__footer">
						<?php get_template_part( '/includes/front/social_share_down' ); ?>
						<?php get_template_part( '/includes/front/tags' ); ?>
                    </footer>
                    <section class="article__misc">
						<?php get_template_part( '/includes/front/related_post' ); ?>
						<?php get_template_part( '/includes/front/comments' ); ?>
                    </section>
				<?php endwhile; endif; ?>
            </article>
        </main>
        <aside class="sidebar">
			<?php get_sidebar(); ?>
        </aside>
    </div>
</section>
<?php get_footer(); ?>
