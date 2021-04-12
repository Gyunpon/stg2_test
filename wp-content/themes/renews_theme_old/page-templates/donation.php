<?php
/**
 * Template Name: 寄付
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
	

<section class="sec sec_donation">
	<div class="inner_base">

		<div class="mv_donation">
			<figure class="img_mv">
				<img src="<?php echo get_template_directory_uri(); ?>/images/donation/donation_img_main.png" alt="寄付メインビジュアル" width="348">
			</figure>
		</div>

		<h1 class="title_lower_l1 eng">
			寄付
		</h1>

		<p class="text_read color_black text_desc_donation l-narrow">
			寄付について説明します。寄付金額と支援内容。私たちのイニシアチブを気に入っていただけることを願っています。寄付について説明します。寄付金額と支援内容。私たちのイニシアチブを気に入っていただけることを願っています。寄付について説明します。寄付金額と支援内容。私たちのイニシアチブを気に入っていただけることを願っています。
		</p>

		<div class="content_donation">

			<section class="sec_login_donation">
				<div class="mv_login">
					<figure class="img_mv border gray">
						<img src="<?php echo get_template_directory_uri(); ?>/images/donation/donation_img_middle.png" alt="寄付イメージ" width="184">
					</figure>
				</div>

				<h2 class="text_middle color_blue">
					ログインして寄付
				</h2>

				<p class="text_read l-narrow">
					ログインをしてから寄付をすることによるメリット。ログインをしてから寄付をすることによるメリット。ログインをしてから寄付をすることによるメリット。
				</p>

				<a class="btn_base color_blue reverse" href="#modal-donation1" uk-toggle>
					<span class="text_btn">
						ログインして寄付
					</span>
				</a>

				<div id="modal-donation1" class="uk-flex-top" uk-modal>
					<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

						<button class="uk-modal-close-default" type="button" uk-close></button>

						<div class="content_modal pd-b60">
							<div class="inner_base">

								<h2 class="text_middle color_blue">
									寄付
								</h2>

								<div class="content_input narrow">

									<div class="wrap_form_normal">

										<form action="">
											<div class="line_input">

												<div class="price_donation flex between wrap">
													<div class="container_radio">
														<div class="radio-tile-group flex wrap between">
															<div class="input-container">
																<input id="walk" class="radio-button" type="radio" name="radio" />
																<div class="radio-tile">
																	<label for="walk" class="radio-tile-label">¥150</label>
																</div>
															</div>

															<div class="input-container">
																<input id="bike" class="radio-button" type="radio" name="radio" />
																<div class="radio-tile">
																	<label for="bike" class="radio-tile-label">¥300</label>
																</div>
															</div>

															<div class="input-container">
																<input id="drive" class="radio-button" type="radio" name="radio" />
																<div class="radio-tile">
																	<label for="drive" class="radio-tile-label">¥1,500</label>
																</div>
															</div>

															<div class="input-container">
																<input id="fly" class="radio-button" type="radio" name="radio" />
																<div class="radio-tile">
																	<label for="fly" class="radio-tile-label">¥10,000</label>
																</div>
															</div>
														</div>
													</div>

													<figure class="img_price">
														<img src="<?php echo get_template_directory_uri(); ?>/images/donation/img_cards.png" alt="寄付イメージ" width="377">
													</figure>
												</div>
											</div>

											<div class="line_input">
												<div class="wrap_input_donation flex between">
													<label for="" class="label_input">カード番号</label>
													<input class="uk-input uk-form-blank uk-form-width-medium text_input_donation l-normal" type="text" placeholder="1234567890123456">
												</div>
											</div>

											<div class="line_input">
												<div class="flex">

													<div class="wrap_input_donation flex between l-normal">
														<label for="" class="label_input">有効期限</label>

														<div class="deadline">
															<div class="uk-form-controls">
																<select class="uk-select" id="form-stacked-select">
																	<option>1月</option>
																	<option>2月</option>
																	<option>3月</option>
																	<option>4月</option>
																	<option>5月</option>
																	<option>6月</option>
																	<option>7月</option>
																	<option>8月</option>
																	<option>9月</option>
																	<option>10月</option>
																	<option>11月</option>
																	<option>12月</option>
																</select>
															</div>
														</div>

														<div class="deadline">
															<div class="uk-form-controls">
																<select class="uk-select" id="form-stacked-select">
																	<option>2019年</option>
																	<option>2020年</option>
																</select>
															</div>
														</div>

													</div>
													<div class="wrap_input_donation flex between l-small">
														<label for="" class="label_input small">保安</label>
														<input class="uk-input uk-form-blank uk-form-width-medium text_input_donation l-small" type="text"
																	 placeholder="CVC">
													</div>

												</div>
											</div>

											<div class="line_input border_b">
												<div class="wrap_input_donation flex between">
													<label for="" class="label_input">名前</label>
													<input class="uk-input uk-form-blank uk-form-width-medium text_input_donation l-normal" type="text"
																 placeholder="Osamu inoue">
												</div>
											</div>

											<button class="btn_base color_blue reverse">
												<span class="text_btn">
													接続する
												</span>
											</button>

											<button class="btn_base color_blue">
												<span class="text_btn">
													キャンセル
												</span>
											</button>

										</form>

									</div>

								</div>

							</div>
						</div>

					</div>
				</div>
			</section>

			<section class="sec_anonymous">

				<h2 class="text_middle color_blue">
					匿名による寄付
				</h2>

				<p class="text_read l-narrow">
					ログインをしてから寄付をすることによるメリット。ログインをしてから寄付をすることによるメリット。ログインをしてから寄付をすることによるメリット。
				</p>

				<a class="btn_base color_blue" href="#modal-donation2" uk-toggle>
					<span class="text_btn">
						寄付
					</span>
				</a>

				<div id="modal-donation2" class="uk-flex-top" uk-modal>
					<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

						<button class="uk-modal-close-default" type="button" uk-close></button>

						<div class="content_modal">
							<div class="inner_base">

								<h2 class="text_middle color_blue">
									ログインして寄付
								</h2>

								<div class="content_input narrow">
									<form action="">
										<!-- .line_inputに.errorがある時エラーメッセージを表示してます -->
										<div class="line_input">
											<p class="text_input color_gray">
												リニューズIDまたはメールアドレス
											</p>
											<input type="text" placeholder="@Osamu" id="" autocomplete="off" class="input_sign">
											<p class="text_error">
												エラーメッセージが入ります
											</p>
										</div>

										<div class="line_input">
											<p class="text_input color_gray">
												パスワード
											</p>
											<input type="text" placeholder="入力してください" id="" autocomplete="off" class="input_sign">
											<p class="text_error">
												エラーメッセージが入ります
											</p>
										</div>

										<button class="btn_base color_blue reverse">
											<span class="text_btn">
												ログイン
											</span>
										</button>

										<p class="text_error">
											エラーメッセージが入ります
										</p>

									</form>

									<div class="social_box">
										<p class="text_social color_gray">
											ソーシャルアカウントで登録
										</p>

										<div class="wrap_social_input flex between">
											<div class="social_input">
												<a href="">
													<i class="fab fa-facebook-f"></i>
												</a>
											</div>
											<div class="social_input">
												<a href="">
													<i class="fab fa-twitter"></i>
												</a>
											</div>
											<div class="social_input">
												<a href="">
													<i class="fab fa-google"></i>
												</a>
											</div>
										</div>
									</div>

									<p class="text_read text_desc_login">
										パスワードを<span class="text_link underline"><a href="../login/">忘れた方</a></span>
									</p>
								</div>

							</div>
						</div>

					</div>
				</div>

			</section>
		</div>

	</div>
</section>
	
	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>