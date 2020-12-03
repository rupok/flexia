<?php
/*
 * Template Name: Gutenberg Template
 * Template Post Type: post
 */
  
get_header(); ?>

<div id="content" class="site-content">
    <div class="flexia-wrapper flexia-gutenberg-container">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">

            <?php
            while ( have_posts() ) : the_post();

                /**
                 * Flexia hook for Blog Single Content
                 *
                 * @since   v2.1.3
                */
                do_action('flexia_single');
                

            endwhile; // End of the loop.
            ?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- #flexia-wrapper -->
</div><!-- #content -->
</div><!-- #page -->
<?php

get_footer();