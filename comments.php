<?php
$nextp = get_next_comments_link( 'Следующие коментарии <i class="material-icons">&#xE409;</i>' );
$prevp = get_previous_comments_link( '<i class="material-icons">&#xE408;</i> Предыдущие коментарии' );
if ( $nextp || $prevp ):
	?>
    <nav class="paging">
        <div class="nav-previous"><?php echo $prevp ?></div>
        <div class="nav-next"><?php echo $nextp ?></div>
    </nav>
<?php endif; ?>
<ul class="article__comments-list">
	<?php wp_list_comments( 'type=comment&callback=format_comment' ); ?>
	<?php

	function format_comment( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment; ?>
        <li class="article__comments-item" id="comment-<?php echo get_comment_id(); ?>">
        <div class="comment__header">
    <span class="comment__avatar">
      <?php echo get_avatar( $comment, 32 ); ?>
    </span>
            <span class="comment__author">
      <?php echo get_comment_author(); ?>
    </span>
            <span class="comment__timestamp">
      <?php echo get_comment_date(); ?>
				<?php echo get_comment_time(); ?>
                <span>

        </div>
        <div class="comment__text">
			<?php echo get_comment_text(); ?>
        </div>
        <div class="comment__reply">
			<?php comment_reply_link(array_merge( $args, array( 'depth'=> $depth, 'max_depth'=> $args['max_depth']))); ?>
        </div>
	<?php } ?>
</ul>
<?php
$nextp = get_next_comments_link( 'Следующие коментарии <i class="material-icons">&#xE409;</i>' );
$prevp = get_previous_comments_link( '<i class="material-icons">&#xE408;</i> Предыдущие коментарии' );
if ( $nextp || $prevp ):
	?>
    <nav class="paging">
        <div class="nav-previous"><?php echo $prevp ?></div>
        <div class="nav-next"><?php echo $nextp ?></div>
    </nav>
<?php endif; ?>