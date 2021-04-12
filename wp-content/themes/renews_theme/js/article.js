//<![CDATA[
$(document).ready(function(){
	
	var uaInfo = UAChk();

	$('#sideFixShare .clipbox').click(function(e){
		var post_id = $(this).data('post_id');
		$('.clipbox[ data-post_id = '+post_id+' ]').toggleClass('stock');

		e.preventDefault();
		return false;
	});
	
	
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
	
//	$shareBox.on('mouseenter mouseleave',function(e){
//		e.preventDefault();
//		return false;
//	});
	
	
//	$('#shareButton').click(function() {
//		$(this).toggleClass('open');
//		$('.sharebox').toggleClass('open');
//		return false;
//	});
	
	var navShowOffset,articleOffset,footOffset = 0;
	
	$(window).on('load',function(){
		navShowOffset = $('.content_mv_article_detail').offset().top+ $('.content_mv_article_detail').outerHeight();
		articleOffset = $('.content_article_detail').offset().top + $('.content_article_detail').outerHeight() + $('#commentsAreaWrap').outerHeight() - $('.content_article').outerHeight();
		footOffset = $('#footer').offset().top - 1000;
	});

	
	
	$(window).scroll(function(){
		var sc = $(this).scrollTop();
//		console.log(sc);
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
		
		
		
//		if( ($(window).scrollTop() > navShowOffset) && ($(window).scrollTop() < footOffset)){
//			// 特定の要素を超えた
//			$('#sideFixShare').addClass('active');
//		}else{
//			$('#sideFixShare').removeClass('active');
//		}
	});
	
//	$('.login_baloon').hover(function(e) {
//		$(this).next('.baloon').addClass('active');
//		setTimeout(function(){
//			$('.baloon').removeClass('active');
//		},1000);
//		return false;
//	});
//	$('.clipbox a').hover(function() {
//		$(this).parent().toggleClass('hover');
//		return false;
//	});
	
	
	
	$(function(){
//		$('#sideFixShare .wp_ulike_general_class').on('click', function () {
//			var ulikeid = $('.wp_ulike_btn').data('ulike-id');
//			console.log(ulikeid);
//		});
		if ($('.wp_ulike_general_class').hasClass('wp_ulike_is_liked')) {
			$('.likebox + .baloon').addClass('hide');
			$('.likebox .baloon').addClass('hide');
			$('.wp_ulike_general_class').on('click', function () {
				$('.likebox + .baloon').toggleClass('hide');
				$('.likebox .baloon').toggleClass('hide');
			});
		}
//		if ($('#sideFixShare .wp_ulike_btn').hasClass('wp_ulike_btn_is_active')) {
//			$('#sideFixShare .likebox').addClass('likeThis');
//			$('#sideFixShare .likebox').on('click', function () {
//				$(this).toggleClass('likeThis');
//				$('#sideFixShare .likebox').addClass('baloonShow');
//
//				setTimeout(function(){
//					$('#sideFixShare .likebox').removeClass('baloonShow');
//				},3000);
//			});
//			$('#sideFixShare .likebox + .baloon').addClass('hide');
//			$('#sideFixShare .wp_ulike_general_class').on('click', function () {
//				$('#sideFixShare .likebox + .baloon').toggleClass('hide');
//			});
//		}else{
//			$('#sideFixShare .likebox').removeClass('likeThis');
//			$('#sideFixShare .likebox').on('click', function () {
//				$(this).toggleClass('likeThis');
//				$('#sideFixShare .likebox').addClass('baloonShow');
//				
//				setTimeout(function(){
//					$('#sideFixShare .likebox').removeClass('baloonShow');
//				},3000);
//			});
//			$('#sideFixShare .likebox + .baloon').removeClass('hide');
//			$('#sideFixShare .wp_ulike_general_class').on('click', function () {
//				$('#sideFixShare .likebox + .baloon').toggleClass('hide');
//			});
//		}
		
		
	});

	


	
	
});
//]]>