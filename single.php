<?php get_header(); ?>
<section class="section-main">
    <div class="container">
        <article class="article">
			<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>
				<?php setPostViews( get_the_ID() ); ?>
                <header class="article__header">
                    <h1 class="article__title"><?php the_title(); ?></h1>


					<?php if ( has_post_thumbnail() ) { ?>
                        <div class="article__thumb"><img src="<?php the_post_thumbnail_url(); ?>"></div>
					<?php } ?>

                    <div class="article__controls">
                            <span class="date"><i
                                        class="material-icons">&#xE916;</i><span><?php echo get_the_date(); ?></span></span>
                        <span class="views"><i
                                    class="material-icons">&#xE417;</i><span><?php echo getPostViews( get_the_ID() ); ?></span></span>
						<?php if ( comments_open() || get_comments_number() ) : ?><a href="#comments"
                                                                                     class="comments"><i
                                    class="material-icons">&#xE24C;</i><span><?php comments_number( '0', '1', '%' ); ?></span>
                            </a> <?php endif; ?>
                    </div>

                    <div class="article__postpone">
                            <span class="time-to-read"><i
                                        class="material-icons">&#xE192;</i><span>Время на чтение:</span><span
                                        class="time"><?php echo estimated_reading_time(); ?></span></span>
                        <a href="#readLater"
                           class="popup-link btn-default mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Нет
                            времени читать?</a>
                        <div class="popup-wrap">
                            <form id="readLater" class="popup">
                                <a href="#" class="close-btn">&times;</a>
                                <h3>Отправить на почту</h3>
                                <div class="input-field required">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <label for="email" class="mdl-textfield__label">Ваш email</label><input
                                                type="email" name="email" class="mdl-textfield__input">
                                    </div>
                                </div>
                                <div class="g-recaptcha"
                                     data-sitekey="6Lc4FFgUAAAAAG8DZesnBpfuSRIE1jq3oBJKjpcu"></div>
                                <!--your site key here-->
                                <div class="actions-block">
                                    <button type="submit"
                                            class="mdl-button--accent mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                                        Отправить
                                    </button>
                                </div>
                            </form>

                            <div id="thanks" class="popup">
                                <h3>Спасибо, что подписались</h3>
                                <p class="text-center"><i class="material-icons"
                                                          style="font-size: 48px; color:#3a5edc">&#xE86C;</i></p>
                                <p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem
                                    Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI
                                    века. </p>
                                <div class="actions-block">
                                    <a href="#" id="closeReadLater"
                                       class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Закрыть</a>
                                </div>
                            </div>
                        </div>

                        <div class="read-later-social">
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_google_plus"></a>
                                <a class="a2a_button_linkedin"></a>
                            </div>
                        </div>
                    </div>

                </header>
                <main class="article__content">
					<?php the_content(); ?>
                </main>
                <footer class="article__footer">
                    <div class="read-later-social">
                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="a2a_button_facebook a2a_counter"></a>
                            <a class="a2a_button_pinterest a2a_counter"></a>
                            <a class="a2a_button_tumblr a2a_counter"></a>
                            <a class="a2a_button_twitter a2a_counter"></a>
                            <a class="a2a_button_google_plus a2a_counter"></a>
                            <a class="a2a_button_linkedin a2a_counter"></a>
                            <a class="a2a_button_flipboard a2a_counter"></a>
                            <a class="a2a_button_pocket a2a_counter"></a>
                        </div>
                    </div>

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
                </footer>
                <section class="article__misc">
					<?php locate_template( '/includes/plugins/related_post.php', true ); ?>
                    <!--?php locate_template('/includes/plugins/comments_page.php', true); ?-->
                </section>
			<?php endwhile; endif; ?>
        </article>
        <aside class="sidebar">
			<?php get_sidebar(); ?>
        </aside>
    </div>
</section>
<?php get_footer(); ?>
