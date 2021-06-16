//<![CDATA[
$(document).ready(function(){
	
	var uaInfo = UAChk();
	
	$(".accordionTitle").on("click", function() {
		$(this).toggleClass('visible');
		$(this).next().slideToggle();
	});
	
	
	//ページリロード
	$("#againSendBtn").on("click", function() {
		location.reload();
	});
	
	// リロード TODO: ?が無い場合対応
	function keep_scroll_reload() {
		var re = /&page_x=(\d+)&page_y=(\d+)/;
		var page_x = document.documentElement ? document.documentElement.scrollLeft : document.body.scrollLeft;
		var page_y = document.documentElement ? document.documentElement.scrollTop : document.body.scrollTop;
		var position = '&page_x=' + page_x + '&page_y=' + page_y;
		if(!url.match(re)) {
			//初回
			location.href = url + position;
		} else {
			//2回目以降
			location.href = url.replace(/&page_x=(\d+)&page_y=(\d+)/,position);
		}
	}

	// スクロール位置を復元
	function restore_scroll() {
		var re = /&page_x=(\d+)&page_y=(\d+)/;
		if(window.location.href.match(re)) {
			var position = window.location.href.match(re)
			window.scrollTo(position[1],position[2]);
		}
	}

	(window.onload = function() {
		restore_scroll();
	})();

	
	
	
	
	
});
//]]>