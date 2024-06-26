<?php
/**
 * Title: List of posts, 1 columns
 * Slug: flexia/posts-list
 * Categories: flexia, posts
 * Block Types: core/query
 */
?>
<!-- wp:query {query":{"perPage":6,"pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:post-template {"layout":{"type":"grid","columnCount":1}} -->
<!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"right":"32px","left":"32px","top":"32px","bottom":"32px"}}},"className":"is-style-hover-shadow is-style-flexia-hover-shadow","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-hover-shadow is-style-flexia-hover-shadow" style="border-radius:8px;padding-top:32px;padding-right:32px;padding-bottom:32px;padding-left:32px"><!-- wp:post-featured-image {"style":{"border":{"radius":"4px"}}} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:post-title {"isLink":true,"fontSize":"medium-plus"} /-->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:post-author {"className":"is-style-author-rounded is-style-flexia-author-rounded"} /-->

<!-- wp:post-date {"fontSize":"small"} /--></div>
<!-- /wp:group -->

<!-- wp:post-excerpt {"moreText":"<?php echo esc_attr_x( 'Read More', 'Read More button text', 'flexia' ); ?>","excerptLength":30} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:spacer {"height":"var:preset|spacing|40","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div style="margin-top:0;margin-bottom:0;height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group -->

<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"space-between"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:query -->