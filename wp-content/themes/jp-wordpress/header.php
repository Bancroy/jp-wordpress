<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<title><?php
            bloginfo('name');
            if(wp_title('', false))
                echo ': ';
            wp_title('');
        ?></title>
        <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
		<?php wp_head(); ?>
	</head>
	<body>
        <header id="header">
            <nav>
                <h3 class="outline-only">Navigation</h3>
                <?php jp_nav(); ?>
                <?php do_action('sublanguage_print_language_switch'); ?>
            </nav>
        </header>