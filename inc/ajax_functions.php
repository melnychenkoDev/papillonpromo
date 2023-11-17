<?php

add_action('wp_ajax_get_posts_pagination', 'get_posts_pagination');
add_action('wp_ajax_nopriv_get_posts_pagination', 'get_posts_pagination');

function get_posts_pagination() {

	$post_type = isset($_POST['post_type']) ? $_POST['post_type'] : false;
	$taxonomy = isset($_POST['taxonomy']) ? $_POST['taxonomy'] : false;
	$current_page = isset($_POST['page']) ? $_POST['page'] : 1;
	$max_count_posts = isset($_POST['max_count_posts']) ? $_POST['max_count_posts'] : 1;

	$response = array();

	if ($post_type) {
		$posts_arr = getPosts($post_type, $taxonomy, $max_count_posts, $current_page);

		$posts = $posts_arr['posts'];
		$posts_html = createPostsHTML($posts);
		$pagination_html = $posts_arr['pagination_html'];

		$response = array(
			'posts_html' => $posts_html,
			'pagination_html' => $pagination_html,
			'posts_arr' => $posts_arr
		);
	}

	echo json_encode($response);
	wp_die();
}