//<![CDATA[
$(document).ready(function(){
	
	var uaInfo = UAChk();
	// URLの取得
	var url = location.href
	// パスの取得
	var path = location.pathname
	// パラメーターの取得
	var param = location.search
	// ページ内アンカーの取得
	var anc = location.hash
	//遷移元ページのURL
	var referrerURL = document.referrer;
	var referrerPath = referrerURL.replace('https://renews.jp','');
	
	//ページリロード
	$("#againSendBtn").on("click", function() {
		location.reload();
	});
	
	
	//スクロール位置
	var smoothScrollSpd = 500;
	var scPos = $('#contactForm').offset().top;
	var minusPos;
	if(uaInfo['winSizeFlg'] == 'SP'){
		minusPos = 0;
	}else{
		minusPos = -130;
	}
	
	function scPosFunc(){
		$("html, body").animate({scrollTop:(scPos) + minusPos}, smoothScrollSpd, "swing");
	}
	
	if (window.performance) {
		if (performance.navigation.type === 1) {
			// リロードされた
			console.log('リロードされた');
			setTimeout(scPosFunc, 100);
			console.log(referrerPath);
		} else {
			// リロードされていない
			console.log(referrerPath);
			console.log('リロードされていない');
			if(path == referrerPath){
				console.log('ページ移動してない');
				setTimeout(scPosFunc, 100);
			}else{
				console.log('ページ移動してる');
			}
		}
	}
	
	
	$('.posReset').on("click", function() {

	});
	//setTimeout(scPosFunc, 100);
	
	

//	if (param != "?move=wrap"){
//		// パラメーターの値が wrap じゃない場合に実行する内容
//		
//	}
	
	
//	$(window).on('load', function() {
//		console.log(scPos);
//	});
	
	
//	// リロード TODO: ?が無い場合対応
//	function keep_scroll_reload() {
//		var re = /&page_x=(\d+)&page_y=(\d+)/;
//		var page_x = document.documentElement ? document.documentElement.scrollLeft : document.body.scrollLeft;
//		var page_y = document.documentElement ? document.documentElement.scrollTop : document.body.scrollTop;
//		var position = '&page_x=' + page_x + '&page_y=' + page_y;
//		if(!url.match(re)) {
//			//初回
//			location.href = url + position;
//		} else {
//			//2回目以降
//			location.href = url.replace(/&page_x=(\d+)&page_y=(\d+)/,position);
//		}
//	}
//
//	// スクロール位置を復元
//	function restore_scroll() {
//		var re = /&page_x=(\d+)&page_y=(\d+)/;
//		if(window.location.href.match(re)) {
//			var position = window.location.href.match(re)
//			window.scrollTo(position[1],position[2]);
//		}
//	}
//
//	(window.onload = function() {
//		restore_scroll();
//	})();

	
	
	
	
	
});
//]]>