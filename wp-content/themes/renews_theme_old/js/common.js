// ---------------------------------------------------------
// ready function
// ---------------------------------------------------------

// imgLiquid
$(document).ready(function imgLiquid() {
  $('.imgLiquidFill').imgLiquid()
})

//ページアクティブ
$(document).ready(() => {
	switch (window.location.pathname) {
		case '/article/':
		case '/article':
			$('.header-article').addClass('highlighted')
			break

			case '/agenda/':
			case '/agenda':
			$('.header-agenda').addClass('highlighted')
			break

			case '/series/':
			case '/series':
			$('.header-series').addClass('highlighted')
			break

			case '/renewers/':
			case '/renewers':
			$('.header-renewer').addClass('highlighted')
			break

			case '/about/':
			case '/about':
			$('.header-about').addClass('highlighted')
			break
	}
})


$(document).ready(function(){
	var nowUrl = location.href;
	var nowParam = location.search;
	var paramAry = nowParam.split('&');
	//console.log(paramAry.length);
	var leaveScrollNum = 0;
	var smoothScrollSpd = 500;

	// 除外するタグ指定
	var smoothScrollNotList = '.commentbox';
	//var smoothScrollNotList = '#globalNavBtn a, #third a, #fourth a, #fifth a';

	$('a[href^="#"]').not(smoothScrollNotList).click(function(e){
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = (target.offset().top)+leaveScrollNum;
		$("html, body").animate({scrollTop:position}, smoothScrollSpd, "swing");
		e.preventDefault();
		return false;
	});


	// 別ページスムーススクロール
	var smoothScrollPrefix = 'move=';
	$(window).on('load.smooth',function(){
		$.each(paramAry, function(i, val) {
			if(val.indexOf(smoothScrollPrefix) != -1){
				var hh = val.replace('?','').replace(smoothScrollPrefix,'');
				var hash = '#' + hh;
				var tgt = $(hash);
				var pos = tgt.offset().top;
				$("html, body").animate({scrollTop:pos}, smoothScrollSpd, "swing");
			}
		});
	});

	/*
		○別ページからのURL
		hogehoge.com/about/?move=ID名
	*/

});



// $(function () {
//   setTimeout('stopload()', 5000);
// });

// function stopload() {
//   $('#loader-bg').delay(200).fadeOut(800);
//   $('#loader').delay(100).fadeOut(800);
//   $('#wrap').delay(800).fadeIn(1200);
// }

// for dev
// $(function () {
//   var h = $(window).height();
//   $('#loader-bg ,#loader').height(h).css('display', 'none');
// });

// header scroll
$(window).scroll(function() {
  const element = $('header')
  const scroll = $(window).scrollTop()
  const height = element.outerHeight()
  if (scroll > height) {
    element.addClass('is_fixed')
  } else {
    element.removeClass('is_fixed')
  }
})

// toggle switch
//$(".switch-button").on('click', function(e) {
//	e.preventDefault()
//	$(this).toggleClass('open');
//});

$(function(){
	$('.switch-button').click(function(e){
		$(this).toggleClass('open');
		e.preventDefault();
		return false;
	});
});
//$(function(){
//	$('.switch-button').click(function(e){
//		$(this).addClass('open');
//		e.preventDefault();
//		return false;
//	});
//});
$(function(){
	$('.followBtn a').click(function(e){
		$(this).toggleClass('nowFollow');
		e.preventDefault();
		return false;
	});
});


