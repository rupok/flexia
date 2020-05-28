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
/**
 * Customizer Values
 */
$scroll_bottom_arrow 	= get_theme_mod('scroll_bottom_arrow', false);
$blog_title 			= get_theme_mod('blog_title', '');
$blog_desc 				= get_theme_mod('blog_desc', '');
$flexia_blog_layout 	= get_theme_mod( 'flexia_blog_content_layout', 'flexia_blog_content_layout_standard' );
$flexia_blog_show 	= flexia_get_option( 'show_blog_header' );
?>

	<?php if ($flexia_blog_show) : ?>

		<header class="page-header blog-header" <?php if ( has_header_image() ) { ?> style="background-image: url('<?php echo( get_header_image() ); ?>'); <?php } ?>">
			<div class="header-inner">
				<div class="header-content">					

					<?php if( get_theme_mod('show_blog_logo') == 'blog_logo_image' ) :  ?>

						<?php if( get_theme_mod('blog_logo') !== '' ) :  ?>

							<img class="flexia-blog-logo" src="<?php echo esc_url(get_theme_mod('blog_logo')); ?>">

						<?php endif; ?>

					<?php endif; ?>

					<h2 class="page-title"><?php

						if( $blog_title !== '' ) :

							echo esc_html($blog_title);

						else:

							bloginfo( 'name' );

						endif;?></h2>

					<h3 class="blog-desc"><?php

						if( $blog_desc !== '' ) :

							echo esc_html($blog_desc);

						else:

							echo wp_kses_post( get_bloginfo ( 'description' ) );


						endif;?></h3>
				</div>

				<?php if( $scroll_bottom_arrow == false ) :

					echo '<a href="#content" class="scroll-down"></a>';

				endif; ?>
			</div>
			<div class="header-overlay"></div>
		</header>

	<?php endif; ?>

	<div id="content" class="site-content">
		<div class="flexia-wrapper flexia-container max width">

			<div id="primary" class="content-area">

				<?php if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>

				<?php
				endif; ?>

				<main id="main" class="site-main flexia-container">
				<?php

					if ( have_posts() ) :
						if( ! class_exists( 'Flexia_Pro' ) || ! class_exists( 'Flexia_Core' ) || $flexia_blog_layout == 'flexia_blog_content_layout_standard' ) :

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'framework/views/template-parts/content', get_post_format() );

							endwhile;


							get_template_part( 'framework/views/template-parts/content', 'pagination' );
							elseif( $flexia_blog_layout == 'flexia_blog_content_layout_grid' || $flexia_blog_layout == 'flexia_blog_content_layout_masonry' ):
								/**
								 * A flexia hook to add blog layouts
								 *
								 * @since   v1.0.1
								 */
								do_action( 'flexia_blog_layout' );
								get_template_part( 'framework/views/template-parts/content', 'pagination' );
							endif;

					else :

						get_template_part( 'framework/views/template-parts/content', 'none' );

					endif;

				?>

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div><!-- #flexia-wrapper -->
	</div><!-- #content -->
</div><!-- #page -->

<?php
get_footer();
