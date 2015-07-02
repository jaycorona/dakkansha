var DEF_W = 1024;
var DEF_H = 930;
var MIN_BG_W = 1600;
var MIN_BG_H = 816;
var DEF_TTL_W = 973;
var DEF_TTL_Y = 440;
var DEF_BANNER5_X = 5;
var DEF_BANNER5_Y = 13;
var DEF_BANNER6_X = 5;
var DEF_BANNER6_Y = 303;
var DEF_BANNER7_X = 5;
var DEF_BANNER7_Y = 158;
var DEF_GRAD_Y = 398;
var DEF_CASTNAME_X = 218;
var DEF_CASTNAME_Y = 10;
var DEF_BANNER_H = 130;
var DEF_SNS_Y = 710;
var CREDIT_H = 26;
var DEF_MOVIE_W = 300;
var DEF_MOVIE_H = 169;
var IS_TEST = false;
var _isCreditOpen = false;
var _isOpenNavi = false;
var _isOpenShare = false;
var _isPC;
var _isSP;
function getContentsSize() {
    var a = WINDOW.width();
    var b = WINDOW.height();
    a = a > DEF_W ? a : DEF_W;
    b = b > DEF_H ? b : DEF_H;
    return ({
        h: b,
        w: a
    })
}
var sliderTimeout;
var Main = (function () {
        var d = false;
        var v = Config.getCookie();
        var r = 0;
        var y = 0;
        var f = false;
        var i;
        var n = false;
        var b = 853;
        var k = 480;
		//自動動画再生
        var l = "http://eden-entertainment.jp/heartsandminds/site/?page_id=870"; // tmp page id
        var p;
        function x() {
            $.fn.colorbox.settings.bgOpacity = "0.93";
            Utils.init();
            i        = Utils.getBrowser();
            WINDOW   = $(window);
            DOCUMENT = $(document);
            WRAPPER  = $("#wrapper");
            WINDOW.bind(Event.ON_INIT_INDEX, m);
            if (IS_TEST && i.name.indexOf("IE") == -1) {
                t()
            }
            var F = $.cookie(v);
            if (F == Config.getCookieValue()) {
                d = true
            }
            $(window).bind("resize", w);
            w();
            var E = $("img");
            var D = $("#progress-txt");
            if (i.name == "IE7" || i.name == "IE8") {
                D.css({
                    display: "none"
                })
            } else {
                r = E.length;
                E.each(function () {
                    if (i.name == "Firefox") {
                        $(this).load(function () {
                            y++;
                            D.text(String(Math.floor((y / r) * 100) + "%"))
                        })
                    } else {
                        $(this).imagesLoaded(function () {
                            y++;
                            D.text(String(Math.floor((y / r) * 100) + "%"))
                        })
                    }
                })
            }
            $(window).load(function () {
                setTimeout(w, 100);
                if (!IS_TEST) {
                    $("#progress-txt").text("100%");
                    B()
                } else {
                    $("#preloader").css({
                        display: "none"
                    });
                    $("#wrapper").css({
                        display: "block"
                    });
                    u()
                }
            });
            $("#drawer-btn").click(function () {
                if (!_isOpenNavi) {
                    e()
                } else {
                    q()
                }
            });
            $("#share-btn").click(function () {
                if (!_isOpenShare) {
                    h()
                } else {
                    g()
                }
            });
            $("#sp-nav li a").click(function () {
                q()
            });
            $("#trailer-btn").click(function () {
                c()
            });
            $("#credit").click(function () {
                if (!_isCreditOpen) {
                    $("#top-footer").stop().animate({
                        "margin-top": -153
                    });
                    $("#credit").stop().animate({
                        "margin-top": -148
                    });
                    _isCreditOpen = true
                } else {
                    $("#top-footer").stop().animate({
                        "margin-top": -5
                    });
                    $("#credit").stop().animate({
                        "margin-top": 0
                    });
                    _isCreditOpen = false
                }
            })
        }
        function B() {
            $("#preloader").delay(600).animate({
                opacity: 0
            }, 1000, "linear", function () {
                $("#preloader").remove();
                var window_size=document.body.clientWidth;
              
                if(window_size>1024) {
                	$("body").css({
                        "overflow-y": "hidden"
                    });
                }else {
                	$("body").css({
                        "overflow-y": "scroll"
                    });  	
                	
                }
                
                $("#wrapper").css({
                    display: "block"
                });
                w();
                u();
                
                // Special case When first page is style2 page
                $("#intro").removeClass("inactive");
            })
        }
        function u() {
            if (IS_TEST) {
                window.requestAnimFrame = (function () {
                    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (F, E) {
                        window.setTimeout(F, 1000 / 60)
                    }
                })()
            }
            var D = new Object();
            $("img[src *='_off.'],input[type=image]").not().each(function () {
                var F = $(this).attr("src");
                var E = F.replace("_off.", "_on.");
                $(this).hover(function () {
                    if ($(this).hasClass("no-change")) {
                        return
                    }
                    this.src = E
                }, function () {
                    if ($(this).hasClass("no-change")) {
                        return
                    }
                    this.src = F
                })
            });
            m()
        }
        function m() {
            if (d == false) {
                if (!IS_TEST) {
                    if (i.iOS || i.name == "Android") {
                        o()
                    } else {
                        c()
                    }
                } else {
                    o()
                }
            } else {
                o()
            }
        }
        function c(D) {
            if (n) {
                return
            }
            n = true;
            $("body").css({
                overflow: "hidden"
            });
            $.colorbox({
                height   : k + 34 + 35,
                href     : l,
                iframe   : true,
                onClosed : function () {
                    A()
                },
                opacity  : 0.93,
                scrolling: false,
                speed    : 600,
                width    : b
            })
        }
        function a() {
            if (f == false && d == false) {
                $.colorbox.close()
            }
        }
        function A() {
            $("body").css({
                overflow: "hidden"
            });
            n = false;
            if (f == false) {
                o()
            } else {}
        }
        function o() {
            f = true;
            if (!skel.isActive("mobile")) {
                _isPC = true;
                _isSP = false
            } else {
                _isPC = false;
                _isSP = true
            }
            if (IS_TEST) {
                C()
            }
            $.cookie(v, Config.getCookieValue(), {
                expires: 3
            });
            setTimeout(function () {
                $("#lemmon-slider").lemmonSlider({
                    infinite: true
                });
                j()
            }, 300)
        }
        function j() {
            $("#lemmon-slider").trigger("nextSlide").fadeIn("slow");
            sliderTimeout = setTimeout(j, 5000)
        }
        function e() {
            if (_isOpenShare) {
                _isOpenNavi = true;
                g();
                $("#sp-nav").stop().delay(300).slideDown(300)
            } else {
                _isOpenNavi = true;
                $("#sp-nav").stop().slideDown(300)
            }
            $("#drawer-btn span").addClass("openNavi")
        }
        function q() {
            $("#sp-nav").stop().slideUp(300);
            $("#drawer-btn span").removeClass("openNavi");
            _isOpenNavi = false
        }
        function h() {
            if (_isOpenNavi) {
                _isOpenShare = true;
                q();
                $("#share-container").stop().delay(300).slideDown(300)
            } else {
                _isOpenShare = true;
                $("#share-container").stop().slideDown(300)
            }
        }
        function g() {
            $("#share-container").stop().slideUp(300);
            _isOpenShare = false
        }
        function z() {
            if (skel.isActive("max")) {
                var E = 0;
                var D = 0;
                $("#prono-navi").children("li").each(function (F) {
                    $(".prono-container .prono-box").eq(E).css({
                        display: "block"
                    });
                    $("#prono-navi").children("li").eq(E).addClass("active");
                    $(this).click(function () {
                        E = F;
                        if (E !== D) {
                            $("#prono-navi").children("li").eq(D).removeClass("active");
                            $("#prono-navi").children("li").eq(E).addClass("active");
                            $(".prono-container .prono-box").eq(D).fadeOut(200);
                            $(".prono-container .prono-box").eq(E).delay(300).fadeIn(800);
                            D = E
                        } else {}
                    })
                })
            }
        }
        function s() {
            if (skel.isActive("mobile")) {
                _isSP = true;
                $(".prono-container").children(".prono-box").each(function (D) {
                    $(this).click(function () {
                        if ($(this).children(".prono-ttl").hasClass("openProno")) {
                            $(this).children(".prono-contents").stop().slideUp(500);
                            $(this).children(".prono-ttl").removeClass("openProno")
                        } else {
                            $(this).children(".prono-contents").stop().slideDown(500);
                            $(this).children(".prono-ttl").addClass("openProno")
                        }
                    })
                })
            }
        }
        function w() {
            var Q = $(window).width();
            var ad = $(window).height();
            Q  = Q > DEF_W ? Q : DEF_W;
            ad = ad > DEF_H ? ad : DEF_H;
            var R = Q > MIN_BG_W ? Q : MIN_BG_W;
            var O = ad > MIN_BG_H ? ad : MIN_BG_H;
            var P = Q - DEF_W;
            var L = ad - DEF_H;
            var W = $(window).width();
            var ae = $("header").innerHeight();
            if (!skel.isActive("mobile")) {
                var I = R;
                var S = MIN_BG_H * (I / MIN_BG_W);
                if (S < ad) {
                    S = ad;
                    I = MIN_BG_W * (S / MIN_BG_H) >> 0
                }
                var Z = I * (1031 / 1600);
                if (Q < Z) {
                    I = Q * (1600 / 1031);
                    S = MIN_BG_H * (I / MIN_BG_W)
                }
                var H = (I - Q) * 0.5;
                var G = (S - ad) * 0.1;
                $("#top").css({
                    "padding-top": ae
                });
                $("#top-pc").css({
                    width : Q,
                    height: ad - ae
                });
                $("#top-bg").css({
                    width : I,
                    height: S,
                    top   : 0,
                    left  : -H
                });
                $("#top-bg-container").css({
                    height: ad,
                    width : Q
                });
                var M = (Q - DEF_TTL_W) * 0.5 >> 0;
                var K = DEF_TTL_Y + L;
                $("#ttl").css({
                    left: M,
                    top : K
                });
                var X = DEF_BANNER5_X + P * 0.2 >> 0;
                var V = DEF_BANNER5_Y + L * 0.2 >> 0;
                $("#banner5").css({
                    left: X,
                    top : V
                });
                var F = DEF_BANNER6_X + P * 0.2 >> 0;
                var E = DEF_BANNER6_Y + L * 0.2 >> 0;
                $("#banner6").css({
                    left: F,
                    top : E
                });
                var ac = DEF_BANNER7_X + P * 0.2 >> 0;
                var ab = DEF_BANNER7_Y + L * 0.2 >> 0;
                $("#banner7").css({
                    left: ac,
                    top : ab
                });
                var J = DEF_SNS_Y + L;
                $("#top-pc .social-container").css({
                    top: J
                });
                var Y = ad - DEF_BANNER_H - ae;
                $("#top-pc .banner").css({
                    top  : Y,
                    width: Q + "px"
                });
                var T = DEF_CASTNAME_Y + L * 0.01 >> 0;
                var U = DEF_CASTNAME_X + P * 0.5 >> 0;
                $("#castname").css({
                    left: U,
                    top : T
                });
                var af = ad - CREDIT_H - ae - 5;
                $("#credit").css({
                    top: af
                });
                var aa = ad - ae;
                $("#top-footer").css({
                    top  : aa,
                    width: Q
                });
                $("iframe[name = 'google_conversion_frame']").css({
                    display: "none",
                    height : 0 + "px"
                });
                if (_isOpenNavi == true) {
                    $("#drawer-btn span").removeClass("openNavi");
                    $("#sp-nav").css({
                        display: "none"
                    });
                    _isOpenNavi = false
                } else {}
                if (!_isPC) {
                    $(".prono-contents").css({
                        display: "block",
                        height : "inherit"
                    });
                    $(".prono-box").css({
                        display: "none"
                    });
                    z();
                    _isPC = true;
                    _isSP = false
                }
            } else {
                $("#top").css({
                    "padding-top": 0
                });
                var D = $(window).width() * 0.9;
                if (D < 300) {
                    D = 300
                }
                var N = (D / DEF_MOVIE_W) * DEF_MOVIE_H;
                $("#youtube").css({
                    height: N,
                    width : D
                });
                if (!_isSP) {
                    $(".prono-box").css({
                        display: "block"
                    });
                    $(".prono-contents").css({
                        display: "none"
                    });
                    $(".prono-ttl").eq(0).addClass("openProno");
                    $(".prono-contents").eq(0).slideDown();
                    s();
                    _isPC = false;
                    _isSP = true
                }
            }
        }
        function C() {
            requestAnimFrame(C);
            if (p) {
                p.update()
            }
        }
        function t() {
            stats                           = new Stats();
            stats.domElement.style.position = "fixed";
            stats.domElement.style.left     = "0px";
            stats.domElement.style.top      = "0px";
            document.body.appendChild(stats.domElement)
        }
        return {
            init           : x,
            __resize       : w,
            showMovie      : c,
            onCompleteMovie: a
        }
    })();
$(document).ready(function (a) {
    Main.init()
});