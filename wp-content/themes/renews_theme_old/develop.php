<?php

/*
ユーザーの権限により管理画面で見れる投稿を制限する
特権管理者/管理者/編集者（内部）
	すべての投稿の閲覧可能になるので下記機能の実装はなし
編集者（外部）
	自分が管理するユーザーと自分の投稿のみ閲覧可能
リニュアー（投稿者）
	自分の投稿のみ閲覧可能
*/
function show_only_authorpost($query) {


	global $wpdb;
// 	$wpdb->show_errors();
	$user_obj = wp_get_current_user();
	$current_user_id = $user_obj->ID;
	$current_user_role = $user_obj->roles;

	$in_postAuthor = array();

	if(in_array("um_micro_editor", $current_user_role) || in_array("editor", $current_user_role)){
		//マイクロ編集者（外部）設定
		//権限グループをすべて取得
		$group_array = $wpdb->get_results("select * from wp_collaboration");
		
		//自分が管理するグループからユーザーの一覧を配列化
		foreach($group_array as $group){
			$moderators_serialize = $group->moderators;
			$moderators_array = unserialize($moderators_serialize);
			
			if(in_array($current_user_id,$moderators_array)){
				$collabgroup = $group->collabgroup;
	
				$group_user_array = $wpdb->get_results("select * from wp_collabwriters where groupid = $collabgroup");
				
				foreach($group_user_array as $group_user){
					$in_postAuthor[] =  intVal($group_user -> writerid);
				}
				$in_postAuthor[] = $current_user_id;
			}
			
			$query->set('author__in', $in_postAuthor);
			
		}
	}elseif(in_array("um_renewer", $current_user_role)){
		//リニュアー設定
		$in_postAuthor[] = $current_user_id;
		$query->set('author__in', $in_postAuthor);
	}
}
add_action('pre_get_posts', 'show_only_authorpost');


/*
	権限によりテキストエディターの使用を禁止
	管理者・内部編集者のみテキストエディター入力可能
*/
add_filter( 'wp_editor_settings', function ( $settings ) {

	//ユーザーの権限を取得
	$user_obj = wp_get_current_user();
	$current_user_role = $user_obj->roles;
		
	if ( user_can_richedit() ) {
		
		if(!in_array("administrator", $current_user_role) && !in_array("editor", $current_user_role)){
		    $settings['quicktags'] = false;
		}
		
	}
	return $settings;
} );

//カスタム投稿に作成者のフィールドを作成
add_action('admin_menu', 'myplugin_add_custom_box');
function myplugin_add_custom_box()
{
    if (function_exists('add_meta_box')) {
        add_meta_box('myplugin_sectionid', __('作成者', 'myplugin_textdomain'), 'post_author_meta_box', 'articles', 'advanced');
    }
}

?>