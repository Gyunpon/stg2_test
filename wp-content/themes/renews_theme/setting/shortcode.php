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
	return '<h2 class="title_large">' . $content . '</h2>';
}
add_shortcode('title_large', 'title_largeFunc');

//タイトル（小さい）
function title_smallFunc( $atts, $content = null ) {
	return '<h2 class="title_small">' . $content . '</h2>';
}
add_shortcode('title_small', 'title_smallFunc');

//テキスト
function text_readFunc( $atts, $content = null ) {
	return '<div class="text_read mb-40">' . $content . '</div>';
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

	return '<blockquote class="embed quote title_component mb-50"><reference class="reference color_gray">' . $text . '</reference><cite class="color_green">出典：<a href="' . $url . '" target="_blank" rel="noopner">' . $source . '</a> — ' . $date . '</cite></blockquote>';
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
//	$icon = (isset($atts['icon'])) ? esc_attr($atts['icon']) : null;
	$renews_id = (isset($atts['renews_id'])) ? esc_attr($atts['renews_id']) : null;
	$user = get_user_by( 'login', $renews_id );
	$user_id = $user->ID;
	$user_name = $user->display_name;
	$user_avatar = get_avatar( $user_id, 64 );
//	if ($_SERVER['REMOTE_ADDR'] == "115.179.101.53"){
//
////		var_dump($user);
//	}

	return '<div class="comment_area level1 flex between mb-40"><figure class="thumbs_article cutIcon"><a href="https://renews.jp/user/' . $renews_id . '/">' . $user_avatar . '</a></figure><div class="wrap_comment"><small class="sst_comment"><span class="name"><a href="https://renews.jp/user/' . $renews_id . '/"><span class="color_black">'.$user_name.'</span><span class="color_blue"> @' . $renews_id . '</span></a></span></small><p class="text_read">' . do_shortcode($content) . '</p></div></div>';
}
add_shortcode('interview_left', 'interview_leftFunc');

//アイコン右
function interview_rightFunc( $atts, $content = null ) {
	$icon = (isset($atts['icon'])) ? esc_attr($atts['icon']) : null;
	$renews_id = (isset($atts['renews_id'])) ? esc_attr($atts['renews_id']) : null;
	$user = get_user_by( 'login', $renews_id );
	$user_id = $user->ID;
	$user_name = $user->display_name;
	$user_avatar = get_avatar( $user_id, 64 );

	return '<div class="comment_area level1 flex between mb-40"><div class="wrap_comment ver_reverse"><small class="sst_comment"><span class="name color_blue"><a href="https://renews.jp/user/' . $renews_id . '/"><span class="color_black">'.$user_name.'</span><span class="color_blue"> @' . $renews_id . '</span></a></span></small><p class="text_read">' . do_shortcode($content) . '</p></div><figure class="thumbs_article cutIcon"><a href="https://renews.jp/user/' . $renews_id . '/">' . $user_avatar . '</a></figure></div>';
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
//	$imageurl = (isset($atts['imageurl'])) ? esc_attr($atts['imageurl']) : null;
	$caption = (isset($atts['caption'])) ? esc_attr($atts['caption']) : null;

	if($caption){$captext = '<figcaption class="caption_article">'.$caption.'</figcaption>';}
	
	//画像imageタグ
	$image_base = do_shortcode($content);
	$pattern='/<p>(.*?)<\/p>/i';
	preg_match($pattern, $image_base, $match );
	$image=$match[1];
	
	
	return '<picture class="wrap_img_article full">' . $image . '' . $captext . '</picture>';
}
add_shortcode('image_center_block', 'image_centerFunc');


//clearfix
function img_wrapFunc( $atts, $content = null ) {
	return '<div class="clearfix">' . do_shortcode($content) . '</div>';
}
add_shortcode('img_wrap_block', 'img_wrapFunc');


//右寄りの画像
function img_rightFunc( $atts, $content = null ) {
//	$imageurl = (isset($atts['imageurl'])) ? esc_attr($atts['imageurl']) : null;
	$caption = (isset($atts['caption'])) ? esc_attr($atts['caption']) : null;

	if($caption){$captext = '<figcaption class="caption_article">'.$caption.'</figcaption>';}
	
	//画像imageタグ
	$image_base = do_shortcode($content);
	$pattern='/<p>(.*?)<\/p>/i';
	preg_match($pattern, $image_base, $match );
	$image=$match[1];
	
	return '<figure class="wrap_img_article img_right">' . $image . '' . $captext . '</figure>';
}
add_shortcode('img_right_block', 'img_rightFunc');

//左寄りの画像
function img_leftFunc( $atts, $content = null ) {
//	$imageurl = (isset($atts['imageurl'])) ? esc_attr($atts['imageurl']) : null;
	$caption = (isset($atts['caption'])) ? esc_attr($atts['caption']) : null;

	if($caption){$captext = '<figcaption class="caption_article">'.$caption.'</figcaption>';}
	
	//画像imageタグ
	$image_base = do_shortcode($content);
	$pattern='/<p>(.*?)<\/p>/i';
	preg_match($pattern, $image_base, $match );
	$image=$match[1];
	
	return '<figure class="wrap_img_article img_left">' . $image . '' . $captext . '</figure>';
}
add_shortcode('img_left_block', 'img_leftFunc');


