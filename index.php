<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexia
 */

get_header();

?>


<?php
/**
 * Flexia hook for Blog Header
 *
 * @since   v2.1.3
 */
?>


<div id="content" class="site-content">

	<?php do_action('flexia_blog_header'); ?>

	<div class="flexia-wrapper flexia-container max width">

		<div id="primary" class="content-area">

			<?php
			/**
			 * Flexia hook for Blog Before Main Content/ Loop
			 *
			 * @since   v2.1.3
			 */

			do_action('flexia_blog_before_content');
			?>

			<?php
			/**
			 * Flexia hook for Blog Content/The Loop
			 *
			 * @since   v2.1.3
			 */

			do_action('flexia_blog_content');
			?>


			<?php
			/**
			 * Flexia hook for Blog After Main Content/ Loop
			 *
			 * @since   v2.1.3
			 */

			do_action('flexia_blog_after_content');
			?>

		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- #flexia-wrapper -->
</div><!-- #content -->
</div><!-- #page -->

<?php
get_footer();
