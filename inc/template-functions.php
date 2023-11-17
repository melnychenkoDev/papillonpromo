<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package papillonpromo
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function papillonpromo_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter('body_class', 'papillonpromo_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function papillonpromo_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}

add_action('wp_head', 'papillonpromo_pingback_header');

function getPosts($post_type, $taxonomy, $max_view = -1, $current_page = 1)
{
	$posts = array();

	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => $max_view,
		'post_status' => 'publish',
		'paged' => $current_page
	);

	if ($taxonomy == 'release' || $taxonomy == 'top-release'):
		$tax_query = array(
			array(
				'taxonomy' => 'release-category',
				'field' => 'slug',
				'terms' => $taxonomy,
			),
		);

		$args['tax_query'] = $tax_query;
	endif;


	$query_posts = get_posts($args);

	for ($i=0; $i < count($query_posts); $i++):
		$post = $query_posts[$i];
		$post_id = $post->ID;
		$post_img_url = get_the_post_thumbnail_url( $post_id, 'full' );
		$post_title = $post->post_title;
		$post_content = $post->post_content;
		$post_link_custom = get_field('field_654c9b7c860e3', $post_id);
		$post_link = get_post_permalink($post_id);
        $post_date = $post->post_date;

        $datetime = new DateTime($post_date);
        $formatted_date = $datetime->format('d M y');

		$posts[$i] = array('post_id' => $post_id, 'post_title' => $post_title, 'post_content' => $post_content, 'post_img_url' => $post_img_url, 'post_link' => $post_link, 'post_link_custom' => $post_link_custom, 'post_date' => $formatted_date);
	endfor;


	$args['posts_per_page'] = -1;
	$total_posts = count(get_posts($args));


	$totalItems = $total_posts;
	$itemsPerPage = $max_view;
	$totalPages = ceil($totalItems / $itemsPerPage);

	if ($totalPages > 1):
		$pagination_html = getPostsPagination($totalPages, $current_page, $post_type, $taxonomy, $max_view);
		return array('posts' => $posts, 'pagination_html' => $pagination_html);
	else:
		return array('posts' => $posts, 'pagination_html' => null);
	endif;
}

function getPostsCountPage($post_type, $taxonomy, $max_view)
{

	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => -1,
		'post_status' => 'publish',
	);

	if ($taxonomy == 'release' || $taxonomy == 'top-release'):
		$tax_query = array(
			array(
				'taxonomy' => 'release-category',
				'field' => 'slug',
				'terms' => $taxonomy,
			),
		);

		$args['tax_query'] = $tax_query;
	endif;

	$total_posts = count(get_posts($args));
	$totalItems = $total_posts;
	$itemsPerPage = $max_view;
	$totalPages = ceil($totalItems / $itemsPerPage);

	return $totalPages;
}


function getPostsPagination($total_pages, $current_page, $post_type, $taxonomy, $max_view)
{
	$wrrap_data = "data-post-type='$post_type' data-max-count-posts='$max_view'";
	if ($taxonomy) $wrrap_data .= " data-taxonomy='$taxonomy'";

	$start = 1;
	$end = $total_pages;
	$before_page = $current_page == $start ? $current_page : $current_page - 1;
	$after_page = $current_page == $end ? $current_page : $current_page + 1;

	if ($total_pages <= 5) {
		$html = "<div class='pagination__wrapper' $wrrap_data>";
		for ($i = 1; $i <= $total_pages; $i++) {
			$class = ($i == $current_page) ? 'pagination_item current' : 'pagination_item';
			$html .= "<a href='?page=$i' data-page='$i' class='$class'>$i</a>";
		}
		$html .= "</div>";
	} else {
		if ($current_page == $start) {
			$html = "<div class='pagination__wrapper' $wrrap_data>";
			for ($i = $start; $i <= ($start + 3); $i++) {
				$class = ($i == $current_page) ? 'pagination_item current' : 'pagination_item';
				$html .= "<a href='?page=$i' data-page='$i' class='$class'>$i</a>";
			}
			$html .= "<a href='?page=$end' data-page='$end' class='pagination_item'>$end</a>";
			$html .= "</div>";
		}

		if ($current_page > $start && $current_page != $end) {
			$html = "<div class='pagination__wrapper' $wrrap_data>";

			if ($before_page > $start) {
				$html .= "<a href='?page=$start' data-page='$start' class='pagination_item'>$start</a>";
			}

			if ($before_page + 2 == $end) {
				for ($i = $before_page - 1; $i <= $after_page; $i++) {
					$class = ($i == $current_page) ? 'pagination_item current' : 'pagination_item';
					$html .= "<a href='?page=$i' data-page='$i' class='$class'>$i</a>";
				}
			} elseif ($before_page == $start) {
				for ($i = $before_page; $i <= ($after_page + 1); $i++) {
					$class = ($i == $current_page) ? 'pagination_item current' : 'pagination_item';
					$html .= "<a href='?page=$i' data-page='$i' class='$class'>$i</a>";
				}
			} else {
				for ($i = $before_page; $i <= $after_page; $i++) {
					$class = ($i == $current_page) ? 'pagination_item current' : 'pagination_item';
					$html .= "<a href='?page=$i' data-page='$i' class='$class'>$i</a>";
				}
			}

			if ($after_page < $end) {
				$html .= "<a href='?page=$end' data-page='$end' class='pagination_item'>$end</a>";
			}

			$html .= "</div>";
		}

		if ($current_page == $end) {
			$html = "<div class='pagination__wrapper' $wrrap_data>";
			$html .= "<a href='?page=$start' data-page='$start' class='pagination_item'>$start</a>";
			for ($i = ($end - 3); $i <= $end; $i++) {
				$class = ($i == $current_page) ? 'pagination_item current' : 'pagination_item';
				$html .= "<a href='?page=$i' data-page='$i' class='$class'>$i</a>";
			}
			$html .= "</div>";
		}
	}

	return $html;
}

function createPostsHTML($posts_arr) {
	$posts_html = '';
	foreach ($posts_arr as $post) {
		$post_id = $post['post_id'];
		$post_img_url = $post['post_img_url'];
		$post_title = $post['post_title'];
		$post_link_custom = $post['post_link_custom'];
		$post_link = $post['post_link'];
		$post_content = $post['post_content'];
        $post_date = $post['post_date'];

		if ($post_content) {
			$posts_html .= get_template_part_string('template-parts/content/content', 'news', array('post_id' => $post_id, 'post_img_url' => $post_img_url, 'post_title' => $post_title, 'post_content' => $post_content, 'post_link' => $post_link, 'post_date' => $post_date));
		} else {
			$posts_html .= get_template_part_string('template-parts/content/content', 'release', array('post_id' => $post_id, 'post_img_url' => $post_img_url, 'post_title' => $post_title, 'post_link_custom' => $post_link_custom));
		}


	}

	return $posts_html;
}