//リニュアーブロック
function renewerFunc( $atts, $content = null ) {
	$renewer_id = (isset($atts['renewer_id'])) ? esc_attr($atts['renewer_id']) : null;
	$post_id_1 = (isset($atts['post_id_1'])) ? esc_attr($atts['post_id_1']) : null;
	$post_id_2 = (isset($atts['post_id_2'])) ? esc_attr($atts['post_id_2']) : null;
	
	//Renewer
	$renewer_info = get_user_by('login',$renewer_id);
	$uid = $renewer_info->ID;
	$renewer_data = get_user_meta($uid);
	$renewer_desc = $renewer_data['description'][0];
	$renewer_pos = $renewer_data['position'][0];
	$renewer_icon = get_avatar( $uid, 190 );
	
	//記事1
	$post_1_title = get_post($post_id_1)->post_title;
	$post_1_url = get_permalink($post_id_1);
	$thumbnail_1_id = get_post_thumbnail_id($post_id_1);
	$imageUrl_1 = '';
	if($thumbnail_1_id){
		$image_1 = wp_get_attachment_image_src($thumbnail_1_id,'large');
		$imageUrl_1 = $image_1[0];
	}else{
		$imageUrl_1 = get_template_directory_uri().'/images/icon/noimg.jpg';
	}
	$comments_1_link = get_permalink($post_id_1);
	$comments_1 = wp_count_comments( $post_id_1 );
	$comments_1_total = $comments_1->total_comments;
	if(function_exists('wp_ulike_comments')){
		$post_1_like = wp_ulike( 'put', array("id" => $post_id_1) );
	}
	$rows_1 = get_field('author_select',$post_id_1); // すべてのrow（内容・行）をいったん取得する
	$first_row_1 = $rows_1[0]; // 1行目だけを$first_rowに格納
	$first_row_item_1 = $first_row_1['author']; // get the sub field value 
	if(!($first_row_item_1)){
		$renews_id_1 = get_the_author_meta( 'user_login', $post->post_author );
		$user_avatar_1 = get_avatar( get_the_author_meta( 'ID' ), 64 );
	}else{
		$renews_id_1 = $first_row_item_1['user_nicename'];
		$user_avatar_1 = $first_row_item_1['user_avatar'];
	}
	
	//記事2
	$post_2_title = get_post($post_id_2)->post_title;
	$post_2_url = get_permalink($post_id_2);
	$thumbnail_2_id = get_post_thumbnail_id($post_id_2);
	$imageUrl_2 = '';
	if($thumbnail_2_id){
		$image_2 = wp_get_attachment_image_src($thumbnail_2_id,'large');
		$imageUrl_2 = $image_2[0];
	}else{
		$imageUrl_2 = get_template_directory_uri().'/images/icon/noimg.jpg';
	}
	$comments_2_link = get_permalink($post_id_2);
	$comments_2 = wp_count_comments( $post_id_2 );
	$comments_2_total = $comments_2->total_comments;
	if(function_exists('wp_ulike_comments')){
		$post_2_like = wp_ulike( 'put', array("id" => $post_id_2) );
	}
	$rows_2 = get_field('author_select',$post_id_2); // すべてのrow（内容・行）をいったん取得する
	$first_row_2 = $rows_2[0]; // 1行目だけを$first_rowに格納
	$first_row_item_2 = $first_row_2['author']; // get the sub field value 
	if(!($first_row_item_2)){
		$renews_id_2 = get_the_author_meta( 'user_login', $post->post_author );
		$user_avatar_2 = get_avatar( get_the_author_meta( 'ID' ), 64 );
	}else{
		$renews_id_2 = $first_row_item_2['user_nicename'];
		$user_avatar_2 = $first_row_item_2['user_avatar'];
	}
	
//	if ($_SERVER['REMOTE_ADDR'] == "115.179.101.53") {
//		
//	}
	
	$echo .= '<div class="article_sec_avater flex mb-80">
<div class="renewer uk-transition-toggle">
<div class="avatar_renewer">'.$renewer_icon.'</div>
<div class="wrap_text_renewer">
<h3 class="name_renewer bold">@'.$renewer_id.'<br><span class="category_renewer"><br>'.$renewer_pos.'<br></span></h3>
<p class="text_renewer">'.$renewer_desc.'</p>
</div>
<div class="wrap_switch"><span id="switch1" class="switch-button"><br>
<i class="switch"></i><br>
</span></div>
</div>
<div class="wrap_article_middle flex colum2">
<div class="article_middle">
<div class="wrap_img">
<div class="article_middle_img imgLiquidFill"><a href="'.$post_1_url.'"><img src="'.$imageUrl_1.'" alt="記事サムネイル" /></a></div>
</div>
<div class="textbox middle left_bottom">
<div class="wrap_avatar flex">
<p class="title_avatar eng mb-0">@'.$renews_id_1.'</p>
</div>
<h2 class="title_middle"><a href="'.$post_1_url.'">'.$post_1_title.'</a></h2>
<div class="wrap_social color_black flex">
<div class="socialbox likebox">'.$post_1_like.'</div>
<a class="socialbox commentbox" href="'.$comments_1_link.'?move=commentsAreaWrap">'.$comments_1_total.'</a>
</div>

</div>
</div>
<div class="article_middle">
<div class="wrap_img">
<div class="article_middle_img imgLiquidFill"><a href="'.$post_2_url.'"><img src="'.$imageUrl_2.'" alt="記事サムネイル" /></a></div>
</div>
<div class="textbox middle left_bottom">
<div class="wrap_avatar flex">
<p class="title_avatar eng mb-0">@'.$renews_id_2.'</p>
</div>
<h2 class="title_middle"><a href="'.$post_2_url.'">'.$post_2_title.'</a></h2>
<div class="wrap_social color_black flex">
<div class="socialbox likebox">'.$post_2_like.'</div>
<a class="socialbox commentbox" href="'.$comments_2_link.'?move=commentsAreaWrap">'.$comments_2_total.'</a>
</div>
</div>
</div>
</div>
</div>';



	return $echo;
}



add_shortcode('renewer_block', 'renewerFunc');



?>
