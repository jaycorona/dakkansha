
<?php
/**
 * Template Name: right-message
 */	
?>
	
	<!--********* 
	@right-message 
	************-->
	<?php show_bg_css(); ?>
	<span id="<?php echo get_post($wp_query->post->ID)->post_name; ?>"></span>
	<section id="intro" class="main style2 right fullscreen bg_<?php echo get_post_thumbnail_id(); ?>">
		<?php 
			$src = get_post_meta($wp_query->post->ID, "sp_header", true);
			if (!$src) {
				$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
			}
		?>
		<p class="sp"><img src="<?php echo $src; ?>" /></p>
		<div class="content box style2">
			<header><h2 class="contents-ttl"><?php the_title(); ?></h2></header>
			<?php 
				global $wp_query;
				echo $wp_query->queried_object->post_content;
			?>
		</div>
	</section>