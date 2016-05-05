	//IEPNGFix.blankImg = 'images/blank.gif';
	var lastScrollTime = 0;
	var last_block = "";
	var tops = [0, 0, 0, 0, 0];

	$(function() {
		var scr_w = $(document).width();
		var scr_h = $(window).height();		
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
		var scr_w = $(document).width();
		var scr_h = $(window).height();		

		function scr01(){
			$("#one").css({width:scr_w + "px",height:scr_h + "px","overflow":"hidden"});
			var scr01_txt1_w = $(".scr01_txt1").outerWidth();
			var scr01_txt2_w = $(".scr01_txt2").outerWidth();
			var scr01_txt2_h = $(".scr01_txt2").outerHeight();
			var scr01_child01_w = $(".scr01_child01").outerWidth();
			var scr01_2code_w = $(".scr01_2code").outerWidth();
			var scr01_phone_w = $(".scr01_phone").outerWidth();
			var scr01_forios_w = $(".scr01_forios").outerWidth();
			var scr01_forand_w = $(".scr01_forand").outerWidth();
			var scr01_bottom_chaopi_w = $(".scr01_bottom_chaopi").outerWidth();
			
			$(".scr01_txt1").css({"left":(scr_w - scr01_txt1_w)/2+"px","top":60+"px"});
			$(".scr01_txt2").css({"left":0+"px","bottom":(scr_h - scr01_txt2_h)/2+"px"});
			$(".scr01_phone").css({"left":250+"px","top":(scr_h - scr01_txt2_h)/2+"px"});
			$(".scr01_child01").css({"left":(scr_w - scr01_child01_w)/2+"px","bottom":0+"px"});
			$(".scr01_2code").css({"right":300+"px","bottom":90+"px"});
			$(".scr01_forios").css({"right":30+"px","bottom":190+"px"});
			$(".scr01_forand").css({"right":30+"px","bottom":100+"px"});
			$(".scr01_bottom_chaopi").css({"left":(scr_w - scr01_bottom_chaopi_w)/2+"px"});
			if(scr_w>1440){
				$(".scr01_2code").css({"right":300+(scr_w-1440)/2+"px","bottom":90+"px"});
				$(".scr01_forios").css({"right":30+(scr_w-1440)/2+"px","bottom":190+"px"});
				$(".scr01_forand").css({"right":30+(scr_w-1440)/2+"px","bottom":100+"px"});
				$(".scr01_txt1").css({"left":(scr_w - scr01_txt1_w)/2+"px","top":110+"px"});
				$(".scr01_txt2").css({"left":0 + (scr_w-1440)/2 + "px","bottom":(scr_h - scr01_txt2_h)/2+"px"});
				$(".scr01_phone").css({"left":250 + (scr_w-1440)/2 + "px","top":(scr_h - scr01_txt2_h)/2+"px"});
				$(".scr01_child01").css({"left":(scr_w - scr01_child01_w)/2+"px","bottom":110+"px"});
			};
		};
		scr01()

		function scr03(){
			var scr_h = $(window).height();
			var a = $(".scr03>div").outerWidth();
			var b = $(".scr03_trans").outerHeight();
			
			//上下左右居中	
			$(".scr03").css({"width":a * 3 + 10 +"px","margin":"0 auto","margin-top":(scr_h - 640) /2+"px"});
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
			$(".scr04").css({"margin":"0 auto","margin-top":(scr_h - b)/2+"px"});
		};
		scr04();

		function scr05(){
			//上下左右居中
			var a = $(".scr05").outerWidth()
			var b = $(".scr05").outerHeight()
			$(".scr05").css({"margin":"0 auto","margin-top":(scr_h - b)/2+"px"})
		};
		scr05();

		
	});
	
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
			if (between(topblock, top - height / 2, top + height / 2)) {
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
			if (between(topblock, top, top + height / 2) || between(topblock, top - height / 2, top)) {
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
/*		$(".fade").animate({opacity:'0'}, 0);
		var fc = $("#fade_char_" + blockid);
		var idx = fc.attr("idx");
		var ft = $("#fade_text_" + blockid);
		fc.animate({opacity:'1.0'}, 500);
		if (idx == "0") {
			ft.animate({left:'-=50px'}, 0);
			ft.animate({opacity:'1.0', left:'+=50px'}, 1500);			
		} else {
			ft.animate({left:'+=50px'}, 0);
			ft.animate({opacity:'1.0', left:'-=50px'}, 1500);
		}
*/		
		$(".nav_img").each(
			function() {
				var id = $(this).attr("id");
				if (id == "nav_" + blockid)
					$(this).attr("src", "img/nav_sel.png");
				else
					$(this).attr("src", "img/nav_notsel.png");
			}
		);
		
		//$("#title").show(1000);
	}
	
	function nav(idx) {
		//console.log(tops,idx)
		scrollTo(0, tops[idx]);
		checkAndFadeIn();
	}
