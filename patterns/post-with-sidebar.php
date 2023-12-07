<?php
    /**
     * Title: Post Wwith Sidebar
     * Slug: flexia/post-with-sidebar
     * Categories: flexia
     */
?>

<!-- wp:group {"style":{"spacing":{"padding":{"left":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|50"},"blockGap":"0","margin":{"top":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--30)"><!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri("/assets/images/page-banner-img.jpg") ); ?>","id":1479,"dimRatio":60,"customOverlayColor":"#0f125c","minHeight":257,"minHeightUnit":"px","align":"full"} -->
    <div class="wp-block-cover alignfull" style="min-height:257px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-background-dim" style="background-color:#0f125c"></span><img class="wp-block-cover__image-background wp-image-1479" alt="" src="<?php echo esc_url( get_theme_file_uri("/assets/images/page-banner-img.jpg") ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","fontSize":"huge"} -->
    <h2 class="wp-block-heading has-text-align-center has-huge-font-size">Blog</h2>
    <!-- /wp:heading -->
    
    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
    <div class="wp-block-group"><!-- wp:paragraph {"fontSize":"small"} -->
    <p class="has-small-font-size">Home</p>
    <!-- /wp:paragraph -->
    
    <!-- wp:paragraph -->
    <p>.</p>
    <!-- /wp:paragraph -->
    
    <!-- wp:heading {"textAlign":"center","fontSize":"small"} -->
    <h2 class="wp-block-heading has-text-align-center has-small-font-size">Blog</h2>
    <!-- /wp:heading --></div>
    <!-- /wp:group --></div>
    <!-- /wp:group --></div></div>
    <!-- /wp:cover -->
    
    <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50)"><!-- wp:columns {"align":"full"} -->
    <div class="wp-block-columns alignfull"><!-- wp:column {"width":"66.66%"} -->
    <div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:query {"queryId":1,"query":{"perPage":10,"pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","layout":{"type":"default"}} -->
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
    
    <!-- wp:post-excerpt {"moreText":"Read More","excerptLength":30} /--></div>
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
    <!-- /wp:query --></div>
    <!-- /wp:column -->
    
    <!-- wp:column {"width":"33.33%"} -->
    <div class="wp-block-column" style="flex-basis:33.33%"> <!-- wp:pattern {"slug":"flexia/main-sidebar"} /--></div>
    <!-- /wp:column --></div>
    <!-- /wp:columns --></div>
    <!-- /wp:group --></div>
    <!-- /wp:group -->