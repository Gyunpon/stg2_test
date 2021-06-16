<?php
/*
プラグインの通知システムにフックをかけて、各種通知を設定する。
*/
add_filter('um_notifications_core_log_types', 'add_custom_notification_type', 200 );
function add_custom_notification_type( $array ) {

	/*
		メールなし
	*/
		//フォローリニュアー記事投稿時
		$array['follow_renewer_newpost'] = array(
			'title' => 'フォローリニュアー記事更新時', // title for reference in backend settings
			'template' => '{renewer}さんが{post_title}を公開しました。', // the template, {member} is a tag, this is how the notification will appear in your notifications
			'account_desc' => 'フォローしているリニュアーが新しい記事を投稿した時、通知を受け取る', // title for account page (notification settings)
		);
			$array['follow_renewer_newpost_mail'] = array(
				'title' => 'フォローリニュアー記事更新時(メール)', // title for reference in backend settings
				'template' => '{renewer}さんが{post_title}を公開しました。', // the template, {member} is a tag, this is how the notification will appear in your notifications
				'account_desc' => '→ メールでも通知を受け取る', // title for account page (notification settings)
			);

		//フォローアジェンダ記事投稿時
		$array['follow_agenda_newpost'] = array(
			'title' => 'フォローアジェンダ記事追加時', // title for reference in backend settings
			'template' => 'アジェンダ：{agenda_title}に{post_title}が投稿されました。', // the template, {member} is a tag, this is how the notification will appear in your notifications
			'account_desc' => 'フォローしているアジェンダに新しい記事が投稿された時、通知を受け取る', // title for account page (notification settings)
		);
			$array['follow_agenda_newpost_mail'] = array(
				'title' => 'フォローアジェンダ記事追加時(メール)', // title for reference in backend settings
				'template' => 'アジェンダ：{agenda_title}に{post_title}が投稿されました。', // the template, {member} is a tag, this is how the notification will appear in your notifications
				'account_desc' => '→ メールでも通知を受け取る', // title for account page (notification settings)
			);
		//フォローシリーズ記事投稿時
		$array['follow_series_newpost'] = array(
			'title' => 'フォローシリーズ記事追加時', // title for reference in backend settings
			'template' => 'シリーズ：{series_title}に{post_title}が投稿されました。', // the template, {member} is a tag, this is how the notification will appear in your notifications
			'account_desc' => 'フォローしているシリーズに新しい記事が投稿された時、通知を受け取る', // title for account page (notification settings)
		);
			$array['follow_series_newpost_mail'] = array(
				'title' => 'フォローシリーズ記事追加時(メール)', // title for reference in backend settings
				'template' => 'シリーズ：{series_title}に{post_title}が投稿されました。', // the template, {member} is a tag, this is how the notification will appear in your notifications
				'account_desc' => '→ メールでも通知を受け取る', // title for account page (notification settings)
			);
	
	return $array;
}

/*
	フォローリニュアー記事公開時アクション
*/
add_action('transition_post_status', function($new_status, $old_status, $post) {
	if(($old_status == 'draft' && $new_status == 'publish') || $old_status == 'future' && $new_status == 'publish' || ($old_status == 'auto-draft' && $new_status == 'publish') || ($old_status == 'pending' && $new_status == 'publish')) {
		trigger_new_post($post);
	}elseif($new_status == 'future'){
		if($new_status == 'publish'){
			trigger_new_post($post);
		}
	}
	
}, 10, 3);
function trigger_new_post($post){

	global $um_notifications;
	global $wpdb;

	$postData = get_post($post->ID);

	//投稿ステータス
	if ($postData){

		//関連ユーザー選択で選択されている著者
		if(have_rows('author_select')):
		while(have_rows('author_select')): the_row();
		$user_data = get_sub_field('author');
		if($user_data){
			$authorID = $user_data['ID'];
			$authorName = $user_data['display_name'];
		}
		endwhile;
		else:
			$author = get_userdata($postData->post_author);
			$authorID = $author->ID;
			$authorName = $author -> display_name;
		endif;

	}
	
	$rows = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."um_followers WHERE user_id1 = ".$authorID."");

	$vars['notification_uri'] = get_permalink( $post->ID );
	$vars['renewer'] = $authorName;
	$vars['post_title'] = get_the_title( $post->ID );
	foreach ($rows as $row){
		UM()->Notifications_API()->api()->store_notification($row->user_id2,'follow_renewer_newpost',$vars);
	}
}

