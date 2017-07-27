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

	$icon_class = get_theme_mod('blog_icon_class');

?>

<div id="page" class="site">

	<?php get_template_part( 'framework/views/template-parts/content', 'masthead' ); ?>
	
	<header class="page-header blog-header" style="background-image: url('<?php echo esc_attr(header_image()); ?>');">
        <div class="header-inner">
            <div class="header-content">

            	<?php if( get_theme_mod('show_blog_logo') == 'blog_icon' ) :  ?>

               		<span><i class="fa fa-3x <?php echo $icon_class ?>"></i></span>

               	<?php elseif( get_theme_mod('show_blog_logo') == 'blog_logo_image' ) :  ?>

               		<img class="flexia-blog-logo" src="<?php echo get_theme_mod('blog_logo'); ?>">

                <?php endif; ?>

                <h2 class="page-title"><?php 

                	if( get_theme_mod('blog_title') !== '' ) : 

                		echo get_theme_mod('blog_title');

                	else:

                		bloginfo( 'name' ); 

                	endif;?></h2>

                <p class="blog-desc"><?php 

                	if( get_theme_mod('blog_desc') !== '' ) : 

                		echo get_theme_mod('blog_desc');

                	else:

                		printf( esc_html__( '%s', 'flexia' ), get_bloginfo ( 'description' ) );
                			
                	
                	endif;?></p>
            </div>

            <?php if( get_theme_mod('scroll_bottom_arrow') == true ) : 

           		echo '<a href="#content" class="scroll-down"></a>';

            endif; ?>
        </div>
    </header>

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
