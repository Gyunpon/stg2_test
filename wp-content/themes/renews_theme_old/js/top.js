//<![CDATA[
$(document).ready(function(){
	
	var uaInfo = UAChk();
	
	//slider
	$('.content_mv_wrap').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 5000,
		appendArrows: $('.arrows'),
	});
	
	
	
	
	
	
	
		if($.cookie("access") == undefined) {
			$.cookie("access","onece");
			
			const h = $(window).height();
			// $('#wrap').css('display', 'none');
//			$('#loader-bg ,#loader').height(h).css('display', 'block');
			$('#loader-bg ,#loader').addClass('firstAccess');

			$('#wrap').css({ opacity: '0' });
			
			$('#loader-bg').delay(200).fadeOut(1000);
			$('#loader').delay(100).fadeOut(1000);
			// $('#wrap').delay(600).fadeIn(1200);

			$('#wrap').animate({ opacity: 1 }, { duration: 400, easing: 'swing' });
			
console.log('1回目');
		
		} else {
			// 2回目以降
			$('#loaderWrap').addClass('access');
			console.log('2回目以降');
		}
	

	// loading
//	$(function() {
//
//	});
//
//	$(window).load(function() {
//
//	});
});
//]]>