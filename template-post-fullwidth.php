<?php
/*
 * Template Name: No Container | Header, Footer
 * Template Post Type: post
 */
  
get_header(); ?>

<div id="content" class="site-content">
    <div class="flexia-wrapper flexia-blank-container">
        <div id="primary" class="content-area">
            <main id="main" class="site-main flexia-container">

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