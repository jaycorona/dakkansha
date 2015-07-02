<?php get_header(); ?>

<?php 
$items = wp_get_nav_menu_items('frontpage');
foreach ($items as $obj) {
	query_posts("post_type=page&p={$obj->object_id}");
	if (!have_posts()) { continue; }
	while (have_posts()) : the_post();
		$template = get_page_template();
		include( $template );
	endwhile;
}
?>

<?php get_footer(); ?>