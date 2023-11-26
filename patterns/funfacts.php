<?php
/**
 * Title: Funfact Section
 * Slug: flexia/funfacts
 * Categories: hidden
 * Inserter: no
 */


 $get_url = trailingslashit(get_template_directory_uri());

 $images = [
    $get_url . "/assets/images/emotion-happy-line.png",
    $get_url . "/assets/images/group-line.png",
    $get_url . "/assets/images/line-chart-line.png",
    $get_url . "/assets/images/team-line.png",
 ];

?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|x-small"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-column"><!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|x-small"}}}} -->
<div class="wp-block-columns is-not-stacked-on-mobile"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"30px","right":"30px"},"blockGap":"var:preset|spacing|xx-small"}},"backgroundColor":"light-background-two","layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"top","orientation":"horizontal"}} -->
<div class="wp-block-group has-light-background-two-background-color has-background" style="padding-top:20px;padding-right:30px;padding-bottom:20px;padding-left:30px"><!-- wp:image {"id":275,"width":"45px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|primary"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $images[0] ); ?>" alt="" class="wp-image-275" style="width:45px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">99%</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Happy Customers</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"30px","right":"30px"},"blockGap":"var:preset|spacing|x-small"}},"backgroundColor":"light-background-two","layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"top","orientation":"horizontal"}} -->
<div class="wp-block-group has-light-background-two-background-color has-background" style="padding-top:20px;padding-right:30px;padding-bottom:20px;padding-left:30px"><!-- wp:image {"id":279,"width":"45px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|primary"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $images[1] ); ?>" alt="" class="wp-image-279" style="width:45px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">10M</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Active Users</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|x-small"}}}} -->
<div class="wp-block-columns is-not-stacked-on-mobile"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"30px","right":"30px"},"blockGap":"var:preset|spacing|xx-small"}},"backgroundColor":"light-background-two","layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"top","orientation":"horizontal"}} -->
<div class="wp-block-group has-light-background-two-background-color has-background" style="padding-top:20px;padding-right:30px;padding-bottom:20px;padding-left:30px"><!-- wp:image {"id":282,"width":"45px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|primary"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $images[2] ); ?>" alt="" class="wp-image-282" style="width:45px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">100%</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Company Growth</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"30px","right":"30px"},"blockGap":"var:preset|spacing|x-small"}},"backgroundColor":"light-background-two","layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"top","orientation":"horizontal"}} -->
<div class="wp-block-group has-light-background-two-background-color has-background" style="padding-top:20px;padding-right:30px;padding-bottom:20px;padding-left:30px"><!-- wp:image {"id":283,"width":"45px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|primary"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $images[3] ); ?>" alt="" class="wp-image-283" style="width:45px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">100+</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Team Members</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->


