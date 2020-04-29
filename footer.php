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
		<i class="fa fa-angle-up" aria-hidden="true"></i>
		<span class="screen-reader-text"><?php echo __('Scroll back to top', 'flexia'); ?></span>
	</a>
<?php endif; ?>

</body>
</html>
