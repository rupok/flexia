<?php
    /**
     * Title: Header
     * Slug: flexia/header
     * Categories: flexia, header
     */
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xx-small","bottom":"var:preset|spacing|xx-small","left":"var:preset|spacing|x-small","right":"var:preset|spacing|x-small"}}},"backgroundColor":"dark-background","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-dark-background-background-color has-background" style="padding-top:var(--wp--preset--spacing--xx-small);padding-right:var(--wp--preset--spacing--x-small);padding-bottom:var(--wp--preset--spacing--xx-small);padding-left:var(--wp--preset--spacing--x-small)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|xx-small"}},"className":"responsive_row","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide responsive_row"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|xx-small"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"18px","height":"20px","scale":"contain","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|grayscale"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( "/assets/images/mail-open-line.svg" ) ); ?>" alt="" style="object-fit:contain;width:18px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|body-alt"}}}},"textColor":"body-alt","fontSize":"small"} -->
<p class="has-body-alt-color has-text-color has-link-color has-small-font-size"><a href="#"><?php echo esc_html_x( 'email@example.com', 'Message to convey header', 'flexia' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right","orientation":"horizontal"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|xx-small"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"18px","height":"20px","scale":"contain","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( "/assets/images/user-line.svg" ) ); ?>" alt="" style="object-fit:contain;width:18px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|body-alt"}}}},"textColor":"body-alt","className":"is-style-list-style-no-bullet is-style-list-style-hide","fontSize":"small"} -->
<p class="is-style-list-style-no-bullet is-style-list-style-hide has-body-alt-color has-text-color has-link-color has-small-font-size"><a href="#"><?php echo esc_html_x( 'Sign up', 'Message to convey header', 'flexia' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|xx-small"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"18px","height":"20px","scale":"contain","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( "/assets/images/user-line.svg" ) ); ?>" alt="" style="object-fit:contain;width:18px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:loginout {"fontSize":"small"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|x-small","bottom":"var:preset|spacing|x-small","left":"var:preset|spacing|x-small","right":"var:preset|spacing|x-small"}},"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}}},"textColor":"contrast","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-contrast-color has-text-color has-link-color" style="padding-top:var(--wp--preset--spacing--x-small);padding-right:var(--wp--preset--spacing--x-small);padding-bottom:var(--wp--preset--spacing--x-small);padding-left:var(--wp--preset--spacing--x-small)"><!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
<div class="wp-block-group alignwide"><!-- wp:image {"width":"140px","height":"35px","scale":"contain","style":{"color":{"duotone":"var:preset|duotone|midnight-blue"}},"className":"size-full theme_logo"} -->
<figure class="wp-block-image is-resized size-full theme_logo"><a href="<?php echo esc_url( get_home_url() ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.svg" alt="Home" style="object-fit:contain;width:140px;height:35px"/></a></figure>
<!-- /wp:image -->

<!-- wp:navigation {"textColor":"Heading","layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"right"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"fontSize":"medium"} -->
<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Home', 'flexia' ); ?>","url":"#","kind":"custom","isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"<?php esc_html_e( 'About', 'flexia' ); ?>","url":"#about","kind":"custom","isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Services', 'flexia' ); ?>","url":"#services","kind":"custom","isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Pricing', 'flexia' ); ?>","url":"#pricing","kind":"custom","isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Blog', 'flexia' ); ?>","url":"#blog","kind":"custom","isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Contact', 'flexia' ); ?>","url":"#","kind":"custom","isTopLevelLink":true} /-->
<!-- /wp:navigation -->

<!-- wp:search {"label":"<?php echo esc_attr_x( 'Search', 'search button text', 'flexia' ); ?>","showLabel":false,"buttonText":"<?php echo esc_attr_x( 'Search', 'search button text', 'flexia' ); ?>","buttonPosition":"button-only","buttonUseIcon":true,"isSearchFieldHidden":true,"style":{"border":{"width":"0px","style":"none","radius":"0px"},"layout":{"selfStretch":"fit","flexSize":null}},"textColor":"Heading","className":"header-search is-style-flexia-minimal-search","fontSize":"small"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->