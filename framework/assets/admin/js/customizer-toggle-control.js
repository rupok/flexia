/*
 * Script run inside a Customizer control sidebar
 *
 * Enable / disable the control title by toggeling its .disabled-control-title style class on or off. 
 */
(function($) {

    wp.customize.bind('ready', function() {
        if ('flexia_blog_content_layout_standard' === flexia_settings.flexia_blog_content_layout) {
            flexia_blog_cotnent_hide_controls();
        } else {
            flexia_blog_cotnent_show_controls();
        }

        wp.customize('flexia_blog_content_layout', function(value) {
            value.bind(function(to) {
                if ('flexia_blog_content_layout_standard' === to) {
                    flexia_blog_cotnent_hide_controls();
                } else {
                    flexia_blog_cotnent_show_controls();
                }
            });
        });

        function flexia_blog_cotnent_hide_controls() {
            jQuery('#customize-control-flexia_blog_grid_column').hide();
            jQuery('#customize-control-flexia_blog_filterable').hide();
            jQuery('#customize-control-flexia_blog_image_popup').hide();
            jQuery('#customize-control-flexia_blog_load_more').hide();
            jQuery('#customize-control-flexia_blog_per_page').hide();
            jQuery('#customize-control-flexia_blog_load_more_text').hide();
            jQuery('#customize-control-flexia_blog_loading_text').hide();
            jQuery('#customize-control-flexia_blog_categories').hide();
            jQuery('#customize-control-flexia_blog_post_meta').hide();
        }

        function flexia_blog_cotnent_show_controls() {
            jQuery('#customize-control-flexia_blog_grid_column').show();
            jQuery('#customize-control-flexia_blog_filterable').show();
            jQuery('#customize-control-flexia_blog_image_popup').show();
            jQuery('#customize-control-flexia_blog_load_more').show();
            jQuery('#customize-control-flexia_blog_per_page').show();
            jQuery('#customize-control-flexia_blog_load_more_text').show();
            jQuery('#customize-control-flexia_blog_loading_text').show();
            jQuery('#customize-control-flexia_blog_categories').show();
            jQuery('#customize-control-flexia_blog_post_meta').show();
        }

        /**
         * Gradient fields 
         */
        jQuery('.flexia-gradient').parent().addClass('flexia-gradient-control');
    });

    // Blog Content Display Excerpt Show/Hide
    wp.customize.bind("ready", function() {
        if ("flexia_blog_content_display_full" === flexia_settings.flexia_blog_content_display) {
            flexia_blog_cotnent_hide_controls();
        } else {
            flexia_blog_cotnent_show_controls();
        }

        wp.customize("flexia_blog_content_display", function(value) {
            value.bind(function(to) {
                if ("flexia_blog_content_display_full" === to) {
                    flexia_blog_cotnent_hide_controls();
                } else {
                    flexia_blog_cotnent_show_controls();
                }
            });
        });

        function flexia_blog_cotnent_hide_controls() {
            $("#customize-control-flexia_blog_excerpt_count").hide();
        }

        function flexia_blog_cotnent_show_controls() {
            $("#customize-control-flexia_blog_excerpt_count").show();
        }
    });

    // Flexia Google Fonts Controllers
    wp.customize.bind("ready", function() {
        flexia_customizer_font_variants_generator(
            "flexia_body_font_family",
            "#customize-control-flexia_body_font_variants",
            "#customize-control-flexia_body_font_subsets",
            "body_google_font",
            "flexia_body_font_variants",
            "flexia_body_font_subsets"
        );

        flexia_customizer_font_variants_generator(
            "flexia_paragraph_font_family",
            "#customize-control-flexia_paragraph_font_variants",
            "#customize-control-flexia_paragraph_font_subsets",
            "paragraph_google_font",
            "flexia_paragraph_font_variants",
            "flexia_paragraph_font_subsets"
        );

        flexia_customizer_font_variants_generator(
            "flexia_heading_font_family",
            "#customize-control-flexia_heading_font_variants",
            "#customize-control-flexia_heading_font_subsets",
            "heading_google_font",
            "flexia_heading_font_variants",
            "flexia_heading_font_subsets"
        );

        flexia_customizer_font_variants_generator(
            "flexia_link_font_family",
            "#customize-control-flexia_link_font_variants",
            "#customize-control-flexia_link_font_subsets",
            "link_google_font",
            "flexia_link_font_variants",
            "flexia_link_font_subsets"
        );

        flexia_customizer_font_variants_generator(
            "flexia_button_font_family",
            "#customize-control-flexia_button_font_variants",
            "#customize-control-flexia_button_font_subsets",
            "button_google_font",
            "flexia_button_font_variants",
            "flexia_button_font_subsets"
        );

    });

    function flexia_customizer_font_variants_generator(
        font_field_name,
        variant_field_id,
        subset_field_id,
        font_field_localize_name,
        font_variant_field_localize_name,
        font_subset_field_localize_name
    ) {
        wp.customize(font_field_name, function(value) {
            $.ajax({
                url: flexia_settings.ajax_url,
                data: {
                    action: "load_google_font_variants",
                    postType: "post",
                    fontFamily: flexia_settings[font_field_localize_name]
                },
                type: "POST",
                success: function(data) {
                    var data = $.parseJSON(data);

                    $(data.variants).each(function(i, val) {
                        $.each(val, function(key, val) {
                            if (
                                key ==
                                flexia_settings[
                                    font_variant_field_localize_name
                                ]
                            ) {
                                var selected = "selected";
                            } else {
                                var selected = "";
                            }
                            $(variant_field_id + " select").append(
                                '<option value="' +
                                key +
                                '" ' +
                                selected +
                                ">" +
                                val +
                                "</option>"
                            );
                        });
                    });

                    $(data.subsets).each(function(i, val) {
                        $.each(val, function(key, val) {
                            if (
                                key ==
                                flexia_settings[font_subset_field_localize_name]
                            ) {
                                var selected = "selected";
                            } else {
                                var selected = "";
                            }
                            $(subset_field_id + " select").append(
                                '<option value="' +
                                key +
                                '" ' +
                                selected +
                                ">" +
                                val +
                                "</option>"
                            );
                        });
                    });
                }
            });
            value.bind(function(to) {
                $(variant_field_id + " select").html("");
                $(subset_field_id + " select").html("");
                $.ajax({
                    url: flexia_settings.ajax_url,
                    data: {
                        action: "load_google_font_variants",
                        postType: "post",
                        fontFamily: to
                    },
                    type: "POST",
                    success: function(data) {
                        var data = $.parseJSON(data);
                        $(data.variants).each(function(i, val) {
                            $.each(val, function(key, val) {
                                $(variant_field_id + " select").append(
                                    $("<option>", {
                                        value: key,
                                        text: val
                                    })
                                );
                            });
                        });
                        $(data.subsets).each(function(i, val) {
                            $.each(val, function(key, val) {
                                $(subset_field_id + " select").append(
                                    $("<option>", {
                                        value: key,
                                        text: val
                                    })
                                );
                            });
                        });
                    }
                });
            });
        });
    }
})(jQuery);