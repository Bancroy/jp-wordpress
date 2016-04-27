<?php
    function jp_nav() {
        wp_nav_menu(array(
            'theme_location'  => 'navigation'
        ));
    }

    add_shortcode('jp_shortcode', 'jp_shortcode');
    function jp_shortcode($attributes, $content = null) {
        return '<div>'.do_shortcode($content).'</div>';
    }
?>