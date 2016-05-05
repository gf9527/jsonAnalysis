	//IEPNGFix.blankImg = 'images/blank.gif';
	var lastScrollTime = 0;
	var last_block = "";
	var tops = [0, 0, 0, 0, 0];

	function polyguide(){
		var scr_w = $(window).width();
		var scr_h = $(window).height();		
		$("#one").css({width:scr_w + "px",height:scr_h + "px","overflow":"hidden"});
		$(".block").each(
			function(index, element) {
				$(this).css({width:scr_w + "px",height:scr_h + "px"});
				tops[index] = $(this).offset().top;
			}
		);
		
		$(".fade").animate({opacity:'0'}, 0);
		
		checkAndFadeIn();
		
		$(document).mousewheel(function(event, delta) {
			event = event || window.event;   
			event.preventDefault();  
			
			var now = new Date().getTime();
			if (now - lastScrollTime < 800){
				return;
			}
			lastScrollTime = now;

			var cur = getCurBlockIdx();
			if (delta < 0) {
				//鼠标向下滚动
				if (cur < 5) {
					//alert(cur)
					animateScroll(tops[cur + 1], 400);
				} else {
					//animateScroll(tops[4] + scr_h, 400);
				}
			} else {
				//鼠标向上滚动
				if (cur > 0){
					animateScroll(tops[cur - 1], 400);
				}
			}
        });	
		
		function scr01(){
			$("#one").css({width:scr_w + "px",height:scr_h + "px","overflow":"hidden"});
			var scr0101_h = $("#scr0101").outerHeight()
			var scr01_txt1_w = $(".scr01_txt1").outerWidth();
			var scr01_txt2_w = $(".scr01_txt2").outerWidth();
			var scr01_txt2_h = $(".scr01_txt2").outerHeight();
			var scr01_2code_w = $(".scr01_2code").outerWidth();
			var scr01_phone_w = $(".scr01_phone").outerWidth();
			var scr01_forios_w = $(".scr01_forios").outerWidth();
			var scr01_forand_w = $(".scr01_forand").outerWidth();
			
			$(".scr01_child01").css({"width":scr_w+"px","background-position":"center 10px"});
			$(".scr01_txt1").css({"left":(1024 - scr01_txt1_w)/2+"px","top":30+"px"});
			$(".scr01_txt2").css({"left":10+"px","top":140+"px"});
			$(".scr01_phone").css({"right":160+"px","bottom":10+"px"});
			$(".scr01_2code").css({"right":17+"px","bottom":160+"px","width":"130px;","height":"130px","background-size":"126px 126px"});
			$(".scr01_forios").css({"right":20+"px","bottom":115+"px","width":"130px;","height":"45px","background-size":"130px 42px"});
			$(".scr01_forand").css({"right":20+"px","bottom":70+"px","width":"130px;","height":"45px","background-size":"130px 42px"});
			$("#scr0101").css({"top":60+"px","height":+scr_h+"px"});
			$(".scr01_cloud").css({"bottom":360 + "px","right":20 + "px"})
			
			if(scr_w>1440){
				$(".scr01_child01").css({"width":scr_w+"px","background-position":"center 10px"});				
				$(".scr01_cloud").css({"bottom":430 + "px","right":20 + "px"})
				$(".scr01_txt1").css({"left":(1024 - scr01_txt1_w)/2+"px","top":130+"px"});
				$(".scr01_txt2").css({"left":10+"px","top":340+"px"});
				$(".scr01_phone").css({"right":140+"px","bottom":35+"px"});
				$(".scr01_2code").css({"right":0+"px","bottom":220+"px","width":"130px;","height":"130px","background-size":"130px 130px"});
				$(".scr01_forios").css({"right":0+"px","bottom":175+"px","width":"130px;","height":"40px","background-size":"130px 40px"});
				$(".scr01_forand").css({"right":0+"px","bottom":130+"px","width":"130px;","height":"40px","background-size":"130px 40px"});
				$("#scr0101").css({"top":60+"px","height":+scr_h+"px"});
			};
		};
		scr01()

		function scr02(){
			var scr_h = $(window).height();
			var a = $(".scr03>div").outerWidth();
			var b = $(".scr03_trans").outerHeight();
			
			//上下左右居中	
			$(".scr02").css({"width":a * 3 + 10 +"px","margin":"0 auto","margin-top":90+"px"});
			if(scr_w>1440){
				$(".scr02").css({"width":a * 3 + 10 +"px","margin":"0 auto","margin-top":(scr_h-a)/2-85+"px"});
			}
		};
		scr02();
		function scr03(){
			var scr_h = $(window).height();
			var a = $(".scr03>div").outerWidth();
			var b = $(".scr03_trans").outerHeight();
			
			//上下左右居中	
			$(".scr03").css({"width":a * 3 + 10 +"px","margin":"0 auto","margin-top":90+"px"});
			if(scr_w>1440){
				$(".scr03").css({"width":a * 3 + 10 +"px","margin":"0 auto","margin-top":(scr_h-a)/2-85+"px"});
			}
		};
		scr03();
		
		function scr04(){
			//标签
			$(".tab_con").first().show();
			$(".tab_idx").children("a").click(function(){
				$(this).addClass("cur").siblings().removeClass("cur");
				var i = $(this).index();
				$(".tab_box").children().eq(i).show().siblings().hide();	
			});
			//上下左右居中
			var a = $(".tab_con").outerWidth();
			var b = $(".tab_con").outerHeight();
			$(".scr04").css({"margin":"0 auto","margin-top":(scr_h-b)/2+"px"});
		};
		scr04();
	}
	
	$(function(){
		//alert("ready")
		polyguide()
	});
	
	$(window).resize(function(){
		polyguide()
	})
	
	var scrollAnimateInterval;
	var scrollAnimateDelta;
	var scrollAnimateCount;
	var scrollAnimateTop;
	
	function animateScroll(top, time) {
		scrollAnimateCount = 50;
		var topBegin = $(window).scrollTop();
		scrollAnimateDelta = (top - topBegin) / scrollAnimateCount;
		scrollAnimateInterval = time / scrollAnimateCount;
		scrollAnimateTop = top;
		doAnimateScroll();
	}
	
	//滚动动画
	function doAnimateScroll() {
		scrollAnimateCount--;
		if (scrollAnimateCount > 0) {
			window.setTimeout(doAnimateScroll, scrollAnimateInterval--);
			var topBegin = $(window).scrollTop();
			window.scrollTo(0, topBegin + scrollAnimateDelta);
		} else {
			window.scrollTo(0, scrollAnimateTop);
			window.setTimeout(function() {
				checkAndFadeIn();
			}, 1150);
		}
	}
	
	function getCurBlockIdx() {
		var top = $(window).scrollTop();
		var height = $(window).height();
		var cur = 0;
		for (var i=0; i<5; i++) {
			var topblock = tops[i];
			if (between(topblock, top - (height/2),top + (height/2))) {
				cur = i;
				break;
			}
		}
		if (cur == 0 && top > tops[4])
			cur = 4;
			return cur;
	}
	
	function checkAndFadeIn() {
		var cur = getCurBlockIdx();
		if (cur > 0) {
			$("#block_nav").show();
			$("#block_nav").css("display", "inline");
		} else {
			$("#block_nav").show();
			$("#block_nav").css("display", "inline");
		}
		$(".block").each(function() {
			var top = $(window).scrollTop();
			var height = $(window).height();
			var topblock = $(this).offset().top;
			if (between(topblock, top, top + (height/2)) || between(topblock, top - (height/2), top)) {
				var id = $(this).attr("id");
				if (id != last_block) {
					last_block = id;
					doFadeIn(last_block);
				}
			}
		});
	}

	function between(n, n1, n2) {
		return (n >= n1 && n <= n2);
	}

	function doFadeIn(blockid) {
		$(".nav_img").each(
			function() {
				var id = $(this).attr("id");
				if (id == "nav_" + blockid){
						$(this).attr("src", "http://www.polyguide.com.cn/public/web/images/nav_sel.png");
					}
					else{
						$(this).attr("src", "http://www.polyguide.com.cn/public/web/images/nav_notsel.png");
					}
				}
		);
	}
	
	function nav(idx) {
		scrollTo(0, tops[idx]);
		checkAndFadeIn();
	}
