<?php
/**
 * Template for the UM Instagram field, view mode
 * Used on the "Profile" page or other page with "Instagram Gallery" field type
 * Called from the Instagram_Public->view_field_profile_instagram_photo() method
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-instagram/field-view.php
 */
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div id="um-ig-content" class="um-ig-content" data-metakey="<?php echo esc_attr( $data['metakey'] ); ?>" data-user_id="<?php echo esc_attr( um_user( 'ID' ) ); ?>">
	<div id="um-ig-photo-wrap" class="um-ig-photos"></div>
	<div class="um-clear"></div>
</div>
<div id="um-ig-preload"></div>