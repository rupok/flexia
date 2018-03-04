;(function($) {
	// Blog Content Display Excerpt Show/Hide
    wp.customize.bind( 'ready', function() {
        if( 'flexia_blog_content_display_full' === settings.flexia_blog_content_display ) {
            flexia_blog_cotnent_hide_controls();
        }else {
            flexia_blog_cotnent_show_controls();
        }

        wp.customize( 'flexia_blog_content_display', function( value ) {
            value.bind( function( to ) {
                if('flexia_blog_content_display_full' === to) {
                    flexia_blog_cotnent_hide_controls();
                }else {
                    flexia_blog_cotnent_show_controls();
                }
            } );
        } );

        function flexia_blog_cotnent_hide_controls() {
            $('#customize-control-flexia_blog_excerpt_count').hide();
        }
        function flexia_blog_cotnent_show_controls() {
            $('#customize-control-flexia_blog_excerpt_count').show();
        }
    });

    // Navbar Settings Show/Hide
    wp.customize.bind( 'ready', function() {
        if( 1 == settings.flexia_navbar ) {
            flexia_blog_cotnent_hide_controls();
        }else {
            flexia_blog_cotnent_show_controls();
        }

        wp.customize( 'flexia_navbar', function( value ) {
            value.bind( function( to ) {
                if(1 == to) {
                    flexia_blog_cotnent_hide_controls();
                }else {
                    flexia_blog_cotnent_show_controls();
                }
            } );
        } );

        function flexia_blog_cotnent_hide_controls() {
            $('#customize-control-flexia_navbar_position').hide();
            $('#customize-control-flexia_logobar_position').hide();
            $('#customize-control-flexia_logobar_bg_color').hide();
            $('#customize-control-flexia_navbar_bg_color').hide();
        }

        function flexia_blog_cotnent_show_controls() {
            $('#customize-control-flexia_navbar_position').show();
            $('#customize-control-flexia_logobar_position').show();
            $('#customize-control-flexia_logobar_bg_color').show();
            $('#customize-control-flexia_navbar_bg_color').show();
        }
    });

    // Topbar Settings Show/Hide
    wp.customize.bind( 'ready', function() {
        if( 1 == settings.flexia_enable_topbar ) {
            flexia_blog_cotnent_show_controls();
        }else {
            flexia_blog_cotnent_hide_controls();
        }

        wp.customize( 'flexia_enable_topbar', function( value ) {
            value.bind( function( to ) {
                if(1 == to) {
                    flexia_blog_cotnent_show_controls();
                }else {
                    flexia_blog_cotnent_hide_controls();
                }
            } );
        } );

        function flexia_blog_cotnent_hide_controls() {
            $('#customize-control-flexia_enable_topbar_menu').hide();
            $('#customize-control-flexia_topbar_bg_color').hide();
            $('#customize-control-flexia_topbar_content').hide();
        }

        function flexia_blog_cotnent_show_controls() {
            $('#customize-control-flexia_enable_topbar_menu').show();
            $('#customize-control-flexia_topbar_bg_color').show();
            $('#customize-control-flexia_topbar_content').show();
        }
    });

    wp.customize.bind( 'ready', function() {
        wp.customize( 'flexia_google_font_family', function( value ) {

            $.ajax({
                    url: settings.ajax_url,
                    data: {
                        action: 'load_google_font_variants',
                        postType: 'post',
                        fontFamily: settings.body_google_font
                    },
                    type: 'POST',
                    success: function( data ) {
                        var data = $.parseJSON(data);

                        $(data).each(function(i,val) {
                            $.each(val,function(key,val) {
                                  $('#customize-control-flexia_google_font_family_variants select').append($('<option>',
                                    {
                                        value: key,
                                        text : val
                                    }
                                ));
                            });
                        });
                    }
                });
            value.bind( function( to ) {
                $('#customize-control-flexia_google_font_family_variants select').html('');
                $.ajax({
                    url: settings.ajax_url,
                    data: {
                        action: 'load_google_font_variants',
                        postType: 'post',
                        fontFamily: to
                    },
                    type: 'POST',
                    success: function( data ) {
                        var data = $.parseJSON(data);

                        $(data).each(function(i,val) {
                            $.each(val,function(key,val) {
                                  $('#customize-control-flexia_google_font_family_variants select').append($('<option>',
                                    {
                                        value: key,
                                        text : val
                                    }
                                ));
                            });
                        });
                    }
                });
            });
        });
    });
})(jQuery);