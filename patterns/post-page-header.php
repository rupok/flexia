<?php
/**
 * Title: Post Page Header
 * Slug: flexia/post-page-header
 * Categories: flexia
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!-- wp:cover {"url":<?php echo wp_json_encode( get_theme_file_uri("/assets/images/page-banner-img.jpg"), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?>,"dimRatio":60,"customOverlayColor":"#0f125c","minHeight":257,"minHeightUnit":"px","align":"full","className":"alignwide"} -->
<div class="wp-block-cover alignfull alignwide" style="min-height:257px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-background-dim" style="background-color:#0f125c"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_theme_file_uri("/assets/images/page-banner-img.jpg") ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:post-title {"level":1,"textAlign":"center","style":{"color":{"text":"#ffffff"}},"fontSize":"huge"} /-->
</div><!-- /wp:group --></div></div><!-- /wp:cover -->
