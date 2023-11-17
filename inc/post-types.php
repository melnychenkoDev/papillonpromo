<?php
// Добавляем свойи типы постов

function register_custom_post_types(){

	$releases = array(
		'name'               => 'RELEASES',
		'singular_name'      => 'RELEASES',
		'add_new'            => 'Добавить новый RELEASE',
		'add_new_item'       => 'Добавить новый RELEASE',
		'edit_item'          => 'Редактировать RELEASE',
		'new_item'           => 'Новый RELEASE',
		'all_items'          => 'Все RELEASES',
		'view_item'          => 'Просмотреть RELEASES',
		'search_items'       => 'Поиск RELEASES',
		'menu_name' => 'RELEASES', // Название в меню
	);

	$releases_args = array(
		'labels' => $releases,
		'public' => true, // Разрешить публичный доступ к типу записей
		'has_archive' => true, // Включить архив записей
		'rewrite' => array('slug' => 'releases'), // Переписать URL записей
		'supports' => array('title', 'thumbnail'), // Включить поддержку полей
		'taxonomies' => array('release-category'),
	);


	register_post_type('releases', $releases_args);


	$news = array(
		'name'               => 'NEWS',
		'singular_name'      => 'NEWS',
		'add_new'            => 'Добавить новую NEWS',
		'add_new_item'       => 'Добавить новую NEWS',
		'edit_item'          => 'Редактировать NEWS',
		'new_item'           => 'Новй NEWS',
		'all_items'          => 'Все NEWS',
		'view_item'          => 'Просмотреть NEWS',
		'search_items'       => 'Поиск NEWS',
		'menu_name' => 'NEWS', // Название в меню
	);

	$news_args = array(
		'labels' => $news,
		'public' => true, // Разрешить публичный доступ к типу записей
		'has_archive' => true, // Включить архив записей
		'rewrite' => array('slug' => 'news'), // Переписать URL записей
		'supports' => array('title', 'editor', 'thumbnail'), // Включить поддержку полей
		'taxonomies' => array('category'),
		'show_ui' => true,
	);


	register_post_type('news', $news_args);

    $partners = array(
        'name'               => 'PARTNERS',
        'singular_name'      => 'PARTNER',
        'add_new'            => 'Добавить новую PARTNER',
        'add_new_item'       => 'Добавить новую PARTNER',
        'edit_item'          => 'Редактировать PARTNER',
        'new_item'           => 'Новй PARTNER',
        'all_items'          => 'Все PARTNERS',
        'view_item'          => 'Просмотреть PARTNER',
        'search_items'       => 'Поиск PARTNERS',
        'menu_name' => 'PARTNERS', // Название в меню
    );

    $partners_args = array(
        'labels' => $partners,
        'public' => true, // Разрешить публичный доступ к типу записей
        'has_archive' => true, // Включить архив записей
        'rewrite' => array('slug' => 'partners'), // Переписать URL записей
        'supports' => array('title', 'thumbnail'), // Включить поддержку полей
        'show_ui' => true,
    );


    register_post_type('partners', $partners_args);

}

add_action( 'init', 'register_custom_post_types' );
