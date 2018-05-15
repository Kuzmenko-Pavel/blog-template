<?php get_header(); ?>
    <section class="section-main">
        <div class="container">
            <article class="article">
                <?php if (have_posts()): while (have_posts()): the_post(); ?>
                    <?php setPostViews(get_the_ID()); ?>

                    <main class="article__content">
                        <?php the_content(); ?>
                    </main>
                    <footer class="article__footer">
                        <div class="read-later-social">
                            <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>"
                               title="Share on Facebook." class="fb"></a>
                            <a href="http://vk.com/share.php?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&noparse=true"
                               onclick="window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="vk"></a>
                            <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="gp"></a>
                            <a href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>"
                               title="Tweet this!" class="tw"></a>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&title=<?php the_title(); ?>&url=<?php the_permalink(); ?>"
                               title="Share on LinkedIn" class="in"></a>
                        </div>

                        <?php if (has_tag()) { ?>
                            <div class="article__tags"><i class="material-icons">&#xE892;</i>
                                <?php
                                $tags = get_the_tags();
                                foreach ($tags as $tag) {
                                    echo '<a href="' . get_tag_link($tag->term_id) . '" title="' . $tag->name . '" rel="tag">' . $tag->name . '</a>';
                                }

                                $postcats = get_the_category();
                                $ccount = 0;
                                if ($postcats) {
                                    echo '<div class="article__tags"><i class="material-icons">&#xE892;</i>';
                                    foreach ($postcats as $cat) {
                                        $ccount++;
                                        echo '<a href="' . get_category_link($cat->term_id) . '" title="' . $cat->name . '" rel="tag">' . $cat->name . '</a>';
                                        if ($ccount >= 5) break; //change the number to adjust the count
                                    }
                                    echo '</div>';
                                }

                                ?>
                            </div>
                        <?php } ?>
                    </footer>
                    <section class="article__misc">
	                    <?php locate_template('/includes/plugins/related_post.php', true); ?>

                        <?php if (comments_open() || get_comments_number()) : ?>
                            <a id="comments" name="comments"></a>
                            <div class="article__comments">
                                <h2>Комментарии</h2>
                                <?php comments_template(); ?>
                                <div class="article__comments-form">

                                    <?php
                                    function comment_form_submit_button($button)
                                    {
                                        $button =
                                            '<button class="action-link btn-default mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit">Оставить комментарий</button>' . get_comment_id_fields();
                                        return $button;
                                    }

                                    add_filter('comment_form_submit_button', 'comment_form_submit_button');
                                    $comment_args = array(
                                        'title_reply' => '',
                                        'fields' => apply_filters('comment_form_default_fields', array(
                                            'author' => '<div class="input-field double"><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><label for="author" class="mdl-textfield__label">Ваше имя</label><input class="mdl-textfield__input" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '"' . $aria_req . ' /></div>',
                                            'email' => '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><label for="email" class="mdl-textfield__label">Ваш e-mail</label><input class="mdl-textfield__input" id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' />' . '</div></div>',
                                            'url' => '')),
                                        'comment_field' => '<div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label">' .
                                            '<label for="comment" class="mdl-textfield__label">Текст сообщения</label>' .
                                            '<textarea id="comment" name="comment" aria-required="true" class="mdl-textfield__input"></textarea>' . '</div>',
                                        'comment_notes_before' => '',
                                        'comment_notes_after' => '');
                                    comment_form($comment_args); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php endwhile; endif; ?>
            </article>
            <aside class="sidebar">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </section>
<?php get_footer(); ?>