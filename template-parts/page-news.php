<?php
wp_enqueue_style('news-page', get_template_directory_uri() . '/assets/css/news.css', array(), _S_VERSION);
wp_enqueue_script('news-page', get_template_directory_uri() . '/assets/js/news.js', array(), _S_VERSION, true);

$current_page = $_GET['page'];
$max_page = getPostsCountPage('news', false, MAX_COUNT_NEWS_POSTS);

if (!isset($current_page) || $current_page > $max_page) $current_page = 1;

$release_arr = getPosts('news', false, MAX_COUNT_NEWS_POSTS, $current_page);

$posts_arr = $release_arr['posts'];
$pagination_html = $release_arr['pagination_html'];

?>


    <h1 class="page_title">news</h1>

    <div class="news_posts_wrapper">
        <?php for ($i = 0; $i < count($posts_arr); $i++):
            $post = $posts_arr[$i];
            $post_id = $post['post_id'];
            $post_img_url = $post['post_img_url'];
            $post_title = $post['post_title'];
            $post_content = $post['post_content'];
            $post_link = $post['post_link'];
            $post_date = $post['post_date'];
            ?>


            <?php get_template_part('template-parts/content/content', 'news', array('post_id' => $post_id, 'post_img_url' => $post_img_url, 'post_title' => $post_title, 'post_content' => $post_content, 'post_link' => $post_link, 'post_date' => $post_date)); ?>


        <?php endfor; ?>
    </div>


<?php echo $pagination_html ? $pagination_html : '' ?>