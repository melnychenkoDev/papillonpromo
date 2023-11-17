<?php
$page_id = 42;
$admin_email = get_option('custom_option_email');
$admin_phone = get_option('custom_option_phone');

?>


<h1 class="page_title">contacts</h1>

<div class="contacts_content">
    <div class="top_text"><?= get_field('field_655693516450e', $page_id) ?></div>
    <div class="contacts">
        <div class="contacts_item"><a href="mailto:<?=$admin_email?>"><?=$admin_email?></a></div>
        <div class="contacts_item"><a href="tel:<?=$admin_phone?>"><?=$admin_phone?></a></div>
    </div>

    <div class="form_block">
        <?= do_shortcode('[wpforms id="173" title="false"]') ?>
    </div>
</div>
