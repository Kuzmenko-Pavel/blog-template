<?php

/*
*  Export
*
*  @description: 
*  @since: 3.6
*  @created: 25/01/13
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// vars
$defaults   = array(
	'acf_posts' => array(),
	'nonce'     => ''
);
$my_options = array_merge( $defaults, $_POST );


// validate nonce
if ( ! wp_verify_nonce( $my_options['nonce'], 'export' ) ) {
	wp_die( __( "Error", 'acf' ) );
}


// check for posts
if ( empty( $my_options['acf_posts'] ) ) {
	wp_die( __( "No ACF groups selected", 'acf' ) );
}


/**
 * Version number for the export format.
 *
 * Bump this when something changes that might affect compatibility.
 *
 * @since 2.5.0
 */
define( 'WXR_VERSION', '1.1' );


/*
*  fix_line_breaks
*
*  This function will loop through all array pieces and correct double line breaks from DB to XML
*
*  @type	function
*  @date	2/12/2013
*  @since	5.0.0
*
*  @param	$v (mixed)
*  @return	$v (mixed)
*/

function fix_line_breaks( $v ) {
	if ( is_array( $v ) ) {
		foreach ( array_keys( $v ) as $k ) {
			$v[ $k ] = fix_line_breaks( $v[ $k ] );
		}
	} elseif ( is_string( $v ) ) {
		$v = str_replace( "\r\n", "\r", $v );
	}

	return $v;
}


/**
 * Wrap given string in XML CDATA tag.
 *
 * @since 2.1.0
 *
 * @param string $str String to wrap in XML CDATA tag.
 */
function wxr_cdata( $str ) {
	if ( seems_utf8( $str ) == false ) {
		$str = utf8_encode( $str );
	}

	// $str = ent2ncr(esc_html($str));
	$str = "<![CDATA[$str" . ( ( substr( $str, - 1 ) == ']' ) ? ' ' : '' ) . ']]>';

	return $str;
}

/**
 * Return the URL of the site
 *
 * @since 2.5.0
 *
 * @return string Site URL.
 */
function wxr_site_url() {
	// ms: the base url
	if ( is_multisite() ) {
		return network_home_url();
	} // wp: the blog url
	else {
		return get_site_url();
	}
}

/**
 * Output a tag_description XML tag from a given tag object
 *
 * @since 2.3.0
 *
 * @param object $tag Tag Object
 */
function wxr_tag_description( $tag ) {
	if ( empty( $tag->description ) ) {
		return;
	}

	echo '<wp:tag_description>' . wxr_cdata( $tag->description ) . '</wp:tag_description>';
}

/**
 * Output a term_name XML tag from a given term object
 *
 * @since 2.9.0
 *
 * @param object $term Term Object
 */
function wxr_term_name( $term ) {
	if ( empty( $term->name ) ) {
		return;
	}

	echo '<wp:term_name>' . wxr_cdata( $term->name ) . '</wp:term_name>';
}

/**
 * Output a term_description XML tag from a given term object
 *
 * @since 2.9.0
 *
 * @param object $term Term Object
 */
function wxr_term_description( $term ) {
	if ( empty( $term->description ) ) {
		return;
	}

	echo '<wp:term_description>' . wxr_cdata( $term->description ) . '</wp:term_description>';
}

/**
 * Output list of authors with posts
 *
 * @since 3.1.0
 */
function wxr_authors_list() {
	global $wpdb;

	$authors = array();
	$results = $wpdb->get_results( "SELECT DISTINCT post_author FROM $wpdb->posts" );
	foreach ( (array) $results as $result ) {
		$authors[] = get_userdata( $result->post_author );
	}

	$authors = array_filter( $authors );

	foreach ( $authors as $author ) {
		echo "\t<wp:author>";
		echo '<wp:author_id>' . $author->ID . '</wp:author_id>';
		echo '<wp:author_login>' . $author->user_login . '</wp:author_login>';
		echo '<wp:author_email>' . $author->user_email . '</wp:author_email>';
		echo '<wp:author_display_name>' . wxr_cdata( $author->display_name ) . '</wp:author_display_name>';
		echo '<wp:author_first_name>' . wxr_cdata( $author->user_firstname ) . '</wp:author_first_name>';
		echo '<wp:author_last_name>' . wxr_cdata( $author->user_lastname ) . '</wp:author_last_name>';
		echo "</wp:author>\n";
	}
}

header( 'Content-Description: File Transfer' );
header( 'Content-Disposition: attachment; filename=advanced-custom-field-export.xml' );
header( 'Content-Type: text/xml; charset=' . get_option( 'blog_charset' ), true );


echo '<?xml version="1.0" encoding="' . get_bloginfo( 'charset' ) . "\" ?>\n";

