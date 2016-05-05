///-------------------------------------------------------------------------
//jQuery弹出窗口 By Await [2009-11-22]
//--------------------------------------------------------------------------
/*参数：[可选参数在调用时可写可不写,其他为必写]
----------------------------------------------------------------------------
    title:	窗口标题
  content:  内容(可选内容为){ text | id | img | url | iframe }
    width:	内容宽度
   height:	内容高度
close_img:  是否有关闭按钮(true为是,false为否)
scrollOff:  禁用滚动条(true为禁用,false为开启)
	 drag:  是否可以拖动(true为是,false为否)
     time:	自动关闭等待的时间，为空是则不自动关闭
   showbg:	[可选参数]设置是否显示遮罩层(0为不显示,1为显示)
  cssName:  [可选参数]附加class名称
  jumpUrl:  跳转Url
 ------------------------------------------------------------------------*/
 //示例:
 //------------------------------------------------------------------------
 //tipsWindown("提示","text:提示信息内容","250","150","true","true","true","","true","","http://www.baidu.com");
 //"text:提示信息内容"            弹出文本信息提示
 //"id:testID"                    弹出页面中的某个ID的html
 //"img:图片路径"                 弹出图片
 //"url:get?test.html"            get加载一个.html文件
 //"iframe:http://www.baidu.com"  加载一个页面到框架显示
 //------------------------------------------------------------------------
