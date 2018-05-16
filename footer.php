</div>
<footer class="footer">
    <div class="container">
        <nav class="footer-menu">
            <a class="navbar-brand" href="https://yottos.com">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/yottos-logo.svg" alt="yottos">
            </a>
        </nav>
        <div class="social-buttons">
			<?php get_template_part( '/includes/front/socialmedia_icons'); ?>
        </div>
    </div>
    <small>&copy;&nbsp;2006&nbsp;&ndash;&nbsp;<?php echo date( 'Y' ); ?>&nbsp;YOTTOS</small>
	<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
        <div id="sidebar-footer">
            <ul>
				<?php dynamic_sidebar( 'sidebar-footer' ); ?>
            </ul>
        </div>
	<?php endif; ?>
</footer>
<?php wp_footer(); ?>
</body>

</html>
