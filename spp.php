<?php
/*
Plugin Name: Simple Popular Posts Lite
Plugin URI: -
Description: -
Version: 2015.03.01
Author: khromov
Author URI: http://snippets.khromov.se
License: GPL2
*/

/**
 * Class Simple_Popular_Posts
 */
class Simple_Popular_Posts
{
    public static $td = 'spp';
    public static $post_types = array('post'); //,'page'

    /**
     * Constructor sets up all our hooks
     */
    function __construct()
    {
        add_action('wp', array(&$this, 'count'));
    }

    /**
     * Count function
     *
     * TODO: This should be doable with SHORTINIT and would be much faster
     */
    function count()
    {
        /**
         * Endpoint for counting visits
         */
        if(intval(get_query_var('spp_count')) === 1 && intval(get_query_var('post_id')) !== 0)
        {
            //JSON response
            header('Content-Type: application/json');
            $id = intval(get_query_var('spp_post_id'));

            $current_count = get_post_meta($id, '_spp_count', true);

            if($current_count === '')
                $count = 1;
            else
                $count = intval($current_count)+1;

            //Update post meta
            update_post_meta($id, '_spp_count', $count);

            echo json_encode(array('status' => 'OK', 'visits' => intval($current_count)+1));
        }
    }
}

$simple_popular_posts = new Simple_Popular_Posts();