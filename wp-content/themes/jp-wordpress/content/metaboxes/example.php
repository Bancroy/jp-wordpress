<?php
    $id_root = 'example';

    $example = new_cmb2_box(array(
        'id'           => $id_root,
        'title'        => __('Example metabox', 'jp'),
        'object_types' => array('page'),
        'context'      => 'normal',
        'priority'      => 'high',
        'show_names'   => true
    ));
    $example->add_field(array(
        'id'   => $id_root.'-heading',
        'name' => __('Heading', 'jp'),
        'type' => 'text'
    ));
?>