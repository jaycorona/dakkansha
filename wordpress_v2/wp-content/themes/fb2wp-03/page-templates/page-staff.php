
<?php
/**
 * Template Name: staff
 */	
?>

	<!--********* 
	@staff
	************-->
	<?php show_bg_css(); ?>
	<span id="<?php echo get_post($wp_query->post->ID)->post_name; ?>"></span>
	<section id="staff" class="main style3 bg_<?php echo get_post_thumbnail_id(); ?>">
		<div class="content container">
			<header><h2 class="contents-ttl"><?php the_title(); ?></h2></header>
			<div id="staff-container">
				<?php 
					global $wp_query;
					echo $wp_query->queried_object->post_content;
				?>
			</div>
			<!--/#staff-container-->
		</div><!--/.content-->
	</section><!--/#staff-->