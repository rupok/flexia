<?php
/**
 * Title: About Section
 * Slug: profily/about-section
 * Categories: profily-patterns,
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:60px;padding-bottom:60px"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%"><!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri("/assets/images/image-home-3.jpg") ); ?>","id":342,"dimRatio":0,"minHeight":600,"contentPosition":"bottom right","isDark":false,"style":{"border":{"radius":{"topLeft":"500px","topRight":"500px","bottomLeft":"0px"},"top":{"width":"20px"},"right":{"color":"#F1F3F5","width":"10px"},"bottom":{},"left":{}}}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-right" style="border-top-left-radius:500px;border-top-right-radius:500px;border-bottom-left-radius:0px;border-top-width:20px;border-right-color:#F1F3F5;border-right-width:10px;min-height:600px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-342" alt="" src="<?php echo esc_url( get_theme_file_uri("/assets/images/image-home-3.jpg") ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"level":5,"style":{"spacing":{"padding":{"top":"10px","bottom":"10px","left":"20px","right":"20px"}}},"backgroundColor":"contrast-3"} -->
<h5 class="wp-block-heading has-contrast-3-background-color has-background" style="padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><?php echo esc_html__('20 Years of experience','profily');?>
</h5>
<!-- /wp:heading --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"padding":{"right":"40px"},"blockGap":"0"}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-right:40px"><!-- wp:heading {"level":6,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","letterSpacing":"2px","textTransform":"uppercase"}},"textColor":"primary","fontSize":"tiny"} -->
<h6 class="wp-block-heading has-primary-color has-text-color has-tiny-font-size" style="font-style:normal;font-weight:600;letter-spacing:2px;text-transform:uppercase"><?php echo esc_html__('About us','profily');?></h6>
<!-- /wp:heading -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"10px","bottom":"10px"}}}} -->
<h3 class="wp-block-heading" style="margin-top:10px;margin-bottom:10px"><?php echo esc_html__('Creative process behind us.','profily');?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"padding":{"right":"var:preset|spacing|50"},"margin":{"bottom":"var:preset|spacing|30"}}},"fontSize":"tiny-plus"} -->
<p class="has-tiny-plus-font-size" style="margin-bottom:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--50)"><?php echo esc_html__('We craft premium digital work for web, mobile and experiential with creative agencies and global brands alike – putting passion.','profily');?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:image {"id":288,"width":30,"height":30,"scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"layout":{"selfStretch":"fit","flexSize":null}},"className":"is-style-default"} -->
<figure class="wp-block-image size-full is-resized is-style-default"><img src="<?php echo esc_url( get_theme_file_uri("/assets/images/idea-150x150.png") ); ?>" alt="" class="wp-image-288" style="object-fit:cover;width:30px;height:30px" width="30" height="30"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":6} -->
<h6 class="wp-block-heading"><?php echo esc_html__('Creative Solutions','profily');?></h6>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:image {"id":279,"width":30,"height":30,"scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"layout":{"selfStretch":"fit","flexSize":null}},"className":"is-style-default"} -->
<figure class="wp-block-image size-full is-resized is-style-default"><img src="<?php echo esc_url( get_theme_file_uri("assets/images/layer-150x150.png") ); ?>" alt="" class="wp-image-279" style="object-fit:cover;width:30px;height:30px" width="30" height="30"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":6} -->
<h6 class="wp-block-heading"><?php echo esc_html__('Digital Product Design','profily');?></h6>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:image {"id":350,"width":30,"height":30,"scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"layout":{"selfStretch":"fit","flexSize":null}},"className":"is-style-default"} -->
<figure class="wp-block-image size-full is-resized is-style-default"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/history-150x150.png" alt="" class="wp-image-350" style="object-fit:cover;width:30px;height:30px" width="30" height="30"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":6} -->
<h6 class="wp-block-heading"><?php echo esc_html__('Unique Production','profily');?></h6>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"10px"}}}} -->
<div class="wp-block-buttons" style="margin-top:10px"><!-- wp:button {"textColor":"contrast-three","className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-contrast-three-color has-text-color wp-element-button"><?php echo esc_html__('Our Services','profily');?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->