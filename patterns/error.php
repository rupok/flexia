<?php
    /**
     * Title: Error
     * Slug: flexia/error-page
     * Categories: flexia
     * Inserter: no
     */
?>


<!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri("/assets/images/error.png") ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|xx-small"}},"layout":{"type":"constrained","contentSize":"550px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"lineHeight":"1.4","textTransform":"capitalize"}},"fontSize":"huge"} -->
<h1 class="wp-block-heading has-text-align-center has-huge-font-size" style="line-height:1.4;text-transform:capitalize">Page Not Found</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
<p class="has-text-align-center has-small-font-size">We're sorry, the page you requested could not be found<br>please go back to the homepage</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"24px"} -->
<div style="height:24px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0"><!-- wp:button {"className":"aligncenter"} -->
<div class="wp-block-button aligncenter"><a class="wp-block-button__link wp-element-button" href="/">Go Home</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

