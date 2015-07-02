
<?php
/**
 * Template Name: left-message
 */	
?>

	<!--********* 
	@left-message
	************-->
	<?php show_bg_css(); ?>
	<span id="<?php echo get_post($wp_query->post->ID)->post_name; ?>"></span>
	<section id="story" class="main style2 left fullscreen bg_<?php echo get_post_thumbnail_id(); ?>">
		<?php 
			$src = get_post_meta($wp_query->post->ID, "sp_header", true);
			if (!$src) {
				$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
			}
		?>
		<p class="sp"><img src="<?php echo $src; ?>" /></p>
		<div class="content box style2">
			<div class="custom-textarea" id="custom-textarea_<?php echo $id ?>">
				<?php 
					global $wp_query;
					echo $wp_query->queried_object->post_content;
				?>
			</div>
			<div class="container">
			<script src="<?php bloginfo('template_directory'); ?>/js/jquery.textpager.js"></script>
				<div id="custom-control_<?php echo $id ?>" class="custom-control"> 
					<a class="tp-control-arrow-left unactive"></a> 
						<ul id="custom-pages_<?php echo $id ?>"></ul>
					<a class="tp-control-arrow-right"></a>
				</div>
			</div>
		</div>
		<?php echo "<script>
			$(window).load(function() {
				$('#custom-textarea_".$id."').textpager({
					controlArrows: '#custom-control_".$id."',
					controlPages: '#custom-control_".$id." #custom-pages_".$id."',
					controlPagesContent: 'li'
				});
			});
		</script>"; ?>
	</section>