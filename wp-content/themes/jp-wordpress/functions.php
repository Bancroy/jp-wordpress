<?php
    /*
        Author: James Pietras | @bancroy
        URL: jpietras.com
    */

    require_once('includes/setup.php');
    require_once('includes/utilities.php');

    if(function_exists('add_theme_support')) {
        load_theme_textdomain('jp', get_template_directory().'/languages');
        add_theme_support('menus');
        //add_theme_support('post-thumbnails');
        //add_image_size('thumbnail-size', 700, 200, true);
    }

    add_filter('widget_text', 'do_shortcode');
    add_filter('widget_text', 'shortcode_unautop');
    add_filter('the_excerpt', 'shortcode_unautop');
    add_filter('the_excerpt', 'do_shortcode');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'rel_canonical');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_filter('the_excerpt', 'wpautop');
?>