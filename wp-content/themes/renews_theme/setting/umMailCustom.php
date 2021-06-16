<?php
/**
 * Add custom email templates
 * @param array $emails
 * @return array
 */


function custom_um_email_notifications( $emails ) {

	/* New email templates */
	$custom_emails = array(
		'follow_renewer_email'	 => array(
			'key'						 => 'follow_renewer_email',
			'title'					 => __( 'フォローしているリニュアーが新しい記事を投稿した時', 'ultimate-member' ),
			'subject'				 => 'Welcome to {site_name}!',
			'body'					 => '',
			'description'		 => __( 'フォローしているリニュアーが新しい記事を投稿した時に通知する', 'ultimate-member' ),
			'recipient'			 => 'user',
			'default_active' => true
		),
		'follow_agenda_email'	 => array(
			'key'						 => 'follow_agenda_email',
			'title'					 => __( 'フォローしているアジェンダに新しい記事が投稿された時', 'ultimate-member' ),
			'subject'				 => 'Welcome to {site_name}!',
			'body'					 => '',
			'description'		 => __( 'フォローしているアジェンダに新しい記事が投稿された時に通知する', 'ultimate-member' ),
			'recipient'			 => 'user',
			'default_active' => true
		),
		'follow_series_email'	 => array(
			'key'						 => 'follow_series_email',
			'title'					 => __( 'フォローしているシリーズに新しい記事が投稿された時', 'ultimate-member' ),
			'subject'				 => 'Welcome to {site_name}!',
			'body'					 => '',
			'description'		 => __( 'フォローしているシリーズに新しい記事が投稿された時に通知する', 'ultimate-member' ),
			'recipient'			 => 'user',
			'default_active' => true
		),
	);

	/* Default settings */
	UM()->options()->options = array_merge( array(
		'follow_renewer_email_on'	 => 1,
		'follow_renewer_email_sub'	 => 'リニュアーの記事公開',
		'follow_agenda_email_on'	 => 1,
		'follow_agenda_email_sub'	 => 'フォローアジェンダ記事公開',
		'follow_series_email_on'	 => 1,
		'follow_series_email_sub'	 => 'フォローシリーズ記事公開',
	), UM()->options()->options );

	return array_merge( $custom_emails, $emails );
}
add_filter( 'um_email_notifications', 'custom_um_email_notifications' );


?>
