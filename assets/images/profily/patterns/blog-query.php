<?php
/**
 * Title: Blog Query
 * Slug: profily/blog-query-post
 * Categories: profily-patterns,
 */
?>
<!-- wp:query {"queryId":1,"query":{"perPage":10,"pages":"","offset":"","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"tagName":"main","align":"wide","layout":{"type":"default"}} -->
<main class="wp-block-query alignwide"><!-- wp:post-template {"align":"wide","layout":{"type":"default","columnCount":3}} -->
<!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"20px"},"color":{"background":"#f9fafa"}},"className":"has-no-hover-shadow-dark","layout":{"inherit":true,"type":"constrained"}} -->
<div class="wp-block-group has-no-hover-shadow-dark has-background" style="background-color:#f9fafa;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:post-featured-image {"isLink":true,"align":"wide","className":"no-padding image-zoom-hover"} /-->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"30px","right":"40px","bottom":"40px","left":"40px"},"margin":{"top":"0px","bottom":"0px"},"blockGap":"10px"}},"backgroundColor":"background-secondary"} -->
<div class="wp-block-group alignwide has-background-secondary-background-color has-background" style="margin-top:0px;margin-bottom:0px;padding-top:30px;padding-right:40px;padding-bottom:40px;padding-left:40px"><!-- wp:post-title {"level":3,"isLink":true,"align":"wide","style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.4"},"spacing":{"margin":{"bottom":"20px"}}},"fontSize":"medium"} /-->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:post-author {"avatarSize":24,"showBio":false,"style":{"spacing":{"margin":{"right":"30px"}}},"fontSize":"tiny"} /-->

<!-- wp:post-date {"format":"M j, Y","isLink":true,"fontSize":"tiny"} /--></div>
<!-- /wp:group -->

<!-- wp:post-excerpt {"moreText":"\u003cbr\u003eKnow More","excerptLength":25,"style":{"elements":{"link":{"color":{"text":"var:preset|color|custom-primary-color"}}}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"20px"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"paginationArrow":"arrow","align":"center","layout":{"type":"flex","justifyContent":"space-between"}} -->
<!-- wp:query-pagination-previous {"fontSize":"small"} /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next {"fontSize":"small"} /-->
<!-- /wp:query-pagination --></main>
<!-- /wp:query -->