//<![CDATA[
jQuery(document).ready(function($){
	
	$('.comments-list > li .commentText').each(function() {
		commentH = $(this).height();
		if(commentH > 110){
			$(this).parent().addClass('overComm');
		}
	});

	
	var itemHeights = []; //
	$(function(){
		$(".grad-item").each(function(){ //ターゲット(縮めるアイテム)
			var thisHeight = $(this).height(); //ターゲットの高さを取得
			itemHeights.push(thisHeight); //それぞれの高さを配列に入れる
			$(this).addClass("is-hide"); //CSSで指定した高さにする
		});
	});

	$(".grad-trigger").click(function(){
		var index = $(this).index(".grad-trigger"); //トリガーが何個目か
		var addHeight = itemHeights[index]; //個数に対応する高さを取得
		$(this).fadeOut().addClass("is-show").next().animate({height: addHeight},200).removeClass("is-hide"); //高さを元に戻す
	});
	

	
//	var $accordionComments = $('.accordionComments');
//	var $depth1 = $('.comment.depth-1');
//	var $commentsMoreBtn = $('.commentsMoreBtn a');
//	
//	var num_commentLim = 5;
//	var cl_commentsMoreBtnClose = 'closeBtn';
//	
//	if($accordionComments.size()){
//		var trgPos = $depth1.eq(num_commentLim - 1).position();
//		var h = Math.floor(trgPos.top);
//		
//		$accordionComments.css('height',h);
//		
//		$commentsMoreBtn.on('click.commentEv',function(e){
//			var $this = $(this);
//			if($this.hasClass(cl_commentsMoreBtnClose)){
//				$accordionComments.css('height',h);
//				$(this).removeClass(cl_commentsMoreBtnClose);
//			}else{
//				var fullH = $accordionComments.find('.comments-list').outerHeight(true);
//				$accordionComments.css('height',fullH);
//				$(this).addClass(cl_commentsMoreBtnClose);
//			}
//			
//			e.preventDefault();
//			return false;
//		});
//	}
//	
//	
//	// recomAreaMove
//	var $recomTourMoveBtn = $('.recomTourMoveBtn a');
//	var id_moveTrg = '#singlePageRecommend';
//	
//	if($(id_moveTrg).size()){
//		$recomTourMoveBtn.on('click.moveEv',function(e){
//			var target = $(id_moveTrg);
//			var position = (target.offset().top);
//			$("html, body").animate({scrollTop:position}, 300, "swing");
//			
//			e.preventDefault();
//			return false;
//		});
//	}else{
//		$recomTourMoveBtn.parent().hide();
//	}
	
});
//]]>