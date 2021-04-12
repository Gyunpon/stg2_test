<?php
/*-------------------------------------------------------------------------------*/
// MW WP Form バリデーション設定

/**
 * 各フォーム識別子
 *
 * お問い合わせ：識別子入力
 *
**/

/*-------------------------------------------------------------------------------*/
// MW WP Form バリデーション設定
/**
* @param string $error
* @param string $key
* @param string $rule（半角小文字）
* mwform_error_message_mw-wp-form-○○○○ フォーム識別子番号を入れる

** バリデーション（検証）ルール **
http://plugins.2inc.org/mw-wp-form/manual/validation-rule/
*/


/* お問い合わせ　バリデーション */
function contact_validation_rule( $Validation, $data, $Data ){
	
	// 氏名
	$Validation->set_rule('name','noEmpty',array(
		'message' => '※氏名を入力してください。'
	));
	
	// 電話番号
	$Validation->set_rule('tel','tel',array(
		'message' => '※電話番号の形式ではありません。'
	));

	// メールアドレス
	$Validation->set_rule('mail', 'noEmpty', array(
		'message' => '※メールを入力してください。'
	));
	$Validation->set_rule('mail', 'mail', array(
		'message' => '※メールアドレスの形式ではありません。'
	));
	
	// メールアドレス確認
	$Validation->set_rule('mail_confirm', 'noEmpty', array(
		'message' => '※メール（確認）を入力してください。'
	));
	$Validation->set_rule('mail_confirm', 'mail', array(
		'message' => '※メールアドレスの形式ではありません。'
	));
	$Validation->set_rule('mail_confirm', 'eq', array(
		'target' => 'mail',
		'message' => '※メールアドレスが一致しません。'
	));
	
	// メッセージ
	$Validation->set_rule('message','noEmpty',array(
		'message' => '※メッセージを入力してください。'
	));
	
	return $Validation;
}

//add_filter( 'mwform_validation_mw-wp-form-【識別子番号】', 'contact_validation_rule', 10, 3 );








?>
