<?php get_header(); ?>
<script type="text/javascript">
// $(document).ready(function(){
// 	if($(window).width() <= '1024'){
// 		$('.like-btn').css({'margin-top':'-11px','margin-left':'-80px'});
// 	}
// 	else{
// 		$('.like-btn').css({'margin-top':$('#top-bg').height()-98+'px','margin-left':'0'});
// 	}
// });

// $(window).resize(function(){
// 	if($(window).width() <= '1024'){
// 		$('.like-btn').css({'margin-top':'-11px','margin-left':'-80px'});
// 	}
// 	else{
// 		$('.like-btn').css({'margin-top':$('#top-bg').height()-98+'px','margin-left':'0'});
// 	}
// });

function vid1(){
	  $("body").css({overflow: "hidden"});
	  $.colorbox({
	      height   : 500 + 34 + 35,
	      href     : 'http://dakkansha.jp/site/?page_id=585',
	      iframe   : true,
	      onClosed : function () {
	          A()
	      },
	      opacity  : 0.93,
	      scrolling: false,
	      speed    : 600,
	      width    : 853,
	      title: function(){
	      	  return '<div class="trl-btn active" onClick="vid1()"><a class="active">本予告</a></div><div class="trl-btn" onClick="vid2()"><a>特報</a></div>';
	      }
	  });
}
function vid2(){
$("body").css({overflow: "hidden"});
$.colorbox({
	height   : 500 + 34 + 35,
    href     : 'https://www.youtube.com/embed/0ibjgSORBi4?autoplay=1',
    iframe   : true,
    onClosed : function () {
        A()
    },
    opacity  : 0.93,
    scrolling: false,
    speed    : 600,
    width    : 853,
    title: function(){
    	  return '<div class="trl-btn" onClick="vid1()"><a>本予告</a></div><div class="trl-btn active" onClick="vid2()"><a class="active">特報</a></div>';
    }
});
}
(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
<div id="fb-root"></div>
<?php 
$items = wp_get_nav_menu_items('frontpage');
foreach ($items as $obj) {
	query_posts("post_type=page&p={$obj->object_id}");
	if (!have_posts()) { continue; }
	while (have_posts()) : the_post();
		$template = get_page_template();
		include( $template );
	endwhile;
}
?>

<?php get_footer(); ?>