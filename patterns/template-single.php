<?php
/**
 * Title: Template Single
 * Slug: flexia/template-single
 * Categories: flexia-pages
 * Inserter: no
 */
?>

<!-- wp:group {"tagName":"main","align":"full","style":{"spacing":{"margin":{"top":"0"}}}} -->
<main class="wp-block-group alignfull" style="margin-top:0"><!-- wp:pattern {"slug":"flexia/post-page-header"} /-->

    <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50"},"margin":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
    <div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--40);padding-top:var(--wp--preset--spacing--50)"><!-- wp:post-title {"level":1,"fontSize":"x-large"} /-->
    
    <!-- wp:post-excerpt /-->
    
    <!-- wp:post-featured-image {"height":"300px","style":{"border":{"radius":"4px"}}} /-->
    
    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10","padding":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
    <div class="wp-block-group" style="padding-top:0;padding-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
    <div class="wp-block-group"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
    <div class="wp-block-group"><!-- wp:post-author {"showBio":false} /-->
    
    <!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
    <p class="has-contrast-2-color has-text-color has-small-font-size">|</p>
    <!-- /wp:paragraph -->
    
    <!-- wp:post-date {"format":"M j, Y"} /-->
    
    <!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
    <p class="has-contrast-2-color has-text-color has-small-font-size">|</p>
    <!-- /wp:paragraph -->
    
    <!-- wp:post-terms {"term":"category","style":{"elements":{"link":{"color":{"text":"var:preset|color|body"}}}},"textColor":"body"} /--></div>
    <!-- /wp:group -->
    
    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
    <div class="wp-block-group"><!-- wp:heading {"style":{"typography":{"textTransform":"capitalize"}},"fontSize":"small"} -->
    <h2 class="wp-block-heading has-small-font-size" style="text-transform:capitalize"><?php echo esc_html_x( 'Share on','share text', 'flexia' ); ?> </h2>
    <!-- /wp:heading -->
    
    <!-- wp:social-links {"size":"has-small-icon-size","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|xx-small"}}},"className":"is-style-logos-only"} -->
    <ul class="wp-block-social-links has-small-icon-size is-style-logos-only"><!-- wp:social-link {"url":"#","service":"facebook"} /-->
    
    <!-- wp:social-link {"url":"#","service":"twitter"} /-->
    
    <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
    
    <!-- wp:social-link {"url":"#","service":"instagram"} /--></ul>
    <!-- /wp:social-links --></div>
    <!-- /wp:group --></div>
    <!-- /wp:group --></div>
    <!-- /wp:group --></div>
    <!-- /wp:group -->
    
    <!-- wp:post-content {"lock":{"move":false,"remove":true},"align":"full","layout":{"type":"constrained","contentSize":"1200px"}} /-->
    
    <!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"},"padding":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
    <div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:comments {"className":"wp-block-comments-query-loop"} -->
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
     <!-- wp:pattern {"slug":"flexia/related-posts"} /--></div>
     <!-- /wp:group --></main>
     <!-- /wp:group -->

    