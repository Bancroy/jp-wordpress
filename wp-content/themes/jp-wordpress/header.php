<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php
            bloginfo('name');
            if(wp_title('', false))
                echo ': ';
            wp_title('');
        ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<?php wp_head(); ?>
	</head>
	<body>
        <header class="header clear" role="banner">
            <nav class="nav" role="navigation">
                <h3 class="outline-only">Navigation</h3>
                <?php jp_nav(); ?>
                <?php do_action('sublanguage_print_language_switch'); ?>
            </nav>
        </header>