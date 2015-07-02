<?php
/*
 Plugin Name: auto_make_theaters_page
 Plugin URI: 
 Description: It is a plug-in to implement the facebook api.
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

$Ath = new Ath();
class Ath
{
	
	// the directory name relative to the template directory
	// where the page templates will be saved.
	// Very useful for much organized looking file system.
	// leave blank if you want the templates to be stored
	// in the theme's root directory.
	private $templates_storage_dir_name = "theaters_templates";
	
	private $ath_xlsx_file      = 'ath_xlsx_file';
	private $ath_template_slug  = 'ath_template_slug';
	private $ath_template_base  = "
<?php
/**
 * Template Name: {#ath_theaters_slug#}
 * Description: auto made by auto_make_theaters_page plugin
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */	
			
get_header(); 
?>			
<div id=\"main-content\" class=\"main-content\">
<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
<link href=\"<?php echo get_template_directory_uri().\"/{#ath_theaters_dir#}/page-{#ath_theaters_slug#}.css\";?>\" rel=\"stylesheet\" type=\"text/css\" />			
			
	<div id='primary' class='site-content'>
		<div id='content' role='main'>

			{#ath_theaters_list#}

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->		

<?php get_footer(); ?>

";
	
	//--------------------------------------------------------------------------
	//
	//  ini
	//
	//--------------------------------------------------------------------------
	public function __construct() {
		// about menu
		add_action('admin_menu', array($this, 'add_menu_ath'));
		
		// about exec post
		if (isset($_POST['ath_make_template_flg']) && !empty($_POST['ath_make_template_flg'])) {
			add_action('admin_init', array($this, 'auth_exec'));
		}
		
	}
	/*
	 *  side menu
	 */
	public function add_menu_ath() {
		add_menu_page(__('Auto Theaters'), __('Auto Theaters'), 0, 'auto_theaters', array($this, 'auto_theaters_form'), null, 2);
		
	}
	
	
	// exec 
	public function auth_exec() {
		
		check_admin_referer('ath_make_template');
		
		$ath_xlsx_file     = $_POST[$this->ath_xlsx_file];
		$ath_template_slug = $_POST[$this->ath_template_slug];
		
		$theaters_html = $this->get_theaters_html($ath_xlsx_file);
		
		
		// IMPORTANT!
		// input validation
		// we need to make sure that the file, passed is and .xlsx file
		$this->validateFields($ath_xlsx_file , $ath_template_slug);
		
		
		$map = array(
			"{#ath_theaters_list#}" => $theaters_html,
			"{#ath_theaters_slug#}" => $ath_template_slug,
			"{#ath_theaters_dir#}"	=> $this->templates_storage_dir_name
		);
		
		$this->ath_template_base = str_replace(array_keys($map), array_values($map), $this->ath_template_base);
		
		
		$destination_dir = null;
		if ( empty($this->templates_storage_dir_name) ) {
			$destination_dir = get_template_directory()."/";
		} else {
			$destination_dir = get_template_directory()."/".$this->templates_storage_dir_name."/";
		}

		
		!is_dir($destination_dir) && mkdir($destination_dir);
		
		$template_file_name = $destination_dir."page-{$ath_template_slug}.php";
		$template_style_name = $destination_dir."page-{$ath_template_slug}.css";	
		
		$css_buffer = "";
		$styles = array(
				//"html5reset-1.6.1.css",
				"common-reset.css",
				"common-modules.css",
				"common-style.css",
				"style.css"	);
		
		foreach ($styles as $style ){
			$css_buffer .= file_get_contents(plugin_dir_path(__FILE__)."styles/".$style);
		}
		
		file_put_contents( $template_file_name, $this->ath_template_base );
		file_put_contents( $template_style_name, $css_buffer);
		
		wp_redirect('admin.php?page=auto_theaters&msg='.urlencode('更新しました。'));
		
	}
	
	
	/**
	 * 	Method which will validate the inputs. If an input is found invalid, 
	 * 	the page will be redirected together with the error message.
	 * 
	 * @param String $ath_xlsx_file The xlsx file path
	 * @param String $ath_template_slug The template slug
	 * @return void
	 */
	public function validateFields($ath_xlsx_file, $ath_template_slug){
		if ( !preg_match("/^.*\\.xlsx$/",$ath_xlsx_file) ) {
			wp_redirect('admin.php?page=auto_theaters&msg='.urlencode(__('Invalid file extension! Only accepts a file with <strong>.xlsx</strong> extension')));
			exit;
		}
		
		if( empty($ath_template_slug) ) {
			wp_redirect('admin.php?page=auto_theaters&msg='.urlencode(__('Template Slug name field can not be empty!')));
			exit;
		}
		
		if ( !preg_match("/^[a-zA-Z0-9_\\-]+$/",$ath_template_slug)) {
			wp_redirect('admin.php?page=auto_theaters&msg='.urlencode(__('Invalid slug name!')));
			exit;
		}
	}
	
	
	
		
	// form
	public function auto_theaters_form() {
		$msg = null;
		if (isset($_GET['msg']) && !empty($_GET['msg'])) {
				echo "<h2>".__("設定")."</h2>";
				echo urldecode($_GET['msg']);
				echo "<br /><a href=\"javascript:window.history.back()\">".__("Return")."</a>";
				return;
		}
		echo '
		<script language="JavaScript">
			jQuery(document).ready(function() {
				
				if ( jQuery("#xlsxi").val().length > 0 ){		
					var __s = jQuery("#xlsxi").val().split("/");
					jQuery("#xlsxf").html(__s[__s.length-1]);
				}
				
				jQuery(\'#xlsx\').click(function() {
					tb_show(\'\', \'media-upload.php?type=file&TB_iframe=true\');
					return false;
				});
				window.send_to_editor = function(html) {
					var pattern = /^<a href=\'(.*)\'.*$/;
					var url = "";
						if ( html.match(pattern) ) {
							url = html.replace(pattern,"$1");
						}
					jQuery("#xlsxi").val(url);
					var __s = url.split("/");
					jQuery("#xlsxf").html(__s[__s.length-1]);
					tb_remove();
				}
				$slug = jQuery("#slug");
				jQuery("#name").keyup(function(){
					$slug.val(jQuery(this).val().trim().replace(/\s/g,"-"));
				});	
			});
		</script>		
		<style type="text/css">
			.auto-theaters label{
				display:inline-block;
				min-width:200px;
			}
		</style>
				
		<h2>設定</h2>
		'.$msg.'
		<form action="" method="post" class="auto-theaters">
			<input type="hidden" id="xlsxi" name="'.$this->ath_xlsx_file.'" />
			<p><label for="xlsx">'.__("Auto Theaters XLSX File").':</label><button id="xlsx">'.__("Choose file").'</button><span id="xlsxf"></span></p>
			<p><label for="slug">'.__("Auto Theaters Template Slug").':</label><input type="text" id="slug" name="'.$this->ath_template_slug.'"  required="required" /></p>
			<input type="hidden" name="ath_make_template_flg" value="1" />
			<p>' . wp_nonce_field('ath_make_template') . '</p>
			<p><input type="submit" value="'.__("作成").'" class="button button-primary" /></p>
		</form>
		';
		

			
	}
	
	
	
	
	// xlsx from html
	public function get_theaters_html($file_path) {
		$html = null;
		
		// include the auto_theaters class
		include plugin_dir_path(__FILE__).'lib/auto_theaters.class.php';
		
		
		// the pattern to use when validating the url and extracting path
		$pattern = "/^https?:\/\/.*\/wp-content\/uploads\/(.*)$/";
		$upload_dir = wp_upload_dir();
		
		if(preg_match($pattern,$file_path) === 1) {
			
			// extract path from the url
			$extract_relative_path = preg_replace($pattern,"$1",$file_path);
			
			// path to the .xlsx file
			$absolute_path = $upload_dir["basedir"]."/".$extract_relative_path;
			
			
			// instantiate the AutoTheater class.
			$auto_theater = new AutoTheater();
			
			// read data from the .xlsx file
			$auto_theater->readXlsx($absolute_path);
			
			// fetch the resulting html output
			$html = $auto_theater->getHtml();
		} 
		
		
		return $html;
	}

}



	

	// scripts needed by the wordpress media uploader
	function wp_gear_manager_admin_scripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery');
	}
	
	function wp_gear_manager_admin_styles() {
		wp_enqueue_style('thickbox');
	}
	
	add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
	add_action('admin_print_styles', 'wp_gear_manager_admin_styles');


	
	

?>
