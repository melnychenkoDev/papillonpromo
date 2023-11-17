<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php wp_head(); ?>
</head>
<body class="overflow-x-h">

<header class="header">
    <div class="container">
        <div class="header_content desk">
            <div class="header_left">
                <?php
                if (has_nav_menu('menu-tl')) {
                    wp_nav_menu(array(
                        'theme_location' => 'menu-tl',
                        'container' => 'nav',
                        'container_class' => 'header_menu',
                        'menu_class' => 'header_menu_list',
                        'menu_id' => 'menu-tl',
                    ));
                }
                ?>
            </div>

            <div class="header_logo">
                <?php if (function_exists('the_custom_logo')) {
                    the_custom_logo();
                } ?>
            </div>

            <div class="header_right">
                <?php
                if (has_nav_menu('menu-tr')) {
                    wp_nav_menu(array(
                        'theme_location' => 'menu-tr',
                        'container' => 'nav',
                        'container_class' => 'header_menu',
                        'menu_class' => 'header_menu_list',
                        'menu_id' => 'menu-tr',
                    ));
                }
                ?>
                <div class="equalizer">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </div>
        </div>
        <div class="header_content mob overflow-h">
            <div class="header_logo">
                <?php if (function_exists('the_custom_logo')) {
                    the_custom_logo();
                } ?>
            </div>

            <div class="header_right">
                <div class="mob_menu-open">
                    <img src="<?= get_template_directory_uri().'/assets/img/menu.svg' ?>" alt="Menu Open Icon">
                </div>

            </div>

            <div class="mob_menu_content">
                <div class="top">
                    <div class="mob_menu-close">
                        <img src="<?= get_template_directory_uri().'/assets/img/menu-close.svg' ?>" alt="Menu Open Icon">
                    </div>
                </div>
                <?php
                if (has_nav_menu('menu-mob')) {
                    wp_nav_menu(array(
                        'theme_location' => 'menu-mob',
                        'container' => 'nav',
                        'container_class' => 'header_menu',
                        'menu_class' => 'header_menu_list',
                        'menu_id' => 'menu-mob',
                    ));
                }
                ?>
            </div>
        </div>
    </div>
</header>