//window.onload = function() {
//  const button1 = $('#switch1')
//  const button2 = $('#switch2')
//  const button3 = $('#switch3')
//  const button4 = $('#switch4')
//  const button5 = $('#switch5')
//  const button6 = $('#switch6')
//  const button7 = $('#switch7')
//
//  button1.on('click', function(e) {
//    e.preventDefault()
//    $(button1).toggleClass('open')
//  })
//
//  button2.on('click', function(e) {
//    e.preventDefault()
//    $(button2).toggleClass('open')
//  })
//
//  button3.on('click', function(e) {
//    e.preventDefault()
//    $(button3).toggleClass('open')
//  })
//
//  button4.on('click', function(e) {
//    e.preventDefault()
//    $(button4).toggleClass('open')
//  })
//
//  button5.on('click', function(e) {
//    e.preventDefault()
//    $(button5).toggleClass('open')
//  })
//
//  button6.on('click', function(e) {
//    e.preventDefault()
//    $(button6).toggleClass('open')
//  })
//
//  button7.on('click', function(e) {
//    e.preventDefault()
//    $(button7).toggleClass('open')
//  })
//}

// sp menu
$(function() {
  $('#menuToggle .triger_btn_sp').on('click', function() {
    $('header').toggleClass('is_open')
    $('.wrapper').toggleClass('is_non_active')
  })
})

// searchbox
$(document).ready(function() {
  $('#search').focus(function() {
    $('.search-box').addClass('border-searching')
    $('.search-icon').addClass('si-rotate')
  })
  $('#search').blur(function() {
    $('.search-box').removeClass('border-searching')
    $('.search-icon').removeClass('si-rotate')
  })
  $('#search').keyup(function() {
    if ($(this).val().length > 0) {
      $('.go-icon').addClass('go-in')
    } else {
      $('.go-icon').removeClass('go-in')
    }
  })
  $('.go-icon').click(function() {
    $('.search-form').submit()
  })
})

// share button
$(function() {
  // 開く時
  $('#target_share_open').click(function() {
    $('.content_share').addClass('showUp')
    $('#target_share_open').addClass('showDown')

    $('#target_share_close').removeClass('showDown')
  })

  // 開いている時
  $('#target_share_close').click(function() {
    $('.content_share').removeClass('showUp')
    $('#target_share_open').removeClass('showDown')

    $('#target_share_close').addClass('showDown')
  })

  // favorite button
  $('.likebox').click(function() {
    $(this).toggleClass('active')
  })
})

$(function() {
	var shareButton = document.getElementsByClassName("share_popup");
	for (var i = 0; i < shareButton.length; i++) {
		shareButton[i].addEventListener("click", function(e) {
			e.preventDefault();
			window.open(this.href, "SNS_window", "width=600, height=500, menubar=no, toolbar=no, scrollbars=yes");
		}, false);
	}
})




/*
 * 三点リーダー
 * @param {string}
 * @return none
 */
function threeDots(name) {
  $(name).each(function() {
    const $target = $(this)
    let html = $target.html()
    const $clone = $target.clone() // 対象要素のクローンを作成する
    $clone // クローンにスタイルを適応
      .css({
        display: 'none',
        position: 'absolute',
        overflow: 'visible'
      })
      .width($target.width())
      .height('auto')
    $target.after($clone) // 対象要素の最後にクローンを追加する。
    // クローンの高さが対象要素より高い場合は、文字列を一文字消す。
    // while ((html.length > 0) && ($clone.height() > $target.height())) {
    //   html = html.substr(0, html.length - 1);
    //   $clone.html(html + '...<span class="text_dots">続きを読む</span>');
    // }

    let original = '<span class="original">'
    original += html + '</span>'

    while (html.length > 0 && $clone.height() > $target.height()) {
      html = html.substr(0, html.length - 1)
      $clone.html(
        '<span class="cmtdots">' +
          html +
          '...<span class="text_dots">続きを読む</span></span>'
      )
    }

    $target.html(original + $clone.html()) // 対象要素にクローンの要素を格納する。
    $clone.remove() // クローンを削除する。
  })
}

// DOMがよみこまれた段階で実装
$(function() {
  threeDots('.threeDots')

  $('.text_dots').click(function() {
    const $el = $(this)
      .parent()
      .parent()
    $el.addClass('active').removeClass('h-110')
  })
})
