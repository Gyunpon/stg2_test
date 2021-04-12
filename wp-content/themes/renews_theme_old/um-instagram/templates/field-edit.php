<?php
/**
 * Template for the UM Instagram field, edit mode
 * Used on the "Profile" page or other page with "Instagram Gallery" field type
 * Called from the Instagram_Public->edit_field_profile_instagram_photo() method
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-instagram/field-edit.php
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$label = ! empty( $data['label'] ) ? $data['label'] : '';
?>

<div class="um-field um-field-<?php echo $data['type'] ?>" data-key="<?php echo $data['metakey'] ?>">

	<?php echo UM()->fields()->field_label( $label, $data['metakey'], $data ); ?>

	<?php if ( $has_token ) { ?>

		<input type="hidden" class="um-ig-photos_metakey" name="<?php echo esc_attr( $data['metakey'] ) ?>" value="<?php echo esc_attr( $has_token ) ?>" />
		
		<a href="javascript:void(0);" class="um-ig-photos_disconnect"><?php _e( 'Disconnect', 'um-instagram' ) ?> <i class="um-faicon-times"></i></a>
		<div class="um-clear"></div>

		<?php echo UM()->Instagram_API()->frontend()->view_field_profile_instagram_photo( '', $data ); ?>

	<?php } ?>

	<div class="um-connect-instagram" <?php echo $has_token ? 'style="display:none;"' : ''; ?>>
		<div class="um-ig-photo-wrap">
			<a href="<?php echo esc_url( UM()->Instagram_API()->connect()->connect_url() ) ?>" onclick="window.open( this.href, 'authWindow', 'width=1048,height=690,scrollbars=yes' );return false;">
				<i class="um-faicon-instagram"></i>
				<div class="um-clear"></div>
				<?php _e( 'Connect to Instagram', 'um-instagram' ); ?>
			</a>
		</div>
	</div>

	<?php if ( ! empty( $error_message ) ) { ?>

		<div class="um-field-error">
			<span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span><?php _e( $error_message, 'um-instagram' ); ?>
		</div>

	<?php } ?>

</div>