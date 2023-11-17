<?php
wp_enqueue_style('releases-page', get_template_directory_uri() . '/assets/css/releases.css', array(), _S_VERSION);
wp_enqueue_script('releases-page', get_template_directory_uri() . '/assets/js/releases.js', array(), _S_VERSION, true);

$current_page = $_GET['page'];
$max_page = getPostsCountPage('releases', 'top-release', MAX_COUNT_RELEASES_POSTS);

if (!isset($current_page) || $current_page > $max_page) $current_page = 1;

$top_release_arr = getPosts('releases', 'top-release', MAX_COUNT_RELEASES_POSTS, $current_page);

$posts_arr = $top_release_arr['posts'];
$pagination_html = $top_release_arr['pagination_html'];


?>

    <h1 class="page_title">top releases</h1>

    <div class="posts_wrapper">
        <?php for ($i = 0; $i < count($posts_arr); $i++):
            $post = $posts_arr[$i];
            $post_id = $post['post_id'];
            $post_img_url = $post['post_img_url'];
            $post_title = $post['post_title'];
            $post_link_custom = $post['post_link_custom'];
            $post_link = $post['post_link'];
            ?>

            <?php get_template_part('template-parts/content/content', 'release', array('post_id' => $post_id, 'post_img_url' => $post_img_url, 'post_title' => $post_title, 'post_link_custom' => $post_link_custom, 'classes' => 'nodisk top')); ?>
        <?php endfor; ?>
    </div>

<?php echo $pagination_html ? $pagination_html : '' ?>