//フォローアジェンダ記事公開時アクション
function trigger_agenda_post( $new_status, $old_status, $post ){

	global $um_notifications;
	global $wpdb;

	$runFlug = false;

	if(($old_status == 'draft' && $new_status == 'publish') || ($old_status == 'future' && $new_status == 'publish') || ($old_status == 'auto-draft' && $new_status == 'publish') || ($old_status == 'pending' && $new_status == 'publish')){
		$agenda_terms = get_the_terms($post->ID,'agenda');
		if(!empty($agenda_terms)){
			foreach($agenda_terms as $t_a){//agendatag
				$tag_id = $t_a->term_id;
				$tag_name = $t_a->name;

				$rows = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."usermeta WHERE meta_value = ".$tag_id." AND meta_key = 'agenda_follow'");

				$vars['notification_uri'] = get_permalink( $post->ID );
				$vars['agenda_title'] = $tag_name;
				$vars['post_title'] = get_the_title($post->ID);
				foreach ($rows as $row){
					UM()->Notifications_API()->api()->store_notification($row->user_id,'follow_agenda_newpost',$vars);
				}
			}
		}
	}
}
add_action( 'transition_post_status', 'trigger_agenda_post', 10,3);


//フォローシリーズ記事公開時アクション
function trigger_series_post( $new_status, $old_status, $post ){
	global $um_notifications;
	global $wpdb;

	$runFlug = false;

	if(($old_status == 'draft' && $new_status == 'publish') || ($old_status == 'future' && $new_status == 'publish') || ($old_status == 'auto-draft' && $new_status == 'publish') || ($old_status == 'pending' && $new_status == 'publish')){
		$series_terms = get_the_terms($post->ID,'series');
		if(!empty($series_terms)){
			foreach($series_terms as $t_s){//agendatag
				$tag_id = $t_s->term_id;
				$tag_name = $t_s->name;
	
				$rows = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."usermeta WHERE meta_value = ".$tag_id." AND meta_key = 'series_follow'");
	
				$vars['notification_uri'] = get_permalink( $post->ID );
				$vars['series_title'] = $tag_name;
				$vars['post_title'] = get_the_title($post->ID);
				foreach ($rows as $row){
					UM()->Notifications_API()->api()->store_notification($row->user_id,'follow_series_newpost',$vars);
				}
			}
		}
	}

}
add_action( 'transition_post_status', 'trigger_series_post', 10,3);




//==メールあり========================================================================================


add_action('transition_post_status', function($new_status, $old_status, $post) {
	if(($old_status == 'draft' && $new_status == 'publish') || $old_status == 'future' && $new_status == 'publish' || ($old_status == 'auto-draft' && $new_status == 'publish') || ($old_status == 'pending' && $new_status == 'publish')) {
		trigger_new_post_mail($post);
	}elseif($new_status == 'future'){
		if($new_status == 'publish'){
			trigger_new_post_mail($post);
		}
	}
	
}, 10, 3);
function trigger_new_post_mail($post){

	global $um_notifications;
	global $wpdb;

	$postData = get_post($post->ID);

	//投稿ステータス
	if ($postData){

		//関連ユーザー選択で選択されている著者
		if(have_rows('author_select')):
		while(have_rows('author_select')): the_row();
		$user_data = get_sub_field('author');
		if($user_data){
			$authorID = $user_data['ID'];
			$authorName = $user_data['display_name'];
		}
		endwhile;
		else:
			$author = get_userdata($postData->post_author);
			$authorID = $author->ID;
			$authorName = $author -> display_name;
		endif;

	}
	
	$rows = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."um_followers WHERE user_id1 = ".$authorID."");

	$vars['notification_uri'] = get_permalink( $post->ID );
	$vars['renewer'] = $authorName;
	$vars['post_title'] = get_the_title( $post->ID );
	
	foreach ($rows as $row){
		um_fetch_user( $row->user_id2 );
		$userdata = get_userdata( $row->user_id2 );
		if(!empty(UM()->user()->profile["_notifications_prefs"])){

			UM()->Notifications_API()->api()->store_notification($row->user_id2,'follow_renewer_newpost_mail',$vars);
			$np = unserialize(UM()->user()->profile["_notifications_prefs"]);
			$follow_mail_flg = $np['follow_renewer_newpost_mail'];
			$follow_mail_flg_org = $np['follow_renewer_newpost'];
			if($follow_mail_flg && !$follow_mail_flg_org){
				UM()->mail()->send( $userdata->user_email, 'follower_email_settings', array(
					'tags'=> array(
						'{to_email}',
						'{renewer_name}',
						'{article_name}',
						'{article_link}',
					),
					'tags_replace' => array(
						$userdata->user_email,
						$authorName,
						$vars['post_title'],
						$vars['notification_uri'],
					)
				));
			}
		}


	}
}



