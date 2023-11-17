<?php

$post_id = $args['post_id'];
$post_img_url = $args['post_img_url'];
$post_title = $args['post_title'];
$post_content = $args['post_content'];
$post_link = get_the_permalink($post_id);
$post_date = $args['post_date'];

?>

<div class="news_item">
    <img src="<?=$post_img_url?>" alt="<?= $post_title ?>" class="news_item_img">
    <a href="<?= $post_link ?>"><h2 class="news_item_title"><?=$post_title?></h2></a>
    <div class="news_item_date"><?=$post_date?></div>
</div>