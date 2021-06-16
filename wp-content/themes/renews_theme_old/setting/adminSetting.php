<?php
/*-------------------------------------------------------------------------------*/
// 管理画面 項目初期設定

if(is_admin()){
	// 1ページに表示する最大投稿数
	update_option( 'posts_per_page', '1' );
	
	// コメント
	// この投稿に含まれるすべてのリンクへの通知を試みる
	update_option( 'default_pingback_flag', '0' );
	
	// 新しい記事に対し他のブログからの通知 (ピンバック・トラックバック) を受け付ける
	update_option( 'default_ping_status', 'closed' );
	
	// 新しい投稿へのコメントを許可する
	update_option( 'default_comment_status', 'open' );
	
	// コメントの投稿者の名前とメールアドレスの入力を必須にする
	update_option( 'require_name_email', '1' );
	
	// ユーザー登録してログインしたユーザーのみコメントをつけられるようにする
	update_option( 'comment_registration', '1' );
	
	// コメントが投稿されたとき
	update_option( 'comments_notify', '0' );
	
	// コメントがモデレーションのために保留されたとき
	update_option( 'moderation_notify', '0' );
	
	// コメントの手動承認を必須にする
	update_option( 'comment_moderation', '1' );
	
	// すでに承認されたコメントの投稿者のコメントを許可し、それ以外のコメントを承認待ちにする
	update_option( 'comment_whitelist', '0' );
	
	// コメントモデレーション
	update_option( 'comment_max_links', '1' );
	
	
	
	
	
	
	
	
}



?>
