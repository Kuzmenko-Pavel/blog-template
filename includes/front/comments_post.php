<?php if ( comments_open() || get_comments_number() ) : ?>
    <a id="comments" name="comments"></a>
    <div class="article__comments">
        <h2>Комментарии</h2>
		<?php comments_template(); ?>
        <div class="article__comments-form">

			<?php
			function comment_form_submit_button( $button ) {
				$button =
					'<button class="action-link btn-default mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit">Оставить комментарий</button>' . get_comment_id_fields();

				return $button;
			}

			add_filter( 'comment_form_submit_button', 'comment_form_submit_button' );
			$commenter = wp_get_current_commenter();
			$comment_args = array(
				'title_reply'          => '',
				'fields'               => apply_filters( 'comment_form_default_fields', array(
					'author' => '<div class="input-field double">
                                 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                 <label for="author" class="mdl-textfield__label">Ваше имя</label>
                                 <input class="mdl-textfield__input" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div>',
					'email'  => '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><label for="email" class="mdl-textfield__label">Ваш e-mail</label><input class="mdl-textfield__input" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . '</div></div>',
					'url'    => ''
				) ),
				'comment_field'        => '<div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label">' .
				                          '<label for="comment" class="mdl-textfield__label">Текст сообщения</label>' .
				                          '<textarea id="comment" name="comment" aria-required="true" class="mdl-textfield__input"></textarea>' . '</div>',
				'comment_notes_before' => '',
				'comment_notes_after'  => ''
			);
			comment_form( $comment_args ); ?>
        </div>
    </div>
<?php endif; ?>