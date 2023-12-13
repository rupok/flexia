<?php
/**
 * Title: Grid of posts, 3 columns
 * Slug: flexia/blog
 * Categories: flexia, posts
 * Block Types: core/query
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|xx-small"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:paragraph {"align":"center","style":{"typography":{"letterSpacing":"4px","textTransform":"uppercase"},"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary","fontSize":"small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-link-color has-small-font-size" style="letter-spacing:4px;text-transform:uppercase">BLog</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","align":"full","style":{"typography":{"textTransform":"capitalize"}},"textColor":"Heading","fontSize":"large-plus"} -->
<h2 class="wp-block-heading alignfull has-text-align-center has-heading-color has-text-color has-large-plus-font-size" style="text-transform:capitalize">latest News</h2>
<!-- /wp:heading -->

<!-- wp:spacer {"height":"20px"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group -->

<!-- wp:query {"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"right":"var:preset|spacing|x-small","left":"var:preset|spacing|x-small","top":"var:preset|spacing|x-small","bottom":"var:preset|spacing|x-small"}}},"className":"is-style-hover-shadow is-style-flexia-hover-shadow","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-hover-shadow is-style-flexia-hover-shadow" style="border-radius:8px;padding-top:var(--wp--preset--spacing--x-small);padding-right:var(--wp--preset--spacing--x-small);padding-bottom:var(--wp--preset--spacing--x-small);padding-left:var(--wp--preset--spacing--x-small)"><!-- wp:post-featured-image {"style":{"border":{"radius":"4px"}}} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:post-title {"isLink":true,"fontSize":"medium-plus"} /-->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:post-date {"fontSize":"small"} /-->

<!-- wp:post-terms {"term":"category","style":{"elements":{"link":{"color":{"text":"var:preset|color|text"}}}},"textColor":"text","fontSize":"small"} /--></div>
<!-- /wp:group -->

<!-- wp:post-author {"className":"is-style-author-rounded is-style-flexia-author-rounded"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->