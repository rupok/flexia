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

$flexia_page_header_layout 	= get_theme_mod( 'flexia_page_header_layout', 'flexia_page_header_default' );
$flexia_page_breadcrumb = get_theme_mod( 'flexia_page_breadcrumb', true);

get_header(); ?>

<div id="page" class="site">

	<?php get_template_part( 'framework/views/template-parts/content', 'masthead' ); ?>

	<div id="content" class="site-content">

	<?php if( $flexia_page_header_layout == 'flexia_page_header_large') { ?>
		<header class="entry-header entry-header-large entry-header-center">
			<div class="flexia-container">
				<div class="entry-header-inner">
				<?php
					flexia_page_title();
					if( $flexia_page_breadcrumb == true ) {
						flexia_breadcrumbs();
					}
				?>
				</div>
			</div>
		</header>

	<?php } elseif( $flexia_page_header_layout == 'flexia_page_header_mini') { ?>
		<header class="entry-header entry-header-mini">
			<div class="flexia-container max width">
				<div class="entry-header-inner">
				<?php
					flexia_page_title();
					if( $flexia_page_breadcrumb == true ) {
						flexia_breadcrumbs();
					}
				?>
				</div>
			</div>
		</header>
		<?php
	}else {
		// no header
	} ?>
		
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
get_template_part( 'framework/views/template-parts/content', 'footer' );
get_footer();
