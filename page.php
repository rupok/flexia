<?php
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

<div id="page" class="site">

	<?php get_template_part( 'framework/views/template-parts/content', 'masthead' ); ?>

	<div id="content" class="site-content">
		<div class="flexia-wrapper flexia-container">
			<div id="primary" class="content-area">
				<main id="main" class="site-main flexia-container max width">

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
get_template_part( 'framework/views/template-parts/content', 'footer' );
get_footer();
