<?php
/*
 Plugin Name: fb2wp
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

date_default_timezone_set('Asia/Tokyo');

$Fb2Wp = new Fb2Wp();
class Fb2Wp
{
	private $app_id_key       = 'fb2wp_app_id';
	private $secret_key       = 'fb2wp_secret';
	private $access_token_key = 'fb2wp_access_token';
	private $target_fb_id     = 'fb2wp_target_fb_id';
	
	//--------------------------------------------------------------------------
	//
	//  ini
	//
	//--------------------------------------------------------------------------
	public function __construct() {
		// about menu
		add_action('admin_menu', array($this, 'add_menu_fb2wp'));
		
		// about exec post
		if (isset($_POST['fb2wp_exec_flg']) && !empty($_POST['fb2wp_exec_flg'])) {
			add_action('admin_init', array($this, 'fb2wp_exec'));
		}
		
		// about setting post
		if (isset($_POST['fb2wp_config_flg']) && !empty($_POST['fb2wp_config_flg'])) {
			add_action('admin_init', array($this, 'fb2wp_setting_update'));
		}
		
		// receive token
		if (isset($_REQUEST['fb2wp_receive_token_flg']) && !empty($_REQUEST['fb2wp_receive_token_flg'])) {
			add_action('admin_init', array($this, 'fb2wp_receive_token'));
		}

	}
	/*
	 *  side menu
	 */
	public function add_menu_fb2wp() {
		add_menu_page('fb2wp', 'fb2wp', 0, 'fb2wp', array($this, 'fb2wp_exec_form'), null, 1);
		add_submenu_page('fb2wp', 'fb2wp設定', 'fb2wp設定', 0, 'fb2wp_config', array($this, 'set_config'));
	}
	
	//--------------------------------------------------------------------------
	//
	//  exec
	//
	//--------------------------------------------------------------------------
	// exec 
	
	public function fb2wp_exec() {
		
		check_admin_referer('fb2wp_exec');
		
		//$this->fb2wp_run();
		aout_update_fb2wp();
		
		// redirect
		wp_redirect('admin.php?page=fb2wp&msg=ok');
	}
	
	/*
	public function fb2wp_run() {
	
		// get feed
		$feed = $this->get_feed();
	
		// post feed
		$this->post_feed_to_wp($feed);
		
		// get albums
		//$albums = $this->get_albums();
		// post albums
		//$this->post_albums_to_wp($albums);
	
		// get cover
		$cover=$this->get_cover();
		// post cover
		$this->post_cover_to_wp($cover);
	
		//$cover=$this->post_cover_to_wp();
	
	}
	*/
	
	
	
	
	
	//--------------------------------------------------------------------------
	//
	//  config
	//
	//--------------------------------------------------------------------------
	
	// show form
	public function fb2wp_exec_form() {
		$msg = null;
		if (isset($_GET['msg']) && !empty($_GET['msg'])) {
			if ($_GET['msg'] === 'ok') {
				$msg = '実行しました。';
			}
		}
		echo '
		<h2>実行画面</h2>
		'.$msg.'
	
		<p>app id       : ' . get_option($this->app_id_key)       . '</p>
		<p>secret_key   : ' . get_option($this->secret_key)       . '</p>
		<p>access_token : ' . get_option($this->access_token_key) . '</p>
		<p>target fb id : ' . get_option($this->target_fb_id)     . '</p>
	
		<form action="" method="post">
			<p>' . wp_nonce_field('fb2wp_exec') . '</p>
			<input type="hidden" name="fb2wp_exec_flg" value="1" /></p>
			<p><input type="submit" value="実行する" class="button button-primary" /></p>
		</form>
		';
	}
	
	// update
	public function fb2wp_setting_update() {
		
		check_admin_referer('fb2wp_config');
		
		update_option($this->app_id_key,       $_POST[$this->app_id_key]);
		update_option($this->secret_key,       $_POST[$this->secret_key]);
		update_option($this->target_fb_id,     $_POST[$this->target_fb_id]);
		
		$token = $this->get_access_token();
	}
	
	public function fb2wp_receive_token() {
		
		$token = $this->get_access_token();
		if ($token['access_token']) {
			update_option($this->access_token_key, $token['access_token']);
			// redirect
			wp_redirect('admin.php?page=fb2wp_config&msg=ok');
		}
	}
	
	
	// show form
	public function set_config() {
		$msg = null;
		if (isset($_GET['msg']) && !empty($_GET['msg'])) {
			if ($_GET['msg'] === 'ok') {
				$msg = '更新しました。';
			}
		}
		echo '
		<h2>設定</h2>
		'.$msg.'
		<form action="" method="post">
			<p>app id       :<input type="text" name="'.$this->app_id_key.'"       value="'.get_option($this->app_id_key).'" /></p>
			<p>secret_key   :<input type="text" name="'.$this->secret_key.'"       value="'.get_option($this->secret_key).'" /></p>
			<p>target fb id :<input type="text" name="'.$this->target_fb_id.'"     value="'.get_option($this->target_fb_id).'" /></p>
			<input type="hidden" name="fb2wp_config_flg" value="1" />
			<p>' . wp_nonce_field('fb2wp_config') . '</p>
			<p><input type="submit" value="登録" class="button button-primary" /></p>
		</form>
		';
	}
	
	
	//--------------------------------------------------------------------------
	//
	//  functions
	//
	//--------------------------------------------------------------------------
	public function get_access_token() {
		
		session_start();
		
		$client_id     = get_option($this->app_id_key); 
		$client_secret = get_option($this->secret_key); 
		$redirect_uri  = admin_url() . '/admin.php?page=fb2wp_config&fb2wp_receive_token_flg=1';
		
		$code = $_REQUEST['code'];
		$error = $_REQUEST['error'];
		$error_reason = $_REQUEST['error_reason'];
		$error_description = $_REQUEST['error_description'];
		
		if (empty($code) && empty($error)) {
		
			$_SESSION['state'] = md5(uniqid(rand(), TRUE));

			header('Location: https://graph.facebook.com/oauth/authorize'
					. '?client_id=' . $client_id
					. '&redirect_uri=' . urlencode($redirect_uri)
					. '&scope=publish_stream,read_stream'
							. '&display=popup'
									. '&state=' . $_SESSION['state']);
		} else {
		
			if (!empty($code)) {
				if($_REQUEST['state'] == $_SESSION['state']) { // CSRF protection
					$token_url = 'https://graph.facebook.com/oauth/access_token'
							. '?client_id=' . $client_id
							. '&redirect_uri=' . urlencode($redirect_uri)
							. '&client_secret=' . $client_secret
							. '&code=' . $code
							. '&grant_type=client_credentials';
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $token_url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$token = curl_exec($ch);
					$array = array();
					parse_str($token, $array);
					return $array;
				}
		
			} else if (!empty($error)) {
				echo 'error:' . $error
				. '/error_reason:' . $error_reason
				. '/error_description:' . $error_description;
			}
		}
	}
	
	/*
	 *  get feed
	 */
	public function get_feed() {
		
		
		$appId        = get_option($this->app_id_key);
		$secret       = get_option($this->secret_key);
		$id           = get_option($this->target_fb_id);
		$access_token = get_option($this->access_token_key);
		
		require_once 'src/facebook.php';
		
		$facebook = new Facebook(array('appId' => $appId, 'secret' => $secret));
		$feed = $facebook->api($id.'/feed/?limit=50', 'GET', array('access_token' => $access_token));
		$video = $facebook->api($id.'/videos/?fields=id', 'GET', array('access_token' => $access_token));
		
		$feedarr= array( 'feed'=>$feed,'video'=>$video);
		
		return $feedarr;
		
	}
	
	//--------------------------------------------------------------------------
	//
	//  get from fb
	//
	//--------------------------------------------------------------------------
	/*
	 *  get albums
	 */
	public function get_albums() {
		

		$appId        = get_option($this->app_id_key);
		$secret       = get_option($this->secret_key);
		$id           = get_option($this->target_fb_id);
		$access_token = get_option($this->access_token_key);
		
		require_once 'src/facebook.php';
		
		$facebook = new Facebook(array('appId' => $appId, 'secret' => $secret));
		$albums = $facebook->api('/albums/?limit=1000', 'GET', array('access_token' => $access_token));
		
		return  $albums;
	}

	
	/*
	 *  get cover photo
	 */
	public function get_cover() {
		$appId        = get_option($this->app_id_key);
		$secret       = get_option($this->secret_key);
		$id           = get_option($this->target_fb_id);
		$access_token = get_option($this->access_token_key);
		
		require_once 'src/facebook.php';
		
		$facebook = new Facebook(array('appId' => $appId, 'secret' => $secret));
		
		$photocover = $facebook->api($id.'?fields=cover', 'GET', array('access_token' => $access_token));
		
		$photo=$photocover['cover'];
		$photo_id=$photo['cover_id'];
		
		$cover = $facebook->api($photo_id.'?fields=images', 'GET', array('access_token' => $access_token));
		
		return $cover;		
	}
	
	
	//--------------------------------------------------------------------------
	//
	//  post to wp
	//
	//--------------------------------------------------------------------------

	/*
	 *  post feed
	 */
	public function post_feed_to_wp($data) {
		
		require_once( ABSPATH . 'wp-load.php');
		require_once('class-wp_post_helper.php');
		
		set_time_limit(0);
		ini_set('memory_limit', '1024M');
		
		wp_create_category ( 'news' );
		$category_id = $this->get_category_id('news');
		
		$arrfeed= $data['feed'];
		$arrvid= $data['video'];
					
		$data=$arrfeed['data'];
		$vvid= $arrvid['data'];
		$x=array();
		foreach($vvid as $id){ $x[]= $id['id']; }
		
		if (!isset($data) || empty($data)) { return; }
		
		foreach($data as $feed){
			
			$feed_id = $feed["id"];
			
			if ($feed["to"]) { continue; }
			if (!$feed["message"]) { continue; }
			if ($this->get_id_by_post_name($feed_id)) {continue;}
			
			$post_ymdhis = date("Y/m/d h:i:s", strtotime($feed['created_time']));
			
			/********** start add title**********/			
			$txt=$feed["message"];
			preg_match_all("/\【(.*?)\】/", $txt, $matches);
			if(count($matches[1])>0){
				foreach($matches[1] as $key=> $value){ if($key==0){ $post_title=$value;}}					
			}else{ $post_title="";}
			
			/********remove bracket************/			
			$message =preg_replace('/\【.*?\】/', '', $feed["message"]);
			$reg_exUrl = "/((((http|https|ftp|ftps)\:\/\/)|www\.)[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,4}(\/\S*)?)/";
			$newfeed= preg_replace( $reg_exUrl, "<a href=\"$1\">$1</a> ", $message );
			
			$post = new wp_post_helper(array(
				'post_name' 		=> $feed_id,
				'post_author'		=> 1 ,
				'post_date'			=>  $post_ymdhis,
				'post_password'		=> '',
				'post_type'			=> 'post' ,
				'post_status'		=> 'publish',
				'comment_status'	=> '' ,
				'ping_status'		=> 'open' ,
				'post_title'		=> $post_title,
				'post_content'		=> $newfeed,
				'page_template'		=> 'default' ,
				'post_parent'		=> 0 ,
				'post_category'		=> array($category_id) ,
				'post_tags'			=> array()
			));
			$media=null;
			if (!$feed["picture"]) { continue; }
			
			// gat file name
			$pic_file_name = $feed["picture"];
			if ( strpos($pic_file_name, "?") !== false ) {
				$tmp = explode("?", $pic_file_name);
				$pic_file_name = basename($tmp[0]);
			}
			$pic_file_name = basename($pic_file_name);
			
			// get origin size pic url when photo
			if ($feed['type'] == 'photo') {
				if (preg_match('|([^/]+).jpg|', $feed["picture"], $matches)) {
					$tmp = explode("_", $matches[1]);
					$picture_url = "https://graph.facebook.com/{$tmp[1]}/picture";
					$media = remote_get_file($picture_url, '', $pic_file_name);
				}
			}
			if (!$media){ $media = remote_get_file($feed["picture"], '', $pic_file_name); }
			if (!$media){ continue; }
			$post->add_media($media, 'タイトル', '説明', 'キャプション', false);
			
			// instert post
			$postid = $post->insert();
			
			// add video link
			if ($feed['type'] == 'video') {
				add_post_meta($postid,'video_link', $feed['link']);
			}
		} 
		return;
	}
	
	
	/*
	 *  post albums
	 */
	public function post_albums_to_wp($albums) {
	
		require_once( ABSPATH . 'wp-load.php');
		require_once('class-wp_post_helper.php');
		if (isset ( $albums ["data"] ) && ! empty ( $albums ["data"] )) {
			
			wp_create_category('Album');
			$cat_album_ID = $this->get_category_id('Album');
				
			foreach ( $albums as $object ) {
				foreach ( $object as $photo ) {
					wp_create_category ( $photo ["name"], $cat_album_ID);
					$cat_subalbum_ID = $this->get_category_id($photo ["name"]);
					
					
					if (isset ( $photo ['name'] )) {$photo_name = $photo ["name"];}
					if (isset ( $photo ['id'] )) {$photo_id = $photo ["id"];}
					
					if($photo['count']>=1){						
						try {
							$appId        = get_option($this->app_id_key);
							$secret       = get_option($this->secret_key);
							$id           = get_option($this->target_fb_id);
							$access_token = get_option($this->access_token_key);
						
							require_once 'src/facebook.php';						
						
							$facebook = new Facebook(array('appId' => $appId, 'secret' => $secret));						
							
							$fql = "SELECT object_id, src_big, caption, src_small, src FROM photo WHERE owner = 22092443056 AND album_object_id = '".$photo_id."' ORDER BY created DESC LIMIT 1000";
						
							$param  =   array('method'    => 'fql.query','query'     => $fql,'callback'  => '');

							$fqlResult =  $facebook->api($param);

							foreach( $fqlResult as $keys => $values ){
																						
								$albumpic = $values['src_big'];
								$albumpic_id=$values['object_id'];								
								$category_ID = $this->get_category_id($photo_name);
								$albumcontent = "<img src='{$albumpic}'/>";

								global $wpdb;
								$albumposts = $wpdb->get_var( "select count(meta_key) from $wpdb->postmeta where meta_value = '$albumpic_id'");
							
								if (empty($albumposts)){
		
									// 初期化
									$post = new wp_post_helper($post_array);
									
									$post->set(array(	
											'post_content' =>$albumcontent,
											'post_category'=>array($category_ID, $cat_album_ID),
											'post_status' => 'inhirit'
									));
									
									$postid = $post->insert();
									update_post_meta($postid,'Object_Id',$albumpic_id);
									
									if ($values['src_big']) {
										$picture_url = $this->get_fbcdn_origin_url($values['src_big']);
										if ( $media = remote_get_file($picture_url) ) {
											$post->add_media($media, 'タイトル', '説明', 'キャプション', false);
										}
									}																												
								}
								
							}
						
						}catch( FacebookRequestException $e ) {
 							$e->getTraceAsString ();
						}
					
					}					
				}
				break;
			}	
					
		} 
	
		return;
	}
	
	/*
	 *  post cover photo
	 */
	public function post_cover_to_wp($cover) {
				
		require_once( ABSPATH . 'wp-load.php');
		require_once('class-wp_post_helper.php');
		
			$photo_id=$cover['id'];
			$photo=$cover['images'];
			foreach($photo as $data){
				if($data['width']=="851"&&$data['height']=="315"){
					$photo_src=$data['source'];
				}
			}
			wp_create_category ( 'Cover Photos' );
			$category_ID = $this->get_category_id('Cover Photos');
			
			global $wpdb;			
		
			$exists_cover = $wpdb->get_results( "select post_id, meta_key from $wpdb->postmeta where meta_key = 'active_cover'and meta_value !='$photo_id'");				
				if (!empty($exists_cover)){
					foreach ($exists_cover as $key => $object) {
						$ref_cover_id= $object->post_id;
					}				
					$del_cover=$wpdb->get_results( "select meta_value from $wpdb->postmeta where meta_key = '_thumbnail_id'and post_id ='$ref_cover_id'");				
					if (!empty($del_cover)){
						foreach ($del_cover as $key => $object) {
							$page_cover_id= $object->meta_value;
						}
						wp_delete_post($ref_cover_id,true);
						wp_delete_post($page_cover_id, true);
						delete_post_meta( $ref_cover_id, '_thumbnail_id', $page_cover_id );
					}					
					delete_post_meta_by_key( 'active_cover');
				}								
				$posts = $wpdb->get_var( "select  count(meta_key) from $wpdb->postmeta where meta_value = '$photo_id'");					
				if (empty($posts)){	
					
					$post = new wp_post_helper($post_array);
						
					$media = null;			
					$post->set(array(
								
						'post_content' =>'<!-Add html code here->',
						'post_category'=>array($category_ID),
						'post_status' => 'inherit'
					));								

							$postid = $post->insert();
							update_post_meta($postid,'active_cover',$photo_id);
							
							if ($photo_src) {																								
								$picture_url = $this->get_fbcdn_origin_url($photo_src);
								if( $media = remote_get_file($picture_url)){										
									$post->add_media($media,$photo_id, '説明', 'キャプション', false);										
								}else{
									$img=$photo_src;
									$img_location = $this->save_file_to_local($img,"coverphoto_");
									if ( $media = remote_get_file($img_location) ) {
										$post->add_media($media, $photo_id, '説明', 'キャプション', false);
									}
										
										
								}
							}
				}
		
		return;		
	}
	
	public function get_category_id($cat_name){		
		$term = get_term_by('name', $cat_name, 'category');
		return $term->term_id;
	}
	
	
	public function get_fbcdn_origin_url($string) {
		$pattern = '/(\/s\d+x\d+|w=\d+&|h=\d+)/i';
		return preg_replace($pattern, '', $string);
	}
	
	public function get_id_by_post_name($post_name)
	{
		global $wpdb;
		$id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$post_name."'");
		return $id;
	}
	public function save_file_to_local($url, $absolute_path=""){
	
		$strip = explode("?",basename($url),2);
		$upload_dir = wp_upload_dir();
				
		file_put_contents($upload_dir['path']."/".$strip[0],@file_get_contents($url));
	
		return $upload_dir['url']."/".$strip[0];
	}
	
}




/*********************************************
 *   cron
 **********************************************/

function aout_update_fb2wp() {

	$Fb2Wp = new Fb2Wp();

	// get feed
	$feed = $Fb2Wp->get_feed();

	// post feed
	$Fb2Wp->post_feed_to_wp($feed);

	// get cover
	$cover = $Fb2Wp->get_cover();

	// post cover
	$Fb2Wp->post_cover_to_wp($cover);
	
	$file = plugin_dir_path( __FILE__ ) . 'cron-log.txt';
	file_put_contents($file, date("Y/m/d H:i:s") . "
", FILE_APPEND);
}

add_action('cron_fb2wp_main_v1', 'aout_update_fb2wp');

function my_activation() {
	if ( !wp_next_scheduled( 'cron_fb2wp_main_v1' ) ) {
		wp_schedule_event(time(), 'hourly', 'cron_fb2wp_main_v1');
	}
}
add_action('wp', 'my_activation');

// when delete plugin
register_deactivation_hook(__FILE__, 'my_deactivation');
function my_deactivation() {
	wp_clear_scheduled_hook('cron_fb2wp_main_v1');
}

// delete old version cron
wp_clear_scheduled_hook('my_cron');

?>
