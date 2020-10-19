<?php
/**
 * Flexia Function to Assign Templates Parts Through Hooks
 *
 * @package Flexia
 */

//Flexia Header File Include using Hook
if (!function_exists('flexia_add_header')) {
    add_action('flexia_header', 'flexia_add_header');
    function flexia_add_header() {
        $no_footer_template = array(
            'template-blank-container-3.php',
            'template-no-container-2.php',
            'template-no-container-4.php',
            'template-post-no-header-footer-fullwidth.php'
        );
        
        $current_template = basename( get_page_template() ) ;
    
        if ( !in_array($current_template, $no_footer_template) ) {
    
            get_template_part( 'framework/views/template-parts/content', 'masthead' );
    
        }
    }
}

//Flexia Footer File Include using Hook
if (!function_exists('flexia_add_footer')) {
    add_action('flexia_footer', 'flexia_add_footer');
    function flexia_add_footer() {
        $no_footer_template = array(
            'template-blank-container-2.php', 
            'template-blank-container-3.php',
            'template-no-container-3.php',
            'template-no-container-4.php',
            'template-post-no-header-footer-fullwidth.php'
        );
        $current_template = basename( get_page_template() ) ;
    
        if ( !in_array($current_template, $no_footer_template) ) {
    
            get_template_part( 'framework/views/template-parts/content', 'footer' );
    
        }
    }
}

//Flexia Add Hook into Header using Function
if (!function_exists('flexia_page_header')) {
    function flexia_page_header() {
        do_action('flexia_page_header_breadcrumb'); 
    }
}

//Flexia Call To Action File Include using Hook
if (!function_exists('flexia_cta_template')) {
    add_action('flexia_before_footer', 'flexia_cta_template');
    function flexia_cta_template() {
        do_action('flexia_call_to_action_before');

        get_template_part( 'framework/views/template-parts/content', 'cta' );

        do_action('flexia_call_to_action_after');
    }
}

//Flexia Template Parts Single Include using Hook 
function add_single_template() {
    get_template_part( 'framework/views/template-parts/content-single', get_post_format() );
}
add_action('flexia_single', 'add_single_template');


//Function to add blog Header
function flexia_blog_header() {
    $blog_title 			= flexia_get_option('blog_title');
    $blog_desc 				= flexia_get_option('blog_desc');
    $flexia_blog_show 		= flexia_get_option( 'show_blog_header' );
    $flexia_custom_logo_id 	= get_theme_mod( 'custom_logo' );

    if ($flexia_blog_show) : ?>

		<header class="page-header blog-header" <?php if ( has_header_image() ) { ?> style="background-image: url('<?php echo( get_header_image() ); ?>'); <?php } ?>">
			<div class="header-inner">
				<div class="header-content">					

					<?php if( flexia_get_option('show_blog_logo') == 'blog_logo_image' ) :  ?>

						<?php if( flexia_get_option('blog_logo') !== '' ) :  ?>

							<img class="flexia-blog-logo" src="<?php echo esc_url(flexia_get_option('blog_logo')); ?>">

						<?php  else : ?> <!-- If Image is empty, use default Logo -->

							<?php if( $flexia_custom_logo_id !== '' ) :  ?>

								<img class="flexia-blog-logo" src="<?php echo esc_url(wp_get_attachment_image_src( $flexia_custom_logo_id , 'full' )[0]); ?>">

							<?php endif; ?>

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
			</div>
		</header>

	<?php endif;
}
add_action('flexia_blog_header', 'flexia_blog_header', 2);


//Flexia Blog Main Content/ The Loop 
function flexia_blog_main_content() {
    $flexia_blog_layout 	= flexia_get_option( 'flexia_blog_content_layout' );

    echo '<main id="main" class="site-main flexia-container">';    

    if ( have_posts() ) :					

        if ($flexia_blog_layout == 'flexia_blog_content_layout_grid' || $flexia_blog_layout == 'flexia_blog_content_layout_masonry') :

            /**
             * A flexia hook to add blog layouts
             *
             * @since   v1.0.1
             */
            do_action( 'flexia_blog_layout' );

        // Is Layout is Stadard or Not selected
        else : 

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

        endif;						

    else :

        get_template_part( 'framework/views/template-parts/content', 'none' );

    endif;

    wp_reset_query();

    echo '</main>';
}
add_action('flexia_blog_content', 'flexia_blog_main_content', 2);


//Flexia Blog Before Main Content/ The Loop 
function flexia_blog_before_main_content() {
    if ( is_home() && ! is_front_page() ) : ?>
        <header>
            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
        </header>

    <?php endif;
}
add_action('flexia_blog_before_content', 'flexia_blog_before_main_content', 1);

?>