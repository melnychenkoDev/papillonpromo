<?php

$page_id = 29;

$latest_releases_args = array(
    'post_type' => 'releases',
    'tax_query' => array(
        array(
            'taxonomy' => 'release-category',
            'field'    => 'slug',
            'terms'    => 'release',
        ),
    ),
    'post_status'    => 'publish',
    'posts_per_page' => 4,
    'orderby'        => 'post_date',
    'order'          => 'DESC',
);

$latest_releases = get_posts($latest_releases_args);

$top_releases_args = array(
    'post_type' => 'releases',
    'tax_query' => array(
        array(
            'taxonomy' => 'release-category',
            'field'    => 'slug',
            'terms'    => 'top-release',
        ),
    ),
    'post_status'    => 'publish',
    'posts_per_page' => 4,
    'orderby'        => 'post_date',
    'order'          => 'DESC',
);

$top_releases = get_posts($top_releases_args);

$news_args = array(
    'post_type' => 'news',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'orderby'        => 'post_date',
    'order'          => 'DESC',
);

$news_releases = get_posts($news_args);

?>

<section class="home_head section">
    <div class="home_head_content">
        <h1 class="home_head_title"><?= get_field('field_654cd1718de74', $page_id) ?></h1>
        <p class="home_head_text"><?= get_field('field_654cd1c08de75', $page_id) ?></p>
        <div class="home_head_buttons">
            <a href="/contacts" class="btn btn-static">CONTACT</a>
            <a href="/about" class="btn btn-secondary">ABOUT US</a>
        </div>
    </div>

    <div class="box_shadow"></div>
    <div class="landscape-wrapper overflow-h">
        <div class="landscape"></div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section_top">
            <div class="section_title">Latest Releases</div>
            <a href="/releases" class="section_info">See all</a>
        </div>

        <div class="posts_wrapper posts_wrapper-4">
            <?php for ($i = 0; $i < count($latest_releases); $i++):
                $post = $latest_releases[$i];
                $post_id = $post->ID;
                $post_img_url = get_the_post_thumbnail_url($post_id, 'full');
                $post_title = $post->post_title;
                $post_link_custom = get_field('field_654c9b7c860e3', $post_id);
                $post_link = get_post_permalink($post_id);

                ?>

                <?php get_template_part('template-parts/content/content', 'release', array('post_id' => $post_id, 'post_img_url' => $post_img_url, 'post_title' => $post_title, 'post_link_custom' => $post_link_custom)); ?>

            <?php endfor; ?>
        </div>
    </div>
</section>

<section class="section overflow-h">

    <div class="infinite-scroll-text">
        <p>Welcome to Papillon Promo <span>Pool, where the power of music takes flight!</span></p>
    </div>

</section>

<section class="section">
    <div class="container">
        <div class="section_top">
            <div class="section_title">About us</div>
            <a href="/about" class="section_info">Read about us</a>
        </div>

        <div class="opacity-scroll-text">
            <?= get_field('field_654cd22a8de77', $page_id) ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section_top">
            <div class="section_title">TOP Releases</div>
            <a href="/top-releases" class="section_info">See all</a>
        </div>

        <div class="posts_wrapper posts_wrapper-4 animate">
            <?php for ($i = 0; $i < count($top_releases); $i++):
                $post = $top_releases[$i];
                $post_id = $post->ID;
                $post_img_url = get_the_post_thumbnail_url($post_id, 'full');
                $post_title = $post->post_title;
                $post_link_custom = get_field('field_654c9b7c860e3', $post_id);
                $post_link = get_post_permalink($post_id);

                ?>

                <?php get_template_part('template-parts/content/content', 'release', array('post_id' => $post_id, 'post_img_url' => $post_img_url, 'post_title' => $post_title, 'post_link_custom' => $post_link_custom)); ?>

            <?php endfor; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section_top">
            <div class="section_title">News</div>
            <a href="/news" class="section_info">See all</a>
        </div>

        <div class="news_posts_wrapper">
            <?php for ($i=0; $i < count($news_releases); $i++):
                $post = $news_releases[$i];
                $post_id = $post->post_id;
                $post_img_url = get_the_post_thumbnail_url($post_id, 'full');
                $post_title = $post->post_title;
                $post_content = $post->post_content;
                $post_link = $post->post_link;
                $post_date = $post->post_date;

                $datetime = new DateTime($post_date);
                $formatted_date = $datetime->format('d M y');
                ?>


                <?php get_template_part( 'template-parts/content/content', 'news', array('post_id' => $post_id, 'post_img_url' => $post_img_url, 'post_title' => $post_title, 'post_link' => $post_link, 'post_date' => $formatted_date) ); ?>


            <?php endfor; ?>
        </div>
    </div>
</section>