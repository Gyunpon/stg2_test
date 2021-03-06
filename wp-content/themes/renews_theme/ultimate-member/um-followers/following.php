<?php
/**
 * Template for the UM Followers. The list of user following
 *
 * Shortcode: [ultimatemember_following]
 * Caller: method Followers_Shortcode->ultimatemember_following()
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-followers/following.php
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $following ) {

	foreach ( $following as $k => $arr ) {
		/**
		 * @var $user_id1;
		 */
		extract( $arr );

		um_fetch_user( $user_id1 ); ?>
	
		<li data-user_id1="<?php echo $user_id1; ?>">
			<div class="followListBlock">
				<div class="followTitleArea">
					<a href="<?php echo esc_url( um_user_profile_url() ); ?>">
						<div class="userInfo">
							<div class="um-followers-user-photo">
								<?php echo get_avatar( um_user('ID'), 190 ); ?>
							</div>

							<div class="um-followers-user-name">
								<?php echo esc_html( um_user( 'display_name' ) ); ?>

								<span class="renewerID">@<?php echo esc_html( um_user( 'user_nicename' ) ); ?></span>
								<?php do_action('um_following_list_post_user_name', $user_id, $user_id1 );

		if ( um_user( 'ID' ) == get_current_user_id() ) { ?>
								<span class="um-followers-user-span"><?php _e( 'You', 'um-followers' ); ?></span>
								<?php } elseif ( UM()->Followers_API()->api()->followed( get_current_user_id(), $user_id1 ) ) { ?>
								<span class="um-followers-user-span"><?php _e( 'Follows you', 'um-followers' ); ?></span>
								<?php }

		do_action('um_following_list_after_user_name', $user_id, $user_id1 ); ?>
							</div>
						</div><!-- userInfo -->
					</a>
				</div>
				<div class="followBtnArea">
					<div class="um-followers-user-btn">
						<?php if ( $user_id1 == get_current_user_id() ) {
			echo '<a href="' . esc_url( um_edit_profile_url() ) . '" class="um-follow-edit um-button um-alt">' . __( 'Edit profile', 'um-followers' ) . '</a>';
		} else {
			echo UM()->Followers_API()->api()->follow_button( $user_id1, get_current_user_id() );
		} ?>
					</div>
				</div>
			</div>


			<?php do_action( 'um_following_list_pre_user_bio', $user_id, $user_id1 ); ?>
		
		
			<?php do_action( 'um_following_list_post_user_bio', $user_id, $user_id1 ); ?>
		
		</li>
	
	<?php }

} else { ?>
<div class="noFollow">
	<p>?????????????????????????????????????????????????????????</p>
</div>
<!--
	<div class="um-profile-note">
		<span><?php echo ( $user_id == get_current_user_id() ) ? __( 'You did not follow anybody yet.', 'um-followers' ) : __( 'This user did not follow anybody yet.', 'um-followers' ); ?></span>
	</div>
-->

<?php }