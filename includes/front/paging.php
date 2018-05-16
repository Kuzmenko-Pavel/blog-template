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