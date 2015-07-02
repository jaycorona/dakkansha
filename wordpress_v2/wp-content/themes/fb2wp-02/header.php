<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<title lang="ja" xml:lang="ja"><?php wp_title( '|', true, 'right' ); ?></title>

<meta name="description" content="ベトナム戦争開戦から50年。その真実を暴き、アメリカでの反戦運動のきっかけとなった映画史上最高のドキュメンタリー、ついに日本初公開！「『ハーツ・アンド・マインズ』は、私がこれまでに見た最高のドキュメンタリーであるだけでなく、これまでに製作された中で最も素晴らしい映画だ！私が映画を作ろうとカメラを手にしたのは、今もまったく色あせることなく、意義ある作品であり続けるこの映画を見たからだ"/>
<meta name="keywords" content="映画,公式サイト,ハーツ＆マインズ,ベトナム戦争の真実,ベトナム帰還兵の告白"/>
<meta name="robots" content="index,follow" />

<!--OGP-->
<meta property="og:title" content="1974年アカデミー賞最優秀長編ドキュメンタリー賞受賞『ハーツ＆マインズ ベトナム戦争の真実』＜デジタル修復バージョン＞ || 2015年4月25日（土）より新宿武蔵野館、シネ・リーブル梅田にてロードショー" />
<meta property="og:type" content="movie" />
<meta property="fb:app_id" content="1545839505664927" />
<meta property="og:locale" content="ja_jp" />
<meta property="og:url" content="http://heartsandminds.eden-entertainment.jp/" />
<meta property="og:image" content="http://heartsandminds.eden-entertainment.jp/img/ogp.png" />
<meta property="og:site_name" content="1974年アカデミー賞最優秀長編ドキュメンタリー賞受賞『ハーツ＆マインズ ベトナム戦争の真実』＜デジタル修復バージョン＞ || 2015年4月25日（土）より新宿武蔵野館、シネ・リーブル梅田にてロードショー" />
<meta property="og:description" content="ベトナム戦争開戦から50年。その真実を暴き、アメリカでの反戦運動のきっかけとなった映画史上最高のドキュメンタリー、ついに日本初公開！「『ハーツ・アンド・マインズ』は、私がこれまでに見た最高のドキュメンタリーであるだけでなく、これまでに製作された中で最も素晴らしい映画だ！私が映画を作ろうとカメラを手にしたのは、今もまったく色あせることなく、意義ある作品であり続けるこの映画を見たからだ" />


<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/common/css/import.css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/common/colorbox/colorbox.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/common/lemmon-slider/lemmon-slider.css">
<noscript>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/skel.css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style-wide.css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style-normal.css" />
</noscript>
<!--[if lte IE 8]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie/v8.css" /><![endif]-->

<!--[if lte IE 8]><script src="<?php bloginfo('template_directory'); ?>/css/ie/html5shiv.js"></script><![endif]-->
<script>
var wp_template_directory = '<?php bloginfo('template_directory'); ?>';
</script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/jquery.cookie.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/utils.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/jquery.poptrox.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/jquery.scrollgress.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/jquery.imagesloaded.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/colorbox/jquery.colorbox-min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/lemmon-slider/lemmon-slider.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/skel.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/config.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/common.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/init.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/index.js"></script>

<!-- for jquery mcustom scroll bar do not delete, new feature-->
	<script src="<?php bloginfo('template_directory'); ?>/common/customscroll/jquery.mCustomScrollbar.concat.min.js"></script>
	<link  rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/common/customscroll/jquery.mCustomScrollbar.min.css" />
<!--  initialization ends here!!! -->
	
<script type="text/javascript">
	
(function($){
	$(window).load(function(){
		$("#top").mCustomScrollbar({});
		$(".style2").mCustomScrollbar({});
		$("#cast").mCustomScrollbar({});
		$("#staff").mCustomScrollbar({});
	});
})(jQuery);
</script>

	
</head>
<body>
<div id="wrapper">
    
    <!--********* 
    @Header 
    ************-->
    <header id="header">
        
        <!--********* 
        @Navi(PC)
        ************-->
        <nav id="pc-nav">
            <ul>
                <?php 
                $items = wp_get_nav_menu_items('navi');
                foreach ($items as $obj) {
                     if ($obj->attr_title) {
                        echo "<li><a href='javascript:void(0);' id='{$obj->attr_title}' target='{$obj->target}'>{$obj->title}</a></li>";
                    } else if($obj->ID==820||$obj->post_name=="theaters"||$obj->post_name=="theaters-3") {
                    	echo "<li><a href='{$obj->url}' id='theater' target='_blank'>{$obj->title}</a></li>";
                    } else {
                        echo "<li><a href='{$obj->url}' target='{$obj->target}'>{$obj->title}</a></li>";
                    }
                }
                ?>
                <li><a href="https://www.facebook.com/heartsandminds.jp" target="_blank">最新情報<span style="font-size:10px">(facebook)</span></a></li>
                <li><a href="https://twitter.com/HEARTS40years" target="_blank">Twitter</a></li>
            </ul>
        </nav>
        
        <!--********* 
        @Navi(SP)
        ************-->
        <nav id="sp-nav">
            <ul class="clearfix">
                <?php 
                $items = wp_get_nav_menu_items('navi');
                foreach ($items as $obj) {
                    echo "<li><a href='{$obj->url}' target='{$obj->target}'>{$obj->title}</a></li>";
                }
                ?>
                <li><a href="https://www.facebook.com/heartsandminds.jp" target="_blank">最新情報</a></li>
                <li><a href="https://twitter.com/HEARTS40years" target="_blank">Twitter</a></li>
            </ul>
        </nav>
        
        <div id="drawer-btn-container">
            <div id="drawer-btn">
                <span>&nbsp;</span>
                <span>&nbsp;</span>
                <span>&nbsp;</span>
            </div>
        </div>
        
        <div id="share-btn-container">
            <p id="share-btn">SHARE</p>
        </div>
        
        <!-- SNS -->
        <ul id="share-container" class="social-container">
            <li>
            <iframe src="//www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fredband.jp%2Fmadnurse%2F&amp;layout=button_count&amp;appId=294395577405097" scrolling="no" frameborder="0" style="border:none; overflow:hidden;" allowTransparency="true"></iframe>
            </li>
            <li><a class="twitter-share-button" href="https://twitter.com/share" data-related="twitterdev" data-size="medium" data-count="none">Share</a><script>
				window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
			</script></li>
        </ul><!--social-container-->
        
    </header><!--/header-->
    
    