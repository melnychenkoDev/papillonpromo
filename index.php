<?php
global $wp_query;
get_header();


$page_name = $wp_query->query['pagename'] ? $wp_query->query['pagename'] : $wp_query->query['post_type'];
$is_main_page = is_front_page();

?>

	<?php if ($is_main_page): ?>
        <?php get_template_part( 'template-parts/page', 'home' ); ?>
	<?php elseif ($page_name): ?>
		<div class="container">
			<?php get_template_part( 'template-parts/content/content', 'breadcrumbs' ); ?>
			<?php get_template_part( 'template-parts/page', $page_name ); ?>
		</div>
	<?php endif; ?>


<?php
get_footer();