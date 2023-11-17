<?php
/**
 * Enqueue scripts and styles.
 */
function papillonpromo_scripts()
{
	wp_enqueue_style( 'papillonpromo-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'papillonpromo-style', 'rtl', 'replace' );

	wp_enqueue_script( 'papillonpromo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css', array(), _S_VERSION);
	wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true);

	if (is_front_page()) {
		wp_enqueue_style('front-page', get_template_directory_uri() . '/assets/css/front-page.css', array(), _S_VERSION);
		wp_enqueue_script('front-page', get_template_directory_uri() . '/assets/js/front-page.js', array(), _S_VERSION, true);
	}

	if (is_page(40)) {
		wp_enqueue_style('about-page', get_template_directory_uri() . '/assets/css/about.css', array(), _S_VERSION);
		wp_enqueue_script('about-page', get_template_directory_uri() . '/assets/js/about.js', array(), _S_VERSION, true);
	}

	if (is_page(42)) {
		wp_enqueue_style('contacts-page', get_template_directory_uri() . '/assets/css/contacts.css', array(), _S_VERSION);
		wp_enqueue_script('contacts-page', get_template_directory_uri() . '/assets/js/contacts.js', array(), _S_VERSION, true);
	}

	wp_localize_script('main', 'ajaxData', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
	));

}

add_action('wp_enqueue_scripts', 'papillonpromo_scripts');
