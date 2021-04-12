<?php
/*-------------------------------------------------------------------------------*/
// 管理画面 カスタム投稿作成時、一覧にカスタムタクソノミーの欄を追加

// 使い方 ※下記がワンセット。カスタム投稿が複数ある場合は、下記を増やす。
/*
function add_【他と被らない好きな名前①】_custom_column( $defaults ) {
	$defaults['【カスタムタクソノミー名】'] = 'カテゴリー';
	return $defaults;
}
add_filter('manage_【カスタム投稿名】_posts_columns', 'add_【他と被らない好きな名前①】_custom_column');

function add_【他と被らない好きな名前①】_custom_column_id($column_name, $id) {
	if( $column_name == '【カスタムタクソノミー名】' ) {
		$terms = get_the_terms( $id, '【カスタムタクソノミー名】' );

		$term_links = array();
		foreach ( $terms as $term ) {
			$term_links[] = $term->name;
		}
		$term_text = join( ", ", $term_links );
		echo $term_text;
	}
}
add_action('manage_【カスタム投稿名】_posts_custom_column', 'add_【他と被らない好きな名前①】_custom_column_id', 10, 2);

function sort_【他と被らない好きな名前①】_column($columns){
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'タイトル',
		'【カスタムタクソノミー名】' => '【管理画面一覧上部に表示される名前 ※例：カテゴリー】',
		'date' => '日時'
	);
	return $columns;
}
add_filter( 'manage_【カスタム投稿名】_posts_columns', 'sort_【他と被らない好きな名前①】_column');
*/
/*-------------------------------------------------------------------------------*/

?>
