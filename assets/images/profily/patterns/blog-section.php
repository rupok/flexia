<?php
/**
 * Title: Blog Section
 * Slug: profily/blog-section
 * Categories: profily-patterns
 */
?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"120px","bottom":"120px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:120px;padding-bottom:120px"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"50px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-bottom:50px"><!-- wp:heading {"textAlign":"center","level":6,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","letterSpacing":"2px","textTransform":"uppercase"}},"textColor":"primary","fontSize":"tiny"} -->
<h6 class="wp-block-heading has-text-align-center has-primary-color has-text-color has-tiny-font-size" style="font-style:normal;font-weight:600;letter-spacing:2px;text-transform:uppercase"><?php echo esc_html__('Blog news','profily');?></h6>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center"><?php echo esc_html__('From Our Blog Posts','profily');?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:query {"queryId":12,"query":{"perPage":"2","pages":"2","offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"default"}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} -->
<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:post-featured-image {"isLink":true,"style":{"border":{"radius":"4px"}}} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"75%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:75%"><!-- wp:post-date {"style":{"color":{"text":"#81888f"}}} /-->

<!-- wp:post-title {"isLink":true,"fontSize":"small-plus"} /-->

<!-- wp:read-more {"content":"Read More","style":{"typography":{"textDecoration":"underline"}}} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->