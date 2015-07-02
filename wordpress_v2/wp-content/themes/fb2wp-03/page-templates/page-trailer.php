
<?php
/**
 * Template Name: trailer
 */	
?>

	<!--********* 
	@trailer
	************-->
	<span id="<?php echo get_post($wp_query->post->ID)->post_name; ?>"></span>
	<section id="trailer" class="main style3 fullscreen">
	
		<div class="content box style2">
			<header><h2 class="contents-ttl"><?php the_title(); ?></h2></header>
			<?php 
				global $wp_query;
				echo $wp_query->queried_object->post_content;
			?>
		</div>  
		
	</section><!--/#trailer-->