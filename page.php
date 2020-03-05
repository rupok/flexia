<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexia
 */


get_header(); ?>

	<div id="content" class="site-content">

	<?php flexia_page_header(); ?>

		<div class="flexia-wrapper flexia-container max width">
			<div id="primary" class="content-area">
				<main id="main" class="site-main flexia-container">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'framework/views/template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div><!-- #flexia-wrapper -->
	</div><!-- #content -->
</div><!-- #page -->
<?php
get_footer();
