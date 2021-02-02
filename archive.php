<?php

// No direct access, please
if (!defined('ABSPATH')) exit;

/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexia
 */

get_header();
/**
 * Flexia hook for Blog Header
 */
?>

<div id="content" class="site-content">

	<?php do_action('flexia_archive_header'); ?>

	<div class="flexia-wrapper flexia-container max width">

		<div id="primary" class="content-area">

			<?php
			/**
			 * Flexia hook for Archive Before Main Content/ Loop
			 */

			do_action('flexia_archive_before_content');
			?>

			<?php
			/**
			 * Flexia hook for Archive Content/The Loop
			 */

			do_action('flexia_archive_content');
			?>

			<?php
			/**
			 * Flexia hook for archive After Main Content/ Loop
			 */

			do_action('flexia_archive_after_content');
			?>

		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- #flexia-wrapper -->
</div><!-- #content -->
</div><!-- #page -->

<?php
get_footer();
