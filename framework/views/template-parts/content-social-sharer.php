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

?>

<div class="flexia-social-share">
	<div class="flexia-social-share-heading">
		<h5>Share This Story</h5>
	</div>
	<ul class="flexia-social-share-links">
		<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-2x fa-fw fa-facebook"></i></a></li>

		<li><a href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-2x fa-fw fa-twitter"></i></a></li>

		<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=&summary=&source=" target="_blank"><i class="fa fa-2x fa-fw fa-linkedin"></i></a></li>

		<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-2x fa-fw fa-google-plus"></i></a></li>

		<li><a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $thumbnail; ?>&description=" target="_blank"><i class="fa fa-2x fa-fw fa-pinterest"></i></a></li>
	</ul>
</div> <!-- Social Share end-->