<?php
// 送信者名を変更
add_filter( 'wp_mail_from_name', function( $email_from ) {
	return 'Renews';
});

// 送信者メールアドレスを変更
add_filter( 'wp_mail_from', function( $email_address ) {
	return 'noreply@renews.jp';
});

/*---------------------------------*/
//ユーザーがメールアドレスを変更した際に届くメール本文の変更
/*---------------------------------*/
add_filter( 'email_change_email', 'custom_email_change_email' );
function custom_email_change_email( $email_change_email ) {
	$subject = '【' . get_option( 'blogname' ) . '】 メールアドレスが変更されました';
	$message = 'こんにちは @###USERNAME### さん' . "\n";
	$message .= "\n";
	$message .= 'Renewsに登録しているあなたのメールアドレスが' . "\n";
	$message .= '###NEW_EMAIL###' . "\n";
	$message .= 'に変更されました。' . "\n";
	$message .= "\n";
	$message .= 'このメールに心当たりがない場合は、第三者がメールアドレスの入力を誤った可能性があります。' . "\n";
	$message .= 'お手数ですが、このメールを破棄して、次のアドレスまでご連絡ください。' . "\n";
	$message .= 'info@renews.jp' . "\n";
	$message .= "\n";
	$message .= '※ 本メールは配信専用のアドレスのため、返信いただいてもご回答いたしかねますので、ご了承ください。' . "\n";
	$message .= "\n";
	$message .= "\n";
	$message .= "\n";
	$message .= '世の中を“リニュー“しよう' . "\n";
	$message .= '課題解決にこだわる新メディア' . "\n";
	$message .= 'Renews' . "\n";
	$message .= 'https://renews.jp' . "\n";

	$email_change_email['subject'] = $subject;
	$email_change_email['message'] = $message;
	return $email_change_email;
}


?>