var showWindown = true;
var templateSrc = "http://www.7daysinn.cn"; //设置loading.gif路径
function tipsWindown(title,content,width,height, close_img, scrollOff,drag,time,showbg,cssName,jumpUrl) {
	$("#windown-box").remove(); //请除内容
	var width = width>= 950?this.width=950:this.width=width;	    //设置最大窗口宽度
	var height = height>= 900?this.height=527:this.height=height;  //设置最大窗口高度
	if (scrollOff == "true"){//dyb 2013-10-28 禁用滚动条
		$("body").eq(0).css("overflow","hidden");
	}
	if(showWindown == true) {
		var simpleWindown_html = new String;
			simpleWindown_html = "<div id=\"windownbg\" style=\"height:"+$(document).height()+"px;filter:alpha(opacity=0);opacity:0;z-index: 999901\"></div>";
			simpleWindown_html += "<div id=\"windown-box\">";
		if (close_img == "true"){//dyb 2013-10-28 是否有关闭按钮
			simpleWindown_html += "<div id=\"windown-title\"><h2></h2><span id=\"windown-close\">关闭</span></div>";
		} else {
			simpleWindown_html += "<div id=\"windown-title\"><h2></h2><span></span></div>";
		}
			simpleWindown_html += "<div id=\"windown-content-border\" style=\"border:1px solid #668cae\"><div id=\"windown-content\"></div></div>"; 
			simpleWindown_html += "</div>";
			$("body").append(simpleWindown_html);
			show = false;
	}
	contentType = content.substring(0,content.indexOf(":"));
	content = content.substring(content.indexOf(":")+1,content.length);
	switch(contentType) {
		case "text":
		$("#windown-content").html(content);
		break;
		case "id":
		$("#windown-content").html($("#"+content+"").html());
		break;
		case "img":
		$("#windown-content").ajaxStart(function() {
			$(this).html("<img src='"+templateSrc+"/images/loading.gif' class='loading' />");
		});
		$.ajax({
			error:function(){
				$("#windown-content").html("<p class='windown-error'>加载数据出错...</p>");
			},
			success:function(html){
				//new_width = parseInt(width) + 10;//duanyangbo add 增加宽和高的属性
				new_width = width;//duanyangbo add
				//$("#windown-content").html("<img src="+content+" alt='' width='"+new_width+"' height='"+height+"'/>");
				$("#windown-content").html("<img src='"+content+"' alt='图片'/>");
			}
		});
		break;
		case "url":
		var content_array=content.split("?");
		// start
		// 解决tipswindown与validate冲突 2012-12-25 11:57:39 yxl
		/* 原有代码
		$("#windown-content").ajaxStart(function(){
			$(this).html("<img src='"+templateSrc+"/images/loading.gif' class='loading' />");
		});*/
					
		$("#windown-content").html("<img src='"+templateSrc+"/images/loading.gif' class='loading' />");
		//end
		$.ajax({
			type:content_array[0],
			url:content_array[1],
			data:content_array[2],
			error:function(){
				$("#windown-content").html("<p class='windown-error'>加载数据出错...</p>");
			},
			success:function(html){
				$("#windown-content").html(html);
			}
		});
		break;
		case "iframe":
		$("#windown-content").ajaxStart(function(){
			$(this).html("<img src='"+templateSrc+"/images/loading.gif' class='loading' />");
		});
		$.ajax({
			error:function(){
				$("#windown-content").html("<p class='windown-error'>加载数据出错...</p>");
			},
			success:function(html){
				$("#windown-content").html("<iframe src=\""+content+"\" width=\"100%\" height=\""+parseInt(height)+"px"+"\" scrolling=\"auto\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\"></iframe>");
			}
		});
	}
	$("#windown-title h2").html(title);
	if(showbg == "true") {$("#windownbg").show();}else {$("#windownbg").remove();};
	$("#windownbg").animate({opacity:"0.5"},"normal");//设置透明度
	$("#windown-box").show();
	if( height >= 700 ) {
		$("#windown-title").css({width:(parseInt(width)+22)+"px"});
		$("#windown-content").css({width:(parseInt(width)+17)+"px",height:height+"px"});
	}else {
		/*if (contentType == "iframe") {//yxl iframe内table右侧有空白，可以去掉，else内是原版
			$("#windown-title").css({width:parseInt(width)+"px"});
		} else {
			$("#windown-title").css({width:(parseInt(width))+"px"});
		}
		$("#windown-content").css({width:width+"px",height:height+"px"});*/
		
		$("#windown-title").css({width:(parseInt(width))+"px"});
		$("#windown-content").css({'width':width+"px",'height':height+"px",'overflow':'auto','text-align':'center'});
	}
	var	cw = document.documentElement.clientWidth,ch = document.documentElement.clientHeight,est = document.documentElement.scrollTop; 
	var _version = $.browser.version;
	if ( _version == 6.0 ) {
		$("#windown-box").css({left:"50%",top:(parseInt((ch)/2)+est)+"px",marginTop: -((parseInt(height)+53)/2)+"px",marginLeft:-((parseInt(width)+32)/2)+"px",zIndex: "999999"});
	}else {
		$("#windown-box").css({left:"50%",top:"50%",marginTop:-((parseInt(height)+53)/2)+"px",marginLeft:-((parseInt(width)+32)/2)+"px",zIndex: "999999"});
	};
	var Drag_ID = document.getElementById("windown-box"),DragHead = document.getElementById("windown-title");
		
	var moveX = 0,moveY = 0,moveTop,moveLeft = 0,moveable = false;
		if ( _version == 6.0 ) {
			moveTop = est;
		}else {
			moveTop = 0;
		}
	var	sw = Drag_ID.scrollWidth,sh = Drag_ID.scrollHeight;
		DragHead.onmouseover = function(e) {
			if(drag == "true"){DragHead.style.cursor = "move";}else{DragHead.style.cursor = "default";}
		};
		DragHead.onmousedown = function(e) {
		if(drag == "true"){moveable = true;}else{moveable = false;}
		e = window.event?window.event:e;
		var ol = Drag_ID.offsetLeft, ot = Drag_ID.offsetTop-moveTop;
		moveX = e.clientX-ol;
		moveY = e.clientY-ot;
		document.onmousemove = function(e) {
				if (moveable) {
				e = window.event?window.event:e;
				var x = e.clientX - moveX;
				var y = e.clientY - moveY;
					if ( x > 0 &&( x + sw < cw) && y > 0 && (y + sh < ch) ) {
						Drag_ID.style.left = x + "px";
						Drag_ID.style.top = parseInt(y+moveTop) + "px";
						Drag_ID.style.margin = "auto";
						}
					}
				}
		document.onmouseup = function () {moveable = false;};
		Drag_ID.onselectstart = function(e){return false;}
	}
	$("#windown-content").attr("class","windown-"+cssName);
	var closeWindown = function() {
		$("#windownbg").remove();
		$("#windown-box").fadeOut("slow",function(){$(this).remove();});
		if (scrollOff == "true"){//dyb 2013-10-28 禁用滚动条
			$("body").eq(0).css("overflow","auto");
		}
		if( (typeof(jumpUrl) != "undefined") && (jumpUrl != '') ){//dyb 2013-10-28 跳转到指定Url
	    	window.location.href = jumpUrl;
	  }
	}
	if( time == "" || typeof(time) == "undefined") {
		$("#windown-close").click(function() {
			$("#windownbg").remove();
			$("#windown-box").fadeOut("slow",function(){$(this).remove();});
			if (scrollOff == "true"){//dyb 2013-10-28 禁用滚动条
				$("body").eq(0).css("overflow","auto");
			}
			if( (typeof(jumpUrl) != "undefined") && (jumpUrl != '') ){//dyb 2013-10-28 跳转到指定Url
	    	window.location.href = jumpUrl;
	  }
		});
	}else { 
		setTimeout(closeWindown,time);
	}
}
