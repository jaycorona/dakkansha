<?php
/**
 * Template Name: movie150212
 * Description: auto made by auto_make_theaters_page plugin
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */	
		
add_action('wp_print_scripts','add_amo_script');
function add_amo_script() {
	wp_register_script('amo_js', plugin_dir_url('/home/sites/heteml/users16/u/l/m/ulm-design/web/eden-entertainment.jp/heartsandminds/site/wp-content/plugins/auto_make_movie_page/auto_make_movie_page.php').'/js/index.js');
	wp_enqueue_script('amo_js');
}
add_action('wp_print_styles', 'add_amo_stylesheet');
function add_amo_stylesheet() {
	wp_register_style('amo_css', plugin_dir_url('/home/sites/heteml/users16/u/l/m/ulm-design/web/eden-entertainment.jp/heartsandminds/site/wp-content/plugins/auto_make_movie_page/auto_make_movie_page.php') . '/css/index.css');
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
var ID_ARR =["waMko6S0tcY"];
var _currentMovieId =0;
	
var OFF_BG_COLOR = "#ffc000";
var OFF_TXT_COLOR ="#000";
var ON_BG_COLOR ="#000";
var ON_TXT_COLOR ="#ffc000";

// -->
</script>

<body>
<div id="wrapper">
	<div id="screen-container">
		<div id="player"></div>
	</div>
	<div id="main" class="relative">
	<ul id="navi"><li id="t2"><a id="movie_0" href="javascript:void(0)">マッドナース予告</a></li></ul>
	</div>
</div><!--/wrapper-->
</body>
</html>