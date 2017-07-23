<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexia
 */

get_header(); ?>
<div id="page" class="site">

	<?php get_template_part( 'framework/views/template-parts/content', 'masthead' ); ?>
	
	<header class="page-header archive-header" style="background: url('<?php echo header_image(); ?>') no-repeat fixed center center / cover;">
        <div class="header-inner">
            <div class="header-content">
            	<div class="author-avatar">
            		<?php echo get_avatar( get_the_author_meta( 'ID' ), 128 ); ?> 
            	</div>
				<h2 class="page-title"><?php the_author(); ?> </h2>
                <?php the_archive_description( '<p class="author-bio">', '</p>' ); ?>
            </div>
        </div>
    </header>

	<div id="content" class="site-content">
		<div class="flexia-wrapper flexia-container">

			<div id="primary" class="content-area">
				<main id="main" class="site-main flexia-container">

				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>

					<?php
					endif;

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

				else :

					get_template_part( 'framework/views/template-parts/content', 'none' );

				endif; ?>

				
				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div><!-- #flexia-wrapper -->
	</div><!-- #content --> 
</div><!-- #page -->

<?php
get_template_part( 'framework/views/template-parts/content', 'footer' );
get_footer();
