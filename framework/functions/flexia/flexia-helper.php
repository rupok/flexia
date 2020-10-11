<?php
/**
 *
 * @package Flexia
 */


//CSS replace "Dash" with "Space"
if( ! function_exists( 'flexia_replae_dash_with_space' ) ) : 

	function flexia_replae_dash_with_space($value){
        $value = ucwords(str_replace("-"," ",$value));
        
		return $value;
	}

endif;


//Flexia Color Hex Value to RGBA Value
if( ! function_exists( 'flexia_hex2rgba' ) ) : 

    function flexia_hex2rgba($color, $opacity) {
 
        $default = 'rgb(255,255,255,0)';
    
        //Return default if no color provided
        if(empty($color))
            return $default; 
    
        //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if(empty($opacity)){
            $opacity = 0;
            if(abs($opacity) > 1) {
                $opacity = 1.0;
            }
        }
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';

        //Return rgb(a) color string
        return $output;
    }
endif;

//Custom Pagination Function for Flexia Blog
function flexia_pagination( $paged, $max_page = '' ) {
    echo '<div class="post-pagination-container">';
    echo '<ul class="post-pagination">';

    global $wp_query;
    $big = 999999999; // need an unlikely integer
    if( ! $paged )
        $paged = get_query_var('paged');
    if( ! $max_page )
        $max_page = $wp_query->max_num_pages;

    $links =  paginate_links( array(
        'base'       => str_replace($big, '%#%', esc_url(get_pagenum_link( $big ))),
        'format'     => '?paged=%#%',
        'current'    => max( 1, $paged ),
        'total'      => $max_page,
        'type'       => 'array',
        'prev_next' => true,
        'prev_text' => '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve"> <g> <g> <path d="M101.5,245.9c0,7.2,2.8,14,7.8,19.1l219.2,219.1c5.1,5.1,11.8,7.9,19,7.9s14-2.8,19-7.9l16.1-16.1 c5.1-5.1,7.9-11.8,7.9-19c0-7.2-2.8-14-7.9-19L198.6,245.9L382.5,62c10.5-10.5,10.5-27.6,0-38.1L366.3,7.9 c-5.1-5.1-11.8-7.9-19-7.9c-7.2,0-14,2.8-19,7.9L109.3,226.8C104.3,231.9,101.5,238.7,101.5,245.9z"/> </g> </g> </svg>',
        "next_text" => '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve"> <g> <g> <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12 c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028 c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265 c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>',
        'mid_size' => 3
    ) );

    if ($links) {
        foreach ($links as $link) {
            if (strpos($link, "current") !== false)
                echo '<li class="active"><a>' . $link . "</a></li>\n";
            else
                echo '<li>' . $link . "</li>\n";

        }
    }

    echo '<div/>';
    echo '<ul/>';
}

