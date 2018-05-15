<?php

function theme_get_sections() {
	$theme_sections = array();

	$theme_sections[] = array(
		"id"   => "theme_buttons",
		"name" => __( 'Social Media Buttons' )
	);

	return $theme_sections;
}

function theme_get_settings() {

	$theme_settings = array();

	### SOCIALMEDIA BUTTONS SETTINGS
	#######################################################################################

	$theme_settings[] = array(
		"name"    => "RSS URL",
		"desc"    => __( 'Enter your RSS URL (e.g. Feedburner Feed) here.' ),
		"id"      => "theme_rss",
		"std"     => "",
		"type"    => "text",
		"section" => "theme_buttons"
	);

	$theme_settings[] = array(
		"name"    => "Twitter",
		"desc"    => __( 'Enter the URL to your Twitter Profile here.' ),
		"id"      => "theme_twitter",
		"std"     => "",
		"type"    => "text",
		"section" => "theme_buttons"
	);

	$theme_settings[] = array(
		"name"    => "Facebook",
		"desc"    => __( 'Enter the URL to your Facebook Profile here.' ),
		"id"      => "theme_facebook",
		"std"     => "",
		"type"    => "text",
		"section" => "theme_buttons"
	);

	$theme_settings[] = array(
		"name"    => "Vk",
		"desc"    => __( 'Enter the URL to your Vk Profile here.' ),
		"id"      => "theme_vk",
		"std"     => "",
		"type"    => "text",
		"section" => "theme_buttons"
	);

	$theme_settings[] = array(
		"name"    => "Instagram",
		"desc"    => __( 'Enter the URL to your Instagram Profile here.' ),
		"id"      => "theme_instagram",
		"std"     => "",
		"type"    => "text",
		"section" => "theme_buttons"
	);

	$theme_settings[] = array(
		"name"    => "Google+",
		"desc"    => __( 'Enter the URL to your Google+ profile.' ),
		"id"      => "theme_googleplus",
		"std"     => "",
		"type"    => "text",
		"section" => "theme_buttons"
	);

	$theme_settings[] = array(
		"name"    => "LinkedIn",
		"desc"    => __( 'Enter the URL to your LinkedIn Profile here.' ),
		"id"      => "theme_linkedin",
		"std"     => "",
		"type"    => "text",
		"section" => "theme_buttons"
	);

	$theme_settings[] = array(
		"name"    => "Youtube",
		"desc"    => __( 'Enter the URL to your Youtube Profile here.' ),
		"id"      => "theme_youtube",
		"std"     => "",
		"type"    => "text",
		"section" => "theme_buttons"
	);

	return $theme_settings;


}

?>