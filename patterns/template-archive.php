<?php
/**
 * Title: Template Archive
 * Slug: flexia/template-archive
 * Categories: flexia-pages
 * Inserter: no
 */
?>

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"layout":{"type":"default"}} -->
<main class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:pattern {"slug":"flexia/archieve-page-header"} /-->
  <!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|30"}}}} -->
  <div class="wp-block-columns alignwide"><!-- wp:column {"width":"33.33%"} -->
  <div class="wp-block-column" style="flex-basis:33.33%"> <!-- wp:pattern {"slug":"flexia/main-sidebar","tagName":"aside"} /--></div>
  <!-- /wp:column -->
  
  <!-- wp:column {"width":"66.66%"} -->
  <div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:query {"query":{"perPage":"2","pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","layout":{"type":"default"}} -->
  <div class="wp-block-query alignwide"><!-- wp:query-no-results -->
    <!-- wp:paragraph {"placeholder":"<?php echo esc_attr_x( 'Add text or blocks that will display when a query returns no results.', 'query placeholder text', 'flexia' ); ?>"} -->
    <p><?php echo esc_html_x( 'No posts were found.','No post found text', 'flexia' ); ?>   </p>
    <!-- /wp:paragraph -->
    <!-- /wp:query-no-results -->
    <!-- wp:group {"layout":{"type":"default"}} -->
  <div class="wp-block-group"><!-- wp:post-template {"layout":{"type":"grid","columnCount":1}} -->
  <!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30","top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"className":"is-style-hover-shadow is-style-flexia-hover-shadow","layout":{"type":"constrained"}} -->
  <div class="wp-block-group is-style-hover-shadow is-style-flexia-hover-shadow" style="border-radius:8px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:post-featured-image {"height":"300px","style":{"border":{"radius":"4px"}}} /-->
  
  <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group"><!-- wp:post-title {"isLink":true,"fontSize":"medium-plus"} /-->
  
  <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
  <div class="wp-block-group"><!-- wp:post-author {"className":"is-style-author-rounded is-style-flexia-author-rounded"} /-->
  
  <!-- wp:post-date {"fontSize":"small"} /-->
  
  <!-- wp:post-terms {"term":"category","style":{"elements":{"link":{"color":{"text":"var:preset|color|text"}}}},"textColor":"text","fontSize":"small"} /--></div>
  <!-- /wp:group -->
  
  <!-- wp:post-excerpt {"moreText":"<?php echo esc_attr_x( 'Read More', 'Read More button text', 'flexia' ); ?>","excerptLength":40} /--></div>
  <!-- /wp:group --></div>
  <!-- /wp:group -->
  <!-- /wp:post-template -->
  
  <!-- wp:spacer {"height":"var:preset|spacing|40","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
  <div style="margin-top:0;margin-bottom:0;height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
  <!-- /wp:spacer --></div>
  <!-- /wp:group -->
  
  <!-- wp:query-pagination {"paginationArrow":"arrow","showLabel":false,"layout":{"type":"flex","justifyContent":"left"}} -->
  <!-- wp:query-pagination-previous /-->
  
  <!-- wp:query-pagination-numbers /-->
  
  <!-- wp:query-pagination-next /-->
  <!-- /wp:query-pagination --></div>
  <!-- /wp:query --></div>
  <!-- /wp:column --></div>
  <!-- /wp:columns --></div>
  <!-- /wp:group --></main>
  <!-- /wp:group -->