<?php
    /**
     * Title: Post With Right Sidebar
     * Slug: flexia/post-with-sidebar
     * Categories: flexia
     * Inserter: no
     */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50)">
<!-- wp:columns {"align":"wide"} --><div class="wp-block-columns alignwide">
<!-- wp:column {"width":"70%"} --><div class="wp-block-column" style="flex-basis:70%">
<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} --><main class="wp-block-group"><!-- wp:pattern {"slug":"flexia/single-content"} /--></main><!-- /wp:group -->
</div><!-- /wp:column -->
<!-- wp:column {"width":"30%"} --><div class="wp-block-column" style="flex-basis:30%"><!-- wp:template-part {"slug":"sidebar","tagName":"aside"} /--></div><!-- /wp:column -->
</div><!-- /wp:columns --></div><!-- /wp:group -->
