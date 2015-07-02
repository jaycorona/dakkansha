<?php
/*
 Plugin Name: auto_make_movie_page
 Plugin URI: 
 Description: auto_make_movie_page. It is a plug-in to implement the facebook api.
 Version: 0.001
 Author: TimeRiverSystem,inc
 Author URI: 
 License: GPLv2
*/

/*
 Copyright 2014 Global IT Academy  (email : tokikawa@globalit-academy.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$Amo = new Amo();
class Amo
{
	
	// the directory name relative to the template directory
	// where the page templates will be saved.
	// Very useful for much organized looking file system.
	// leave blank if you want the templates to be stored
	// in the theme's root directory.
	private $templates_storage_dir_name = "movies_templates";
	
	private $amo_template_slug  = 'amo_template_slug';
	private $amo_template_name  = 'amo_template_name';
	private $amo_template_base  = 
<<<EOD
<?php
/**
 * Template Name: {#amo_template_name#}
 * Description: auto made by auto_make_theaters_page plugin
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */	
		
add_action('wp_print_scripts','add_amo_script');
function add_amo_script() {
	wp_register_script('amo_js', plugin_dir_url('{#plugin_absolute_path#}').'/js/index.js');
	wp_enqueue_script('amo_js');
}
add_action('wp_print_styles', 'add_amo_stylesheet');
function add_amo_stylesheet() {
	wp_register_style('amo_css', plugin_dir_url('{#plugin_absolute_path#}') . '/css/index.css');
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
{#youtube_ids#}
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
	{#youtube_ids_title#}
	</div>
</div><!--/wrapper-->
</body>
</html>
EOD;
	
	//--------------------------------------------------------------------------
	//
	//  ini
	//
	//--------------------------------------------------------------------------
	public function __construct() {
		
		add_action('init', array($this, 'add_movie_post_type'));
		
		// about menu
		add_action('admin_menu', array($this, 'add_menu_amo'));
		
		// about exec post
		if (isset($_POST['amo_make_template_flg']) && !empty($_POST['amo_make_template_flg'])) {
			add_action('admin_init', array($this, 'amo_exec'));
		}
		
	}
	/*
	 *  side menu
	 */
	public function add_menu_amo() {
		add_menu_page(__('Auto Movie'), __('Auto Movie'), 0, 'auto_movie', array($this, 'auto_movie_form'), null, 3);
		
	}
	
	
	// exec 
	public function amo_exec() {
		
		global $post;
		
		check_admin_referer('amo_make_template');
		
		$amo_template_slug = $_POST[$this->amo_template_slug];
		
		$theaters_html = $this->get_theaters_html();
		
		// IMPORTANT!
		// input validation
		// we need to make sure that the file, passed is and .xlsx file
		$this->validateFields($amo_template_slug);
		
		
		$args = array(
			'post_type'     => 'movie',
			'post_status'   => 'publish',
			'orderby'       =>'menu_order'
		);
		query_posts($args);
		$ids    = array();
		$titles_tag = '<ul id="navi">';
		$index = 0;
		while(have_posts()): the_post();
			$ids[]    = trim($post->post_content);
			$titles_tag .= '<li id="t2"><a id="movie_' . $index . '" href="javascript:void(' . $index . ')">' . $post->post_title . '</a></li>';
			$index++;
		endwhile;
		$titles_tag .= '</ul>';
		
		
		$map = array(
			"{#amo_template_name#}" => $amo_template_slug,	
			"{#amo_theaters_list#}" => $theaters_html,
			"{#amo_theaters_slug#}" => $amo_template_slug,
			"{#amo_theaters_dir#}"	=> $this->templates_storage_dir_name,
			"{#plugin_absolute_path#}" => __FILE__,
			"{#youtube_ids#}"          => 'var ID_ARR =["' . implode('","', $ids)  .'"];',
			"{#youtube_ids_title#}"    => $titles_tag,
		);
		
		$this->amo_template_base = str_replace(array_keys($map), array_values($map), $this->amo_template_base);
		
		
		$destination_dir = null;
		if ( empty($this->templates_storage_dir_name) ) {
			$destination_dir = get_template_directory()."/";
		} else {
			$destination_dir = get_template_directory()."/".$this->templates_storage_dir_name."/";
		}
		
		!is_dir($destination_dir) && mkdir($destination_dir);
		
		$template_file_name  = $destination_dir."page-{$amo_template_slug}.php";
		$template_style_name = $destination_dir."page-{$amo_template_slug}.css";
		
		file_put_contents( $template_file_name, $this->amo_template_base );
		file_put_contents( $template_style_name, "");
		
		wp_redirect('admin.php?page=auto_movie&msg='.urlencode('予告編のテンプレートを作成しました。固定ページで選択お願いします。'));
		
	}
	
	
	/**
	 * 	Method which will validate the inputs. If an input is found invalid, 
	 * 	the page will be redirected together with the error message.
	 * 
	 * @param String $amo_template_slug The template slug
	 * @return void
	 */
	public function validateFields($amo_template_slug){
		
		if( empty($amo_template_slug) ) {
			wp_redirect('admin.php?page=auto_movie&msg='.urlencode(__('空では実行できません。')));
			exit;
		}
		
		if ( !preg_match("/^[a-zA-Z0-9_\\-]+$/",$amo_template_slug)) {
			wp_redirect('admin.php?page=auto_movie&msg='.urlencode(__('半角英数で入力お願いします。')));
			exit;
		}
	}
	
	
	// form
	public function auto_movie_form() {
		$msg = "";
		if (isset($_GET['msg']) && !empty($_GET['msg'])) {
			$msg = urldecode($_GET['msg']);
		}
		echo '
				
		<h2>設定</h2>
		'.$msg.'
		<form action="" method="post">
			<p><label for="slug">'.__("Auto Theaters Template Slug").':</label><input type="text" id="slug" name="'.$this->amo_template_slug.'"  required="required" /></p>
			<input type="hidden" name="amo_make_template_flg" value="1" />
			<p>' . wp_nonce_field('amo_make_template') . '</p>
			<p><input type="submit" value="'.__("作成").'" class="button button-primary" /></p>
		</form>
		';
	}
	
	
	
	
	// xlsx from html
	public function get_theaters_html() {
		
		
		
		
		
		return $html;
	}
	
	public function add_movie_post_type() {

		$labels = array(
			'name' => 'movie',
			'singular_name' => 'movie',
			'add_new' => 'movie新規追加',
			'add_new_item' => 'movieを新規追加',
			'edit_item' => 'movieを編集する',
			'new_item' => '新規movie',
			'all_items' => 'movie一覧',
			'view_item' => 'movieの説明を見る',
			'search_items' => '検索する',
			'not_found' => 'movieが見つかりませんでした。',
			'not_found_in_trash' => 'ゴミ箱内にmovieが見つかりませんでした。'
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'supports' => array('title','editor','thumbnail','custom-fields','excerpt','author','trackbacks','comments','revisions','page-attributes'),
			'has_archive' => true
		);
		register_post_type('movie', $args);
	}

}

function custom_post_archive_orderby_menu_order( $wp_query ) {
	if ( $wp_query->is_post_type_archive() && post_type_supports( $wp_query->query_vars['post_type'], 'page-attributes' ) ) {
		if ( ! isset( $wp_query->query_vars['orderby'] ) ) {
			$wp_query->query_vars['orderby'] = 'menu_order';
		}
		if ( ! isset( $wp_query->query_vars['order'] ) ) {
			$wp_query->query_vars['order'] = 'ASC';
		}
	}
}
add_action( 'pre_get_posts', 'custom_post_archive_orderby_menu_order' );


function movie_popup_action(){
	
	if($_COOKIE["movie_popup_page"]){ return ; }
	setcookie("movie_popup_page" , 1 , time() + 60 * 60);
	
	function popup_scripts() {
		wp_register_script('colorboxscript', plugin_dir_url(__FILE__).'/js/jquery.colorbox.js');
		wp_enqueue_script('colorboxscript');
		wp_register_style('colorboxcss', plugin_dir_url(__FILE__) . '/css/colorbox.css');
		wp_enqueue_style( 'colorboxcss');
	}
	add_action( 'wp_enqueue_scripts', 'popup_scripts' );
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>
	jQuery(document).ready(function(){
		jQuery('#show_popup').click(function (event, target_url) {
			jQuery.colorbox({href:target_url, iframe:true, open:true, scrolling:false, width:855, height:564 ,maxWidth:'95%', speed:'200'});
			
			setTimeout(resizeEvent,1000);
			function resizeEvent() {
				var tmp_height = jQuery('iframe.cboxIframe').contents().find('div#wrapper').css("height").replace("px","");
				jQuery("#colorbox").css("height", parseInt(tmp_height) + 33 + "px");
				jQuery("#cboxWrapper").css("height", parseInt(tmp_height) + 33 + "px");
				jQuery("#cboxContent").css("height", parseInt(tmp_height) + 33 + "px");
				jQuery("#cboxLoadedContent").css("height", parseInt(tmp_height) + 33 + "px");
			}
		});
	});
	</script>
<?php
}


function movie_popup_page($atts) {
	
	add_action( 'after_setup_theme', 'movie_popup_action' );
	
	extract(shortcode_atts(array(
		'target_url' => '',
	), $atts));
	
	$return_html = "
	<span id='show_popup'></span>
	<script>
		jQuery(document).ready(function(){
			jQuery('#show_popup').trigger('click', ['{$target_url}']);
		});
	</script>
";
	return $return_html;
}
add_shortcode('movie_popup_page', 'movie_popup_page');


function is_mobile(){
	$useragents = array(
			'iPhone',          // iPhone
			'iPod',            // iPod touch
			'Android',         // 1.5+ Android
			'dream',           // Pre 1.5 Android
			'CUPCAKE',         // 1.5+ Android
			'blackberry9500',  // Storm
			'blackberry9530',  // Storm
			'blackberry9520',  // Storm v2
			'blackberry9550',  // Storm v2
			'blackberry9800',  // Torch
			'webOS',           // Palm Pre Experimental
			'incognito',       // Other iPhone browser
			'webmate'          // Other iPhone browser
	);
	$pattern = '/'.implode('|', $useragents).'/i';
	return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}



?>
