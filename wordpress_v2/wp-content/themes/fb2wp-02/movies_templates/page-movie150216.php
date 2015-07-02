<?php
/**
 * Template Name: trailer150216
 * Description: auto made by auto_make_theaters_page plugin
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */	
		
add_action('wp_print_scripts','add_amo_script');
function add_amo_script() {
	wp_register_script('amo_js', plugin_dir_url('auto_make_movie_page/auto_make_movie_page.php').'js/index.js');
	wp_enqueue_script('amo_js');
}
add_action('wp_print_styles', 'add_amo_stylesheet');
function add_amo_stylesheet() {
	wp_register_style('amo_css', plugin_dir_url('auto_make_movie_page/auto_make_movie_page.php') . 'css/index.css');
	wp_enqueue_style( 'amo_css');
}

?>
<!DOCTYPE html>
<html <?php language_attributes();?>
<head>  
    <meta charset="<?php bloginfo('charset'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php wp_title('&#124;', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>
		
<script type="text/javascript">
<!--
var MOVIE_W = 853;
var MOVIE_H = 480;
var ID_ARR =["aS7QfGR2CHs"];
var _currentMovieId =0;
	
var OFF_BG_COLOR = "#ffc000";
var OFF_TXT_COLOR ="#000";
var ON_BG_COLOR ="#000";
var ON_TXT_COLOR ="#ffc000";

// -->
</script>

<body style="background-color: black; padding:0;">
<div id="wrapper">
	<div id="screen-container" style="padding-top :0;">
		<div id="player"></div>
	</div>
</div><!--/wrapper-->
</body>
</html>