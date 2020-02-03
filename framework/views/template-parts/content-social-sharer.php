<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Template part for displaying post social sharer
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexia
 */
$thumbnail = '';
    if (function_exists('has_post_thumbnail')) {
        if ( has_post_thumbnail() ) {
             $thumbnail = wp_get_attachment_url( get_post_thumbnail_id() );
        }
    }
$social_sharing_text = get_theme_mod('flexia_social_sharing_text', 'Share This Story');
$facebook_sharing = get_theme_mod('post_social_share_facebook', true);
$twitter_sharing = get_theme_mod('post_social_share_twitter', true);
$linkedin_sharing = get_theme_mod('post_social_share_linkedin', true);
$gplus_sharing = get_theme_mod('post_social_share_gplus', true);
$pinterest_sharing = get_theme_mod('post_social_share_pinterest', true);
?>

<div class="flexia-social-share">
	<div class="flexia-social-share-heading">
        <h5><?php echo $social_sharing_text; ?></h5>
	</div>
	<ul class="flexia-social-share-links">
		<?php if( $facebook_sharing == true ) : ?>
		<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-2x fa-fw fa-facebook"></i></a></li>
		<?php endif; ?>

		<?php if( $twitter_sharing == true ) : ?>
		<li><a href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-2x fa-fw fa-twitter"></i></a></li>
		<?php endif; ?>

		<?php if( $linkedin_sharing == true ) : ?>
		<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=&summary=&source=" target="_blank"><i class="fa fa-2x fa-fw fa-linkedin"></i></a></li>
		<?php endif; ?>

		<?php if( $gplus_sharing == true ) : ?>
		<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-2x fa-fw fa-google-plus"></i></a></li>
		<?php endif; ?>

		<?php if( $pinterest_sharing == true ) : ?>
		<li><a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $thumbnail; ?>&description=" target="_blank"><i class="fa fa-2x fa-fw fa-pinterest"></i></a></li>
		<?php endif; ?>
	</ul>
</div> <!-- Social Share end-->