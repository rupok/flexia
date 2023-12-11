<?php
/**
 * Title: Archieve Page Header
 * Slug: flexia/archieve-page-header
 * Categories: flexia
 * Inserter: no
 */
?>

<!-- wp:cover {"url":""<?php echo esc_url( get_theme_file_uri("/assets/images/page-banner-img.jpg") ); ?>","dimRatio":60,"customOverlayColor":"#0f125c","minHeight":257,"minHeightUnit":"px","align":"wide"} -->
<div class="wp-block-cover alignwide" style="min-height:257px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-background-dim" style="background-color:#0f125c"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_theme_file_uri("/assets/images/page-banner-img.jpg") ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:query-title {"type":"archive","textAlign":"center","showPrefix":false,"fontSize":"huge"} /-->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">Home</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>.</p>
<!-- /wp:paragraph -->

<!-- wp:query-title {"type":"archive","textAlign":"center","showPrefix":false,"fontSize":"small"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
