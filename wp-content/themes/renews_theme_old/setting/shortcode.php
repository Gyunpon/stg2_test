<?php
/*-------------------------------------------------------------------------------*/
// オリジナルショートコード設定


// テンプレートパス
add_shortcode( 'tp_url', 'shortcode_tp' );
function shortcode_tp( $atts, $content = '' ) {
	return get_template_directory_uri().$content;
}

// home_url
add_shortcode( 'home_url', 'shortcode_hm' );
function shortcode_hm( $atts, $content = '' ) {
	return home_url();
}



/*-------------------------------------------------------------------------------*/
//article 記事内で使用するショートコード
function shortcode_empty_paragraph_fix($content) {
	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);

	$content = strtr($content, $array);
	return $content;
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');


//タイトル（大きい）
function title_largeFunc( $atts, $content = null ) {
	return '<h2 class="title_large color_black">' . $content . '</h2>';
}
add_shortcode('title_large', 'title_largeFunc');

//タイトル（小さい）
function title_smallFunc( $atts, $content = null ) {
	return '<h3 class="title_small">' . $content . '</h3>';
}
add_shortcode('title_small', 'title_smallFunc');

//テキスト
function text_readFunc( $atts, $content = null ) {
	return '<p class="text_read mb-40">' . $content . '</p>';
}
add_shortcode('text_read', 'text_readFunc');

//1文字目が大きい テキスト
function firttletter_largeFunc( $atts, $content = null ) {
	return '<p class="text_read mb-60">' . $content . '</p>';
}
add_shortcode('firttletter_large', 'firttletter_largeFunc');

//引用
function quoteFunc( $atts, $content = null ) {
	$text = (isset($atts['text'])) ? esc_attr($atts['text']) : null;
	$source = (isset($atts['source'])) ? esc_attr($atts['source']) : null;
	$date = (isset($atts['date'])) ? esc_attr($atts['date']) : null;
	$url = (isset($atts['url'])) ? esc_attr($atts['url']) : null;

	return '<blockquote class="embed quote title_component mb-50"><reference class="reference color_green">' . $text . '</reference><cite class="color_green">出典：' . $source . ' — ' . $date . ' —<a href="' . $url . '" target="_blank" rel="noopner">' . $url . '</a></cite></blockquote>';
}
add_shortcode('quote', 'quoteFunc');

//テーブル
function table_basic_wrapFunc( $atts, $content = null ) {
	return '<table class="table_basic border_bottom mb-40">'. do_shortcode($content) .'</table>';
}
add_shortcode('table_basic_wrap', 'table_basic_wrapFunc');

//th,td
function table_basicFunc( $atts, $content = null ) {
	$item = (isset($atts['item'])) ? esc_attr($atts['item']) : null;
	return '<tr><th>'.$item.'</th><td>'. do_shortcode($content) .'</td></tr>';
}
add_shortcode('table_basic', 'table_basicFunc');


//吹き出し（インタビュー）
//アイコン左
function interview_leftFunc( $atts, $content = null ) {
	$icon = (isset($atts['icon'])) ? esc_attr($atts['icon']) : null;
	$name = (isset($atts['name'])) ? esc_attr($atts['name']) : null;

	return '<div class="comment_area level1 flex between mb-40"><figure class="thumbs_article"><img src="' . $icon . '" alt="アバターサムネイル" width="50"></figure><div class="wrap_comment"><small class="sst_comment"><span class="name color_blue">' . $name . '</span></small><p class="text_read">' . do_shortcode($content) . '</p></div></div>';
}
add_shortcode('interview_left', 'interview_leftFunc');

//アイコン右
function interview_rightFunc( $atts, $content = null ) {
	$icon = (isset($atts['icon'])) ? esc_attr($atts['icon']) : null;
	$name = (isset($atts['name'])) ? esc_attr($atts['name']) : null;

	return '<div class="comment_area level1 flex between mb-40"><div class="wrap_comment ver_reverse"><small class="sst_comment"><span class="name color_blue">' . $name . '</span></small><p class="text_read">' . do_shortcode($content) . '</p></div><figure class="thumbs_article"><img src="' . $icon . '" alt="アバターサムネイル" width="50"></figure></div>';
}
add_shortcode('interview_right', 'interview_rightFunc');


//寄付（donation）
function donationFunc( $atts, $content = null ) {
	$title = (isset($atts['title'])) ? esc_attr($atts['title']) : null;
	$register_btn = (isset($atts['register_btn'])) ? esc_attr($atts['register_btn']) : null;
	$donation_btn = (isset($atts['donation_btn'])) ? esc_attr($atts['donation_btn']) : null;
	
	return '<div class="article_sec_sign_up mb-40"><figure class="img_mv"><img src="'.get_template_directory_uri().'/images/donation/donation_img_main.png" alt="寄付メインビジュアル" width="348"></figure><h2 class="text_sign mb-20">' . $title . '</h2><p class="text_read text_center mb-20">' . do_shortcode($content) . '</p><div class="wrap_btn_sign flex wrap between"><a href="' . $register_btn . '" class="btn_base color_blue reverse"><span class="text_btn">登録</span></a><a href="' . $donation_btn . '" class="btn_base color_blue"><span class="text_btn">寄付</span></a></div></div>';
}
add_shortcode('donation', 'donationFunc');


//画像
function image_centerFunc( $atts, $content = null ) {
	$imageurl = (isset($atts['imageurl'])) ? esc_attr($atts['imageurl']) : null;
	$caption = (isset($atts['caption'])) ? esc_attr($atts['caption']) : null;

	if($caption){$captext = '<figcaption class="caption_article">'.$caption.'</figcaption>';}
	
	return '<picture class="wrap_img_article full"><img src="' . $imageurl . '" alt="記事イメージ" />' . $captext . '</picture>';
}
add_shortcode('image_center_block', 'image_centerFunc');


//clearfix
function img_wrapFunc( $atts, $content = null ) {
	return '<div class="clearfix">' . do_shortcode($content) . '</div>';
}
add_shortcode('img_wrap_block', 'img_wrapFunc');


//右寄りの画像
function img_rightFunc( $atts, $content = null ) {
	$imageurl = (isset($atts['imageurl'])) ? esc_attr($atts['imageurl']) : null;
	$caption = (isset($atts['caption'])) ? esc_attr($atts['caption']) : null;

	if($caption){$captext = '<figcaption class="caption_article">'.$caption.'</figcaption>';}
	
	return '<figure class="wrap_img_article img_right"><img src="' . $imageurl . '" alt="記事イメージ" />' . $captext . '</figure>';
}
add_shortcode('img_right_block', 'img_rightFunc');

//左寄りの画像
function img_leftFunc( $atts, $content = null ) {
	$imageurl = (isset($atts['imageurl'])) ? esc_attr($atts['imageurl']) : null;
	$caption = (isset($atts['caption'])) ? esc_attr($atts['caption']) : null;

	if($caption){$captext = '<figcaption class="caption_article">'.$caption.'</figcaption>';}
	
	return '<figure class="wrap_img_article img_left"><img src="' . $imageurl . '" alt="記事イメージ" />' . $captext . '</figure>';
}
add_shortcode('img_left_block', 'img_leftFunc');


//リニュアーブロック
function renewerFunc( $atts, $content = null ) {
	$renewer_id = (isset($atts['renewer_id'])) ? esc_attr($atts['renewer_id']) : null;
	
	
	
	
	
	return '<p>' . $renewer_id . '</p>';
}
add_shortcode('renewer_block', 'renewerFunc');



?>
