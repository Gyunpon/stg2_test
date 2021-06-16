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
		var $this = $(this);
		if($this.hasClass('is-hide')){
			var index = $this.index(".grad-trigger"); //トリガーが何個目か
			var addHeight = itemHeights[index]; //個数に対応する高さを取得
			$this.removeClass("is-hide");
			$this.addClass("is-show").next().animate({height: addHeight},200).removeClass("is-hide"); //高さを元に戻す
			$this.text('折りたたむ');
		}else{
			$this.removeClass("is-show");
			$this.addClass("is-hide").next().animate({height: '110px'},200).removeClass("is-show"); //高さを元に戻す
			$this.text('続きを見る');
		}
	});
	

	
	//コメント欄が空だったら送信ボタン無効化
	$(function() {
		//始めにjQueryで送信ボタンを無効化する
		$('#submit').prop("disabled", true);

		//入力欄の操作時
		$('#comment').change(function () {
			//必須項目が空かどうかフラグ
			let flag = true;
			//必須項目をひとつずつチェック
			$('#comment').each(function(e) {
				//もし必須項目が空なら
				if ($('#comment').eq(e).val() === "") {
					flag = false;
				}
			});
			//全て埋まっていたら
			if (flag) {
				//送信ボタンを復活
				$('#submit').prop("disabled", false);
			}
			else {
				//送信ボタンを閉じる
				$('#submit').prop("disabled", true);
			}
		});
	});
	
	
	
	
	
	
	//分割したい個数を入力
	var division = 10;

	//要素の数を数える
	var divlength = $('.comments-list li').length;
	//分割数で割る
	dlsizePerResult = divlength / division;
	//分割数 刻みで後ろにmorelinkを追加する
	for(i=1;i<=dlsizePerResult;i++){
		$('.comments-list li').eq(division*i-1)
			.after('<div class="morelinkWrap link'+i+'"><span class="morelink">コメントをもっと見る</span></div>');
	}
	//最初のli（分割数）と、morelinkを残して他を非表示
	$('.comments-list li,.morelinkWrap').hide();
	for(j=0;j<division;j++){
		$('.comments-list li').eq(j).show();
	}
	$('.morelinkWrap.link1').show();

	//morelinkにクリック時の動作
	$('.morelink').click(function(){
		//何個目のmorelinkがクリックされたかをカウント
		index = $(this).index('.morelink');
		//(クリックされたindex +2) * 分割数 = 表示数
		for(k=0;k<(index+2)*division;k++){
			$('.comments-list li').eq(k).fadeIn();
		}

		//一旦全てのmorelink削除
		$('.morelinkWrap').hide();
		//次のmorelink(index+1)を表示
		$('.morelinkWrap').eq(index+1).show();

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