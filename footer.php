<?php

$admin_email = get_option('custom_option_email');

?>


<footer class="footer section">
    <div class="container">
        <div class="footer_top">
            <div class="left">Let's discuss</div>
            <div class="right"><a href="mailto:<?=$admin_email?>"><?=$admin_email?></a></div>
        </div>
        <div class="footer_middle">
            <div class="left">
                <div class="tit">Social</div>
                <?php
                if (has_nav_menu('menu-fs')) {
                    wp_nav_menu(array(
                        'theme_location' => 'menu-fs',
                        'container' => 'nav',
                        'container_class' => 'footer_menu',
                        'menu_class' => 'footer_menu_list',
                        'menu_id' => 'menu-fs',
                    ));
                }
                ?>
                <div class="txt">© 2023 Papilon Promo | All rights reserved | Website by <a href="#" target="_blank">artdes.net</a></div>
            </div>
            <div class="right">
                <div class="tit">Legal</div>
                <?php
                if (has_nav_menu('menu-fr')) {
                    wp_nav_menu(array(
                        'theme_location' => 'menu-fr',
                        'container' => 'nav',
                        'container_class' => 'footer_menu',
                        'menu_class' => 'footer_menu_list',
                        'menu_id' => 'menu-fr',
                    ));
                }
                ?>
                <div class="txt">© 2023</div>
            </div>
        </div>
        <div class="footer_bottom">
            <p class="footer_bottom_text">PAPILLON PROMO</p>
            <div class="txt">© 2023 Papilon Promo | All rights reserved | Website by <a href="#" target="_blank">artdes.net</a></div>
            <div class="txt">© 2023</div>
        </div>
    </div>
</footer>
<audio id="audio" src="<?=get_field('field_6556ab66e6eb8', 29)?>"></audio>

<?php wp_footer(); ?>
<div class="overlay"></div>
</body>
</html>
