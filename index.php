<?php get_header(); ?>
    <section class="section-main">
        <div class="container">
            <main class="main">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php locate_template( '/includes/plugins/short_article.php', true ); ?>
				<?php endwhile; ?>
				<?php endif; ?>
				<?php
				$nextp = get_next_posts_link( 'Предыдущие статьи <i class="material-icons">&#xE409;</i>' );
				$prevp = get_previous_posts_link( '<i class="material-icons">&#xE408;</i> Следующие статьи' );
				if ( $nextp || $prevp ):
					?>
                    <nav class="paging">
                        <div class="nav-previous"><?php echo $prevp ?></div>
                        <div class="nav-next"><?php echo $nextp ?></div>
                    </nav>
				<?php endif; ?>
            </main>
            <aside class="sidebar">
				<?php get_sidebar(); ?>
            </aside>
        </div>
    </section>
<?php get_footer(); ?>