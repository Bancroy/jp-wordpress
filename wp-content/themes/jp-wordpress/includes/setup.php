<?php
    //add_action('admin_init', 'jp_admin');
    function jp_admin() {
        global $post;
    }

    //add_filter('avatar_defaults', 'jp_avatar');
    function jp_avatar($avatar_defaults) {
        $avatar = 'https://en.wikipedia.org/static/images/project-logos/enwiki.png';
        $avatar_defaults[$avatar] = "JP-Wordpress Avatar";
        return $avatar_defaults;
    }

    add_filter('style_loader_tag', 'jp_cleanup');
    function jp_cleanup($tag) {
        $no_media = preg_replace('~\s+media=["\'][^"\']++["\']~', '', $tag);
        $no_type  = preg_replace('~\s+type=["\'][^"\']++["\']~', '', $no_media);
        return $no_type;
    }

    add_action('get_header', 'jp_comments');
    function jp_comments() {
        if (!is_admin())
            if (is_singular() && comments_open() && (get_option('thread_comments') === 1))
                wp_enqueue_script('comment-reply');
    }

    add_filter('nav_menu_css_class', 'jp_filter', 100, 1);
    add_filter('nav_menu_item_id',   'jp_filter', 100, 1);
    add_filter('page_css_class',     'jp_filter', 100, 1);
    function jp_filter($attributes) {
        if(is_array($attributes))
            if(array_search('current_page_item', $attributes))
                $attributes = array(0 => 'current_page_item');
            else
                $attributes = array();
        else
            if($attributes !== 'current_page_item')
                $attributes = '';
        return $attributes;
    }

    add_filter('the_category', 'jp_fix');
    function jp_fix($list) {
        return str_replace('rel="category tag"', 'rel="tag"', $list);
    }

    //add_action('init', 'jp_menus');
    function jp_menus() {
        register_nav_menus(array(
            'navigation' => __('Navigation', 'jp')
        ));
    }

    //add_action('cmb2_admin_init', 'jp_metaboxes');
    function jp_metaboxes() {
        $files = glob(get_template_directory().'/content/metaboxes/*.php');
        foreach($files as $file)
            require_once($file);
    }

    //add_filter('body_class', 'jp_modify');
    function jp_modify($classes) {
        return array();
    }

    add_action('init', 'jp_pagination');
    function jp_pagination() {
        global $wp_query;
        $big = 999999999;

        echo paginate_links(array(
            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages
        ));
    }

    //add_action('init', 'jp_posts');
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

    //add_action('sublanguage_custom_switch', 'jp_switch', 10, 2); 
    function jp_switch($languages, $sublanguage) {
        echo '<ul>';
            foreach ($languages as $language) {
                $abbreviation = $language->post_name;
                $current      = ($sublanguage->current_language->ID === $language->ID ? ' current' : false);
                $link         = $sublanguage->get_translation_link($language);
                $name         = $language->post_title;

                echo '<li class="'.$abbreviation.$current.'">';
                    echo '<a href="'.$link.'">'.$name.'</a>';
                echo '</li>';
            }
        echo '</ul>';
    }

    //add_filter('show_admin_bar', 'jp_toolbar');
    function jp_toolbar() {
        return false;
    }

    //add_filter('excerpt_more', 'jp_view');
    function jp_view($more) {
        global $post;
        return '<a href="'.get_permalink($post->ID).'">'.__('View article', 'html5blank').'...</a>';
    }
?>