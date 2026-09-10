<?php
/**
 * Title: Single post content
 * Slug: flexia/single-content
 * Categories: flexia-pages
 * Inserter: no
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<!-- wp:post-title {"level":1,"fontSize":"x-large"} /-->
<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group"><!-- wp:post-author {"showBio":false} /--><!-- wp:post-date /--><!-- wp:post-terms {"term":"category"} /--></div>
<!-- /wp:group -->
<!-- wp:post-featured-image /-->
<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
<!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
<div class="wp-block-group"><!-- wp:post-navigation-link {"type":"previous"} /--><!-- wp:post-navigation-link {"type":"next"} /--></div>
<!-- /wp:group -->
<!-- wp:comments {"className":"wp-block-comments-query-loop"} -->
    <div class="wp-block-comments wp-block-comments-query-loop"><!-- wp:comments-title {"showPostTitle":false,"level":3} /-->

    <!-- wp:comment-template -->
    <!-- wp:columns {"verticalAlignment":"top","isStackedOnMobile":false,"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-top is-not-stacked-on-mobile"><!-- wp:column {"verticalAlignment":"top","width":"65px"} -->
    <div class="wp-block-column is-vertically-aligned-top" style="flex-basis:65px"><!-- wp:avatar {"size":65} /--></div>
    <!-- /wp:column -->

    <!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}}} -->
    <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
    <div class="wp-block-group"><!-- wp:comment-author-name /-->

    <!-- wp:comment-date /--></div>
    <!-- /wp:group -->

    <!-- wp:comment-content /-->

    <!-- wp:comment-reply-link /--></div>
    <!-- /wp:column --></div>
    <!-- /wp:columns -->
    <!-- /wp:comment-template -->

    <!-- wp:post-comments-form {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"background-alt"} /--></div>
    <!-- /wp:comments -->
