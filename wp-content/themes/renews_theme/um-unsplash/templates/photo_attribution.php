<?php
/**
 * Template for the UM Unsplash.
 * Used on the "Profile" page, upper cover image
 *
 * Caller: method UM_Unsplash_Functions->show_photo_attribution()
 * Hook: 'um_cover_area_content'
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-unsplash/photo_attribution.php
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<span class="um-unsplash-attribution">
	<?php printf( __( 'Photo by <a target="_blank" class="author-url" href="%s">%s</a> on Unsplash <a class="download-url" target="_blank" href="%s"><i class="um-faicon-download"></i></a>', 'um-unsplash' ), $author_url, ucfirst( esc_html( $pic_author ) ), $download_url ); ?>
</span>