//Flexia Admin Page for few theme settings
function flexia_dashboard_page() {
    echo '<div class="flexia-core-admin-wrapper">
        <div class="flexia-core-admin-header">
            <div class="flexia-logo-inline">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80.27 88.23"><defs><style>.flexia-logo-inline{fill:#4d4d4f;}</style></defs><title>Flexia Logo</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="flexia-logo-inline" d="M70.55,14.31,44.24,1.41a13.82,13.82,0,0,0-13.79.94L6.12,18.68A13.82,13.82,0,0,0,0,31.1L2,60.33A13.82,13.82,0,0,0,9.72,71.81L43.2,88.23l.07,0L14.74,45.69a9.66,9.66,0,0,1,2.64-13.41L37.32,18.9a6.69,6.69,0,0,1,10.37,4.67h0A6.69,6.69,0,0,1,44.78,30L28.28,41.09l6.3,9.38.27.41L42.31,62,43,63,54.73,80.48l19.42-13A13.82,13.82,0,0,0,80.24,55l-2-29.24A13.82,13.82,0,0,0,70.55,14.31Zm-19,41.48-5.46,3.66L38.63,48.34l5.46-3.66a6.69,6.69,0,0,1,10.37,4.67h0A6.69,6.69,0,0,1,51.55,55.79Z"/></g></g></svg>
            </div>
            <h2 class="title">Flexia Settings</h2>
        </div>
        <div class="flexia-core-content">
            <div class="flexia-core-content-inner">
                <div class="flexia-core-admin-block-large">
                    <img class="flexia-preview-img" src="' . get_template_directory_uri() . '/admin/img/flexia-banner.jpg" >';
                    do_action('flexia_pro_license_activation');
                echo '</div>
                <div class="flexia-core-admin-block-wrapper">
                    <div class="flexia-core-admin-block flexia-core-admin-block-customize">
                        <header class="flexia-core-admin-block-header">
                            <div class="flexia-core-admin-block-header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 45.91"><defs><style>.flexia-icon-customize{fill:#e74c3c;}</style></defs><title>Customization</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="flexia-icon-customize" d="M23,15.6q11.21,0,22.42,0c.44,0,.56.13.56.56q0,13.75,0,27.5a2,2,0,0,1-2.26,2.25H2.31A2,2,0,0,1,0,43.61Q0,29.91,0,16.2c0-.6,0-.6.59-.6ZM19.08,37.22c.48.2.91.41,1.36.54a.58.58,0,0,1,.49.58A1.9,1.9,0,0,0,22.64,40a1.77,1.77,0,0,0,2-1.25c.13-.86.64-1.09,1.29-1.31a1.18,1.18,0,0,0,.29-.14.55.55,0,0,1,.76.06,1.81,1.81,0,0,0,2.29,0,1.69,1.69,0,0,0,.66-2.17,1.66,1.66,0,0,1,0-2,.28.28,0,0,0,0-.08c.07-.47.31-.66.81-.72a1.88,1.88,0,0,0,1.62-1.73,1.72,1.72,0,0,0-1.27-1.84c-.83-.11-1.06-.6-1.26-1.22a1.26,1.26,0,0,0-.15-.33.58.58,0,0,1,.08-.8,1.79,1.79,0,0,0,0-2.25,1.72,1.72,0,0,0-2.22-.65,1.57,1.57,0,0,1-1.87,0,1.19,1.19,0,0,0-.39-.13c-.31-.05-.4-.22-.43-.53a1.92,1.92,0,0,0-1.69-1.72,1.77,1.77,0,0,0-2,1.27c-.12.83-.61,1-1.23,1.26a1.2,1.2,0,0,0-.29.14.63.63,0,0,1-.88-.06,1.8,1.8,0,0,0-2.25,0,1.71,1.71,0,0,0-.63,2.18,1.57,1.57,0,0,1,0,1.84,1,1,0,0,0-.1.3c-.05.32-.21.43-.55.46a1.91,1.91,0,0,0-1.7,1.65,1.76,1.76,0,0,0,1.24,2,1.57,1.57,0,0,1,1.31,1.29,1.14,1.14,0,0,0,.14.29.56.56,0,0,1-.06.76,1.83,1.83,0,0,0,.23,2.56A1.94,1.94,0,0,0,19.08,37.22Z"/><path class="flexia-icon-customize" d="M22.94,11.8H.61c-.61,0-.61,0-.61-.63Q0,6.73,0,2.29A2,2,0,0,1,2.31,0H43.59a2,2,0,0,1,2.3,2.3c0,3,0,6,0,9,0,.42-.12.54-.54.54ZM17.79,3.91a1.94,1.94,0,0,0-.07,3.89,2,2,0,0,0,2-1.92A2,2,0,0,0,17.79,3.91ZM6.46,5.81a1.94,1.94,0,1,0,2-1.9A1.94,1.94,0,0,0,6.46,5.81Z"/><path class="flexia-icon-customize" d="M22.95,27a3.7,3.7,0,1,1-3.71,3.73A3.7,3.7,0,0,1,22.95,27Z"/></g></g><head xmlns=""/></svg>
                            </div>
                            <h4 class="flexia-core-admin-title">Customize Flexia</h4>
                        </header>
                        <div class="flexia-core-admin-block-content">
                            <p>Flexia got lots of customization options to achieve almost anything you want. Take a minute to explore the power of Flexia.</p>
                            <a href="' . esc_url(admin_url('customize.php')) . '" class="customize-flexia button button-primary" target="_blank">Customize Flexia</a>
                        </div>
                    </div>
                    <div class="flexia-core-admin-block flexia-core-admin-block-docs">
                        <header class="flexia-core-admin-block-header">
                            <div class="flexia-core-admin-block-header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 46"><defs><style>.cls-1{fill:#1abc9c;}</style></defs><title>Flexia Documentation</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-1" x="15.84" y="17.13" width="14.32" height="1.59"/><rect class="cls-1" x="15.84" y="24.19" width="14.32" height="1.59"/><rect class="cls-1" x="15.84" y="20.66" width="14.32" height="1.59"/><path class="cls-1" d="M23,0A23,23,0,1,0,46,23,23,23,0,0,0,23,0Zm5.47,9.9,4.83,4.4H28.47Zm-2.29,23v3.2H15.49a2.79,2.79,0,0,1-2.79-2.79V12.69A2.79,2.79,0,0,1,15.49,9.9H27.28v5.59h6V27.72H15.84v1.59H29.78v1.94H15.84v1.59H26.19Zm11.29,2.52H33.88V39H31.37V35.42H27.78V32.9h3.59V29.31h2.52V32.9h3.59Z"/></g></g><head xmlns=""/></svg>
                            </div>
                            <h4 class="flexia-core-admin-title">Documentation</h4>
                        </header>
                        <div class="flexia-core-admin-block-content">
                            <p>Get started by spending some time with the documentation to get familiar with Flexia. Build awesome websites for you or your clients with ease.</a></p>
                            <a href="https://flexia.pro/docs" class="flexia-docs-btn button button-primary" target="_blank">Documentation</a>
                        </div>
                    </div>
                    <div class="flexia-core-admin-block flexia-core-admin-block-contribution">
                        <header class="flexia-core-admin-block-header">
                            <div class="flexia-core-admin-block-header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 45.69"><defs><style>.flexia-icon-bug{fill:#9b59b6;}</style></defs><title>Bugs</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="flexia-icon-bug" d="M18.87,28.37,9.16,38.08A8.66,8.66,0,0,0,14.49,40h4.38a9.55,9.55,0,0,0,2.28-.38v5.14a1,1,0,0,0,1.9,0v-5.9A4.83,4.83,0,0,0,25,37.31l.76-.76a.92.92,0,0,0,0-1.33Z"/><path class="flexia-icon-bug" d="M11.64,21.13c-.19-.19-.57-.38-.76-.19H9c-.38,0-.57,0-.76.38L7.07,23H1.17a1,1,0,1,0,0,1.9H6.31a9.56,9.56,0,0,0-.38,2.28V31.6a8.66,8.66,0,0,0,1.9,5.33l9.71-9.71Z"/><path class="flexia-icon-bug" d="M24.39,14.47c.19.19.38.19.76.19a.7.7,0,0,0,.57-.19.92.92,0,0,0,.38-1.14,11.08,11.08,0,0,1-1-3,.87.87,0,0,0-1-.76H22.3a1,1,0,0,0-.76.38,1.14,1.14,0,0,0-.19.76,2.35,2.35,0,0,0,.76,1.52Z"/><path class="flexia-icon-bug" d="M35.81,28.56h3.43a1,1,0,0,0,0-1.9H33.91L20.77,13.52A5.2,5.2,0,0,1,19.25,9.9V6.66a.9.9,0,0,0-1-1h-.19A13.52,13.52,0,0,0,16.21,3,9.12,9.12,0,0,0,9.54,0a9.71,9.71,0,0,0-5.9,2.09,1.44,1.44,0,0,0-.38.76,1,1,0,0,0,.38.76L9.54,7a5.39,5.39,0,0,1-2.86,4.19l-5.14-3a.85.85,0,0,0-1,0c-.38.19-.57.38-.57.76a8.9,8.9,0,0,0,2.67,7,9.53,9.53,0,0,0,6.85,3,4.1,4.1,0,0,0,2.09-.38L26.87,33.89,37.15,44.17a5.2,5.2,0,0,0,3.62,1.52,5,5,0,0,0,4.95-4.95,5.2,5.2,0,0,0-1.52-3.62Z"/><path class="flexia-icon-bug" d="M34.86,24.75c.19.19.38.19.76.19H36a1,1,0,0,0,.57-1V21.51c0-.38-.38-1-.76-1a7,7,0,0,1-3.43-.76.92.92,0,0,0-1.14.38c-.19.38-.19,1,.19,1.14Z"/><path class="flexia-icon-bug" d="M45.71,9.9c-1.52-1.52-5.14-.38-7,.57L35.81,7.62c.76-2.09,1.9-5.71.57-7a.92.92,0,0,0-1.33,0,.92.92,0,0,0,0,1.33c.38.38,0,2.67-1,5.14L28,8a.87.87,0,0,0-.76,1C26.87,14.28,31.63,19,37.34,19c.38,0,1-.38,1-.76l1-6.09c2.47-1,4.76-1.33,5.14-1A.94.94,0,1,0,45.71,9.9Z"/></g></g><head xmlns=""/></svg>
                            </div>
                            <h4 class="flexia-core-admin-title">Contribute to Flexia</h4>
                        </header>
                        <div class="flexia-core-admin-block-content">
                            <p>Flexia is a free theme and always will be. You can contribute to make it better reporting bugs, creating issues, pull requests at <a href="https://github.com/rupok/flexia" target="_blank">Github.</a></p>
                            <a href="https://github.com/rupok/flexia/issues/new" class="flexia-report-bug button button-primary" target="_blank">Report a bug</a>
                        </div>
                    </div>
                    <div class="flexia-core-admin-block flexia-core-admin-block-support">
                        <header class="flexia-core-admin-block-header">
                            <div class="flexia-core-admin-block-header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.22 42.58"><defs><style>.flexia-icon-support{fill:#6c75ff;}</style></defs><title>Flexia Support</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="flexia-icon-support" d="M6.36,29.34l1.09-1.09h8l-5.08-9.18-3.76.76a2.64,2.64,0,0,0-2,1.91L.09,36.31a2.64,2.64,0,0,0,2.55,3.31H6.36V29.34Z"/><path class="flexia-icon-support" d="M32.13,36.31,27.67,21.75a2.64,2.64,0,0,0-2.06-1.92l-3.74-.71-5.06,9.13h8.56l1.09,1.09V39.62h3.12a2.64,2.64,0,0,0,2.55-3.31Z"/><polygon class="flexia-icon-support" points="8.54 39.62 8.24 39.62 8.24 39.62 23.98 39.62 23.98 39.62 24.28 39.62 24.28 30.43 8.54 30.43 8.54 39.62"/><rect class="flexia-icon-support" x="4.19" y="40.61" width="23.83" height="1.97"/><path class="flexia-icon-support" d="M7.62,12.65c0,.09.1.22.15.36a3.58,3.58,0,0,0,.68,1.22c1.21,3.94,4.33,6.68,7.64,6.67s6.38-2.77,7.55-6.72A3.61,3.61,0,0,0,24.31,13c.06-.14.11-.27.15-.36a2,2,0,0,0-.33-2.41V10.1C24.12,5.2,23.48,0,16,0S7.92,5,7.94,10.15c0,0,0,.06,0,.09A2,2,0,0,0,7.62,12.65Zm1-1.58h0A.55.55,0,0,0,9,10.83l1.3.2a.28.28,0,0,0,.3-.16L11.39,9a35.31,35.31,0,0,0,7.2,1,7.76,7.76,0,0,0,2.11-.25L21.23,11a.27.27,0,0,0,.25.17h.07l1.51-.43a.56.56,0,0,0,.31.3h0c.23.11.3.6.06,1.09-.06.12-.12.27-.18.43a4.18,4.18,0,0,1-.4.82.55.55,0,0,0-.26.33c-1,3.58-3.68,6.08-6.54,6.09s-5.6-2.48-6.63-6a.55.55,0,0,0-.26-.33,4.3,4.3,0,0,1-.41-.82c-.06-.15-.13-.3-.18-.42C8.37,11.68,8.44,11.19,8.67,11.08Z"/></g></g><head xmlns=""/></svg>
                            </div>
                            <h4 class="flexia-core-admin-title">Need Help?</h4>
                        </header>
                        <div class="flexia-core-admin-block-content">
                            <p>Stuck with something? Get help from the community on <a href="https://wordpress.org/support/theme/flexia" target="_blank">WordPress Support Forum.</a> In case of emergency, initiate a live chat at <a href="https://wpdeveloper.net" target="_blank">WPDeveloper.net.</a></p>
                            <a href="https://wordpress.org/support/theme/flexia" class="flexia-support-btn button button-primary" target="_blank">Get Community Support</a>
                        </div>
                    </div>
                    <div class="flexia-core-admin-block flexia-core-admin-block-review">
                        <header class="flexia-core-admin-block-header">
                            <div class="flexia-core-admin-block-header-icon">
                                <svg style="enable-background:new 0 0 48 48;" version="1.1" viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Icons"><g><g id="Icons_7_"><g><path d="M35.72935,25.74662l0.8357-0.8271c1.611-1.611,2.4122-3.7475,2.4122-5.8668      c0-2.1279-0.8012-4.2558-2.4122-5.8668c-3.2221-3.2221-8.5031-3.2221-11.7337,0l-0.8271,0.8356l-0.8356-0.8356      c-3.222-3.2221-8.5031-3.2221-11.7251,0c-1.6196,1.611-2.4208,3.7389-2.4208,5.8668c0,2.1193,0.8012,4.2558,2.4208,5.8668      l0.8271,0.8271l11.3076,11.3077c0.2353,0.2352,0.6167,0.2351,0.8519-0.0002L35.72935,25.74662" style="fill:#EF4B53;"/></g></g><path d="M17.80325,12.24382c0,0-6.9318-0.5491-7.6524,7.3092c0,0,1.4413-5.765,7.8583-5.4905    c0,0,1.5941,0.1605,1.5901-0.8317C19.59495,12.14722,17.80325,12.24382,17.80325,12.24382z" style="fill:#F47682;"/></g></g></svg>
                            </div>
                            <h4 class="flexia-core-admin-title">Show your Love</h4>
                        </header>
                        <div class="flexia-core-admin-block-content">
                            <p>We love to have you in Flexia family. We are making it more awesome everyday. Take your 2 minutes to review the theme and spread the love to encourage us to keep it going.</p>

                            <a href="https://wordpress.org/support/theme/flexia/reviews/#new-post" class="review-flexia button button-primary" target="_blank">Leave a Review</a>
                        </div>
                    </div>
                </div>';

                do_action('flexia_core_after_admin_helper_box');

            echo '</div>
            <div class="flexia-core-sidebar">
                <div class="flexia-core-sidebar-block">';
                if (class_exists('Flexia_Pro')) {
                    echo '<div class="flexia-admin-sidebar-logo flexia-pro-logo">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 110.09 117.46"><defs><style>.flexia-pro-logo-shape{fill:#ee3560;}.flexia-pro-badge{fill:#124c9c;}.flexia-pro-logo-border{fill:#124c9c;}.flexia-pro-text{fill:#fff;}</style></defs><title>Flexia Pro Logo</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="flexia-pro-logo-shape" d="M90,48.67c-.75.06-1.5.1-2.26.1A26.43,26.43,0,0,1,61.34,23L50.78,17.81a15.87,15.87,0,0,0-15.83,1.07L7,37.64A15.87,15.87,0,0,0,0,51.89L2.31,85.45a15.87,15.87,0,0,0,8.85,13.17l38.43,18.84.08-.06L16.92,68.64a11.09,11.09,0,0,1,3-15.39L42.83,37.88a7.68,7.68,0,0,1,11.9,5.36h0a7.68,7.68,0,0,1-3.33,7.4L32.46,63.36l7.23,10.76.31.47,8.57,12.76.76,1.13,13.5,20.1,22.29-15a15.87,15.87,0,0,0,7-14.25ZM59.17,80.23l-6.26,4.2L44.34,71.67l6.26-4.2a7.68,7.68,0,1,1,8.57,12.76Z"/><circle class="flexia-pro-badge" cx="87.76" cy="22.33" r="22.33"/><path class="flexia-pro-logo-border" d="M87.76,2.5A19.83,19.83,0,1,1,67.93,22.33,19.86,19.86,0,0,1,87.76,2.5m0-2.5a22.33,22.33,0,1,0,22.33,22.33A22.33,22.33,0,0,0,87.76,0Z"/><path class="flexia-pro-text" d="M83.39,20.24a3.29,3.29,0,0,1-1.08,2.66,4.64,4.64,0,0,1-3.09.92h-1v3.83H76V16.88H79.4a4.57,4.57,0,0,1,3,.84A3.07,3.07,0,0,1,83.39,20.24Zm-5.15,1.71H79a2.49,2.49,0,0,0,1.57-.42,1.45,1.45,0,0,0,.52-1.21,1.49,1.49,0,0,0-.44-1.18,2.05,2.05,0,0,0-1.37-.38h-1Z"/><path class="flexia-pro-text" d="M89.83,19.26a3.59,3.59,0,0,1,.76.07l-.17,2.1a2.58,2.58,0,0,0-.66-.07,2.38,2.38,0,0,0-1.67.55,2,2,0,0,0-.6,1.54v4.19H85.24V19.41h1.7l.33,1.38h.11a3.1,3.1,0,0,1,1-1.11A2.55,2.55,0,0,1,89.83,19.26Z"/><path class="flexia-pro-text" d="M99.56,23.51a4.42,4.42,0,0,1-1.06,3.14,3.84,3.84,0,0,1-2.95,1.13,4.13,4.13,0,0,1-2.09-.52,3.45,3.45,0,0,1-1.39-1.49,5,5,0,0,1-.49-2.26,4.4,4.4,0,0,1,1.05-3.13,3.86,3.86,0,0,1,3-1.12,4.14,4.14,0,0,1,2.09.52,3.43,3.43,0,0,1,1.39,1.48A5,5,0,0,1,99.56,23.51Zm-5.69,0a3.45,3.45,0,0,0,.4,1.85,1.43,1.43,0,0,0,1.3.63,1.41,1.41,0,0,0,1.29-.62,3.5,3.5,0,0,0,.39-1.85,3.39,3.39,0,0,0-.4-1.83,1.69,1.69,0,0,0-2.6,0A3.4,3.4,0,0,0,93.87,23.51Z"/></g></g><head xmlns=""/></svg>
                    </div>
                    <div class="flexia-admin-sidebar-logo-text">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 207.82 45.6"><defs><style>.flexia-logo-text{fill:#4d4d4f;}</style></defs><title>Flexia logo text</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="flexia-logo-text" d="M11.3,29.15V45H.5V.56H2.79V42.74H9V26.86H23.88v-2.1H9.08V22.48H26.16v6.67ZM7,2.85V41H4.76V.56H29.28v10.8H13.39V9.08H27V2.85ZM26.16,18.22v2.35H9V4.69H25V7H11.3V18.22Z"/><path class="flexia-logo-text" d="M60.4,34.36V45H34.92V.5h6.54V40.84H39.12v-38H37.21v40h20.9v-6.1H47.76V34.36Zm-4.32,4.13v2.35H43.56V.5h2.29v38Z"/><path class="flexia-logo-text" d="M94.12,34.1V45H65.22V.69h2.29V42.74H91.84V36.39H73.92v-6.1h2.29V34.1Zm-7.5-12.77v2.29H69.54V.69H93.8V11.55H78.56V9.27h13V3H71.83V21.34Zm3,17.15v2.29H69.54V25.65H88.85V19.3H73.92V4.88H89.29V7.17H76.21V17H91.14V27.94H71.83V38.49Z"/><path class="flexia-logo-text" d="M132,41.28h-2.73l-9.4-14.74L134.9,2.91h-2.29L105.68,45l-7.56.06,14.29-22.55L98.44.63h2.73l14,21.85L102.31,42.74h2.16L131.4.63h7.69L122.51,26.54ZM116.29,20.7,103.14.56H111l6.61,10.29L116.29,13,109.74,2.85h-2.41l9,13.66,2.41-3.75.06-.13L126.39.56h2.73ZM126.7,45l-8.07-12.39-8,12.39H107.9l10.67-16.58L128,42.74h7.24l-10.35-16,1.4-2.16.19.32,13,20.14Z"/><path class="flexia-logo-text" d="M158.65.56V45h-11V.56h6.67V40.77H152V2.85h-2.1V42.74h6.42V.56Z"/><path class="flexia-logo-text" d="M203.43,42.74l-17.66-40h-1.52l-17.6,40h7.56l2-5h13.09l1,2.16H177.64L175.48,45H163.09L183,.56H187l20,44.4L195.36,45l-4.07-9.21-16.58-.06-2.22,5.34h-2.8l3.24-7.43h19.69l4.07,9.08ZM180.18,28.07,185,16.44l7,15.44H173.57L185,6.22,200.64,41H198l-13-29.6-7.75,18.49H188.5L185,22.29l-2.35,5.78Z"/></g></g></svg>
                    </div>
                    <div class="flexia-admin-sidebar-cta">
                        ' . sprintf(__('<a href="%s" target="_blank">Manage License</a>', 'flexia'), 'https://wpdeveloper.net/account/') . '
                    </div>';
                } else {
                    echo '<div class="flexia-admin-sidebar-logo">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80.27 88.23"><defs><style>.cls-1{fill:#ee3560;}</style></defs><title>Flexia Logo</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M70.55,14.31,44.24,1.41a13.82,13.82,0,0,0-13.79.94L6.12,18.68A13.82,13.82,0,0,0,0,31.1L2,60.33A13.82,13.82,0,0,0,9.72,71.81L43.2,88.23l.07,0L14.74,45.69a9.66,9.66,0,0,1,2.64-13.41L37.32,18.9a6.69,6.69,0,0,1,10.37,4.67h0A6.69,6.69,0,0,1,44.78,30L28.28,41.09l6.3,9.38.27.41L42.31,62,43,63,54.73,80.48l19.42-13A13.82,13.82,0,0,0,80.24,55l-2-29.24A13.82,13.82,0,0,0,70.55,14.31Zm-19,41.48-5.46,3.66L38.63,48.34l5.46-3.66a6.69,6.69,0,0,1,10.37,4.67h0A6.69,6.69,0,0,1,51.55,55.79Z"/></g></g></svg>
                    </div>
                    <div class="flexia-admin-sidebar-logo-text">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 207.82 45.6"><defs><style>.flexia-logo-text{fill:#4d4d4f;}</style></defs><title>Flexia logo text</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="flexia-logo-text" d="M11.3,29.15V45H.5V.56H2.79V42.74H9V26.86H23.88v-2.1H9.08V22.48H26.16v6.67ZM7,2.85V41H4.76V.56H29.28v10.8H13.39V9.08H27V2.85ZM26.16,18.22v2.35H9V4.69H25V7H11.3V18.22Z"/><path class="flexia-logo-text" d="M60.4,34.36V45H34.92V.5h6.54V40.84H39.12v-38H37.21v40h20.9v-6.1H47.76V34.36Zm-4.32,4.13v2.35H43.56V.5h2.29v38Z"/><path class="flexia-logo-text" d="M94.12,34.1V45H65.22V.69h2.29V42.74H91.84V36.39H73.92v-6.1h2.29V34.1Zm-7.5-12.77v2.29H69.54V.69H93.8V11.55H78.56V9.27h13V3H71.83V21.34Zm3,17.15v2.29H69.54V25.65H88.85V19.3H73.92V4.88H89.29V7.17H76.21V17H91.14V27.94H71.83V38.49Z"/><path class="flexia-logo-text" d="M132,41.28h-2.73l-9.4-14.74L134.9,2.91h-2.29L105.68,45l-7.56.06,14.29-22.55L98.44.63h2.73l14,21.85L102.31,42.74h2.16L131.4.63h7.69L122.51,26.54ZM116.29,20.7,103.14.56H111l6.61,10.29L116.29,13,109.74,2.85h-2.41l9,13.66,2.41-3.75.06-.13L126.39.56h2.73ZM126.7,45l-8.07-12.39-8,12.39H107.9l10.67-16.58L128,42.74h7.24l-10.35-16,1.4-2.16.19.32,13,20.14Z"/><path class="flexia-logo-text" d="M158.65.56V45h-11V.56h6.67V40.77H152V2.85h-2.1V42.74h6.42V.56Z"/><path class="flexia-logo-text" d="M203.43,42.74l-17.66-40h-1.52l-17.6,40h7.56l2-5h13.09l1,2.16H177.64L175.48,45H163.09L183,.56H187l20,44.4L195.36,45l-4.07-9.21-16.58-.06-2.22,5.34h-2.8l3.24-7.43h19.69l4.07,9.08ZM180.18,28.07,185,16.44l7,15.44H173.57L185,6.22,200.64,41H198l-13-29.6-7.75,18.49H188.5L185,22.29l-2.35,5.78Z"/></g></g></svg>
                    </div>
                    <div class="flexia-admin-sidebar-cta">
                        ' . sprintf(__('<a href="%s" target="_blank">Upgrade to Pro</a>', 'flexia'), 'https://flexia.pro/pricing') . '
                    </div>';
                }
                echo '</div>
            </div>
        </div>
    </div>';
}