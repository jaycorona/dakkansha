<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<title lang="ja" xml:lang="ja"><?php wp_title( '|', true, 'right' ); ?></title>

 
<meta name="description" content="タランティーノが“「マッドマックス」以来の傑作！”と叫んだ世紀末バイオレンス・チェイス・ムービー!!　世界経済の崩壊から１０年、無法者たちの巣窟と化したオーストラリア。暗黒の大地に負け犬たちの逆襲がはじまる…。" />
<meta name="keywords" content="奪還者,アニマル・キングダム,マッドマックス,クエンティン・タランティーノ,ガイ・ピアース,ロバート・パティンソン,世紀末,近未来,カー・チェイス,デヴィッド・ミショッド,ジョエル・エドガートン,映画"/>
<meta name="robots" content="index,follow" />
<meta name="twitter:widgets:csp" content="on">
<link rel="shortcut icon" href="" type="image/x-icon">
<link rel="icon" href="" type="image/x-icon">


<link href='http://fonts.googleapis.com/css?family=Bevan' rel='stylesheet' type='text/css'>

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
var wp_template_directory = '<?php echo bloginfo('template_directory'); ?>';
</script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/jquery.cookie.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/utils.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/jquery.poptrox.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/jquery.scrolly.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/jquery.scrollgress.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/jquery.imagesloaded.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/colorbox/jquery.colorbox-min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/lemmon-slider/lemmon-slider.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/common/js/skel.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/config.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/common.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/init.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/index.js"></script>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

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
                        echo "<li><a href='javascript:void(0);' id='{$obj->attr_title}' >{$obj->title}</a></li>";
                    } else {
                        echo "<li><a href='{$obj->url}' >{$obj->title}</a></li>";
                    }
                }
                ?>
               <li><a href="https://www.facebook.com/dakkansha.jp" target="_blank">FACEBOOK<!--<i class="fa fa-facebook">--></i></a></li>
               <li><a href="https://twitter.com/dakkansha" target="_blank">TWITTER</a></li>          
            	<!-- <li><a href="https://twitter.com/nurse_redband" target="_blank"><i class="fa fa-twitter"></i></a></li> -->
            </ul>
        </nav>
        
        <!--********* 
        @Navi(SP)
        ************-->
        <nav id="sp-nav">
            <ul class="clearfix">
              <!--  <?php 
                $items = wp_get_nav_menu_items('navi');
                foreach ($items as $obj) {
                    echo "<li><a href='{$obj->url}'>{$obj->title}</a></li>";
                }
                ?>--> 
                <li><a href="https://youtu.be/sAs5eA5Wetw" target="_blank">TRAILER</a></li>
                <li><a href="https://www.facebook.com/dakkansha.jp" target="_blank">FACEBOOK</a></li>
                <li><a href="https://twitter.com/dakkansha" target="_blank">TWITTER</a></li>          
            </ul>
        </nav>
        
        <div id="drawer-btn-container">
            <div id="drawer-btn">
                <span>&nbsp;</span>
                <span>&nbsp;</span>
                <span>&nbsp;</span>
            </div>
        </div>
        <!--
        <div id="share-btn-container">
            <p id="share-btn">SHARE</p>
        </div>
        -->
        <!-- SNS -->
        <!--
        <ul id="share-container" class="social-container">
            <li><iframe src="//www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;layout=button&amp;appId=294395577405097" scrolling="no" frameborder="0" style="border:none; overflow:hidden;" allowTransparency="true"></iframe></li>
        	<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://redband.jp" data-text="最強無敵のエンタテインメント・ラインREDBAND公式" data-lang="ja" data-count="none">ツイート</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
        </ul> --><!--social-container-->
        
    </header><!--/header-->
    
    