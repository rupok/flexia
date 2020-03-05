<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Flexia
 */

get_header(); ?>
	
	<header class="page-header error-header">
        <div class="header-inner">
            <div class="header-content">
                <h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'flexia' ); ?></h2>
            </div>
        </div>
    </header>

	<div id="content" class="site-content">
		<div class="flexia-wrapper flexia-container">
			<div id="primary" class="content-area">
				<main id="main" class="site-main flexia-container">
					<section class="error-404 not-found">
						<p><?php esc_html_e( 'Bummer! The page you are looking for is no longer here, or never existed in the first place. You can try searching for what you are looking for using the form below. If that still doesn\'t provide the results you are looking for, you can always start over from the home page.', 'flexia' ); ?></p>

						<?php get_search_form(); ?>
					</section>
				</main><!-- #main -->
			</div><!-- #primary -->

		</div><!-- #flexia-wrapper -->
	</div><!-- #content --> 
</div><!-- #page -->

<?php
get_footer();
