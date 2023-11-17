<?php

$post_id = $args['post_id'];
$post_img_url = $args['post_img_url'];
$post_title = $args['post_title'];
$post_link_custom = $args['post_link_custom'];

$classes = $args['classes'] ? 'post_item ' . $args['classes'] : 'post_item';

?>

<a class="<?=$classes?>" href="<?= $post_link_custom ?>">
    <h2 class="post_item_title"><?= $post_title ?></h2>
    <div class="img_block">
        <img class="post_item_img" src="<?= $post_img_url ?>" alt="<?= $post_title ?>">
        <img class="disk_img" src="<?= get_template_directory_uri().'/assets/img/vinyl.svg' ?>">
    </div>
</a>
