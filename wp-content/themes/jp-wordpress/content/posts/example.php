<?php
    $name = 'example';

    register_post_type($name, array(
        'labels' => array(
            'name' => __(ucfirst($name), 'jp'),
            'singular_name' => __(ucfirst($name), 'jp'),
            'add_new' => __('Add new', 'jp'),
            'add_new_item' => __('Add new '.$name, 'jp'),
            'edit' => __('Edit', 'jp'),
            'edit_item' => __('Edit '.$name, 'jp'),
            'new_item' => __('New '.$name, 'jp'),
            'view' => __('View '.$name, 'jp'),
            'view_item' => __('View '.$name, 'jp'),
            'search_items' => __('Search '.$name, 'jp'),
            'not_found' => __('No '.$name.' found', 'jp'),
            'not_found_in_trash' => __('No '.$name.' found in trash', 'jp')
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