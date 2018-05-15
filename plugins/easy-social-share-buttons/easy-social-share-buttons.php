<?php
if ( ! defined( 'ABSPATH' ) ) exit;
require_once( 'includes/class-easy-social-share-buttons.php' );
require_once( 'includes/class-easy-social-share-buttons-settings.php' );
require_once( 'includes/lib/class-easy-social-share-buttons-admin-api.php' );
function Easy_Social_Share_Buttons () {
	$instance = Easy_Social_Share_Buttons::instance( __FILE__, '1.0.0' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = Easy_Social_Share_Buttons_Settings::instance( $instance );
	}

	return $instance;
}

$easy_social_share = Easy_Social_Share_Buttons();
