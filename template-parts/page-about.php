<?php
$page_id = 40;


$partners_args = array(
    'post_type' => 'partners',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
);

$partners_arr = get_posts($partners_args);
?>

<h1 class="page_title">About</h1>

<div class="about_content">
    <div class="top_text">
        <?= get_field('field_65568491810fc', $page_id) ?>
    </div>

    <div class="img_section">
        <img src="<?= get_field('field_654cd3b816e18', $page_id) ?>">
        <img src="<?= get_field('field_654cd3f316e19', $page_id) ?>">
    </div>

    <h2 class="title"><?= get_field('field_655689352d9a2', $page_id) ?></h2>

    <div class="block_content">
        <h4 class="block_content_title"><?= get_field('field_655689a42d9a5', $page_id) ?></h4>
        <p class="block_content_text"><?= get_field('field_6556895c2d9a3', $page_id) ?></p>
    </div>

    <div class="partners_wrapper">
        <?php for ($i = 0; $i < count($partners_arr); $i++):
            $post = $partners_arr[$i];
            $post_id = $post->ID;
            $post_img_url = get_the_post_thumbnail_url($post_id, 'full');
            $post_link_custom = get_field('field_6556868d41320', $post_id);

            ?>

            <div class="partner_item">
                <img src="<?=$post_img_url?>">
            </div>

        <?php endfor; ?>
    </div>

    <div class="block_content">
        <h4 class="block_content_title"><?= get_field('field_655689bb2d9a6', $page_id) ?></h4>
        <p class="block_content_text"><?= get_field('field_655689702d9a4', $page_id) ?></p>
    </div>
</div>