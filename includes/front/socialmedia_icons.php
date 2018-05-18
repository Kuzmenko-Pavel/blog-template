<?php
// Social Media Buttons
$url     = get_template_directory_uri() . '/images/icons';
$options = get_option( 'theme_options' );
?>
<?php // RSS Button
if ( isset( $options['theme_rss'] ) and $options['theme_rss'] <> '' ) { ?>
    <a href="<?php echo esc_url( $options['theme_rss'] ); ?>" target="_blank" class="icon-rss social-button color"
       title="RSS" rel="noreferrer"><span>RSS</span></a>
<?php } ?>

<?php // Twitter Button
if ( isset( $options['theme_twitter'] ) and $options['theme_twitter'] <> '' ) { ?>
    <a href="<?php echo esc_url( $options['theme_twitter'] ); ?>" target="_blank"
       class="icon-twitter social-button color"
       title="Twitter" rel="noreferrer"><span>Twitter</span></a>
<?php } ?>

<?php // VK Button
if ( isset( $options['theme_vk'] ) and $options['theme_vk'] <> '' ) { ?>
    <a href="<?php echo esc_url( $options['theme_vk'] ); ?>" target="_blank" class="icon-twitter social-button color"
       title="Vk" rel="noreferrer"><span>Vk</span></a>
<?php } ?>


<?php // Facebook Button
if ( isset( $options['theme_facebook'] ) and $options['theme_facebook'] <> '' ) { ?>
    <a href="<?php echo esc_url( $options['theme_facebook'] ); ?>" target="_blank"
       class="icon-facebook social-button color"
       title="Facebook" rel="noreferrer"><span>Facebook</span></a>
<?php } ?>

<?php // Instagram Button
if ( isset( $options['theme_instagram'] ) and $options['theme_instagram'] <> '' ) { ?>
    <a href="<?php echo esc_url( $options['theme_instagram'] ); ?>" target="_blank"
       class="icon-instagram social-button color"
       title="Instagram" rel="noreferrer"><span>Instagram</span></a>
<?php } ?>

<?php // Google+ Button
if ( isset( $options['theme_googleplus'] ) and $options['theme_googleplus'] <> '' ) { ?>
    <a href="<?php echo esc_url( $options['theme_googleplus'] ); ?>" target="_blank"
       class="icon-googleplus social-button color"
       title="Google+" rel="noreferrer"><span>Google+</span></a>
<?php } ?>

<?php // LinkedIn Button
if ( isset( $options['theme_linkedin'] ) and $options['theme_linkedin'] <> '' ) { ?>
    <a href="<?php echo esc_url( $options['theme_linkedin'] ); ?>" target="_blank"
       class="icon-linkedin social-button color"
       title="LinkedIn" rel="noreferrer"><span>LinkedIn</span></a>
<?php } ?>

<?php // Youtube Button
if ( isset( $options['theme_youtube'] ) and $options['theme_youtube'] <> '' ) { ?>
    <a href="<?php echo esc_url( $options['theme_youtube'] ); ?>" target="_blank"
       class="icon-youtube social-button color"
       title="Youtube" rel="noreferrer"><span>Youtube</span></a>
<?php } ?>
