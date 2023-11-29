<?php
/**
 * Title: Banner Section
 * Slug: profily/banner
 * Categories: profily-patterns,
 */
?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri("/assets/images/banner.jpg") ); ?>","id":172,"dimRatio":90,"customGradient":"linear-gradient(108deg,rgb(16,19,42) 0%,rgb(14,17,35) 100%)","align":"full","style":{"spacing":{"padding":{"top":"120px","bottom":"200px"}}},"layout":{"type":"constrained","contentSize":"900px"}} -->
<div class="wp-block-cover alignfull" style="padding-top:120px;padding-bottom:200px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-90 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(108deg,rgb(16,19,42) 0%,rgb(14,17,35) 100%)"></span><img class="wp-block-cover__image-background wp-image-172" alt="" src="<?php echo esc_url( get_theme_file_uri("assets/images/banner.jpg") ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"textAlign":"center","style":{"spacing":{"padding":{"left":"18px","right":"18px","top":"2px","bottom":"2px"}},"border":{"radius":"20px"},"color":{"background":"#10132b","text":"#acacd0"},"typography":{"fontStyle":"normal","fontWeight":"400","fontSize":"12px","letterSpacing":"2px"}},"className":"is-style-fill"} -->
<div class="wp-block-button has-custom-font-size is-style-fill" style="font-size:12px;font-style:normal;font-weight:400;letter-spacing:2px"><a class="wp-block-button__link has-text-color has-background has-text-align-center wp-element-button" style="border-radius:20px;color:#acacd0;background-color:#10132b;padding-top:2px;padding-right:18px;padding-bottom:2px;padding-left:18px"><?php echo esc_html__('Check out our new products','profily');?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:heading {"textAlign":"center","fontSize":"huge"} -->
<h2 class="wp-block-heading has-text-align-center has-huge-font-size"><?php echo esc_html__('We help you to create','profily');?> <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-contrast-2-color"><?php echo esc_html__('high quality design','profily');?></mark></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","contentSize":"550px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","style":{"color":{"text":"#ffffffd4"}},"fontSize":"tiny-plus"} -->
<p class="has-text-align-center has-text-color has-tiny-plus-font-size" style="color:#ffffffd4"><?php echo esc_html__('Take the guesswork out of launching your next project with our expert guidance and cutting-edge tools.','profily');?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__('Get started','profily');?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__('Learn More','profily');?> </a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->