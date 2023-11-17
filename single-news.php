<?php
wp_enqueue_style('news-page', get_template_directory_uri() . '/assets/css/news.css', array(), _S_VERSION);
wp_enqueue_script('news-page', get_template_directory_uri() . '/assets/js/news.js', array(), _S_VERSION, true);
get_header();
?>


	<div class="container">

        <nav class="breadcrumbs">
            <?php if (function_exists('bcn_display')) {
                bcn_display();
            }
            ?>
        </nav>

        <?php

        if (have_posts()) :
            while (have_posts()) : the_post();

                $post_id = get_the_ID();
                $post_title = get_the_title();
                $post_content = apply_filters('the_content', get_the_content());
                $post_img_url = get_the_post_thumbnail_url( $post_id, 'full' );

                ?>
                <h1 class="page_title"><?=$post_title?></h1>

                <div class="single_content">
                    <img src="<?=$post_img_url?>" alt="<?=$post_title?>" class="single_content_img">
                    <div class="single_content_text"><?=$post_content?></div>
                </div>
                <?php
            endwhile;
        endif;

        ?>

    </div>

<?php
get_footer();
