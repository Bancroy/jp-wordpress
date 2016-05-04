<?php
    register_post_type('example', array(
        'labels' => array(
            'name' => __('Example', 'jp'),
            'singular_name' => __('Example', 'jp')
        ),
        'public' => true,
        'hierarchical' => true,
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ),
        'can_export' => true
    ));
?>