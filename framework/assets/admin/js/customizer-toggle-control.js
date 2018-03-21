/*
 * Script run inside a Customizer control sidebar
 *
 * Enable / disable the control title by toggeling its .disabled-control-title style class on or off.
 */
( function( $ ) {
	wp.customize.bind( 'ready', function() { // Ready?

		var customize = this; // Customize object alias.
		// Array with the control names
		// TODO: Replace #CONTROLNAME01#, #CONTROLNAME02# etc with the real control names.
		var toggleControls = [
			'#CONTROLNAME01#',
			'#CONTROLNAME02#'
		];
		$.each( toggleControls, function( index, control_name ) {
			customize( control_name, function( value ) {
				var controlTitle = customize.control( control_name ).container.find( '.customize-control-title' ); // Get control  title.
				// 1. On loading.
				controlTitle.toggleClass('disabled-control-title', !value.get() );
				// 2. Binding to value change.
				value.bind( function( to ) {
					controlTitle.toggleClass( 'disabled-control-title', !value.get() );
				} );
			} );
		} );
	} );

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

    // Flexia Google Fonts Controllers
    wp.customize.bind( 'ready', function() {
        flexia_customizer_font_variants_generator( 'flexia_google_font_family', '#customize-control-flexia_google_font_family_variants', '#customize-control-flexia_google_font_family_subsets', 'body_google_font', 'body_font_variants', 'body_font_subsets' );

        flexia_customizer_font_variants_generator( 'flexia_heading_font_family', '#customize-control-flexia_heading_font_family_variants', '#customize-control-flexia_heading_font_family_subsets', 'heading_google_font', 'heading_font_variants', 'heading_font_subsets' );
    });
    function flexia_customizer_font_variants_generator( font_field_name, variant_field_id, subset_field_id, font_field_localize_name, font_variant_field_localize_name, font_subset_field_localize_name ) {
        wp.customize( font_field_name, function( value ) {
            $.ajax({
                url: settings.ajax_url,
                data: {
                    action: 'load_google_font_variants',
                    postType: 'post',
                    fontFamily: settings[font_field_localize_name]
                },
                type: 'POST',
                success: function( data ) {
                    var data = $.parseJSON(data);

                    $(data.variants).each(function(i,val) {
                        $.each(val,function(key,val) {
                            if( key == settings[font_variant_field_localize_name] ) {
                                var selected = 'selected';
                            }else {
                                var selected = '';
                            }
                            $(variant_field_id+' select').append('<option value="'+key+'" '+selected+'>'+val+'</option>')
                        });
                    });

                    $(data.subsets).each(function(i,val) {
                        $.each(val,function(key,val) {
                            if( key == settings[font_subset_field_localize_name] ) {
                                var selected = 'selected';
                            }else {
                                var selected = '';
                            }
                            $(subset_field_id+' select').append('<option value="'+key+'" '+selected+'>'+val+'</option>')
                        });
                    });
                }
            });
            value.bind( function( to ) {
                $(variant_field_id+' select').html('');
                $(subset_field_id+' select').html('');
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
                        $(data.variants).each(function(i,val) {
                            $.each(val,function(key,val) {
                                  $(variant_field_id+' select').append($('<option>',
                                    {
                                        value: key,
                                        text : val
                                    }
                                ));
                            });
                        });
                        $(data.subsets).each(function(i,val) {
                            $.each(val,function(key,val) {
                                  $(subset_field_id+' select').append($('<option>',
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
    }
} )( jQuery );
