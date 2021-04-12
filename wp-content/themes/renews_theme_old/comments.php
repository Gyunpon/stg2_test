<div id="comments">
	<?php
	$args = array(
		'title_reply' => '',
		'comment_notes_before' => '',
		'logged_in_as' =>'',
		'must_log_in' => '<p class="must-log-in">コメントを投稿するには<a href="/login/">ログイン</a>してください。</p>',
		'fields' => array(
			'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
			'email'  => '',
			'url'    => '',
		),
		'label_submit' => __( 'コメントする' ),
		'cancel_reply_link'=>__( 'リプライキャンセル' ),
		// オリジナルの textarea (コメント本文入力欄) を再定義
		'comment_field' => '<div class="wrap_input_comment"><textarea id="comment" class="uk-textarea" name="comment" placeholder="コメントを入力"></textarea></div>',
	);
	comment_form( $args );
	
	?>
	<?php if ( have_comments() ):?>
	<?php
	// 記事コメント数（承認済み）を取得
	global $post;
	$commentsCnt = wp_count_comments( $post->ID );
	$commentsNum =$commentsCnt->approved; //「承認済み」のコメント数を取得
	?>
	<div class="commentsAreaWrap<?php if($commentsNum > 5){ echo ' accordionComments'; } ?>">
		<ul class="comments-list">
			<?php wp_list_comments( 'callback=custom_comment' ); ?>
		</ul>
		<?php endif;?>
<!--		<div class="commentsMoreBtn"><a href="javascript:void(0);"><span class="openTxt">もっとみる</span><span class="closeTxt">閉じる</span></a></div>-->
	</div>

</div>
<?php if( $wp_query -> max_num_comment_pages > 1 ):?>
<div class="st-pagelink">
	<?php
	$args = array(
		'prev_text' => '&laquo; Prev',
		'next_text' => 'Next &raquo;',
	);
	paginate_comments_links($args);
	?>
</div>
<?php endif;?>