//<![CDATA[
$(document).ready(function(){
	
	var uaInfo = UAChk();

	//PAGE : notifications
	var counter = 0;
	$('#noticeArea .um-notification-ajax .um-notification').each(function(){
		counter++;
	});
	if(counter > 0){
		$('#noticeArea .um-notifications-none').addClass('hide');
		$('#noticeArea .um-notification-ajax').removeClass('hide');
	}else{
		$('#noticeArea .um-notifications-none').removeClass('hide');
		$('#noticeArea .um-notification-ajax').addClass('hide');
	}
	
	//PAGE : profile edit
	$('.profEditPage .um-profile-photo').append('<div class="mypageTitleArea"><h2 class="mypageTitle">プロフィール変更</h2><div class="pageCatch"><p>氏名は任意でご登録いただけます</p></div></div>');
	
	//PAGE : member/follow
	/* follow解除 */
	$('.followRemoveBtn').click(function(e){
		$(this).removeClass('open');
		var user_id1 = $(this).data('user_id1');
		var user_id2 = $(this).data('user_id2');
		
		$.ajax({
			type: 'post',
			url: ajaxUrl, // admin-ajax.php のURLが格納された変数
			data: {
				'action': 'delete_renewer_follow', // 登録したアクション名
				'user_id1' : user_id1,
				'user_id2' : user_id2
			},
			success: function(data) {
									console.log(data);
				$('#renewer.followBlock .followList li[data-user_id1 = '+user_id1+' ]').fadeOut();
			}
		});
		e.preventDefault();
		return false;
	});
	
	
	var notification_flg = $('.is_user_notification_flg').html();
	if(notification_flg != 'true'){
		//コメントが有ったとき、フォローされたときをメンバーだったら非表示に
		$('input[name="um-notifyme[user_comment]"]').parents('.um-field-checkbox').css("display","none");
		$('input[name="um-notifyme[new_follow]"]').parents('.um-field-checkbox').css("display","none");
	}
	
	
	$('input[name="um-notifyme[follow_renewer_newpost_mail]"],input[name="um-notifyme[follow_agenda_newpost_mail]"],input[name="um-notifyme[follow_series_newpost_mail]"]').parents('.um-field-checkbox').css({
		'margin-top' : '-20px'
	});
	

	$('input[name="um-notifyme[follow_renewer_newpost]"]').on('click',function(e){
		if($('input[name="um-notifyme[follow_renewer_newpost_mail]"]').prop('checked')){
			$('input[name="um-notifyme[follow_renewer_newpost_mail]"]').prop('checked', false);
		}
	});
	$('input[name="um-notifyme[follow_renewer_newpost_mail]"]').on('click',function(e){
		if($('input[name="um-notifyme[follow_renewer_newpost]"]').prop('checked')){
			$('input[name="um-notifyme[follow_renewer_newpost]"]').prop('checked', false);
		}
	});

	$('input[name="um-notifyme[follow_agenda_newpost]"]').on('click',function(e){
		if($('input[name="um-notifyme[follow_agenda_newpost_mail]"]').prop('checked')){
			$('input[name="um-notifyme[follow_agenda_newpost_mail]"]').prop('checked', false);
		}
	});
	$('input[name="um-notifyme[follow_agenda_newpost_mail]"]').on('click',function(e){
		if($('input[name="um-notifyme[follow_agenda_newpost]"]').prop('checked')){
			$('input[name="um-notifyme[follow_agenda_newpost]"]').prop('checked', false);
		}
	});

	$('input[name="um-notifyme[follow_series_newpost]"]').on('click',function(e){
		if($('input[name="um-notifyme[follow_series_newpost_mail]"]').prop('checked')){
			$('input[name="um-notifyme[follow_series_newpost_mail]"]').prop('checked', false);
		}
	});
	$('input[name="um-notifyme[follow_series_newpost_mail]"]').on('click',function(e){
		if($('input[name="um-notifyme[follow_series_newpost]"]').prop('checked')){
			$('input[name="um-notifyme[follow_series_newpost]"]').prop('checked', false);
		}
	});

	if($('input[name="um-notifyme[follow_renewer_newpost]"]').prop('checked') && $('input[name="um-notifyme[follow_renewer_newpost_mail]"]').prop('checked')){
		$('input[name="um-notifyme[follow_renewer_newpost]"]').prop('checked',true);
		$('input[name="um-notifyme[follow_renewer_newpost_mail]"]').prop('checked',false);
	}

	if($('input[name="um-notifyme[follow_agenda_newpost]"]').prop('checked') && $('input[name="um-notifyme[follow_agenda_newpost_mail]"]').prop('checked')){
		$('input[name="um-notifyme[follow_agenda_newpost]"]').prop('checked',true);
		$('input[name="um-notifyme[follow_agenda_newpost_mail]"]').prop('checked',false);
	}

	if($('input[name="um-notifyme[follow_series_newpost]"]').prop('checked') && $('input[name="um-notifyme[follow_series_newpost_mail]"]').prop('checked')){
		$('input[name="um-notifyme[follow_series_newpost]"]').prop('checked',true);
		$('input[name="um-notifyme[follow_series_newpost_mail]"]').prop('checked',false);
	}


	
});
//]]>