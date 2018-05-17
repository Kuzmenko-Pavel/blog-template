<?php
$posttags = get_the_tags();
$tcount   = 0;
if ( $posttags ) {
	echo '<div class="article__tags"><i class="material-icons">&#xE892;</i>';
	foreach ( $posttags as $tag ) {
		$tcount ++;
		echo '<a class="tag-cloud-link" href="' . get_tag_link( $tag->term_id ) . '" title="' . $tag->name . '" rel="tag">' . $tag->name . '</a>';
		if ( $tcount >= 5 ) {
			break;
		}
	}
	echo '</div>';
}
$postcats = get_the_category();
$ccount   = 0;
if ( $postcats ) {
	echo '<div class="article__tags"><i class="material-icons">&#xE866;</i>';
	foreach ( $postcats as $cat ) {
		$ccount ++;
		echo '<a class="tag-cloud-link" href="' . get_category_link( $cat->term_id ) . '" title="' . $cat->name . '" rel="tag">' . $cat->name . '</a>';
		if ( $ccount >= 5 ) {
			break;
		}
	}
	echo '</div>';
}
?>
