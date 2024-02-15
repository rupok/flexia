<?php
    /**
     * Title: Banner
     * Slug: flexia/banner
     * Categories: flexia
     */

?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|x-small","right":"var:preset|spacing|x-small"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:0;padding-right:var(--wp--preset--spacing--x-small);padding-bottom:0;padding-left:var(--wp--preset--spacing--x-small)"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0","right":"0","left":"0"}}},"backgroundColor":"background","layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group alignwide has-background-background-color has-background" style="padding-top:0;padding-right:0;padding-left:0"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"padding":{"right":"0","left":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="padding-right:0;padding-left:0"><!-- wp:column {"verticalAlignment":"center","width":"55%","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);flex-basis:55%"><!-- wp:heading {"style":{"typography":{"textTransform":"capitalize"}},"fontSize":"huge"} -->
<h2 class="wp-block-heading has-huge-font-size" style="text-transform:capitalize"><?php echo esc_html_x( 'Creative solutions to improve your business', 'Message to convey banner', 'flexia' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"},"blockGap":"var:preset|spacing|xx-small"}},"layout":{"type":"flex","flexWrap":"wrap","orientation":"horizontal"}} -->
<div class="wp-block-group" style="padding-right:0;padding-left:0"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"typography":{"textTransform":"capitalize"},"border":{"radius":"8px"}},"className":"is-style-flexia-btn-theme"} -->
<div class="wp-block-button is-style-flexia-btn-theme" style="text-transform:capitalize"><a class="wp-block-button__link wp-element-button" style="border-radius:8px"><?php echo esc_html_x( 'Get started', 'Message to convey banner', 'flexia' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"blockGap":"10px","padding":{"top":"13px","bottom":"13px","left":"var:preset|spacing|x-small","right":"var:preset|spacing|x-small"}}},"backgroundColor":"tertiary","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group has-tertiary-background-color has-background" style="border-radius:8px;padding-top:13px;padding-right:var(--wp--preset--spacing--x-small);padding-bottom:13px;padding-left:var(--wp--preset--spacing--x-small)"><!-- wp:group {"style":{"spacing":{"blockGap":"0","padding":{"right":"0","left":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="padding-right:0;padding-left:0"><!-- wp:image {"width":"76px","height":"auto","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( "/assets/images/stack-img.png" ) ); ?>" alt="" style="object-fit:cover;width:76px;height:auto"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|dark-background"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"typography":{"textTransform":"capitalize"}},"textColor":"text","fontSize":"small"} -->
<h2 class="wp-block-heading has-text-color has-link-color has-small-font-size" style="text-transform:capitalize"><a href="#"><?php echo esc_html_x( 'Book A Call', 'Message to convey that banner', 'flexia' ); ?></a></h2>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"margin\u002d\u002dleft"} -->
<figure class="wp-block-image size-full margin--left"><img src="<?php echo esc_url( get_theme_file_uri( "/assets/images/image-1.png" ) ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->