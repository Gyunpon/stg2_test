<?php
/**
 * Template for the UM myCRED.
 * Used on Account page, My Points tab
 *
 * Caller: method myCRED_Account->points_tab_content()
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-mycred/account_points.php
 */
if ( ! defined( 'ABSPATH' ) ) exit; ?>


<div class="um-field um-mycred-account-col" data-key="">
	<div class="um-field-label"><strong><?php _e( 'My Balance', 'um-mycred' ); ?></strong></div>
	<div class="um-field-area">
		<span><?php echo UM()->myCRED()->get_points( $user_id ); ?></span>
	</div>
</div>

<?php if ( um_user( 'can_transfer_mycred' ) ) {

	add_filter( 'number_format_i18n', array( UM()->myCRED(), 'custom_number_format_i18n' ), 10, 3 ); ?>

	<div class="um-field um-mycred-account-col" data-key="">
		<div class="um-field-label"><strong><?php _e( 'Transfer Balance', 'um-mycred' ); ?></strong></div>
		<div class="um-field-area">

			<?php $mycred_options = mycred_get_option( 'mycred_pref_core' ); ?>
			<p><?php printf( __( 'You can transfer up to %s %s to another user.', 'um-mycred' ), UM()->myCRED()->get_points_clean( $user_id ), lcfirst( $mycred_options['name']['plural'] ) ); ?></p>

			<input type="text" name="mycred_transfer_uid" placeholder="<?php esc_attr_e( 'Username, e-mail, or ID', 'um-mycred' ); ?>" class="um-mycred-input" />

			<p><?php _e( 'Enter amount below', 'um-mycred' ); ?></p>

			<input type="text" name="mycred_transfer_amount" placeholder="<?php echo number_format_i18n( 0, UM()->options()->get( 'mycred_decimals' ) ) ?>" class="um-mycred-amount" />

			<input type="hidden" name="um_account_nonce_points" value="<?php echo esc_attr( wp_create_nonce( 'um_account_nonce_points' ) ); ?>" />
			<input type="submit" name="um_account_submit" id="um_account_submit_mycred_transfer" value="<?php esc_attr_e( 'Confirm Transfer', 'um-mycred' ); ?>" class="um-mycred-send-points um-button" />

			<p><?php _e( 'This is not reversible once you click confirm transfer.', 'um-mycred' ); ?></p>
			
		</div>
	</div>

	<?php remove_filter( 'number_format_i18n', array( UM()->myCRED(), 'custom_number_format_i18n' ) );
}

if ( UM()->options()->get( 'mycred_refer' ) && $mycred_referral_link && function_exists( 'mycred_render_affiliate_link' ) ) { ?>

	<div class="um-field um-mycred-account-col" data-key="">
		<div class="um-field-label"><strong><?php _e( 'My Referral Link', 'um-mycred' ); ?></strong></div>
		<div class="um-field-area">
			<a href="<?php echo do_shortcode( '[mycred_affiliate_link url="' . get_bloginfo( 'url' ) . '"]' ); ?>" target="_blank"><?php echo do_shortcode( '[mycred_affiliate_link url="' . get_bloginfo( 'url' ) . '"]' ); ?></a>
		</div>
	</div>

	<?php
}