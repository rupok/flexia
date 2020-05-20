<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

?>

<?php

	do_action('flexia_before_footer'); //Hook for Add Content Before Footer 

	do_action('flexia_footer');
	
?>

<?php if(get_theme_mod('flexia_nav_menu_search', true) == true): ?>
	<div class="flexia-search-overlay">
		<svg class="hidden">
			<defs>
				<symbol id="icon-cross" viewBox="0 0 24 24">
					<title>cross</title>
					<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
				</symbol>
			</defs>
		</svg>
		<button id="btn-search-close" class="btn--search-close" aria-label="Close search form"><svg class="icon-search-close icon--cross"><use xlink:href="#icon-cross"></use></svg></button>
		<div class="search--form-wrapper">
			<form class="search__form" action="/" method="get">
				<div class="search--input-wrapper" data-text="">
					<input class="search__input" name="s" type="search" id="search" placeholder="Search..." autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" value="<?php the_search_query(); ?>"/>
				</div>
				<label class="search__info"><?php echo __('Hit ENTER to search or ESC to close', 'flexia'); ?></label>
			</form>
		</div>
	</div><!-- /search overlay -->
<?php endif; ?>

<?php wp_footer(); ?>

<?php if(get_theme_mod('flexia_scroll_to_top') == true): ?>
	<a title="Scroll back to top" rel="nofollow" href="#" class="flexia-back-to-top" style="opacity: 0; visibility: hidden;" data-scroll-speed="400" data-start-scroll="300">
		<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve"> <g> <g> <path d="M246.1,109.5c-7.2,0-14,2.8-19.1,7.8L7.9,336.5c-5.1,5.1-7.9,11.8-7.9,19s2.8,14,7.9,19L24,390.7c5.1,5.1,11.8,7.9,19,7.9 c7.2,0,14-2.8,19-7.9l184.1-184.1L430,390.5c10.5,10.5,27.6,10.5,38.1,0l16.1-16.1c5.1-5.1,7.9-11.8,7.9-19s-2.8-14-7.9-19 L265.2,117.3C260.1,112.2,253.3,109.5,246.1,109.5z"/> </g> </g> </svg>
		<span class="screen-reader-text"><?php echo __('Scroll back to top', 'flexia'); ?></span>
	</a>
<?php endif; ?>

</body>
</html>
