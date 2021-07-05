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
	var leaveScrollNum = -150;
	var smoothScrollSpd = 500;

	// 除外するタグ指定
	var smoothScrollNotList = '.commentbox , #headerShareLinkBtn , .uk-slider-nav a .uk-button,.popup-modal,.modalClose';
	//var smoothScrollNotList = '#globalNavBtn a, #third a, #fourth a, #fifth a';

	$('a[href^="#"]').not(smoothScrollNotList).click(function(e){
		leaveScrollNum = ($('header.is_fixed').outerHeight()) * -1;

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
				leaveScrollNum = ($('header.is_fixed').outerHeight()) * -1;

				var hh = val.replace('?','').replace(smoothScrollPrefix,'');
				var hash = '#' + hh;
				var tgt = $(hash);
				var pos = tgt.offset().top+leaveScrollNum;
				$("html, body").animate({scrollTop:pos}, smoothScrollSpd, "swing");
			}
		});
	});

	/*
		○別ページからのURL
		hogehoge.com/about/?move=ID名
	*/

	//アイコン上部の数字
	if($('#noticeCount').length){
		var noticeCountAll = document.getElementById('noticeCount');
		var noticeCount = noticeCountAll.innerHTML;

		if(noticeCount == '0'){
			$('#noticeCount').addClass('hide');
		}
	}

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



