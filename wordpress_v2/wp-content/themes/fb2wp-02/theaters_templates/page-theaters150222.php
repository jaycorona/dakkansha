
<?php
/**
 * Template Name: theaters150222
 * Description: auto made by auto_make_theaters_page plugin
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */	
			
get_header(); 
?>			
<div id="main-content" class="main-content">
<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
<link href="<?php echo get_template_directory_uri()."/theaters_templates/page-theaters150222.css";?>" rel="stylesheet" type="text/css" />			
			
	<div id='primary' class='site-content'>
		<div id='content' role='main'>

			<section id="section-container">
	<div id="kanto" class="wrap">
		<div align="center" class="arealist paddingB30">
			<a href="#tohoku">北海道・東北</a>　｜　
			<a href="#kanto">関東・甲信越</a>　｜　
			<a href="#hokuriku">中部・北陸</a>　｜　
			<a href="#kinki">近畿　</a>　｜　
			<a href="#shikoku">中国・四国</a>　｜　
			<a href="#okinawa">九州・沖縄</a>
		</div>
		<section class="article-container">
			<p class="area">関東・甲信越</p>
			<article class="top-header clearfix" >
				<p class="t1">都道府県</p>
				<p class="t2">劇場名</p>
				<p class="t3">公開日</p>
			</article>
		</section>
		<section class="article-container list-all">
			<article class="clearfix">
				<p class="t1">東京</p>
				<p class="t2"><a href="http://shinjuku.musashino-k.jp/" target="_blank">新宿武蔵野館</a></p>
				<p class="t3">4/25（土）～</p>
			</article>
		</section>
	</div>
	<div id="kinki" class="wrap">
		<div align="center" class="arealist paddingB30">
			<a href="#tohoku">北海道・東北</a>　｜　
			<a href="#kanto">関東・甲信越</a>　｜　
			<a href="#hokuriku">中部・北陸</a>　｜　
			<a href="#kinki">近畿　</a>　｜　
			<a href="#shikoku">中国・四国</a>　｜　
			<a href="#okinawa">九州・沖縄</a>
		</div>
		<section class="article-container">
			<p class="area">近畿</p>
			<article class="top-header clearfix" >
				<p class="t1">都道府県</p>
				<p class="t2">劇場名</p>
				<p class="t3">公開日</p>
			</article>
		</section>
		<section class="article-container list-all">
			<article class="clearfix">
				<p class="t1">大阪</p>
				<p class="t2"><a href="http://www.ttcg.jp/cinelibre_umeda/" target="_blank">シネ・リーブル梅田</a></p>
				<p class="t3">4/25（土）～</p>
			</article>

			<article class="clearfix">
				<p class="t1">京都</p>
				<p class="t2"><a href="http://www.kyotocinema.jp/" target="_blank">京都シネマ</a></p>
				<p class="t3"> 5月予定</p>
			</article>

			<article class="clearfix">
				<p class="t1">神戸</p>
				<p class="t2"><a href="http://www.motoei.com/" target="_blank">元町映画館</a></p>
				<p class="t3"> 5月予定</p>
			</article>
		</section>
	</div>
	<div id="hokuriku" class="wrap">
		<div align="center" class="arealist paddingB30">
			<a href="#tohoku">北海道・東北</a>　｜　
			<a href="#kanto">関東・甲信越</a>　｜　
			<a href="#hokuriku">中部・北陸</a>　｜　
			<a href="#kinki">近畿　</a>　｜　
			<a href="#shikoku">中国・四国</a>　｜　
			<a href="#okinawa">九州・沖縄</a>
		</div>
		<section class="article-container">
			<p class="area">中部・北陸</p>
			<article class="top-header clearfix" >
				<p class="t1">都道府県</p>
				<p class="t2">劇場名</p>
				<p class="t3">公開日</p>
			</article>
		</section>
		<section class="article-container list-all">
			<article class="clearfix">
				<p class="t1">名古屋</p>
				<p class="t2"><a href="http://cineaste.jp/" target="_blank">名古屋シネマテーク </a></p>
				<p class="t3">5月予定</p>
			</article>
		</section>
	</div>
	<div id="okinawa" class="wrap">
		<div align="center" class="arealist paddingB30">
			<a href="#tohoku">北海道・東北</a>　｜　
			<a href="#kanto">関東・甲信越</a>　｜　
			<a href="#hokuriku">中部・北陸</a>　｜　
			<a href="#kinki">近畿　</a>　｜　
			<a href="#shikoku">中国・四国</a>　｜　
			<a href="#okinawa">九州・沖縄</a>
		</div>
		<section class="article-container">
			<p class="area">北海道・東北</p>
			<article class="top-header clearfix" >
				<p class="t1">都道府県</p>
				<p class="t2">劇場名</p>
				<p class="t3">公開日</p>
			</article>
		</section>
		<section class="article-container list-all">
			<article class="clearfix">
				<p class="t1">沖縄</p>
				<p class="t2"><a href="http://www.sakura-zaka.com/" target="_blank">桜坂劇場</a></p>
				<p class="t3">5月予定</p>
			</article>
		</section>
	</div>
</section>


		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->		

<?php get_footer(); ?>

