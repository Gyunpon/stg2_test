<?php
/**
 * Template Name: マイページ・メニュー
 */
?>
<?php get_header(); ?>

<?php
	// 固定ページ情報
	$page = get_post(get_the_ID());
	$pageTitle = $page->post_title;
	$pageSlug = $page->post_name;
	$pageParent = $page->post_parent;
	
	// 最上位親ページスラッグ取得
	if($pageParent != 0){
		$current_id = $page->ID;
		$par_id = get_post($current_id)->post_parent;
		$most_par_id = $current_id;
		while($par_id != 0){
			$par_post = get_post($par_id);
			$most_par_id = $par_post->ID;
			$par_id = $par_post->post_parent;
		}

		$mostParentsPage = get_post($most_par_id);
		$mostParentsPageSlug = $mostParentsPage->post_name;
		
		$pageSlug .= ' '.$mostParentsPageSlug.'_child';
		
	}
?>
	<?php if(have_posts()): while (have_posts()): the_post(); ?>
<?php
//現在のアカウント
$login_userBase = wp_get_current_user();

		$login_user_id = $login_userBase->user_nicename;
		$login_user_name = $login_userBase->display_name;

$user_avatar = get_avatar( get_the_author_meta( 'ID' ), 240 );


$follow_url = ''. home_url() .'/user/'.$login_user_id.'/?profiletab=following';
 ?>
<!--
<script type="text/javascript">
	var follow_url='<?php echo $follow_url; ?>';
</script>
-->

	<div id="my">
		<section class="sec sec_my">
			<div class="inner_base">

				<div class="profileAreaWrap">
					<div class="profileLink">
					<div class="userNameWrap">
						<h1 class="userName"><?php echo $login_user_name; ?></h1>
						<p class="userId">@<?php echo $login_user_id; ?></p>
						さんのマイページ
					</div>

					
					
					<ul>
						<li class="profile">
							<div class="linkParts">
								<a href="<?php echo home_url(); ?>/user/<?php echo $login_user_id; ?>/?um_action=edit">
									<div class="thumb"><?php echo $user_avatar; ?></div>
									<p class="title">プロフィール変更</p>
								</a>
							</div>
						</li>

						<li>
							<div class="linkParts">
								<a href="<?php echo home_url(); ?>/user/<?php echo $login_user_id; ?>/?profiletab=following">
									<div class="thumb"><img src="<?php echo get_template_directory_uri(); ?>/images/my/follow.png" alt="" /></div>
									<p class="title">フォロー管理</p>
								</a>
							</div>
						</li>
						

						<li>
							<div class="linkParts">
								<a href="<?php echo home_url(); ?>/bookmark/">
									<div class="thumb"><img src="<?php echo get_template_directory_uri(); ?>/images/my/bookmark.png" alt="" /></div>
									<p class="title">ストック記事</p>
								</a>
							</div>
						</li>

						<li>
							<div class="linkParts">
								<a href="<?php echo home_url(); ?>/member/notifications/">
									<div class="thumb"><img src="<?php echo get_template_directory_uri(); ?>/images/my/notice.png" alt="" /></div>
									<p class="title">通知設定</p>
								</a>
							</div>
						</li>


<!--
						<li>
							<div class="linkParts">
								<a href="https://renews.jp/member/webnotifications/">
									<div class="thumb"><img src="<?php echo get_template_directory_uri(); ?>/images/my/follow.png" alt="" /></div>
									<p class="title"></p>
								</a>
							</div>
						</li>
-->

						<li class="textLink">
							<div class="linkParts">
								<a href="<?php echo home_url(); ?>/member/password/">
									<p class="title">パスワード変更</p>
								</a>
							</div>
						</li>
						

						<li class="textLink">
							<div class="linkParts">
								<a href="<?php echo home_url(); ?>/member/social/">
									<p class="title">SNS連携</p>
								</a>
							</div>
						</li>


						<li class="textLink">
							<div class="linkParts">
								<a href="<?php echo home_url(); ?>/member/delete/">
									<p class="title">メンバー退会</p>
								</a>
							</div>
						</li>
					</ul>
					</div><!-- profileLink -->
					
					<div class="profileArea">
						<?php echo do_shortcode( '[ultimatemember_account]' ); ?>
					</div>
				</div>

		
		
			</div>
		</section>
		
	</div>



	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>