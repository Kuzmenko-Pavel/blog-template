<?php if ( has_tag() ) { ?>
    <div class="article__tags"><i class="material-icons">&#xE892;</i>
		<?php
		$tags = get_the_tags();
		foreach ( $tags as $tag ) {
			echo '<a href="' . get_tag_link( $tag->term_id ) . '" title="' . $tag->name . '" rel="tag">' . $tag->name . '</a>';
		}

		$postcats = get_the_category();
		$ccount   = 0;
		if ( $postcats ) {
			echo '<div class="article__tags"><i class="material-icons">&#xE892;</i>';
			foreach ( $postcats as $cat ) {
				$ccount ++;
				echo '<a href="' . get_category_link( $cat->term_id ) . '" title="' . $cat->name . '" rel="tag">' . $cat->name . '</a>';
				if ( $ccount >= 5 ) {
					break;
				} //change the number to adjust the count
			}
			echo '</div>';
		}

		?>
    </div>
<?php } ?>