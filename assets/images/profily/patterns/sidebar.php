<?php
/**
 * Title: sidebar
 * Slug: profily/sidebar
 * Categories: profily-patterns
 */
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"30px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}},"color":{"background":"#edf2f7"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:10px;background-color:#edf2f7;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:heading {"level":3,"fontSize":"small-plus"} -->
<h3 class="wp-block-heading has-small-plus-font-size">Can't find something?</h3>
<!-- /wp:heading -->

<!-- wp:search {"label":"","showLabel":false,"placeholder":"Type keywords","buttonText":"Search","buttonPosition":"button-inside","buttonUseIcon":true,"backgroundColor":"white","className":"is-style-border is-style-border-with-radius"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"30px","left":"30px","top":"30px","bottom":"30px"}},"border":{"radius":"10px"},"color":{"background":"#edf2f7"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:10px;background-color:#edf2f7;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:heading {"level":3,"fontSize":"small-plus"} -->
<h3 class="wp-block-heading has-small-plus-font-size">About The Author</h3>
<!-- /wp:heading -->

<!-- wp:image {"id":3008,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/sidebar-author.jpg" alt="" class="wp-image-3008"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.8"}},"fontSize":"small"} -->
<p class="has-small-font-size" style="line-height:1.8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean a orci bibendum, egestas quam et, mollis massa. Nam id diam et lacus facilisis viverra in quis</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"30px","left":"30px","top":"30px","bottom":"30px"}},"border":{"radius":"10px"},"color":{"background":"#edf2f7"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:10px;background-color:#edf2f7;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:heading {"level":3,"fontSize":"small-plus"} -->
<h3 class="wp-block-heading has-small-plus-font-size">Fresh Articles</h3>
<!-- /wp:heading -->

<!-- wp:query {"queryId":13,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":""}},"layout":{"type":"default"},"fontSize":"tiny"} -->
<!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"blockGap":{"top":"0px","left":"20px"}}}} -->
<div class="wp-block-columns is-not-stacked-on-mobile"><!-- wp:column {"width":"80px"} -->
<div class="wp-block-column" style="flex-basis:80px"><!-- wp:group {"className":"lemmony-aspect-1_1 has-background-background-color","layout":{"type":"constrained"}} -->
<div class="wp-block-group lemmony-aspect-1_1 has-background-background-color"><!-- wp:post-featured-image {"isLink":true,"width":"80px","height":"80px","sizeSlug":"thumbnail","align":"wide","style":{"border":{"radius":"8px"}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%","style":{"spacing":{"blockGap":"var:preset|spacing|10"}}} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:post-title {"level":4,"isLink":true,"style":{"typography":{"lineHeight":"1.6","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"bottom":"10px"}}},"fontSize":"tiny-plus"} /-->

<!-- wp:post-date {"textColor":"meta","fontSize":"tiny"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"30px","left":"30px","top":"30px","bottom":"30px"}},"border":{"radius":"10px"},"color":{"background":"#edf2f7"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:10px;background-color:#edf2f7;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:heading {"level":3,"fontSize":"small-plus"} -->
<h3 class="wp-block-heading has-small-plus-font-size">Keep it social</h3>
<!-- /wp:heading -->

<!-- wp:social-links {"style":{"spacing":{"blockGap":{"top":"0px","left":"10px"},"margin":{"top":"0px","right":"0px","bottom":"0px","left":"0px"}}},"className":"is-style-logos-border","layout":{"type":"flex","justifyContent":"left"}} -->
<ul class="wp-block-social-links is-style-logos-border" style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px"><!-- wp:social-link {"url":"#","service":"twitter"} /-->

<!-- wp:social-link {"url":"#","service":"facebook"} /-->

<!-- wp:social-link {"url":"#","service":"youtube"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"0px","left":"0px","top":"0px","bottom":"0px"}},"border":{"radius":"10px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-radius:10px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:heading {"level":3,"fontSize":"small-plus"} -->
<h3 class="wp-block-heading has-small-plus-font-size">Categories</h3>
<!-- /wp:heading -->

<!-- wp:categories {"showPostCounts":true,"showOnlyTopLevel":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"radius":"10px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-radius:10px"><!-- wp:heading {"level":3,"fontSize":"small-plus"} -->
<h3 class="wp-block-heading has-small-plus-font-size">Tags</h3>
<!-- /wp:heading -->

<!-- wp:tag-cloud {"smallestFontSize":"13pt","largestFontSize":"13pt"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->