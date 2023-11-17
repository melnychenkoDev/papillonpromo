<?php
/**
 * papillonpromo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package papillonpromo
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! defined( 'MAX_COUNT_RELEASES_POSTS' ) ) {
	// Replace the version number of the theme on each release.
	define( 'MAX_COUNT_RELEASES_POSTS', 24 );
}

if ( ! defined( 'MAX_COUNT_NEWS_POSTS' ) ) {
	// Replace the version number of the theme on each release.
	define( 'MAX_COUNT_NEWS_POSTS', 5 );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function papillonpromo_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on papillonpromo, use a find and replace
		* to change 'papillonpromo' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'papillonpromo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-tl' => esc_html__( 'Header Menu Left', 'papillonpromo' ),
			'menu-tr' => esc_html__( 'Header Menu Right', 'papillonpromo' ),
			'menu-fs' => esc_html__( 'Footer Menu Social', 'papillonpromo' ),
			'menu-fr' => esc_html__( 'Footer Menu Right', 'papillonpromo' ),
			'menu-mob' => esc_html__( 'Mobile Menu', 'papillonpromo' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'papillonpromo_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'papillonpromo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function papillonpromo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'papillonpromo_content_width', 640 );
}
add_action( 'after_setup_theme', 'papillonpromo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function papillonpromo_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'papillonpromo' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'papillonpromo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'papillonpromo_widgets_init' );



function custom_menu_classes($classes, $item, $args) {
	$classes[] = 'menu_list__item'; // Добавьте класс 'custom-li-class' к каждому элементу li
	return $classes;
}
add_filter('nav_menu_css_class', 'custom_menu_classes', 10, 3);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer styles and scripts.
 */
require get_template_directory() . '/inc/script_style.php';

/**
 * Customizer post types.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Customizer taxonomy types.
 */
require get_template_directory() . '/inc/taxonomy-types.php';

require get_template_directory() . '/inc/ajax_functions.php';

// Добавление страницы настроек в админ-панель
function custom_options_page() {
    add_menu_page(
        'Custom Options',     // Название страницы
        'Custom Options',     // Название меню
        'manage_options',     // Роль пользователя, имеющего доступ
        'custom-options',     // Уникальный идентификатор страницы
        'custom_options_page_content', // Функция, которая отобразит содержимое страницы
        'dashicons-admin-generic', // Иконка для меню (подробнее: https://developer.wordpress.org/resource/dashicons/)
        30                    // Позиция в меню
    );
}
add_action('admin_menu', 'custom_options_page');

// Функция, которая отобразит содержимое страницы настроек
function custom_options_page_content() {
    ?>
    <div class="wrap">
        <h2>Custom Options</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('custom_options_group');
            do_settings_sections('custom_options_page');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Регистрация настроек и добавление полей
function custom_options_init() {
    register_setting('custom_options_group', 'custom_option_email', 'sanitize_callback');
    register_setting('custom_options_group', 'custom_option_phone', 'sanitize_callback');

    add_settings_section('custom_options_section', 'Custom Options Section', 'section_callback', 'custom_options_page');

    add_settings_field('custom_option_name', 'Custom Option', 'field_callback', 'custom_options_page', 'custom_options_section');
}
add_action('admin_init', 'custom_options_init');

// Функция обратного вызова для секции
function section_callback() {
    echo '<p>Описание секции</p>';
}

// Функция обратного вызова для поля
function field_callback() {
    $value = get_option('custom_option_email');
    $value2 = get_option('custom_option_phone');
    echo '<h3>Email</h3><input type="text" name="custom_option_email" value="' . esc_attr($value) . '" />';
    echo '<h3>Phone</h3><input type="text" name="custom_option_phone" value="' . esc_attr($value2) . '" />';
}

// Функция очистки данных
function sanitize_callback($input) {
    return sanitize_text_field($input);
}


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function get_template_part_string($slug, $name = null, $args = array()) {
    ob_start(); // Включаем буфер вывода

    // Загружаем шаблон в буфер вывода
    get_template_part($slug, $name, $args);

    // Получаем содержимое буфера и очищаем его
    $template_content = ob_get_clean();

    return $template_content;
}