<?php


define( 'THEME_NAME', 'YottosBlog' );
define( 'THEME_INFO', 'http://yottos.com/' );

// Register Theme Features
function custom_theme_features() {

	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails' );

	// Add theme support for HTML5 Semantic Markup
	add_theme_support( 'html5', array() );

	if ( ! is_admin() && ! current_user_can( 'manage_options' ) ) {
		show_admin_bar( false );
	}

	add_theme_support( 'menus' );
	register_nav_menus(
		array(
			'top_dropdown' => __( 'Top dropdown menu' ),
			'main_nav'     => __( 'Main navigation' )
		)
	);

	register_sidebar( array( 'name' => 'Sidebar Home', 'id' => 'sidebar-home' ) );

	register_sidebar( array( 'name' => 'Sidebar Blog Post', 'id' => 'sidebar-blog-post' ) );

	register_sidebar( array( 'name' => 'Sidebar Pages', 'id' => 'sidebar-pages' ) );

	register_sidebar( array( 'name' => 'Sidebar Search', 'id' => 'sidebar-search' ) );

	register_sidebar( array( 'name' => 'Sidebar NotFound', 'id' => 'sidebar-not-found' ) );

	register_sidebar( array( 'name' => 'Sidebar Footer', 'id' => 'sidebar-footer' ) );

}

add_action( 'after_setup_theme', 'custom_theme_features' );


// include Admin Files
locate_template( '/includes/admin/theme-settings.php', true );
locate_template( '/includes/admin/theme-admin.php', true );

if (!is_admin()) add_action("wp_enqueue_scripts", "deregister_jquery_enqueue", 11);
function deregister_jquery_enqueue() {
	wp_deregister_script('jquery');
}

function enqueue_styles() {
	wp_enqueue_style( 'yo-style', get_stylesheet_uri() );
//	wp_enqueue_style( 'load-fa', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
//	wp_enqueue_style( 'load-material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons' );
//	wp_enqueue_style( 'font-style', 'https://fonts.googleapis.com/css?family=Roboto:700,600,400,300' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_styles' );


function enqueue_scripts() {
//	wp_register_script( 'yo-script', get_template_directory_uri() . '/assets/js/main.js' );
//	wp_enqueue_script( 'yo-script', $in_footer=true);
//	wp_register_script( 'share_button', get_template_directory_uri() . '/assets/js/share_button.js' );
//	wp_enqueue_script( 'share_button', $in_footer=true );
//	wp_register_script( 'subscribe', get_template_directory_uri() . '/assets/js/subscribe.js' );
//	wp_enqueue_script( 'subscribe', '', array(), false, true );
//	wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.2.1.min.js', array(), null, true );
//	wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js' );
//	wp_register_script( 'material', get_template_directory_uri() . '/assets/js/vendor/material.min.js' );
//	wp_register_script( 'flex_menu', get_template_directory_uri() . '/assets/js/vendor/flexmenu.min.js' );
	wp_register_script( 'addtoany', 'https://static.addtoany.com/menu/page.js' );
	wp_register_script( 'google-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), '2.0', true);

//	wp_enqueue_script( 'jquery' );
//	wp_enqueue_script( 'bootstrap' );
//	wp_enqueue_script( 'material' );
//	wp_enqueue_script( 'flex_menu' );
	wp_enqueue_script( 'addtoany', '', $deps = array(), $ver = false, true);
	wp_enqueue_script( 'google-recaptcha', $in_footer=true);
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts');


add_filter( 'widget_tag_cloud_args', 'tag_widget_limit' );
function tag_widget_limit( $args ) {
	if ( isset( $args['taxonomy'] ) && $args['taxonomy'] == 'post_tag' ) {
		$args['number'] = 10; //Limit number of tags
	}

	return $args;
}


// function to display number of posts.
function getPostViews( $postID ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );

		return "0";
	}

	return $count;
}

// function to count views.
function setPostViews( $postID ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count ++;
		update_post_meta( $postID, $count_key, $count );
	}
}


// Add it to a column in WP-Admin
add_filter( 'manage_posts_columns', 'posts_column_views' );
add_action( 'manage_posts_custom_column', 'posts_custom_column_views', 5, 2 );
function posts_column_views( $defaults ) {
	$defaults['post_views'] = __( 'Views' );

	return $defaults;
}

function posts_custom_column_views( $column_name, $id ) {
	if ( $column_name === 'post_views' ) {
		echo getPostViews( get_the_ID() );
	}
}

function wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}

add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

function estimated_reading_time() {
	$post           = get_post();
	$words          = substr_count( "( strip_tags( $post->post_content ) ) ", ' ' );
	$minutes        = round( $words / 190 );
	$estimated_time = $minutes . ' мин.';

	return $estimated_time;
}


function SearchFilter( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post_type', 'post' );
	}

	return $query;
}

add_filter( 'pre_get_posts', 'SearchFilter' );


function add_async_defer_attribute( $tag, $handle ) {
	return str_replace( ' src', ' async defer src', $tag );
}
if (!is_admin()) add_filter('script_loader_tag', 'add_async_defer_attribute', 20, 2);


function add_stylesheet_min( $stylesheet_uri, $stylesheet_dir_uri ) {
	return trailingslashit( $stylesheet_dir_uri ) . 'style.min.css';
}
//add_filter('stylesheet_uri', 'add_stylesheet_min', 20, 2);

//clean oembed
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
//clean emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
//clean head
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );


add_action( 'after_setup_theme', 'my_load_plugin' );
function my_load_plugin() {
	include_once( TEMPLATEPATH . '/plugins/advanced-custom-fields/acf.php' );
}

?>

