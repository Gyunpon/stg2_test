//<![CDATA[
$(document).ready(function(){
	
	var uaInfo = UAChk();

	
	var $shareTrigger = $('#sideFixShare .fixBlock.for_pc');
	var $shareBtn = $shareTrigger.find('#shareButton');
	var $shareBox = $shareTrigger.find('.sharebox');
	var clName_shareActive = 'hvActive';
	var clName_shareOpen = 'open';
	var ev_shareHv = 'shareHv';
	
	$shareTrigger.on('mouseenter.'+ev_shareHv, function(){
		var $this = $(this);
		$this.addClass(clName_shareActive);
		$shareBtn.addClass(clName_shareOpen);
		$shareBox.addClass(clName_shareOpen);
	});
	
	$shareTrigger.on('mouseleave.'+ev_shareHv, function(){
		var $this = $(this);
		$this.removeClass(clName_shareActive);
		$shareBtn.removeClass(clName_shareOpen);
		$shareBox.removeClass(clName_shareOpen);
	});
	
	
	
	
	var navShowOffset, footOffset = 0;
	
	
	
	$(window).scroll(function(){
		var sc = $(this).scrollTop();
		navShowOffset = $('.content_mv_article_detail').offset().top+ $('.content_mv_article_detail').outerHeight();
		footOffset = $('#footer').offset().top - 1000;
		
		//600px以上の場合
		if (window.matchMedia( '(min-width: 768px)' ).matches) {
			if( ($(window).scrollTop() > navShowOffset) && ($(window).scrollTop() < footOffset)){
				// 特定の要素を超えた
				$('#sideFixShare').addClass('active');
			}else{
				$('#sideFixShare').removeClass('active');
			}
			//600px以下の場合
		} else {
			if( ($(window).scrollTop() > navShowOffset)){
				// 特定の要素を超えた
				$('#sideFixShare').addClass('active');
			}else{
				$('#sideFixShare').removeClass('active');
			}
		};
	});
	
	
});
//]]>