?>
<!-- This is a WordPress eXtended RSS file generated by WordPress as an export of your site. -->
<!-- It contains information about your site's posts, pages, comments, categories, and other content. -->
<!-- You may use this file to transfer that content from one site to another. -->
<!-- This file is not intended to serve as a complete backup of your site. -->

<!-- To import this information into a WordPress site follow these steps: -->
<!-- 1. Log in to that site as an administrator. -->
<!-- 2. Go to Tools: Import in the WordPress admin panel. -->
<!-- 3. Install the "WordPress" importer from the list. -->
<!-- 4. Activate & Run Importer. -->
<!-- 5. Upload this file using the form provided on that page. -->
<!-- 6. You will first be asked to map the authors in this export file to users -->
<!--    on the site. For each author, you may choose to map to an -->
<!--    existing user on the site or to create a new user. -->
<!-- 7. WordPress will then import each of the posts, pages, comments, categories, etc. -->
<!--    contained in this file into your site. -->

<?php the_generator( 'export' ); ?>
<rss version="2.0"
     xmlns:excerpt="http://wordpress.org/export/<?php echo WXR_VERSION; ?>/excerpt/"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:wfw="http://wellformedweb.org/CommentAPI/"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:wp="http://wordpress.org/export/<?php echo WXR_VERSION; ?>/"
>

    <channel>
        <title><?php bloginfo_rss( 'name' ); ?></title>
        <link><?php bloginfo_rss( 'url' ); ?></link>
        <description><?php bloginfo_rss( 'description' ); ?></description>
        <pubDate><?php echo date( 'D, d M Y H:i:s +0000' ); ?></pubDate>
        <language><?php echo get_option( 'rss_language' ); ?></language>
        <wp:wxr_version><?php echo WXR_VERSION; ?></wp:wxr_version>
        <wp:base_site_url><?php echo wxr_site_url(); ?></wp:base_site_url>
        <wp:base_blog_url><?php bloginfo_rss( 'url' ); ?></wp:base_blog_url>
		<?php wxr_authors_list(); ?>
		<?php if ( $my_options['acf_posts'] ) {

			global $wp_query, $wpdb, $post;
			$wp_query->in_the_loop = true; // Fake being in the loop.

			// create SQL with %d placeholders
			$where = 'WHERE ID IN (' . substr( str_repeat( '%d,', count( $my_options['acf_posts'] ) ), 0, - 1 ) . ')';

			// now prepare the SQL based on the %d + $_POST data
			$posts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->posts} $where", $my_options['acf_posts'] ) );

			// Begin Loop
			foreach ( $posts as $post ) {
				setup_postdata( $post );
				?>
                <item>
                    <title><?php echo apply_filters( 'the_title_rss', $post->post_title ); ?></title>
                    <link><?php the_permalink_rss() ?></link>
                    <pubDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_post_time( 'Y-m-d H:i:s', true ), false ); ?></pubDate>
                    <dc:creator><?php echo get_the_author_meta( 'login' ); ?></dc:creator>
                    <guid isPermaLink="false"><?php esc_url( the_guid() ); ?></guid>
                    <wp:post_id><?php echo $post->ID; ?></wp:post_id>
                    <wp:post_date><?php echo $post->post_date; ?></wp:post_date>
                    <wp:post_date_gmt><?php echo $post->post_date_gmt; ?></wp:post_date_gmt>
                    <wp:comment_status><?php echo $post->comment_status; ?></wp:comment_status>
                    <wp:ping_status><?php echo $post->ping_status; ?></wp:ping_status>
                    <wp:post_name><?php echo $post->post_name; ?></wp:post_name>
                    <wp:status><?php echo $post->post_status; ?></wp:status>
                    <wp:post_parent><?php echo $post->post_parent; ?></wp:post_parent>
                    <wp:menu_order><?php echo $post->menu_order; ?></wp:menu_order>
                    <wp:post_type><?php echo $post->post_type; ?></wp:post_type>
                    <wp:post_password><?php echo $post->post_password; ?></wp:post_password>
					<?php $postmeta       = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->postmeta WHERE post_id = %d", $post->ID ) );
					foreach ( $postmeta as $meta ) : if ( $meta->meta_key != '_edit_lock' ) :

						$meta->meta_value = maybe_unserialize( $meta->meta_value );
						$meta->meta_value = fix_line_breaks( $meta->meta_value );
						$meta->meta_value = maybe_serialize( $meta->meta_value );

						?>
                        <wp:postmeta>
                            <wp:meta_key><?php echo $meta->meta_key; ?></wp:meta_key>
                            <wp:meta_value><?php echo wxr_cdata( $meta->meta_value ); ?></wp:meta_value>
                        </wp:postmeta>
					<?php endif; endforeach; ?>
                </item>
				<?php
			}
		}
		?>
    </channel>
</rss>