//フォローアジェンダ記事公開時アクション
function trigger_agenda_post_mail( $new_status, $old_status, $post ){

	global $um_notifications;
	global $wpdb;

	$runFlug = false;

	if(($old_status == 'draft' && $new_status == 'publish') || ($old_status == 'future' && $new_status == 'publish') || ($old_status == 'auto-draft' && $new_status == 'publish') || ($old_status == 'pending' && $new_status == 'publish')){
			$agenda_terms = get_the_terms($post->ID,'agenda');
			if(!empty($agenda_terms)){
				foreach($agenda_terms as $t_a){//agendatag
					$tag_id = $t_a->term_id;
					$tag_name = $t_a->name;
	
					$rows = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."usermeta WHERE meta_value = ".$tag_id." AND meta_key = 'agenda_follow'");
	
					$vars['notification_uri'] = get_permalink( $post->ID );
					$vars['agenda_title'] = $tag_name;
					$vars['post_title'] = get_the_title($post->ID);
					foreach ($rows as $row){
						$userdata = get_userdata( $row->user_id );
						um_fetch_user( $row->user_id );
						if(!empty(UM()->user()->profile["_notifications_prefs"])){
							$np = unserialize(UM()->user()->profile["_notifications_prefs"]);
							$follow_mail_flg = $np['follow_agenda_newpost_mail'];
							$follow_mail_flg_org = $np['follow_agenda_newpost'];
							if($follow_mail_flg && !$follow_mail_flg_org){
								UM()->Notifications_API()->api()->store_notification($row->user_id,'follow_agenda_newpost_mail',$vars);
								UM()->mail()->send( $userdata->user_email, 'agenda_email_settings', array(
									'tags'=> array(
										'{to_email}',
										'{series_name}',
										'{article_name}',
										'{article_link}',
									),
									'tags_replace' => array(
										$userdata->user_email,
										$tag_name,
										$vars['post_title'],
										$vars['notification_uri']
									)
								));
							}
						}
					}
				}
			}
		}
}
add_action( 'transition_post_status', 'trigger_agenda_post_mail', 10,3);


//フォローシリーズ記事公開時アクション
function trigger_series_post_mail( $new_status, $old_status, $post ){

	global $um_notifications;
	global $wpdb;

	$runFlug = false;

	if(($old_status == 'draft' && $new_status == 'publish') || ($old_status == 'future' && $new_status == 'publish') || ($old_status == 'auto-draft' && $new_status == 'publish') || ($old_status == 'pending' && $new_status == 'publish')){
		$series_terms = get_the_terms($post->ID,'series');
		if(!empty($series_terms)){
			foreach($series_terms as $t_s){//agendatag
				$tag_id = $t_s->term_id;
				$tag_name = $t_s->name;
	
				$rows = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."usermeta WHERE meta_value = ".$tag_id." AND meta_key = 'series_follow'");
	
				$vars['notification_uri'] = get_permalink( $post->ID );
				$vars['series_title'] = $tag_name;
				$vars['post_title'] = get_the_title($post->ID);
				foreach ($rows as $row){
					$userdata = get_userdata( $row->user_id );
					um_fetch_user( $row->user_id );
					if(!empty(UM()->user()->profile["_notifications_prefs"])){
						$np = unserialize(UM()->user()->profile["_notifications_prefs"]);
						$follow_mail_flg = $np['follow_series_newpost_mail'];
						$follow_mail_flg_org = $np['follow_series_newpost'];
						if($follow_mail_flg && !$follow_mail_flg_org){
							UM()->Notifications_API()->api()->store_notification($row->user_id,'follow_series_newpost_mail',$vars);
							UM()->mail()->send( $userdata->user_email, 'series_email_settings', array(
								'tags'=> array(
									'{to_email}',
									'{series_name}',
									'{article_name}',
									'{article_link}',
								),
								'tags_replace' => array(
									$userdata->user_email,
									$tag_name,
									$vars['post_title'],
									$vars['notification_uri']
								)
							));
						}
					}
				}
			}
		}
	}

}
add_action( 'transition_post_status', 'trigger_series_post_mail', 10,3);


function addFollowerMail( $emails ) {

	$custom_emails = array(
		'follower_email_settings'	 => array(
				'key'						 => 'follower_email_settings',
				'title'					 => 'フォロワーの記事公開時のメール',
				'subject'				 => 'フォローしているリニュアーが記事を公開しました。',
				'body'					 => '',
				'description'		 => '',
				'recipient'			 => 'user',
				'default_active' => true
		),
		'agenda_email_settings'	 => array(
				'key'						 => 'agenda_email_settings',
				'title'					 => 'フォロー中のアジェンダに記事が追加された際のメール',
				'subject'				 => 'フォローしているアジェンダに記事が追加されました。',
				'body'					 => '',
				'description'		 => '',
				'recipient'			 => 'user',
				'default_active' => true
		),
		'series_email_settings'	 => array(
				'key'						 => 'series_email_settings',
				'title'					 => 'フォロー中のシリーズに記事が追加された際のメール',
				'subject'				 => 'フォローしているシリーズに記事が追加されました。',
				'body'					 => '',
				'description'		 => '',
				'recipient'			 => 'user',
				'default_active' => true
		),
	);

	UM()->options()->options = array_merge( array(
			'follower_email_settings_on'	 => 1,
			'follower_email_settings_sub'	 => 'フォローしているリニュアーが記事を公開しました。',
			'agenda_email_settings_on'	 => 1,
			'agenda_email_settings_sub'	 => 'フォローしているアジェンダに記事が追加されました。',
			'series_email_settings_on'	 => 1,
			'series_email_settings_sub'	 => 'フォローしているシリーズに記事が追加されました。',
			), UM()->options()->options );

	return array_merge( $custom_emails, $emails );
}
add_filter( 'um_email_notifications', 'addFollowerMail' );



?>