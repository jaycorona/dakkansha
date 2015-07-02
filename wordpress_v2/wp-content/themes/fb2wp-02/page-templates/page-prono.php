
<?php
/**
 * Template Name: prono
 */	
?>
<style>
<!--
#prono {
	min-height:1200px;
}
-->
</style>
	<!--********* 
	@prono
	************-->
	<?php show_bg_css(); ?>
	<span id="<?php echo get_post($wp_query->post->ID)->post_name; ?>"></span>
	<section id="prono" class="main style3 fullscreen bg_<?php echo get_post_thumbnail_id(); ?>">
	
		<div class="content container">
			<header><h2 class="contents-ttl"><?php the_title(); ?></h2></header>
			
			<?php 
				global $wp_query;
				echo $wp_query->queried_object->post_content;
			?>
			
		</div><!--/.content-->
		
	</section><!--/#prono-->