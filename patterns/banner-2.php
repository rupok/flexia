<?php
    /**
     * Title: Banner Two
     * Slug: flexia/banner2
     * Categories: hidden
     * Inserter: no
     */

    $get_url = trailingslashit( get_template_directory_uri() );

    $images = [
        $get_url . "/assets/images/banner-bg-1.png",
        $get_url . "/assets/images/stack-img.png"
    ];

?>


<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:cover {"url":"                                                   <?php echo esc_url( $images[0] ); ?>","id":181,"dimRatio":0,"overlayColor":"secondary","contentPosition":"center center","isDark":false,"align":"wide","style":{"spacing":{"padding":{"right":"0px","left":"0px","top":"110px","bottom":"110px"}},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignwide is-light" style="border-radius:8px;padding-top:110px;padding-right:0px;padding-bottom:110px;padding-left:0px"><span aria-hidden="true" class="wp-block-cover__background has-secondary-background-color has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-181" alt="" src="<?php echo esc_url( $images[0] ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%"><!-- wp:heading {"style":{"typography":{"textTransform":"capitalize"}},"fontSize":"huge"} -->
<h2 class="wp-block-heading has-huge-font-size" style="text-transform:capitalize">Creative solutions to improve your business</h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="padding-right:0;padding-left:0"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"primary","style":{"typography":{"textTransform":"capitalize"}}} -->
<div class="wp-block-button" style="text-transform:capitalize"><a class="wp-block-button__link has-primary-background-color has-background wp-element-button">Get started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"blockGap":"10px","padding":{"top":"12px","bottom":"12px","left":"20px","right":"20px"}}},"backgroundColor":"tertiary","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group has-tertiary-background-color has-background" style="border-radius:8px;padding-top:12px;padding-right:20px;padding-bottom:12px;padding-left:20px"><!-- wp:group {"style":{"spacing":{"blockGap":"0","padding":{"right":"0","left":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="padding-right:0;padding-left:0"><!-- wp:image {"id":272,"scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( $images[1] ); ?>" alt="" class="wp-image-272" style="object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|dark-background"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"typography":{"textTransform":"capitalize"}},"textColor":"text","fontSize":"small"} -->
<h2 class="wp-block-heading has-text-color has-link-color has-small-font-size" style="text-transform:capitalize"><a href="#">Book A Call</a></h2>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->