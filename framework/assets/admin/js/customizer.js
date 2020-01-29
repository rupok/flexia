/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

function generateCSS() {
    $.get(object.ajax_url + '?action=generate_css', {
        'security': object.nonce
    }).done(function(response) {
        $('#flexia-dynamic-css').html(response)
    }).fail(function() {
        alert('Failed to load response!')
    })
}

(function($) {
    // Site title and description.
    wp.customize("blogname", function(value) {
        value.bind(function(to) {
            $(".site-title a").text(to);
        });
    });
    wp.customize("blogdescription", function(value) {
        value.bind(function(to) {
            $(".site-description").text(to);
        });
    });

    // Header text color.
    wp.customize("header_textcolor", function(value) {
        value.bind(function(to) {
            if ("blank" === to) {
                $(".site-title, .site-description").css({
                    clip: "rect(1px, 1px, 1px, 1px)",
                    position: "absolute"
                });
            } else {
                $(".site-title, .site-description").css({
                    clip: "auto",
                    position: "relative"
                });
                $(".site-title a, .site-description").css({
                    color: to
                });
            }
        });
    });

    
    /**
     * Defeault Colors from Global Settings
     */

    // Default Text Colors
    wp.customize("default_text_color", function(value) {
        value.bind(function(to) {
            $("body, button, input, select, optgroup, textarea").css(
                "color",
                to
            );
        });
    });

    // Default Heading Colors
    wp.customize("default_heading_color", function(value) {
        value.bind(function(to) {
            $("h1, h2, h3, h4, h5, h6").css(
                "color",
                to
            );
        });
    });

    // Site Link Colors
    wp.customize("site_link_color", function(value) {
        value.bind(function(to) {
            $("a").css(
                "color",
                to
            );
        });
    });

    // Site Link Hover Colors
    wp.customize("site_link_hover_color", function(value) {
        value.bind(function(to) {
            $("a:hover, a:focus, a:active").css(
                "color",
                to
            );
        });
    });

    // Site Background Colors
    wp.customize("site_background_color", function(value) {
        value.bind(function(to) {
            $("body").css(
                "background-color",
                to
            );
        });
    });

    // Site Background Image
    wp.customize("site_background_image", function(value) {
        value.bind(function(to) {
            $("body").css(
                "background-image",
                "url('"+to+"')"
            );
        });
    });

    // Site Background Image Size
    wp.customize("site_background_image_size", function(value) {
        value.bind(function(to) {
            $("body").css(
                "background-size",
                to
            );
        });
    });

    // Site Background Image Position
    wp.customize("site_background_image_position", function(value) {
        value.bind(function(to) {
            $("body").css(
                "background-position",
                to
            );
        });
    });

    // Site Background Image Repeat
    wp.customize("site_background_image_repeat", function(value) {
        value.bind(function(to) {
            $("body").css(
                "background-repeat",
                to
            );
        });
    });



    // Container width
    wp.customize("container_width", function(value) {
        value.bind(function(to) {
            $(".flexia-container.width").css("width", to + "%");
        });
    });

    wp.customize("container_max_width", function(value) {
        value.bind(function(to) {
            $(".flexia-container.max").css("max-width", to + "px");
        });
    });

    // Post Container width
    wp.customize("post_width", function(value) {
        value.bind(function(to) {
            $(".single-post .entry-content-wrapper").css("width", to + "%");
        });
    });

    wp.customize("post_max_width", function(value) {
        value.bind(function(to) {
            $(".single-post .entry-content-wrapper").css(
                "max-width",
                to + "px"
            );
        });
    });

    wp.customize("blog_bg_color", function(value) {
        value.bind(function(to) {
            $("body.blog, body.archive, body.single-post").css(
                "background-color",
                to
            );
        });
    });

    wp.customize("post_content_bg_color", function(value) {
        value.bind(function(to) {
            $("body:not(.single-post) .flexia-wrapper > .content-area").css(
                "background-color",
                to
            );
            $(".entry-content.single-post-entry").css("background-color", to);
        });
    });

    wp.customize("post_meta_bg_color", function(value) {
        value.bind(function(to) {
            $(
                ".single-post .entry-header.single-blog-meta.single-blog-meta-large"
            ).css("background-color", to);
        });
    });

    wp.customize("sidebar_widget_bg_color", function(value) {
        value.bind(function(to) {
            $(".flexia-sidebar .widget").css("background-color", to);
        });
    });

    // Header logo width
    wp.customize("flexia_header_logo_width", function(value) {
        value.bind(function(to) {
            $(".flexia-header-logo").css("width", to + "px");
        });
    });

    // Blog logo width
    wp.customize("blog_logo_width", function(value) {
        value.bind(function(to) {
            $(".header-content .flexia-blog-logo").css("width", to + "px");
        });
    });

    // Page title and font size
    wp.customize("flexia_page_title_bg", function(value) {
        value.bind(function(to) {
            $(
                ".page .entry-header.entry-header-large, .page .entry-header.entry-header-mini"
            ).css("background-color", to);
        });
    });

    wp.customize("flexia_page_title_font_color", function(value) {
        value.bind(function(to) {
            $(".page .entry-header .entry-title").css("color", to);
        });
    });

    wp.customize("flexia_page_title_font_size", function(value) {
        value.bind(function(to) {
            $(".page .entry-header .entry-title").css("font-size", to + "px");
        });
    });

    // Breadcrumbs
    wp.customize("flexia_breadcrumb_font_size", function(value) {
        value.bind(function(to) {
            $(
                ".flexia-breadcrumb .flexia-breadcrumb-item, .flexia-breadcrumb .flexia-breadcrumb-item a, .flexia-breadcrumb .breadcrumb-delimiter"
            ).css("font-size", to + "px");
        });
    });

    wp.customize("flexia_breadcrumb_font_color", function(value) {
        value.bind(function(to) {
            $(
                ".flexia-breadcrumb .flexia-breadcrumb-item, .flexia-breadcrumb .flexia-breadcrumb-item a, .flexia-breadcrumb .breadcrumb-delimiter"
            ).css("color", to);
        });
    });

    wp.customize("flexia_breadcrumb_active_font_color", function(value) {
        value.bind(function(to) {
            $(
                ".flexia-breadcrumb-item.current span, .breadcrumb li a:hover, .breadcrumb li a:focus"
            ).css("color", to);
        });
    });

    // Blog title and font size
    wp.customize("blog_title", function(value) {
        value.bind(function(to) {
            $(".blog-header .header-content > .page-title").text(to);
        });
    });

    wp.customize("blog_title_font_size", function(value) {
        value.bind(function(to) {
            $(".blog-header .header-content > .page-title").css(
                "font-size",
                to + "px"
            );
        });
    });

    // Blog description and font size
    wp.customize("blog_desc", function(value) {
        value.bind(function(to) {
            $(".header-content .blog-desc").text(to);
        });
    });

    wp.customize("blog_desc_font_size", function(value) {
        value.bind(function(to) {
            $(".header-content .blog-desc").css("font-size", to + "px");
            $(".header-content .archive-description > p").css(
                "font-size",
                to + "px"
            );
        });
    });

    // Sidebars width
    wp.customize("left_sidebar_width", function(value) {
        value.bind(function(to) {
            $(".flexia-sidebar-left").css("width", to + "px");
        });
    });

    wp.customize("right_sidebar_width", function(value) {
        value.bind(function(to) {
            $(".flexia-sidebar-right").css("width", to + "px");
        });
    });

    // Header Area
    wp.customize("header_widget_area_bg_color", function(value) {
        value.bind(function(to) {
            $(".flexia-header-widget-area").css("background-color", to);
        });
    });

    wp.customize("flexia_topbar_bg_color", function(value) {
        value.bind(function(to) {
            $(".flexia-topbar").css("background-color", to);
        });
    });

    wp.customize("flexia_logobar_bg_color", function(value) {
        value.bind(function(to) {
            $(".flexia-logobar").css("background-color", to);
        });
    });

    wp.customize("flexia_navbar_bg_color", function(value) {
        value.bind(function(to) {
            $(".flexia-navbar").css("background-color", to);
        });
    });

    // Main nav
    wp.customize("flexia_main_nav_menu_link_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });

    wp.customize("flexia_main_nav_menu_link_hover_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });

    wp.customize("flexia_main_nav_menu_link_hover_bg", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    wp.customize("flexia_main_nav_menu_submenu_bg_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    wp.customize("flexia_main_nav_menu_submenu_link_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    wp.customize("flexia_main_nav_menu_submenu_link_hover_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    wp.customize("flexia_main_nav_menu_submenu_link_hover_bg", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    
    wp.customize("flexia_main_nav_menu_dropdown_animation", function(value) {
        value.bind(function(to) {
            $('.flexia-primary-menu').removeClass('flexia-menu-dropdown-animate-fade flexia-menu-dropdown-animate-to-top flexia-menu-dropdown-animate-zoom-in flexia-menu-dropdown-animate-zoom-out').addClass('flexia-menu-dropdown-animate-' + to)
        });
    });

    // Topbar nav
    wp.customize("flexia_top_nav_menu_link_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });

    wp.customize("flexia_top_nav_menu_link_hover_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });

    wp.customize("flexia_top_nav_menu_link_hover_bg", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    wp.customize("flexia_top_nav_menu_submenu_bg_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    wp.customize("flexia_top_nav_menu_submenu_link_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    wp.customize("flexia_top_nav_menu_submenu_link_hover_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    wp.customize("flexia_top_nav_menu_submenu_link_hover_bg", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    
    wp.customize("flexia_top_nav_menu_dropdown_animation", function(value) {
        value.bind(function(to) {
            $('.flexia-topbar-menu').removeClass('flexia-menu-dropdown-animate-fade flexia-menu-dropdown-animate-to-top flexia-menu-dropdown-animate-zoom-in flexia-menu-dropdown-animate-zoom-out').addClass('flexia-menu-dropdown-animate-' + to)
        });
    });

    // Search Overlay
    wp.customize("flexia_overlay_search_bg_color", function(value) {
        value.bind(function(to) {
            $(".flexia-search-overlay").css("background-color", to);
        });
    });

    wp.customize("flexia_overlay_search_close_btn_size", function(value) {
        value.bind(function(to) {
            $(".icon-search-close").css("width", to + "px");
            $(".icon-search-close").css("height", to + "px");
        });
    });

    wp.customize("flexia_overlay_search_close_btn_color", function(value) {
        value.bind(function(to) {
            $(".icon-search-close").css("fill", to);
        });
    });

    wp.customize("flexia_overlay_search_field_font_color", function(value) {
        value.bind(function(to) {
            $(
                ".search--input-wrapper .search__input, .search--input-wrapper .search__input:focus"
            ).css("color", to);
        });
    });

    wp.customize("flexia_overlay_search_field_font_size", function(value) {
        value.bind(function(to) {
            $(
                ".search--input-wrapper .search__input, .search--input-wrapper .search__input:focus"
            ).css("font-size", to + "px");
        });
    });

    wp.customize("flexia_overlay_search_label_font_color", function(value) {
        value.bind(function(to) {
            $(".search__info").css("color", to);
        });
    });

    wp.customize("flexia_overlay_search_label_font_size", function(value) {
        value.bind(function(to) {
            $(".search__info").css("font-size", to + "px");
        });
    });

    // Footer Area
    wp.customize("footer_widget_area_bg_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    
    wp.customize("footer_widget_area_content_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    
    wp.customize("footer_widget_area_link_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
    
    wp.customize("footer_widget_area_link_hover_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });

    wp.customize("flexia_footer_bg_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });

    wp.customize("flexia_footer_content_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });

    wp.customize("flexia_footer_link_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });

    wp.customize("flexia_footer_link_hover_color", function(value) {
        value.bind(function(to) {
            generateCSS();
        });
    });
})(jQuery);