//ログインポップアップ
$(window).load(function(){
	$('.popup-modal').magnificPopup({
		type: 'inline',
		preloader: false,
		removalDelay: 300,
		mainClass: 'mfp-fade',
		showCloseBtn: false,
		fixedContentPos:true
	});




	//閉じるリンクの設定
	$(document).on('click', '.popup-modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});


	if($('#modalLoginWrap .um-field-error').length){
			$.magnificPopup.open({
				items: {src: '#modalLoginWrap'},
				type: 'inline',
				preloader: false,
				removalDelay: 300,
				mainClass: 'mfp-fade',
				showCloseBtn: false,
				modal: true,
			}, 0);
	}
	if($('#modalLoginWrap .um-error-code-invalid_username').length){
		$('#um_field_10_username').append('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>不明なリニュアーIDです。再確認するか、メールアドレスでログインください。</div>');
	}
});

//$('.hatenaBtn').click(function(e) {
//	alert('aaa');
//
//});


$(function(){
	/* follow */
	//リニュアー


//	if($('#renewer .followViewArea .um-followers-user-btn .um-unfollow-btn').length){
//		console.log('ある');
//	}

//	if($('#renewer .followViewArea .followList .um-button').addClass('um-follow-btn')){
//		console.log('test');
//	}

	$('#renewer .followViewArea .followList .um-button').click(function(e){

		//var user_id1 = $(this).data('user_id1');


//		if($(this).hasClass('um-unfollow-btn')){
//			alert('ddd');
//			$.ajax({
//				type: 'post',
//				url: ajaxUrl, // admin-ajax.php のURLが格納された変数
//				data: {
//					//'action': 'delete_user_follow', // 登録したアクション名
//					'user_id1' : user_id1,
////					'taxnomy' : taxonomy,
////					'taxnomy_id' : taxonomy_id
//				},
//				success: function(data) {
//										console.log(data);
////					$('.followViewArea .followList li[data-taxonomy_id = '+taxonomy_id+' ]').fadeOut();
//				}
//			});
//		}
//		$('.followViewArea .followList li[data-taxonomy_id = '+taxonomy_id+' ]').fadeOut();
	});


	//シリーズ・アジェンダ
	$('.articleFollow').click(function(e){
		$(this).toggleClass('open');
		var uid = $(this).data('uid');
		var taxonomy = $(this).data('taxonomy');
		var taxonomy_id = $(this).data('taxonomy_id');

		if($(this).hasClass('open')){
			$.ajax({
				type: 'post',
				url: ajaxUrl, // admin-ajax.php のURLが格納された変数
				data: {
					'action': 'add_user_follow', // 登録したアクション名
					'uid' : uid,
					'taxnomy' : taxonomy,
					'taxnomy_id' : taxonomy_id
				},
				success: function(data) {
//					console.log(data);
				}
			});
		}else{
			$.ajax({
				type: 'post',
				url: ajaxUrl, // admin-ajax.php のURLが格納された変数
				data: {
					'action': 'delete_user_follow', // 登録したアクション名
					'uid' : uid,
					'taxnomy' : taxonomy,
					'taxnomy_id' : taxonomy_id
				},
				success: function(data) {
//					console.log(data);
					$('.followViewArea .followList li[data-taxonomy_id = '+taxonomy_id+' ]').fadeOut();
				}
			});
		}
		e.preventDefault();
		return false;
	});

	/* bookmark */
	$('.postStockBtn').click(function(e){
		$(this).toggleClass('stock');
		$('#clip_fixBlock').toggleClass('clip_stock');
//		$('.clipboxWrap').toggleClass('active');
//		$('.clipboxWrap').addClass('baloonShow');
		var uid = $(this).data('uid');
		var post_id = $(this).data('post_id');

//		setTimeout(function(){
//			$('.clipboxWrap').removeClass('baloonShow');
//		},3000);
//		var $stockNum = $("#js-stockNum");
//		$stockNum.val(0);
//		console.log($stockNum);
//		var stockNum = $stockNum.val();
//



		if($(this).hasClass('stock')){
			$.ajax({
				type: 'post',
				url: ajaxUrl, // admin-ajax.php のURLが格納された変数
				data: {
					'action': 'add_bookmark', // 登録したアクション名
					'uid' : uid,
					'follow' : 'article_follow',
					'post_id' : post_id
				},
				success: function(data) {
//					console.log(data);
//					$('.clipbox[ data-post_id = '+post_id+' ]').html(data);
					$('.postStockBtn[ data-post_id = '+post_id+' ]').addClass('stock');
					$('#clip_fixBlock[ data-post_id = '+post_id+' ]').addClass('clip_stock');
				}
			});
		}else{
			$.ajax({
				type: 'post',
				url: ajaxUrl, // admin-ajax.php のURLが格納された変数
				data: {
					'action': 'delete_bookmark', // 登録したアクション名
					'uid' : uid,
					'follow' : 'article_follow',
					'post_id' : post_id
				},
				success: function(data) {
//					console.log(data);
//					$('.clipbox[ data-post_id = '+post_id+' ]').html(data);
					$('.postStockBtn[ data-post_id = '+post_id+' ]').removeClass('stock');
					$('#clip_fixBlock[ data-post_id = '+post_id+' ]').removeClass('clip_stock');
					$('.bookmarkPage .article_middle[ data-post_id = '+post_id+' ]').fadeOut();
				}
			});
		}
		e.preventDefault();
		return false;
	});




	//コメント削除
	$('.commentDeleteBtn').click(function(e){
		var comment_id = $(this).data('comment_id');
		var comment_text = $(this).data('comment_text');
		var hide_li_base = $(this).data('hide_li');
		var hide_li = '#' + hide_li_base;
		var result = window.confirm('このコメントを削除しますか？');

//		var commentBlock = $('.commentDeleteBtn[ data-comment_id = '+comment_id+' ]').parents('#li-comment-' + comment_id);
		if( result ) {
//			console.log('OKがクリックされました');
			$.ajax({
				type: 'post',
				url: ajaxUrl, // admin-ajax.php のURLが格納された変数
				data: {
					'action': 'delete_my_comment', // 登録したアクション名
					'comment_id' : comment_id,
					'force_delete' : 'false'
				},
				success: function(data) {
					console.log(data);
					$(hide_li).fadeOut();
				}
			});
		}

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

$(function(){
	$('.followCover').html('<a href="#modalLoginWrap" class="popup-modal"></a>');
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
  $('button.menu-trigger').on('click', function() {
    $('.menu-trigger').toggleClass('active');
    $('header').toggleClass('is_open');
    $('.wrapper').toggleClass('is_non_active');
    $('body').toggleClass('is_non_active');
  })
})

// searchbox
$(document).ready(function() {
	$('.searchInput').focus(function() {
    $('.search-box').addClass('border-searching')
    $('.search-icon').addClass('si-rotate')
  })
	$('.searchInput').blur(function() {
    $('.search-box').removeClass('border-searching')
    $('.search-icon').removeClass('si-rotate')
  })
	$('.searchInput').keyup(function() {
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
//  $('.likebox').click(function() {
//    $(this).toggleClass('stock')
//  })
})

//$(function() {
//	var shareButton = document.getElementsByClassName("share_popup");
//	for (var i = 0; i < shareButton.length; i++) {
//		shareButton[i].addEventListener("click", function(e) {
//			e.preventDefault();
//			window.open(this.href, "SNS_window", "width=600, height=500, menubar=no, toolbar=no, scrollbars=yes");
//		}, false);
//	}
//})

$(function(){


	var widthHalf = window.screen.width / 2,
			heightHalf = window.screen.height / 2,
			blankWindowWidth = 640,   // 別窓の横幅
			blankWindowHeight = 360,  // 別窓の縦幅
			options = { // 後ほど記載する window.open の第３引数で使用する
				left  : Math.floor(widthHalf - (blankWindowWidth / 2)),   // 別窓の X座標
				top   : Math.floor(heightHalf - (blankWindowHeight / 2)), // 別窓の Y座標
				width : blankWindowWidth,
				height: blankWindowHeight
			};

//	$('.share-btn').find('a').each(function(index, el) {
//		$(this).on('click', function(event) {
//			if(window.innerWidth < 768) return;
//			event.preventDefault();
//			var thisHref = $(this).attr('href'),
//					arg = 'left=' + options.left
//			+ ',top=' + options.top
//			+ ',width=' + options.width
//			+ ',height=' + options.height;
//
//			window.open(thisHref, 'blankShareWindow', arg);
//		});
//	});
	$('.share_popup').each(function(index, el) {
		$(this).on('click', function(event) {
			if(window.innerWidth < 768) return;
			event.preventDefault();
			var thisHref = $(this).attr('href'),
					arg = 'left=' + options.left
			+ ',top=' + options.top
			+ ',width=' + options.width
			+ ',height=' + options.height;

			window.open(thisHref, 'blankShareWindow', arg);
		});
	});

});







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
  });
}

// DOMがよみこまれた段階で実装
$(function() {
  threeDots('.threeDots')

  $('.text_dots').click(function() {
    const $el = $(this)
      .parent()
      .parent()
    $el.addClass('active').removeClass('h-110');
  });
});

let isFolderOpen = false

//シリーズ説明文
$(() => {
	$('.see-more').on('click', function() {
		isFolderOpen = !isFolderOpen

		isFolderOpen ? openFolder() : closeFolder()

		function openFolder() {
			$('.see-more > span').text('折りたたむ');
			$('.folder').addClass('open');
		}

		function closeFolder() {
			$('.see-more > span').text('もっと見る');
			$('.folder').removeClass('open');
		}
	});
});
