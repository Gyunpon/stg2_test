<?php
/**
 * Template for the UM Real-time Notifications "Web notifications" settings
 * Used on "Account" page, "Web notifications" tab
 *
 * Called from the um_account_content_hook_webnotifications() function
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-notifications/account_webnotifications.php
 */
if ( ! defined( 'ABSPATH' ) ) exit; ?>

<!-- um-notifications/templates/account_webnotifications.php -->
<div class="um-field" data-key="">
<?php
	if(!empty(get_current_user_id())){

		$user_id = get_current_user_id();
		um_fetch_user( $user_id );

		if(UM()->user()->get_role() == 'administrator' || UM()->user()->get_role() == 'um_renewer'){
			echo '<div class="is_user_notification_flg" style="display:none;">true</div>';
		}else{
			echo '<div class="is_user_notification_flg" style="display:none;">false</div>';
		}

	}
	
/*
	echo '<pre>';
	var_dump(UM()->options());
	echo '</pre>';
*/
	
?>



	
	<div class="um-field-label"><strong><?php _e( 'Receiving Notifications', 'um-notifications' ); ?></strong></div>
	<div class="um-field-area">

		<?php foreach ( $logs as $key => $array ) {

			if ( ! UM()->options()->get( 'log_' . $key ) ) {
				continue;
			}

			$enabled = UM()->Notifications_API()->api()->user_enabled( $key, $user_id );

			if ( $enabled ) { ?>

				<label class="um-field-checkbox active">
					<input type="checkbox" name="um-notifyme[<?php echo esc_attr( $key ); ?>]" value="1" checked />
					<span class="um-field-checkbox-state"><i class="um-icon-android-checkbox-outline"></i></span>
					<span class="um-field-checkbox-option"><?php echo $array['account_desc']; ?></span>
				</label>

			<?php } else { ?>

				<label class="um-field-checkbox">
					<input type="checkbox" name="um-notifyme[<?php echo esc_attr( $key ); ?>]" value="1" />
					<span class="um-field-checkbox-state"><i class="um-icon-android-checkbox-outline-blank"></i></span>
					<span class="um-field-checkbox-option"><?php echo $array['account_desc']; ?></span>
				</label>

			<?php }
		} ?>

		<div class="um-clear"></div>
	</div>
</div>