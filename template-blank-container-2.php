<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  TEMPLATE NAME: Blank - Container | Header, No Footer
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
		</div><!-- #flexia-wrapper -->
	</div><!-- #content --> 
</div><!-- #page -->
<?php
get_footer();
