/*---------------------------------

@params

----------------------------------*/
// YouTubeのウェブサイト上にある「IFrameプレーヤーAPI」のコードを
// 非同期的に読み込む。
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";

var iframePlayerApiScriptTag = document.getElementsByTagName('script')[0];
iframePlayerApiScriptTag.parentNode.insertBefore(tag, iframePlayerApiScriptTag);


// 「IFrameプレーヤーAPI」のコードが読み込まれた後、
// 「iframe_player_api」というIDがついている<div>タグが
// YouTube動画プレーヤーの<iframe>タグに置き換えられる。
var player;
function onYouTubePlayerAPIReady() {
	//ここで指定しているID名（「iframe_player_api」）がついた
	//<div>タグ（上記）は、ページが表示される前に
	//自動的に<iframe>タグ（動画プレーヤー）に置き換えられます。
	player = new YT.Player('player', {
		width: MOVIE_W,
		height: MOVIE_H,
		videoId: ID_ARR[_currentMovieId],
		playerVars: {
			'autoplay':1,
			'modestbranding': 1,
			'autohide': 1,
			'controls': 1,
			'showinfo': 0,
			'rel': 0
		},
		events: {
			'onReady': __onPlayerReady,
			'onStateChange': __onPlayerStateChange
		}
	});
}


/*----------------------------------

@onPlayerReady

------------------------------------*/
function __onPlayerReady(){
	jQuery("#navi").css({"display":"block"});
}




/*----------------------------------

@statechange

------------------------------------*/
function __onPlayerStateChange(event){
	
	switch(event.data){
		
		case YT.PlayerState.ENDED:
		
			window.parent.Main.onCompleteMovie();
			
		break;
		
		case YT.PlayerState.PLAYING:
		break;
		
		case YT.PlayerState.PAUSED:
		break;
		
		case YT.PlayerState.BUFFERING:
		break;
		
		case YT.PlayerState.CUED:
		break;
		
		default:
		break;
	  }
}







/*----------------------------------

@statechange

------------------------------------*/
jQuery(document).ready(function($){

	var params;
	
	jQuery.extend({
		getParameter: function getParameter() {
			/// <summary>
			/// URLのパラメーターを取得
			/// </summary>
			
			var arg  = new Object;
			var pair = location.search.substring(1).split('&');
			for(i=0; pair[i]; i++) {
				var kv = pair[i].split('=');
				arg[kv[0]] = kv[1];
			}
			return arg;
		}
	});
	
	
	/*---------------------------------------
	@INIT
	-----------------------------------------*/
	function init(){
		
		params = jQuery.getParameter();
		if(params.id != undefined){
			_currentMovieId = params.id;
		}
		
		
		$("#navi li a").each(function(i){
			
			if(i == _currentMovieId){	
			
				$(this).addClass("selected");
			};
			
			$(this).click(function(e){
				if(i !=_currentMovieId){
					changeTrailer(i);
				}else{
				}
			});
		});
		
	};
	
	
	/*---------------------------------------
	@change Trailer
	---------------------------------------*/
	function changeTrailer(__id){
		
		var playerContainer =$("#screen-container");
		var btn;
		
		var oldMovieId = ID_ARR[_currentMovieId];
		var movieId =ID_ARR[__id]
		
		var old =$("#navi li").eq(_currentMovieId);
		var current = $("#navi li").eq(__id);
		old.children("a").removeClass("selected");
		current.children("a").addClass("selected");
		
		_currentMovieId = __id;
		
		var oldSrc = $("#player").attr("src");
		$("#player").attr("src","https://www.youtube.com/embed/"+movieId+"?autoplay=1&fs=1&hd=0&rel=0");
	
	}//End of function
	
	
	init();
	
	
	/*---------------------------------------
	@width buutton
	---------------------------------------*/
	function btnsize(){	
		count_div =$('div #t2').length;
		var width = $("#main").width();		
		var btnsize= width/count_div;
		var window_w=$(document).width();
		
		$('#navi li').css('width',btnsize);
		$('#navi li a').css('width',btnsize);
	}	
	btnsize();
	$('#navi').css('display','block');
	equalHeight($("#navi li a"));
	function equalHeight(group) {
		 	tallest = 50;
		 	group.each(function() {
		 	thisHeight = $(this).height();
		 	if(thisHeight > tallest) {
		 		allest = thisHeight;
		 	}
	});
	group.height(tallest)+'px';
	}
	$(window).resize(function() {btnsize(); equalHeight($("#navi li a")); });
}); 