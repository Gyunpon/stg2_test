//<![CDATA[
$(function() {

		if($.cookie("access") == undefined) {
			$.cookie("access","onece");

			$('#loaderWrap').addClass('firstAccess');
				const h = $(window).height();
				$('#loader-bg ,#loader').height(h).css('display', 'block');

//				$('#wrap').css({ opacity: '0' });

				$(window).load(function() {
					$('#loader-bg').delay(200).fadeOut(1000);
					$('#loader').delay(100).fadeOut(1000);

					$('#wrap').animate({ opacity: 1 }, { duration: 400, easing: 'swing' });
				});


			console.log('1回目');
		} else {
			$('#loaderWrap').addClass('secondAccess');
			$('#wrap').css({ opacity: '1' });
			console.log('2回目以降');
		}
});


//$(document).ready(function(){
//
//	var uaInfo = UAChk();
//
//		if($.cookie("access") == undefined) {
//			$.cookie("access","onece");
//
//
//
//			$(window).load(function () {
//
//
//			const h = $(window).height();
////			// $('#wrap').css('display', 'none');
//////			$('#loader-bg ,#loader').height(h).css('display', 'block');
////			//$('#loader-bg ,#loader').addClass('firstAccess');
////			$('#wrap').css({ opacity: '0' });
//	$('#wrap').addClass('firstAccessWrap');
//				$("#loaderWrap").css({
//					display:"block",
//					opacity:"1"
//				});
//////	$('#loaderWrap').addClass('firstAccess');
////
////
//
//			$('#loaderWrap').delay(200).fadeOut(1000);
//
//////			$('#loader-bg').delay(200).fadeOut(1000);
////			$('#loader').delay(100).fadeOut(1000);
//////			$('#loader-bg').delay(200).fadeOut(1000);
//////			$('#loader').delay(100).fadeOut(1000);
////			// $('#wrap').delay(600).fadeIn(1200);
////
//			$('#wrap').animate({ opacity: 1 }, { duration: 400, easing: 'swing' });
//
//
//			});//$(window).load
//
//console.log('1回目');
//
//
//
//
//		} else {
//
//
//
////			// 2回目以降
////	$('#wrap').css({ opacity: '1' });
//			$('#wrap').addClass('secondAccessWrap');
////			$('#loaderWrap').addClass('secondAccess');
////////			$('#loader-bg').css({ opacity: '0' });
////////			$('#loader').css({ opacity: '0' });
//
//
//			console.log('2回目以降');
//		}
//
//
//});
//]]>
