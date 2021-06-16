<?php 
$user = wp_get_current_user();
$user_roles = $user->roles[0];

function my_show_admin_bar( $content ) {
	// 管理者の場合は表示
	if ( (current_user_can( 'administrator' )) || current_user_can( 'editor' ) ) {
		return $content;
		// 管理者以外の場合は非表示
	} else {
		return false;
	}
}
add_filter( 'show_admin_bar' , 'my_show_admin_bar');


//contact form7
function wpcf7_main_validation_filter( $result, $tag ) {
	$type = $tag['type'];
	$name = $tag['name'];
	$_POST[$name] = trim( strtr( (string) $_POST[$name], "\n", " " ) );
	if ( 'email' == $type || 'email*' == $type ) {
		if (preg_match('/(.*)_confirm$/', $name, $matches)){
			$target_name = $matches[1];
			if ($_POST[$name] != $_POST[$target_name]) {
				if (method_exists($result, 'invalidate')) {
					$result->invalidate( $tag,"メールアドレスが一致していません");
				} else {
					$result['valid'] = false;
					$result['reason'][$name] = 'メールアドレスが一致していません';
				}
			}
		}
	}
	return $result;
}

add_filter( 'wpcf7_validate_email', 'wpcf7_main_validation_filter', 11, 2 );
add_filter( 'wpcf7_validate_email*', 'wpcf7_main_validation_filter', 11, 2 );




// お問い合わせ（MWWPFORM） バリデート
//include('setting/formValidata.php');
//function my_exam_validation_rule( $Validation, $data, $Data ) {
//	//メールアドレス
//	$Validation->set_rule( 'mail', 'noEmpty', array( 'message' => '入力してください。' ) );
//	$Validation->set_rule('mail', 'mail', array(
//		'message' => '※メールアドレスの形式ではありません。'
//	));
//
//	//メールアドレス確認
//	$Validation->set_rule( 'mail_conf', 'noEmpty', array( 'message' => '入力してください。' ) );
//	$Validation->set_rule('mail_conf', 'mail', array(
//		'message' => '※メールアドレスの形式ではありません。'
//	));
//	$Validation->set_rule('mail_conf', 'eq', array(
//		'target' => 'mail',
//		'message' => '※メールアドレスが一致しません。'
//	));
//
//	//問い合わせ内容
//	$Validation->set_rule( 'content_text', 'noEmpty', array( 'message' => '入力してください。' ) );
//
//	return $Validation;
//}
//add_filter( 'mwform_validation_mw-wp-form-26', 'my_exam_validation_rule', 10, 3 );


?>