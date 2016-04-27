<?php
    add_action('admin_init', 'jp_admin');
    function jp_admin() {
        global $post;
    }

    add_action('init', 'jp_menus');
    function jp_menus() {
        register_nav_menus(array(
            'navigation' => __('Navigation', 'jp')
        ));
    }

    add_action('cmb2_admin_init', 'jp_metaboxes');
    function jp_metaboxes() {
        $files = glob(get_template_directory().'/content/metaboxes/*.php');
        foreach($files as $file)
            require_once($file);
    }

    add_action('init', 'jp_posts');
    function jp_posts() {
        $files = glob(get_template_directory().'/content/posts/*.php');
        foreach($files as $file)
            require_once($file);
    }

    add_action('init', 'jp_scripts');
    function jp_scripts() {
        wp_register_script('jp', get_template_directory_uri().'/script.js', array('jquery'), false, true);
        wp_enqueue_script('jp');
    }

    add_action('wp_enqueue_scripts', 'jp_styles');
    function jp_styles() {
        wp_register_style('jp', get_template_directory_uri()."/style.css");
        wp_enqueue_style('jp');
    }
?>