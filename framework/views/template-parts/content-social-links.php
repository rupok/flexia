<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Social Media Links
 *
 * @link 
 * 
 * @package Flexia
 */

?>

<?php
$alignment = flexia_get_option('flexia_header_social_alignment');
$tab = flexia_get_option('flexia_header_social_open_tab');

$media_links = array();

array_push($media_links, array("icon" => "fa-facebook", "title" => "Facebook", "link" => flexia_get_option('flexia_header_social_link_facebook')));
array_push($media_links, array("icon" => "fa-instagram", "title" => "Instagram", "link" => flexia_get_option('flexia_header_social_link_instagram')));
array_push($media_links, array("icon" => "fa-twitter", "title" => "Twitter", "link" => flexia_get_option('flexia_header_social_link_twitter')));
array_push($media_links, array("icon" => "fa-linkedin", "title" => "LinkedIn", "link" => flexia_get_option('flexia_header_social_link_linkedin')));
array_push($media_links, array("icon" => "fa-youtube", "title" => "YouTube", "link" => flexia_get_option('flexia_header_social_link_youtube')));
array_push($media_links, array("icon" => "fa-pinterest", "title" => "Pinterest", "link" => flexia_get_option('flexia_header_social_link_pinterest')));
array_push($media_links, array("icon" => "fa-reddit", "title" => "Reddit", "link" => flexia_get_option('flexia_header_social_link_reddit')));
array_push($media_links, array("icon" => "fa-rss", "title" => "RSS Feed", "link" => flexia_get_option('flexia_header_social_link_rss')));

?>

<ul class="flexia-social-links">
    <?php 
        $html = "";
        if ( !empty($media_links) && is_array($media_links) ) {
            foreach ($media_links as $link) {
                if ( !empty($link['link']) ) {
                    $html .= '<li>';
                    $html .= '<a href="'. $link['link'] .'" title="'. $link['title'] .'" target="'. $tab .'">';
                    $html .= '<i class="fa '. $link['icon'] .'"></i>';
                    $html .= '</a>';
                    $html .= '</li>';
                }
            }
            echo $html;
        }
    ?>
</ul>