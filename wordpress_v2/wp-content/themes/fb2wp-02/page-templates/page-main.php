
<?php
/**
 * Template Name: top
 */	
?>
	<!--********* 
	@top
	************-->
	<span id="<?php echo get_post($wp_query->post->ID)->post_name; ?>"></span>
	<section id="top" class="main">
		
		<?php 
			global $wp_query;
			echo $wp_query->queried_object->post_content;
		?>
		
	</section>
