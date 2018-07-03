<div class="article__controls">
    <span class="date">
        <i class="material-icons">&#xE916;</i>
        <span><?php echo get_the_date(); ?></span>
    </span>
    <span class="views">
        <i class="material-icons">&#xE417;</i>
        <span class="post_views" data-id="get_the_ID()"><?php echo getPostViews( get_the_ID() ); ?></span>
    </span>
	<?php if ( comments_open() || get_comments_number() ) : ?>
        <a href="<?php the_permalink(); ?>#comments" class="comments">
            <i class="material-icons">&#xE24C;</i>
            <span><?php comments_number( '0', '1', '%' ); ?></span>
        </a>
	<?php endif; ?>
</div>